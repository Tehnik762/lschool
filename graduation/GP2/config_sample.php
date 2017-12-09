<?php
namespace MVC;
$db = '';
$user = '';
$password = '';

// MAKING ROOT PATH
$root = "http://".$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];
$root = str_replace("index.php", "", $root);\
define(ROOT, $root);

