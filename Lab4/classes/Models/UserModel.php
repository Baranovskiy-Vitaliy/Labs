<?php

namespace Models;
/**
 *  Просто клас UserModel
  */
class UserModel {
    /**
         * Повертає повідомлення з міткою даного класу
         */
    public function getMessage(string $clas = 'Model') {
        return "$clas: успішно підключений<br>";
    }
}