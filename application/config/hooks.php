<?php

use Dotenv\Dotenv;

// use Dotenv\Dotenv\Repository\RepositoryBuilder;

defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/userguide3/general/hooks.html
|
*/

$hook['post_controller_constructor'][] = array(
    'class'    => 'ProfilerEnabler',
    // 'function' => 'enableProfiler',
    'filename' => 'hooks.profiler.php',
    'filepath' => 'hooks',
    'params'   => array()
);

$hook['pre_system'] = function () {
    $dotenv = Dotenv::createImmutable('./');
    $dotenv->load();

    // var_dump(env('DB_HOSTNAME_OO'));

    // putenv('DB_HOSTNAME_OO=' . $_ENV['DB_HOSTNAME_OO']);
    // putenv('DB_USERNAME_OO=' . $_ENV['DB_USERNAME_OO']);
    // putenv('DB_PASSWORD_OO=' . $_ENV['DB_PASSWORD_OO']);
    // putenv('DB_DATABASE_OO=' . $_ENV['DB_DATABASE_OO']);
    // putenv('DB_DRIVER_OO=' . $_ENV['DB_DRIVER_OO']);

    // putenv('DB_HOSTNAME_BC=' . $_ENV['DB_HOSTNAME_BC']);
    // putenv('DB_USERNAME_BC=' . $_ENV['DB_USERNAME_BC']);
    // putenv('DB_PASSWORD_BC=' . $_ENV['DB_PASSWORD_BC']);
    // putenv('DB_DATABASE_BC=' . $_ENV['DB_DATABASE_BC']);
    // putenv('DB_DRIVER_BC=' . $_ENV['DB_DRIVER_BC']);

    // putenv('SECRET_KEY=' . $_ENV['SECRET_KEY']);
    // putenv('TIME_T0_LIVE=' . $_ENV['TIME_T0_LIVE']);

    // var_dump(getenv('DB_HOSTNAME_OO'));
    // var_dump($_ENV['DB_HOSTNAME_OO']);
};
