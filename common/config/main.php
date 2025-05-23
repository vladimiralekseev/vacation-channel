<?php

use dmstr\cookieconsent\components\CookieConsentHelper;
use webvimark\modules\UserManagement\UserManagementModule;

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cookieConsentHelper' => [
            'class' => CookieConsentHelper::class
        ],
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
    ],
    'modules' => [
        'user-management' => [
            'class'           => UserManagementModule::class,

//            'on beforeAction' => static function (yii\base\ActionEvent $event) {
//                if ($event->action->uniqueId === 'user-management/auth/login') {
//                    $event->action->controller->layout = 'loginLayout.php';
//                }
//            },
        ],
    ]
];
