<?php
/*
 *  
 *     Homework PHP LoftSchool
 *     Student: Braslavskii Anton
 *     Email: yastroitel@gmail.com
 *  
*/

$header = array("Название", "Фотография", "Действие");

    echo render::tableHeader($header);

    $sql = "SELECT photo, id FROM users WHERE 1";
    $set = array();
    $res = $db->querySqlAll($sql, $set);

    foreach ($res as $value) {
        if (!empty($value['photo'])) {
        $name = str_replace("/photos/", "", $value['photo']);
        $href = "<a href='includes/photo_delete.php?id={$value['id']}'>Удалить фото</a>";
        $photo = "<img src='http://".$_SERVER['HTTP_HOST']."/homework/homework04".$value['photo']."'/>";
        $arr = [$name,$photo, $href];
        echo render::string($arr);
        
        
        }
         
        
        
}
    
    
    
    
    
    echo render::tableEnd();

?>


