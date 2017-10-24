<?php
/*
 *  
 *     Homework PHP LoftSchool
 *     Student: Braslavskii Anton
 *     Email: yastroitel@gmail.com
 *  
 */

require_once 'functions.php';

// Task 03-01
echo "Задание №1<br/>";
echo task1('data.xml');
echo "<br/><br/><br/>";
// Task 03-02
echo "Задание №2<br/>";
$arr = array(
    1,
    2,
    3,
    array(
        5,
        6,
        7
    ),
    "42 is the answer",
    "Near Bird" => "Prochee"
);


echo task2($arr);
echo "<br/><br/><br/>";


// Task 03-03
echo "Задание №3<br/>";
echo task3()."<br/>";


// Task 03-04
echo "Задание №4<br/>";
$url = "https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json";

$info = task4($url);
echo "<br/> Page_ID = " . $info['page_id'];
echo "<br/> Title = " . $info['title'];
