<?php
/*
 *  
 *     Homework PHP LoftSchool
 *     Student: Braslavskii Anton
 *     Email: yastroitel@gmail.com
 *  
 */

class Car
{

    private $engine;
    private $transmission;

    public function __construct($type, $horseforce)
    {
        $this->engine = new Engine($horseforce);
        $this->transmission = TransFactory::turnOn($type);
        renderString("У вашего автомобиля " . $this->transmission->type . " коробка передач");
    }

    public function move($speed, $dist, $direction)
    {
        renderString($this->engine->turnOn($speed));
        $gear = $this->transmission->changeState($speed, $direction);
        renderString("Вы включили " . $gear . " передачу");
        $this->engine->working($dist, $speed);
        $this->engine->turnOff();
        $this->transmission->neutral();
    }
}

class Engine
{

    private $power, $temp;

    public function __construct($hf)
    {
        $this->power = $hf;
        $this->temp = 0;
    }

    private function cooling()
    {
        $this->temp -= 10;
        if ($this->temp > 90) {
            $this->cooling();
        }
    }

    public function turnOn($speed)
    {
        $max = $this->power * 2;
        if ($max > $speed) {
            return "Двигатель работает";
        } else {
            die("Машина не может разогнаться до такой скорости");
        }
    }

    public function working($dist, $speed)
    {
        while ($dist > 0) {
            $dist -= $speed;
            if ($dist < 0) {
                break;
            }
            $this->temp += ceil($speed / 10) * 5;
            if ($this->temp > 90) {
                renderString("Температура двигателя " . $this->temp);
                $this->cooling();
                renderString("<b>System Cooling</b>");
            }
            renderString("Осталось ехать " . $dist . " метров");
        }
    }

    public function turnOff()
    {
        renderString("Приехали. Температура двигателя " . $this->temp);
    }
}

abstract class BaseTransmission
{

    public $type;

    public function __construct($type)
    {
        if ($type == "Auto") {
            $this->type = "Автоматическая";
        } else {
            $this->type = "Механическая";
        }
    }

    public function neutral()
    {
        return "Нейтральную";
    }
}

class ManualTransmission extends BaseTransmission
{

    public function changeState($speed, $direction)
    {
        if ($direction == "back") {
            return "Заднюю";
        } else {
            if ($speed > 10) {
                return "Вторую";
            } else {
                return "Первую";
            }
        }
    }
}

class AutoTransmission extends BaseTransmission
{

    public function changeState($speed, $direction)
    {
        if ($direction == "back") {
            return "Заднюю";
        } else {
            return "Переднюю";
        }
    }
}

class TransFactory
{

    public static function turnOn($type)
    {
        $t = $type . "Transmission";
        return new $t($type);
    }
}

function renderString($str)
{
    echo $str . "<br/>";
}
