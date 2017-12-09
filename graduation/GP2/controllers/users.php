<?php
/*
 *  
 *     Graduation Project PHP LoftSchool
 *     Student: Braslavskii Anton
 *     Email: yastroitel@gmail.com
 *  
 */
namespace MVC;

class Users extends Controller
{

    public function __construct()
    {
        parent::__construct();
        require_once 'models/user.php';
    }

    public function allasc()
    {
        $_SESSION['order'] = 'asc';
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }

    public function alldesc()
    {
        $_SESSION['order'] = 'desc';
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }

    public function all()
    {
// Выводит всех пользователей
        if (!$_SESSION['order']) {
            $_SESSION['order'] = 'asc';
        }
        $users = User::orderBy('birth', $_SESSION['order'])->get()->toArray();
        $this->data['content']['Все пользователи'] = '<p> Сортировать по:
<a href="' . ROOT . 'users/allasc">Возрастанию</a>
<a href="' . ROOT . 'users/alldesc">Убыванию</a>  
</p>
            <table>
  <thead>
    <tr>
    <th>Аватар</th>
      <th>Имя</th>
      <th>Возраст</th>
      <th>Описание</th>
      <th>Статус</th>
    </tr>
  </thead>
  <tbody>';

        foreach ($users as $user) {
            $age = floor((time() - $user['birth']) / (365.25 * 24 * 60 * 60));
            $age > 17 ? $s = 'Совершеннолетний' : $s = 'Несовершеннолетний';
            if (!empty($user['image'])) {

                $image = '<img src="' . ROOT . $user['image'] . '" /><a href="' . ROOT . 'users/avatar?id=' . $user['id'] . '" class="button button-outline">Заменить аватар</a>';
            } else {
                $image = '<a href="' . ROOT . 'users/avatar?id=' . $user['id'] . '" class="button button-outline">Добавить аватар</a>';
            }
            $this->data['content']['Все пользователи'] .= '<tr>
                <td>' . $image . '</td>      
                <td>' . $user['name'] . '</td>
                <td>' . $age . '</td>
                <td>' . $user['description'] . '</td>
                <td>' . $s . '</td>
                </tr>';
            unset($image);
        }
        $this->data['content']['Все пользователи'] .= '  </tbody></table>';




        $this->view->render($this->data);
    }

    public function avatar($param)
    {
        $this->data['id'] = $param['id'];
        $this->data['content']['Управление аватаром'] = $this->view->renderPart($this->data, "avatar.html");
        $this->view->render($this->data);
    }

    public function saveavatar()
    {

        if ($_FILES['photo']['size'] > 0) {
            $path = "images/" . $_POST['id'] . ".jpg";
            $r_path = $_SERVER['DOCUMENT_ROOT'] . "/graduation/GP2/" . $path;
            $this->prepareImage($_FILES['photo']['tmp_name'], $r_path);
            header("Location: " . ROOT . "users/all");
        } else {
            $this->errorLogin("Нет фото для замены");
        }
    }

    public function login()
    {
        // осуществляет вход пользователя в систему
        $login = filter_var($_POST['login'], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $user = User::where('name', $login)->first()->toArray();
        if ($user) {

            if (password_verify($password, $user['password'])) {
                $_SESSION['auth'] = time();
                $_SESSION['name'] = $login;
                $_SESSION['id'] = $user['id'];
                header("Location: " . $_SERVER['HTTP_REFERER']);
            } else {
                $this->errorLogin("Введенный пароль не является достоверным!");
            }
        } else {
            $this->errorLogin("Такого пользователя не существует");
        }
    }

    public function newuser()
    {
        $this->data['content']['Новый пользователь'] = $this->view->renderPart($this->data, "new.html");

        $this->view->render($this->data);
    }

    public function register()
    {
        // осуществляет регистрацию пользователя в системе
        $p1 = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $p2 = filter_var($_POST['password2'], FILTER_SANITIZE_STRING);
        if ($p1 != $p2) {
            $this->errorLogin("Пароли не совпадают");
        } else {
            $login = filter_var($_POST['login'], FILTER_SANITIZE_STRING);
            $user = User::where('name', $login)->first();
            if ($user) {
                $this->errorLogin("Пользователь с таким логином уже зарегистрироан.");
            } else {
                $user = new User();
                $user->name = filter_var($_POST['login'], FILTER_SANITIZE_STRING);
                $user->birth = strtotime($_POST['birth']);
                $user->password = password_hash($p1, PASSWORD_DEFAULT);
                $user->description = filter_var($_POST['info'], FILTER_SANITIZE_STRING);
                $user->save();

                if ($_FILES['photo']['size'] > 0) {
                    $path = "images/" . $user->id . ".jpg";
                    $r_path = $_SERVER['DOCUMENT_ROOT'] . "/graduation/GP2/" . $path;
                    $this->prepareImage($_FILES['photo']['tmp_name'], $r_path);
                    $user->image = $path;
                    $user->save();
                }
                if (isset($_SESSION['auth']) AND ! empty($_SESSION['auth'])) {
                    header("Location: " . ROOT . "users/all");
                } else {
                    $_SESSION['auth'] = time();
                    $_SESSION['name'] = $user->name;
                    $_SESSION['id'] = $user->id;
                    header("Location: " . $_SERVER['HTTP_REFERER']);
                }
            }
        }
    }

    private function prepareImage($init, $result, $w = 150, $h = 150)
    {
        // меняет размер фотографии и сохраняет в новом месте
        $image = \Spatie\Image\Image::load($init);
        $image->fit(\Spatie\Image\Manipulations::FIT_CONTAIN, $w, $h)->save($result);
    }

    public function quit()
    {
        // разлогин пользователя
        unset($_SESSION['auth']);
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }

    private function errorLogin($txt)
    {
        // выводит сообщение об ошибке и скидыает на предыдущую страницу
        $_SESSION['errors'] = $txt;
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}
