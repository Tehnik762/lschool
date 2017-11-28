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

$voc = [
    "street" => "Улица",
    "home" => "Дом",
    "part" => "Корпус",
    "appt" => "Квартира",
    "floor" => "Этаж",
    "comment" => "Комментарий",
    "callback" => "Требуется звонить?",
    "payment" => "Нужна сдача",
    "payment_card" => "Оплата картой"
];


switch ($_GET['action']) {
    case 'edit':
        $id = (int) $_GET['id'];
        $user = new Order();
        $user = $user->find($id)->toArray();

        echo '<form action="edit.php?action=update" method="POST">';
        echo '<input type="hidden" value="' . $id . '" name="id"/>';
        echo 'ID пользователя, сделавшего заказ <br/><input type="text" name="user_id" value="' . $user['user_id'] . '"/><br/>';

        $vardata = json_decode($user['varinfo'], TRUE);
        foreach ($vardata as $key => $value) {
            echo $voc[$key] . "<br/>";
            switch ($key) {
                case 'comment':
                    echo '<textarea name="comment">' . $value . '</textarea><br/>';

                    break;
                case "callback":
                case "payment":
                case "payment_card":
                    if ($value == "true") {
                        $check = ' value="true" checked';
                    } else {
                        $check = ' value="true"';
                    }
                    echo '<input type="checkbox" name="' . $key . '"' . $check . '/><br/>';
                    unset($check);
                    break;


                default:
                    echo '<input type="text" name="' . $key . '" value="' . $value . '"/><br/>';
                    break;
            }
        }



        echo '<button type="submit">Внести правки</button>';





        break;

    case "update":




        $order = Order::find($_POST['id']);
        $order->varinfo = prepareJson();
        $order->user_id = $_POST['user_id'];
        $order->save();
        header("Location: admin.php");



        break;

    case "create":

        ?>
        <form method="POST" action="edit.php?action=save" enctype="multipart/form-data">
            <div>
                <div>
                    <label>
                        <div>Имя</div>
                        <input name="name" type="text" placeholder="">
                    </label>
                    <label>
                        <div>Телефон</div>
                        <input name="phone" type="text" placeholder="">
                    </label>
                </div>
                <div >
                    <label>
                        <div>email</div>
                        <input name="email" type="email" placeholder="">
                    </label>
                    <label>
                        <div>Улица</div>
                        <input name="street" type="text" placeholder="">
                    </label>
                </div>
                <div >
                    <label>
                        <div>Дом</div>
                        <input name="home" type="text" placeholder="">
                    </label>
                    <label>
                        <div>Корпус</div>
                        <input name="part" type="text" placeholder="">
                    </label>
                    <label>
                        <div>Квартира</div>
                        <input name="appt" type="text" placeholder="">
                    </label>
                    <label>
                        <div>Этаж</div>
                        <input name="floor" type="text" placeholder="">
                    </label>
                </div>
            </div>
            <div>
                <div>
                    <label>
                        <div>Комментарий</div>
                        <textarea name="comment"></textarea>
                    </label>
                </div>
                <div>
                    <div>
                        <label>
                            <input name="payment" type="radio">
                            <div></div>
                            <div>Потребуется сдача</div>
                        </label>
                        <label>
                            <input name="payment_card" type="radio">
                            <div></div>
                            <div>Оплата по карте</div>
                        </label>
                    </div>
                    <div>
                        <label >
                            <input name="callback" type="checkbox">
                            <div></div>
                            <div>Не перезванивать</div>
                        </label>
                    </div>
                    <div>
                          <div class="order__form-label">Добавить свое фото</div>
                          <input name="avatar" type="file" /><br>

                        <button type="submit" style="background-color: red; padding: 10px;
                                border: 1px solid green; border-radius: 3px; color: white; margin: 10px;">Сделать заказ</button>

                        <input name="" type="reset" value="Очистить">
                    </div>
                </div>
            </div>
        </form>


        <?php
        break;

    case "save":

        $email = $_POST['email'];
        $user_id = User::firstOrNewId(['email' => $email]);
        $vardata = prepareJson();
        $order = new Order;
        $order->user_id = $user_id;
        $order->varinfo = $vardata;
        $order->save();
        header("Location: admin.php");


        break;

    default:
        break;
}
