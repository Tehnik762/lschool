<?php
/*
 *  
 *     Homework PHP LoftSchool
 *     Student: Braslavskii Anton
 *     Email: yastroitel@gmail.com
 *  
*/

require_once 'config.inc';
require_once 'class.php';

$user = new User();
$db = Db::getInstance($dsn, $dbuser, $pass, $opt);
$auth = $user->checkAuth($_COOKIE);

$auth_cookie = password_hash($secret, PASSWORD_DEFAULT);
setcookie("DELETE", $auth_cookie, time()+600, "/");