<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],

    'aliases' => [

        //xml
        '@ftpXml' => 'xml',
        '@localXml' => '@frontend/web/xml',


        //images
        '@ftpProductsImg' => 'images/products',
        '@localProductsImg' => '@frontend/web/images/products/gallery',

        '@ftpContentImg' => 'images/content',
        '@localContentImg' => '@frontend/web/images/content',

        '@ftpCatalogsImg' => 'images/catalogs',
        '@localCatalogsImg' => '@frontend/web/images/catalogs/gallery',

        '@localFiles' => '@app/files',






    ],

    'components' => [

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
    ],
    'params' => $params,
];
