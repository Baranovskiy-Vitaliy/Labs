<?php

class Programmer extends Human {
    private $programmingLanguages = [];
    private $experience;

    public function __construct(string $name, int $age, int $experience) {
        parent::__construct($name, $age);
        $this->experience = $experience;
    }

    public function getProgrammingLanguages() {
        return $this->programmingLanguages;
    }

    public function setProgrammingLanguages($languages) {
        $this->programmingLanguages = $languages;
    }

    public function getExperience() {
        return $this->experience;
    }

    public function setExperience($experience) {
        $this->experience = $experience;
    }

    public function addProgrammingLanguage(string $language) {
        $this->programmingLanguages[] = $language;
    }

    protected function birthMessage() {
        echo "Програміст народився.<br>";
    }

    public function cleanRoom() {
        echo "Програміст прибирає кімнату.<br>";
    }

    public function cleanKitchen() {
        echo "Програміст прибирає кухню.<br>";
    }
}