<?php
/*
 *  
 *     Homework PHP LoftSchool
 *     Student: Braslavskii Anton
 *     Email: yastroitel@gmail.com
 *  
 */

// Task #02-01

function makeP($arr, $str = NULL)
{

    foreach ($arr as $key => $part) {
        $res[$key] = "<p>" . $part . "</p>";
    }
    if (!$str) {
        foreach ($res as $out) {
            echo $out . PHP_EOL;
        }
    } else {
        foreach ($res as $out) {
            $out_str .= $out;
        }
        return $out_str;
    }
}
$example = ["asd", "qwe", "qaz"];

makeP($example);

$x = makeP($example, TRUE);

echo $x;
