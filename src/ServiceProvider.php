<?php

namespace Jason\Sms;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{

    /**
     * 部署时加载
     * @Author:<C.Jason>
     * @Date:2018-06-22T16:01:20+0800
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../config/config.php' => config_path('sms.php')], 'sms');
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations/');
        }

        /**
         * 短信验证码验证
         */
        Validator::extend('sms_check', function ($attribute, $code, $parameters) {
            if (empty($code)) {
                return false;
            }
            $mobileFiled = $parameters[0] ?? 'mobile';
            $channel     = $parameters[1] ?? 'DEFAULT';
            $mobile      = request()->input($mobileFiled);

            return \Sms::check($mobile, $code, $channel);
        });
    }

    /**
     * 注册服务提供者
     * @Author:<C.Jason>
     * @Date:2018-06-22T16:01:12+0800
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'sms');
    }

}
