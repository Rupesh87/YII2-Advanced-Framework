<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableSession' => false,
            'loginUrl' => null
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
//        'urlManager' => [
//            'enablePrettyUrl' => false,
////            'enableStrictParsing' => true,
//            'showScriptName' => false,
//            'rules' => [
//                ['class' => 'yii\rest\UrlRule', 'controller' => 'user'],
//            ],
//        ],
        'urlManager'=>array(
//            'urlFormat'=>'path',
            'enableStrictParsing' => false,
            'showScriptName' => false,
            'rules'=>array(
                'post/<id:\d+>/<title:.*?>'=>'post/view',
                'posts/<tag:.*?>'=>'post/index',
                // REST patterns
                array('company/list', 'pattern'=>'company/<model:\w+>', 'verb'=>'GET'),
                array('company/view', 'pattern'=>'company/<model:\w+>/<id:\d+>', 'verb'=>'GET'),
                array('company/update', 'pattern'=>'company/<model:\w+>/<id:\d+>', 'verb'=>'PUT'),
                array('company/delete', 'pattern'=>'company/<model:\w+>/<id:\d+>', 'verb'=>'DELETE'),
                array('company/create', 'pattern'=>'company/<model:\w+>', 'verb'=>'POST'),
                // Other controllers
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ),
        ),
    ],
    'params' => $params,
];
