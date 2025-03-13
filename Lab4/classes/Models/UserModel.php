<?php

namespace Models;
/**
 *  Просто клас UserModel
  */
class UserModel {
    public function getMessage(string $clas = 'Model') {
        return "$clas: успішно підключений<br>";
    }
}