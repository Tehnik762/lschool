<?php
/*
 *  
 *     Graduation Project PHP LoftSchool
 *     Student: Braslavskii Anton
 *     Email: yastroitel@gmail.com
 *  
 */

use Illuminate\Database\Capsule\Manager as Capsule;
use Intervention\Image\ImageManager;

$capsule = new Capsule;

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'ham',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);


$capsule->setAsGlobal();

$capsule->bootEloquent();

class User extends Illuminate\Database\Eloquent\Model
{

    public $timestamps = false;
    protected $fillable = ['email', 'name', 'phone', 'ip'];

    public function orders()
    {
        return $this->hasMany('Order');
    }

    public static function firstOrNewId($array)
    {
        $id = self::firstOrNew($array);
        $id->name = $_POST['name'];
        $id->phone = $_POST['phone'];
        $id->ip = $_SERVER['REMOTE_ADDR'];
        if (isset($_FILES)) {
            $file = $_FILES['avatar'];
            $uploaddir = $_SERVER['DOCUMENT_ROOT'] . "/graduation/GP1/www/img/avatar/";
            list($width, $height) = getimagesize($file['tmp_name']);
            if ($width > 0 AND $height > 0) {
                $cache = time();
                if (move_uploaded_file($file['tmp_name'], $uploaddir . $cache . ".jpg")) {
                    $manager = new ImageManager();

                    $img = $manager->make($uploaddir . $cache . ".jpg");
                    $img->fit(480);
                    $img->save();
                    $gref = "http://" . $_SERVER['HTTP_HOST'] . "/graduation/GP1/www/img/avatar/" . $cache . ".jpg";

                    $id->avatar = $gref;
                }
            }
        }
        $id->save();
        return $id->id;
    }
}

class Order extends Illuminate\Database\Eloquent\Model
{

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('User');
    }
}

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

function prepareJson()
{

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
    return json_encode($vardata);
}
