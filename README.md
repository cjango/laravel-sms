# AsLong/Sms 短信发送扩展

## 安装

```
$ composer require jasonc/sms
```

## 短信发送

```
\Sms::send($mobile, $channel = 'DEFAULT');
```


## 短信验证

```
\Sms::check($mobile, $code, $channel = 'DEFAULT');
```


扩展验证规则

```
sms_check:MOBILEFIELD,CHANNEL  短信验证码验证

MOBILEFIELD：手机号码字段名称
CHANNEL：验证通道
```
