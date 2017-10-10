<?php
// Task #4

$age = rand();

if ($age > 17 AND $age < 66) {
    echo "Вам   еще работать   и   работать";
} elseif ($age > 65) {
    echo "Вам   пора   на   пенсию";
} elseif ($age < 18) {
    echo "Вам   ещё   рано   работать";
} else {
    echo "Неизвестный возраст";
}


