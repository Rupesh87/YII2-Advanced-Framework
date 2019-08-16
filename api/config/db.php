<?php

return [
    'mongodb' => [
        'class' => '\yii\mongodb\Connection',
        'dsn' => 'mongodb://@localhost:27017/testdb',
        'options' => [
            "username" => "username",
            "password" => "password"
        ]
    ],
];