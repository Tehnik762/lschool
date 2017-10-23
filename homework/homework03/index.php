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

//echo task1('data.xml');


// Task 03-02

$arr = array(
    1,
    2,
    3,
    array (
        5,
        6,
        7
    ),
    "42 is the answer",
    "Near Bird" => "Prochee"
);


echo task2($arr);