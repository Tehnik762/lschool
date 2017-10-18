<?php
/*
 *  
 *     Homework PHP LoftSchool
 *     Student: Braslavskii Anton
 *     Email: yastroitel@gmail.com
 *  
 */

function task1($arr, $str = NULL)
{

    foreach ($arr as $key => $part) {
        $res[$key] = "<p>" . $part . "</p>";
    }
    if (!$str) {
        foreach ($res as $out) {
            echo $out . "<br/>";
        }
    } else {
        foreach ($res as $out) {
            $out_str .= $out;
        }
        return $out_str;
    }
}

function task2($arr, $znak)
{
    $result = array_shift($arr);
    switch ($znak) {
        case "+":
            foreach ($arr as $value) {
                $result += $value;
            }
            break;

        case "-":
            foreach ($arr as $value) {
                $result -= $value;
            }
            break;

        case "*":

            foreach ($arr as $value) {

                $result *= $value;
            }
            break;

        case "/":
            foreach ($arr as $value) {
                $result /= $value;
            }
            break;


        default:
            $result = "Некорректный ввод";
            break;
    }

    return $result;
}

function task3()
{
    $arr = func_get_args();
    $action = array_shift($arr);
    $result = task2($arr, $action);
    return $result;
}

function task4($first, $second)
{
    if (is_int($first) & is_int($second)) {
        $result = "<table>";
        for ($i = 1; $i <= $first; $i++) {
            $result .= "<tr>";
            for ($j = 1; $j <= $second; $j++) {
                $x = $j * $i;
                $result .= "<td> " . $i . " * " . $j . " = " . $x . " </td>";
            }
            $result .= "</tr>";
        }
        $result .= "</table><br/>";

        return $result;
    } else {
        return "Введены некорректные исходные данные<br/>";
    }
}

function task5($phrase)
{
    $phrase = mb_strtolower($phrase, "UTF-8");
    $phrase = str_replace(" ", "", $phrase);
    $len = strlen($phrase) - 1;
    for ($len; $len >= 0; $len--) {
        $new .= mb_substr($phrase, $len, 1);
    }
    if ($phrase === $new) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function checkTask5($bool)
{
    return $bool ? "Да, это палиндром<br/>" : "Нет, это не палиндром<br/>";
}

function task6()
{
    $now = date("d.m.Y H:i");
    echo $now . "</br>";
    $unix = strtotime("24.02.2016 00:00:00");
    echo $unix . "</br>";
}

function task7()
{
    $str1 = "Карл у Клары украл Кораллы";
    $str2 = "Две бутылки лимонада";

    $str1 = str_replace("К", "", $str1);
    $str2 = str_replace("Две", "Три", $str2);
    echo $str1 . "<br/>" . $str2 . "<br/>";
}

function task8($log)
{
    $pattern = "/(?<=RX packets:)\d+/";
    preg_match($pattern, $log, $match);
    $smile = "/\:\)/";
    if (preg_match($smile, $log)) {
        return smile();
    }

    if ($match[0] > 1000) {
        return "Сеть есть<br/>";
    }
}

function smile()
{
    return "<p>.<br />
████████████████████████████████████████<br />
███████████████▀▀▀▀▀▀▀▀▀▀███████████████<br />
███████████▀░░░░░░░░░░░░░░░▀▀███████████<br />
████████▀░░░░░░░░░░░░░░░░░░░░░▀▀████████<br />
██████▀░░▄██████▄░░░░░▄▄██████▄░░███████<br />
█████▀░░████▀▀▀███▄░░▄███▀▀▀███▄░░▀█████<br />
████░░░░▀▀▀░░░░░▀▀▀░░▀▀▀░░░░░▀██░░░▀████<br />
███▀░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░████<br />
███░░██████████████████████████████░░███<br />
███░░███▀▀▀▀▀███▀▀▀▀▀▀▀▀███▀▀▀▀▀███░░███<br />
███░░███░░░░░███░░░░░░░░███░░░░░███░░███<br />
███░░███░░░░░███░░░░░░░░███░░░░▄███░▄███<br />
████░░███░░░░███░░░░░░░░███░░░░███░░████<br />
████▄░▀███▄░░███░░░░░░░░███░░▄███░░█████<br />
█████▄░░████▄███░░░░░░░░███▄███▀░░██████<br />
███████░░▀██████▄░░░░░░▄█████▀▀░▄███████<br />
████████▄▄░░▀▀████████████▀▀░░▄█████████<br />
███████████▄▄░░░░▀▀▀▀▀▀░░░▄▄████████████<br />
████████████████▄▄▄▄▄▄▄▄████████████████<br />
████████████████████████████████████████</p>";
}
