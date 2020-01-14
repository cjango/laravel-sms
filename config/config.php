<?php

return [

    // 模拟调试，不会真正发送验证码，验证后也不会失效
    'debug'     => true,

    // 调试模式发送的验证码
    'debug_code' => '0000',

    // HTTP 请求的超时时间（秒）
    'timeout'   => 5.0,

    // 默认发送配置
    'default'   => [
        // 网关调用策略，默认：顺序调用
        'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,
        // 默认可用的发送网关
        'gateways' => [
            'aliyun',
        ],
    ],

    // 验证码长度
    'length'    => 4,

    // 验证后立即失效
    'once_used' => true,

    // 模板与通道映射
    'template'  => [
        'DEFAULT'  => '',
        'LOGIN'    => '',
        'REGISTER' => '',
    ],

    // 可用的网关配置
    'gateways'  => [
        'errorlog'   => [
            'file' => storage_path('logs/easy-sms.log'),
        ],
        // 阿里云 AccessKeyID：
        'aliyun'     => [
            'access_key_id'     => '',
            'access_key_secret' => '',
            'sign_name'         => '',
        ],
        // 阿里云Rest
        'aliyunrest' => [
            'app_key'        => '',
            'app_secret_key' => '',
            'sign_name'      => '',
        ],
        // 云片
        'yunpian'    => [
            'api_key'   => '',
            'signature' => '',
        ],
        // ...  具体参数请参考 https://github.com/overtrue/easy-sms/blob/master/README.md
    ],
];
