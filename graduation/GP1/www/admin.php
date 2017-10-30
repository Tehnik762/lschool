<?php
/*
 *  
 *     Graduation Project PHP LoftSchool
 *     Student: Braslavskii Anton
 *     Email: yastroitel@gmail.com
 *  
 */

require_once 'config.inc';

$pdo = new PDO($dsn, $user, $pass, $opt);

function makeTable($array)
{
    $res = "<table border ='1' cellpadding=\"7\"><tr>";
    foreach ($array as $value) {
        $res .= "<td><b>" . $value . "</b></td>";
    }
    $res .= "</tr>";
    return $res;
}

function makeString($array)
{
    $res = "<tr>";
    foreach ($array as $value) {
        $res .= "<td>" . $value . "</td>";
    }
    $res .= "</tr>";
    return $res;
}
echo "<h3>Список пользователей системы</h3>";

$head = ["ID", "Имя", "Email"];
echo makeTable($head);

$sql = "SELECT id, name, email FROM users WHERE 1";
$stmt = $pdo->prepare($sql);
$stmt->execute();

while ($row = $stmt->fetch()) {

    echo makeString($row);
}

echo "</table>";

echo "<h3>Список заказов системы</h3>";

$head = ["ID заказа", "Имя клиента"];
echo makeTable($head);
$sql = "SELECT orders.id, users.name FROM orders LEFT JOIN users ON orders.user_id=users.id WHERE 1";
$stmt = $pdo->prepare($sql);
$stmt->execute();

while ($row = $stmt->fetch()) {

    echo makeString($row);
}

echo "</table>";
