<?php


abstract class Human {
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
}