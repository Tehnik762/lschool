<?php
/*
 *  
 *     Homework PHP LoftSchool
 *     Student: Braslavskii Anton
 *     Email: yastroitel@gmail.com
 *  
 */

$header = array("Пользователь(логин)", "Имя", "возраст", "описание", "Фотография", "Действия");

echo render::tableHeader($header);

$sql = "SELECT login, name, age, description, photo, id FROM users WHERE 1";
$set = array();
$res = $db->querySqlAll($sql, $set);

foreach ($res as $value) {

        $age = time() - $value['age'];
        $age = floor($age / (60 * 60 * 24 * 365)) . " лет";

    $href = "<a href='includes/user_delete.php?id={$value['id']}'>Удалить пользователя</a>";
    if (!empty($value['photo'])) {
        $photo = "<img src='http://" . $_SERVER['HTTP_HOST'] . "/homework/homework04" . $value['photo'] . "'/>";
    }


    $arr = array($value['login'], $value['name'], $age, $value['description'], $photo, $href);

    echo render::string($arr);
    unset($photo);
    unset($age);
}





echo render::tableEnd();

?>


