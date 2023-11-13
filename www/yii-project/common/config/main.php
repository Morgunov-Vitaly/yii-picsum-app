<?php

use yii\caching\FileCache;

return [
    'name' => 'Yii Picsum',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@frontendDomain' => 'http://localhost:82',
        '@backendDomain' => 'http://admin.localhost:82',
    ],
    'vendorPath' => dirname(__DIR__, 2) . '/vendor',
    'components' => [
        'cache' => [
            'class' => FileCache::class,
        ],
    ],
];
