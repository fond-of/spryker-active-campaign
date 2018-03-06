<?php

use Spryker\Shared\Config\Environment;

require_once __DIR__ . '/../vendor/autoload.php';

define('APPLICATION_ENV', Environment::TESTING);
define('APPLICATION_STORE', 'UNIT');

$x = \org\bovigo\vfs\vfsStream::setup('root', null, [
    'config' => [
        'Shared' => [
            'stores.php' => file_get_contents(codecept_data_dir('stores.php')),
            'config_default.php' => file_get_contents(codecept_data_dir('config_default.php')),
        ],
    ],
]);

define('APPLICATION_ROOT_DIR', $x->url());
