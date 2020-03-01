<?php
define('ROOT', __DIR__);
define('DB_ONLINE', true);
require ROOT . '/../include/setting.php';
require ROOT . '/function.php';


$_APP_NAME = 'cms';
$_APP_URL = $_SERVER['CONTEXT_PREFIX'] . '/' . $_APP_NAME;
$_APP_EDITOR = $_SERVER['CONTEXT_PREFIX'] . '/' . 'kindeditor';
$_APP_STATIC = $_APP_URL . '/' . 'static';


adminLoginCheck();
?>