<?php

class Student extends Human {
    private string $university;
    private int $course;

    public function __construct(string $name, int $age, string $university, int $course){
        parent::__construct($name, $age);
        $this->university = $university;
        $this->course = $course;
    }

    public function getUniversity() {
        return $this->university;
    }

    public function setUniversity($university) {
        $this->university = $university;
    }

    public function getCourse() {
        return $this->course;
    }

    public function setCourse($course) {
        $this->course = $course;
    }

    public function getDataStudent(Student $student) {
        echo "Дані про студента:<br>
        Ім'я: ". $student-> getName() ."<br>
        Вік: " . $student->getAge() ."<br
        Університет: ". $student->getUniversity() ."<br>
        Курс: ". $student->getCourse() . "<br><br>";
    }

    public function nextCourse() {
        $this->course++;
    }

    
    protected function birthMessage() {
        echo "Студент поступив!<br>";
    }

    public function cleanRoom() {
        echo "Студент прибирає кімнату.<br>";
    }

    public function cleanKitchen() {
        echo "Студент прибирає кухню.<br>";
    }
}