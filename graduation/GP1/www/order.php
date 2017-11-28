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

use PHPMailer\PHPMailer\PHPMailer;
use Illuminate\Database\Capsule\Manager as Capsule;
use Intervention\Image;

require_once 'classes.php';

// check Recaptcha



$r = new recap($fields);

if ($r->check()) {


    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

        $email = $_POST['email'];
        $user_id = User::firstOrNewId(['email' => $email]);
     
        $vardata = prepareJson();            
            
        $order = new Order;
        $order->user_id = $user_id;
        $order->varinfo = $vardata;
        $order->save();



// Counting orders
        $orders = Order::where('user_id', $user_id)
        ->count();


        $thanks = "Ваш заказ был отправлен! ";

        if ($orders == 1) {
            $thanks .= "Спасибо - это ваш первый заказ!";
        } else {
            $thanks .= "Спасибо! Это уже " . $orders . " заказ";
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

        $mailbody = '<h2>Дорогой друг!</h2>
<p>Только что, некто по имени - <strong>' . $_POST['name'] . '</strong> заказал восхитетельный бургер!</p>
<p>Его нужно доставить по адресу - ' . $adres . '</p>
<blockquote>
	<p align="center"><b>Поторопись-ка! Клиент не собирается долго ждать!</b></p>
	<p align="center"><b><img alt="Парис Хилтон" height="449" src="http://ic.pics.livejournal.com/malinina_sasha/73968006/1517426/1517426_800.jpg" width="800"></b></p>
</blockquote>
<p align="right">Твой бургерный лендинг!</p>
';

        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.yandex.ru';
            $mail->SMTPAuth = true;
            $mail->Username = 'awesome.student';
            $mail->Password = 'cjhjrlbrb[j,tpmzy';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->CharSet = "UTF-8";

            //Recipients
            $mail->setFrom('awesome.student@yandex.ru', 'Лофтскульный');
            $mail->addAddress('yastroitel@gmail.com', 'Антон');
            $mail->addReplyTo('awesome.student@yandex.ru', 'Лофтскульный');

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Дзынь! Заказан бургер';
            $mail->Body = $mailbody;
            $mail->AltBody = 'Это письмо для HTML';

            $mail->send();
            echo $thanks;
        } catch (Exception $e) {
            echo 'Мы не смогли отправить письмо. Звоните по телефону!';
        }
    } else {
        echo "Вы ввели некорректный адрес электронной почты";
        print_r($_FILES);
    }
} else {

    echo "Извините, вы не прошли проверку на робота!";
}