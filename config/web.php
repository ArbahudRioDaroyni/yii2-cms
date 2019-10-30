<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'bootstrap' => [],//admin
    'components' => [
        'assetsAutoCompress' =>
        [
            'class' => '\iisns\assets\AssetsCompressComponent',
            'enabled'           => true,
            'jsCompress'        => true,
            'cssFileCompile'    => true,
            'jsFileCompile'     => true,
        ],
		'view' => [
            'theme' => [
              'pathMap' => [
                 '@dektrium/user/views' => '@app/themes/adminlte/user',
              ],
            ],
        ],   
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'iiMX2qWn0MmQSGnFwGj0PQ6v3Cfx6SWA',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhpManager'
            'defaultRoles' => ['Guest'], //role biasa
        ],
        'errorHandler' => [
            'errorAction' => 'site/index',
        ],
        'mailer'=>[
            'class' => 'yii\swiftmailer\Mailer',
			'useFileTransport' => true,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'serverus1.computesta.com',
                'username' => 'test@project.computesta.com',
                'password' => 'test123!',
                'port' => '465',
                'encryption' => 'ssl',
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                    [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
    
      'urlManager' => [
		'enablePrettyUrl' => true,
		'showScriptName' => false,
		'rules' => [
			['class' => 'app\components\UrlRule'],
			'user/login'=>'useradmin/security/login',
                        'sitemap.xml'=>'site/sitemap',
		],
      ],
     
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
			'doctor/*',
            'proposal/*',
            'search/*',
            //'admin/*', //untuk setting role admin diawal
            //'user/*', //untuk setting user diawal
			'gii/*',
			//'backend/*',
        ]
    ],
    'modules' => [
        'user' => [
            //'class' => 'app\modules\user\Module',
			'class'=>'dektrium\user\Module',
            'admins' => ['admin'], //['admin'] harus sesuai dengan username
		],
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => '@app/themes/adminlte/layouts/main',
        ],
		'backend'=>[
			'class'=> 'app\modules\backend\Module'
		],
		'gridview' => [ 'class' => '\kartik\grid\Module' ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
            // uncomment the following to add your IP if you are not connecting from localhost.
            //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '192.168.178.20'],
        'generators' => [
            'computestaModel' => [
                'class' => 'app\components\gii\model\Generator',
                'templates' => [
                    'computesta' => '@app/components/gii/model/default',
                ]
            ],
            'computestaAjaxcrud' => [
                'class' => 'app\components\gii\ajaxcrud\Generator',
                'templates' => [
                    'computestaAjaxcrud' => '@app/components/gii/ajaxcrud/default',
                ]
            ]
        ],
    ];
}

return $config;
