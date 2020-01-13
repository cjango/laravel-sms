<?php

namespace Jason\Sms;

use Jason\Sms\Exceptions\SmsSendException;
use Jason\Sms\Models\Sms as SmsModel;
use Illuminate\Support\Facades\DB;
use Overtrue\EasySms\EasySms;

class Sms
{

    /**
     * 发送短信
     * @Author:<C.Jason>
     * @Date:2018-11-07T14:25:37+0800
     * @param string $mobile 手机号码
     * @param string $channel 验证通道
     * @return [type] [description]
     */
    public function send(string $mobile, string $channel = 'DEFAULT')
    {
        try {
            $config = config('sms');

            if (!isset($config['template'][$channel]) || empty($config['template'][$channel])) {
                throw new SmsSendException('不合法的验证通道');
            }

            DB::transaction(function () use ($mobile, $channel, $config) {

                $code = sprintf("%0" . $config['length'] . "d", mt_rand(1, pow(10, $config['length']) - 1));

                if ($config['debug'] != true) {
                    $easySms = new EasySms($config);
                    $easySms->send($mobile, [
                        'template' => $config['template'][$channel],
                        'data'     => [
                            'code' => $code,
                        ],
                    ]);
                }

                SmsModel::create([
                    'mobile'  => $mobile,
                    'channel' => $channel,
                    'code'    => $code,
                ]);
            });

            return true;
        } catch (\Exception $e) {
            throw new SmsSendException($e->getMessage());
        }
    }

    /**
     * 验证短信
     * @Author:<C.Jason>
     * @Date:2018-11-07T14:26:38+0800
     * @param string $mobile [description]
     * @param string $code [description]
     * @param string $channel [description]
     * @return
     */
    public function check(string $mobile, string $code, string $channel = 'DEFAULT')
    {
        $Sms = SmsModel::where('mobile', $mobile)->where('channel', $channel)->orderBy('id', 'desc')->first();

        if ($Sms) {
            if ($Sms->code == $code) {
                if ($Sms->used == 1 && config('sms.once_used') && config('sms.debug') == false) {
                    return false;
                }
                $Sms->used = 1;
                $Sms->save();
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
