<?php
define('APP_PUBLIC', getcwd());
chdir(dirname(__DIR__));
define('APP_ROOT', getcwd());
define('APP_PATH', APP_ROOT . '/app/b2c');

date_default_timezone_set('Asia/Chongqing');

$app = new Yaf_Application(APP_PATH . "/config/default.ini");
$app->bootstrap()->run();
