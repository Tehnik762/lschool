<?php
/*
 *  
 *     Homework PHP LoftSchool
 *     Student: Braslavskii Anton
 *     Email: yastroitel@gmail.com
 *  
 */


require 'vendor/autoload.php';


use Intervention\Image\ImageManager;

?>
<form enctype="multipart/form-data" action="index.php" method="POST">
    <label>Выберите файл для вставки</label><br/>
    <input type="file" id="photo" name="photo" style="padding: 10px; margin: 10px;"><br/>

    <button type="submit" class="btn btn-default">Преобразовать</button>
</form>

<?php
if (isset($_FILES)) {
    $file = $_FILES['photo'];
    $uploaddir = $_SERVER['DOCUMENT_ROOT'] . "/homework/homework06/cache/";
    list($width, $height) = getimagesize($file['tmp_name']);
    if ($width > 0 AND $height > 0) {
        $cache = time();
        if (move_uploaded_file($file['tmp_name'], $uploaddir . $cache . ".jpg")) {
            $manager = new ImageManager();

            $img = $manager->make($uploaddir . $cache . ".jpg");
            $img->rotate(45, "#FFFFFF");
            $img->insert("rick.png", "center");
            $img->fit(200);
            $img->save();
            $gref = "http://".$_SERVER['HTTP_HOST']."/homework/homework06/cache/". $cache . ".jpg";
            
            echo 'Результат: <img src="'.$gref.'"/>';
        }
    }


}