<?php
/*
 *  
 *     Homework PHP LoftSchool
 *     Student: Braslavskii Anton
 *     Email: yastroitel@gmail.com
 *  
*/

require_once 'config.inc';
require_once 'class.php';
$user = new User();
$db = Db::getInstance($dsn, $dbuser, $pass, $opt);
switch ($_POST['target']) {
    case 'auth':
        $login = strip_tags($_POST['login']);
        $password = strip_tags($_POST['password']);

      
        $sql = "SELECT password FROM users WHERE login=?";
        $set[] = $login;
        $res = $db->querySql($sql, $set);
        if ($res) {
            if (password_verify($password, $res['password'])) {
                $user->setAuth();
                
            } else {
                $user->authError("Ошибка авторизации", "index.html");
            }
            
        }
        else {
            $user->authError("Такого пользователя не существует", "index.html");
        }
        

        break;
    case 'reg':
        if (empty($_POST['login']) OR empty($_POST['password1']) OR empty($_POST['password2'])) {
            $user->authError("Не задан один из обязательных параметров", "reg.html");
        }
        else {

            if ($_POST['password1'] != $_POST['password2']) {
             $user->authError("Введены не идентичные пароли", "reg.html");
            } else {
             
             $login = strip_tags($_POST['login']);
             $password = password_hash(strip_tags($_POST['password1']), PASSWORD_DEFAULT);
             $name = strip_tags($_POST['name']);
             $birthdate = strtotime($_POST['birth']);  
             $info = strip_tags($_POST['info']);
             
            
             
             $sql = 'INSERT INTO users (login, password, name, age, description) VALUES (?, ?, ?, ?, ?)';
             $set = array($login, $password, $name, $birthdate, $info);
             $res = $db->querySql($sql, $set, TRUE);
             
             $photo = $user->savePhoto($_FILES['photo'], $res);
             if ($photo) {
            $sql = 'UPDATE users SET photo=? WHERE id='.$res;
             $set = array($photo);
             $res = $db->querySql($sql, $set, FALSE, TRUE);
             }
             $user->setAuth();
                
            }
        }
        
        
        
        
        break;


}
