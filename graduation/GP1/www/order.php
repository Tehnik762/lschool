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



// check Recaptcha

class recap
{

    private $url = "https://www.google.com/recaptcha/api/siteverify";
    private $result;

    public function __construct($fields)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $fields);
        $this->result = curl_exec($curl);
        curl_close($curl);
    }

    public function check()
    {

        $this->result = json_decode($this->result, true);

        //reCaptcha введена

        if ($this->result['success']) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

$fields = "secret=6Ld9FjkUAAAAAKVG9Rtlz1MpnuqBhSdNXLaHmJIt&response=" . $_POST['g-recaptcha-response'];

$r = new recap($fields);

if ($r->check()) {

    
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
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
<p>Только что, некто по имени - <strong>'.$_POST['name'].'</strong> заказал восхитетельный бургер!</p>
<p>Его нужно доставить по адресу - '. $adres . '</p>
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
    $mail->Body    = $mailbody;
    $mail->AltBody = 'Это письмо для HTML';

    $mail->send();
    echo $thanks;
} catch (Exception $e) {
    echo 'Мы не смогли отправить письмо. Звоните по телефону!';

}
    
     
    
    
} else {
    echo "Вы ввели некорректный адрес электронной почты";
}
    }

else {

    echo "Извините, вы не прошли проверку на робота!";
}