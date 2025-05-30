<?php

use yii\bootstrap\BootstrapAsset;
use yii\bootstrap\BootstrapPluginAsset;
use yii\web\AssetManager;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id'                  => 'app-frontend',
    'basePath'            => dirname(__DIR__),
    'bootstrap'           => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components'          => [
        'request'      => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user'         => [
            'identityClass'   => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie'  => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session'      => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'assetManager' => [
            'class'   => AssetManager::class,
            'bundles' => [
                BootstrapAsset::class       => [
                    'css' => [
                        'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css',
                    ],
                ],
                BootstrapPluginAsset::class => [
                    'js' => [
                        'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js',
                    ],
                ]
            ]
        ],
        'urlManager'   => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'suffix'          => '/',
            'rules'           => [
                '/'                                   => 'site/index',
                '/search-on-main'                     => 'site/search',
                '/about'                              => 'site/about',
                '/cookies-policy/'					  => 'site/cookies-policy',
                '/programming'                        => 'programming/index',
                '/schedule/show'                      => 'schedule/show',
                '/schedule/show-print'                => 'schedule/show-print',
                '/schedule/show-schedule'             => 'schedule/show-schedule',
                '/schedule/attraction'                => 'schedule/attraction',
                '/schedule/attraction-print'          => 'schedule/attraction-print',
                '/schedule/attraction-schedule'       => 'schedule/attraction-schedule',
                '/c/<code:[\w\d\-]+>'                 => 'category/detail',
                '/<code:[\w\d\-]+>/search'            => 'category/search',
                '/<sCode:[\w\d\-]+>/<videoCode:[\w\d\-]+>' => 'video/detail',
            ]
        ],
    ],
    'params'              => $params,
];
