<?php
/*
 *  
 *     Homework PHP LoftSchool
 *     Student: Braslavskii Anton
 *     Email: yastroitel@gmail.com
 *  
*/
require_once '../config.inc';
require_once '../class.php';
$db = Db::getInstance($dsn, $dbuser, $pass, $opt);
setcookie("DELETE", "", 1, "/");

if (password_verify($secret, $_COOKIE['DELETE'])) {
    $id = (int)$_GET['id'];
    $set[] = $id;
    $sql = "DELETE FROM users WHERE id=?";
    $res = $db->querySql($sql, $set, FALSE, TRUE);
    $path = $_SERVER['DOCUMENT_ROOT'] . "/homework/homework04/photos/" . $id . ".jpg";
    $temp = unlink(realpath($path));
    header("location: ../list.html");

}
else {
    header("location: ../index.html");
}