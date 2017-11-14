<?php
/*
 *  
 *     Homework PHP LoftSchool
 *     Student: Braslavskii Anton
 *     Email: yastroitel@gmail.com
 *  
 */

class Db
{

    private $_conn;
    private static $_instance;
    public $stmt;

    private function __construct($dsn, $user, $pass, $opt)
    {

        $this->_conn = new PDO($dsn, $user, $pass, $opt);
    }

    private function __clone()
    {
//
    }

    public static function getInstance($dsn, $user, $pass, $opt)
    {
        if (empty(self::$_instance)) {
            self::$_instance = new self($dsn, $user, $pass, $opt);
        }
        return self::$_instance;
    }

    private function preSql($sql, $settings)
    {
        $this->stmt = $this->_conn->prepare($sql);
        $this->stmt->execute($settings);
    }

    public function querySql($sql, $settings, $insert = FALSE, $update = FALSE)
    {
        $this->preSql($sql, $settings);

        if ($update) {
            return TRUE;
        }
        if ($insert) {
            return $this->_conn->lastInsertId();
        } else {
            return $this->stmt->fetch();
        }
    }

    public function querySqlAll($sql, $settings)
    {
        $this->preSql($sql, $settings);
        return $this->stmt->fetchAll();
    }
}

class User
{

    public function checkAuth($cookie)
    {
        if (isset($cookie['auth'])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function setAuth()
    {
        setcookie("auth", "set", time() + 36000);
        header("location: index.html");
    }

    public function authError($name, $location)
    {
        setcookie("error", $name, time() + 600);
        header("location: {$location}");
    }

    public function savePhoto($file, $id)
    {
        $w = 400;
        $h = 250;
        switch ($file['type']) {
            case "image/gif":
                $image = 1;
                break;
            case "image/jpeg":
            case "image/jpg":
                $image = 2;
                break;
            case "image/png":
                $image = 3;
                break;

            default :

                break;
        }

        if (isset($image)) {

            list($width, $height) = getimagesize($file['tmp_name']);
            $ratio_orig = $width / $height;

            if ($w / $h > $ratio_orig) {
                $w = $h * $ratio_orig;
            } else {
                $h = $w / $ratio_orig;
            }
            $image_p = imagecreatetruecolor($w, $h);

            $image = $this->makeImage($image, $file['tmp_name']);
            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $w, $h, $width, $height);



            $path = $_SERVER['DOCUMENT_ROOT'] . "/homework/homework04/photos/" . $id . ".jpg";
            if (imagejpeg($image_p, $path)) {
                return "/photos/" . $id . ".jpg";
                ;
            } else {
                return FALSE;
            }


   
        }
    }

    private function makeImage($p, $name)
    {
        switch ($p) {
            case "1":
                return imagecreatefromgif($name);

                break;
            case "2":
                return imagecreatefromjpeg($name);

                break;
            case "3":
                return imagecreatefrompng($name);
                break;
        }
    }
}

class render
{

    public static function tableHeader($head)
    {
        $res = '<table class="table table-bordered"><tr>';

        foreach ($head as $value) {
            $res .= "<th>{$value}</th>";
        }
        $res .= "</tr>";
        return $res;
    }

    public static function string($str)
    {
    $res = "<tr>";
    foreach($str as  $value) {
    $res .= "<td>{$value}</td>";
    }
    $res .= "</tr>";
    return $res;
    }
    public static function tableEnd()



    

    {
    return "</table>";

    }



    }


    class
    Menu {

        public static $menu = [
            "index.html" => "Авторизация",
            "reg.html" => "Регистрация",
            "list.html" => "Список пользователей",
            "filelist.html" => "Список файлов"
        ];

        public static function renderMenu()
        {
            $base = str_replace("/homework/homework04/", "", $_SERVER['REQUEST_URI']);
            foreach (self::$menu as $key => $value) {

                if ($base == $key) {
                    $class = ' class="active"';
                }
                echo '<li' . $class . '><a href="' . $key . '">' . $value . '</a></li>';
                unset($class);
            }
        }
    }
    