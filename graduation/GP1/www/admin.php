<?php
/*
 *  
 *     Graduation Project PHP LoftSchool
 *     Student: Braslavskii Anton
 *     Email: yastroitel@gmail.com
 *  
 */
require_once 'vendor/autoload.php';
require_once 'config.inc';

use Illuminate\Database\Capsule\Manager as Capsule;

require_once 'classes.php';

function makeTable($array)
{
    $res = "<table border ='1' cellpadding=\"7\"><tr>";
    foreach ($array as $value) {
        $res .= "<td><b>" . $value . "</b></td>";
    }
    $res .= "</tr>";
    return $res;
}

function makeString($array, $av = FALSE)
{
    $res = "<tr>";
    foreach ($array as $key => $value) {
        if ($key=="avatar" AND !empty($value) AND $av) {
            $res .= "<td><img src='" . $value . "'/></td>";
        } else {
        $res .= "<td>" . $value . "</td>";
        }
    }
    $res .= "</tr>";
    return $res;
}
echo "<h3>Список пользователей системы</h3>";



$head = ["ID", "Email", "Имя", "Телефон", "IP", "Аватар"];
echo makeTable($head);

$users = User::all();

foreach ($users as $user) {
    echo makeString($user->toArray(), TRUE);
}



echo "</table>";

echo "<h3>Список заказов системы</h3>";

echo "<div style='padding:10px; margin:10px;'><a href='edit.php?action=create' style='padding:5px; border:1px dotted red;background-color:black; color: white; border-radius:2px;'>Добавить новый</a></div>";

$head = ["ID заказа", "Имя клиента", "Редактировать"];
echo makeTable($head);


$orders = Order::select('orders.id', 'users.name')
        ->leftJoin('users', 'orders.user_id', '=', 'users.id')->get()->toArray();



foreach ($orders as $order) {
    $order[] = '<a href="edit.php?action=edit&id=' . $order['id'] . '"/>Отредактировать</a>';
    echo makeString($order);
}

echo "</table>";
