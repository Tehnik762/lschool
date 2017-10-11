<?php
/*
 *  
 *     Homework PHP LoftSchool
 *     Student: Braslavskii Anton
 *     Email: yastroitel@gmail.com
 *  
 */

// Task #8

$str = "123 asd sss eee ggg rrr 42";
$arr = explode(" ", $str);
$rezult = array_pop($arr);

while ($arr) {
    $rezult .= "|" . array_pop($arr);
}

echo $rezult;
