<?php
/*
 *  
 *     Graduation Project PHP LoftSchool
 *     Student: Braslavskii Anton
 *     Email: yastroitel@gmail.com
 *  
 */
namespace MVC;

class Files extends Controller
{

    public function __construct()
    {
        parent::__construct();
        require_once 'models/file.php';
    }

    public function all()
    {
        $files = File::where('user_id', $_SESSION['id'])->get()->toArray();
        $this->data['content']['Файлы'] = '<table>
  <thead>
    <tr>
    <th>Путь</th>
      <th>Файл</th>
    </tr>
  </thead>
  <tbody>';

        foreach ($files as $file) {
            $image = '<img src="' . ROOT . $file['path'] . '" />';

            $this->data['content']['Файлы'] .= '<tr>'
                . '<td>' . $file['path'] . '</td>      
                <td>' . $image . '</td>';
        }
        $this->data['content']['Файлы'] .= '  </tbody></table>';

        $this->view->render($this->data);
    }

    public function upload()
    {
        $this->data['user_id'] = $_SESSION['id'];
        $this->data['content']['Добавить файл'] = $this->view->renderPart($this->data, "upload.html");

        $this->view->render($this->data);
    }

    public function save()
    {
        if ($_FILES['photo']['size'] > 0) {
            $path = "uploads/" . time() . rand(0, 1000) . ".jpg";
            $r_path = $_SERVER['DOCUMENT_ROOT'] . "/graduation/GP2/" . $path;
            $this->prepareImage($_FILES['photo']['tmp_name'], $r_path);
            $file = new File;
            $file->path = $path;
            $file->user_id = $_POST['id'];
            $file->save();
        }
        header("Location: " . ROOT . "files/all");
    }

    private function prepareImage($init, $result, $w = 500, $h = 300)
    {
        // я понимаю, что нужно ее прописать статикой и брать из Юзерс. Но сроки горят!
        $image = \Spatie\Image\Image::load($init);
        $image->fit(\Spatie\Image\Manipulations::FIT_CONTAIN, $w, $h)->save($result);
    }
}
