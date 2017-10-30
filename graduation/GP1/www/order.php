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

$stmt = $pdo->prepare('SELECT name, id FROM users WHERE email = ?');
$stmt->execute(array($_POST['email']));

// Testing existence of user

$res = $stmt->fetch();

if (!$res) {
    // There is no such user
    $stmt = $pdo->prepare('INSERT INTO users (email, name, phone) VALUES (?, ?, ?)');
    $stmt->execute(array($_POST['email'], $_POST['name'], $_POST['phone']));
    $user_id = $pdo->lastInsertId();
} else {
    $user_id = $res['id'];
}

// Adding order

$vardata = array(
    "street" => $_POST['street'],
    "home" => $_POST['home'],
    "part" => $_POST['part'],
    "appt" => $_POST['appt'],
    "floor" => $_POST['floor'],
    "comment" => $_POST['comment'],
    "callback" => $_POST['callback'],
    "payment" => $_POST['payment'],
    "payment_card" => $_POST['payment_card']
);
$vardata = json_encode($vardata);

$sql = 'INSERT INTO orders (user_id, varinfo) VALUES (?, ?)';
$stmt = $pdo->prepare($sql);
$stmt->execute(array($user_id, $vardata));
$order_id = $pdo->lastInsertId();


// Counting orders
$sql = "SELECT COUNT(*) FROM orders WHERE user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute(array($user_id));
$orders = $stmt->fetchColumn();

if ($orders == 1) {
    $thanks = "Спасибо - это ваш первый заказ!";
} else {
    $thanks = "Спасибо! Это уже " . $orders . " заказ";
}
$adres = "Улица: " . $_POST['street'] . " 
Дом: " . $_POST['home'] . "
Корпус: " . $_POST['part'] . "
Квартира: " . $_POST['appt'] . "
Этаж: " . $_POST['floor'];


$template = "Заказ №" . $order_id . "
     
Ваш заказ будет доставлен по адресу:
" . $adres . "
DarkBeefBurger за 500 рублей, 1 шт
" . $thanks;

$filename = time() . ".txt";
file_put_contents("mail/" . $filename, $template);
echo $thanks;
