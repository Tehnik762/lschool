<?php


/**
 * Класс описывающий автомобиль
 *
 * 
 */
class Car {
    private $engine;
    private $transmission;



    public function __construct($type, $horseforce) {
        $this->engine = new Engine($horseforce);
        $this->transmission = TransFactory::turnOn($type);
    }
    
    public function move($speed, $dist, $direction) {
        $this->engine->turnOn($speed);
        $gear = $this->transmission->changeState($speed, $direction);
        $this->engine->working($dist, $speed);
        $this->engine->turnOff();
        $this->transmission->neutral();
        
    }
    
    
}

class Engine {
    private $power, $temp;
    
    public function __construct($hf) {
        $this->power = $hf;
        $this->temp = 0;
    }
    
    private function cooling() {
        $this->temp -= 10;
        if ($this->temp>90) {
            $this->cooling();
        }
    }
    
    public function turnOn($speed) {
        $max = $this->power*2;
        if ($max>$speed) {
        return "Двигатель работает";
        } else {
            die("Машина не может разогнаться до такой скорости");
        }
    }
    
    public function working($dist, $speed) {
        while ($dist>0) {
            $dist -= $speed;
            $this->temp += ceil($speed/10)*5;
            if ($this->temp > 90) {
                echo $this->cooling();
                echo "<br/>System Cooling<br/>";
            }
            echo "Осталось ехать ".$dist." метров<br>";
        }
        
    }
    
    public function turnOff() {
        echo "Приехали. Температура двигателя ".$this->temp."<br/>";
    }
    
}


abstract class BaseTransmission {
    public $type;
    
    public function __construct($type) {
        $this->type = $type;        
    }
    
    public function neutral() {
        return 0;        
    }
}
        



class ManualTransmission extends BaseTransmission {
    
    public function changeState($speed, $direction) {
        if ($direction == "back") {
            return -1;
        } else {
            if ($speed>10) {
                return 2;
            } else {
                return 1;
            }
        }
        
    }
    
}

class AutoTransmission extends BaseTransmission {
    
    public function changeState($speed, $direction) {
        if ($direction == "back") {
            return -1;
        } else {
            return 1;
        }
    }
}

class TransFactory {
    
    public static function turnOn($type) {
        $t = $type."Transmission";
        return new $t($type);
    }
}