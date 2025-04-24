<?php

interface HouseCleaning {
    public function cleanRoom();  
    public function cleanKitchen();  
}


abstract class Human implements HouseCleaning {
    protected string $name;
    protected int $age;


    public function __construct(string $name, int $age) {
        $this->name = $name;
        $this->age = $age;
    }

    public function getName() {
        return $this->name;
    }
    public function getAge() {
        return $this->age;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setAge($age) {
        $this->age = $age;
    }

    
    abstract protected function birthMessage();
    public function birth() {
        $this->birthMessage();
    }


    public function cleanRoom() {
        echo $this->getClassName() . " прибирає прибирає кімнату<br>";
    }

    public function cleanKitchen() {
        echo $this->getClassName() . " прибирає прибирає кухню<br>";
    }
}