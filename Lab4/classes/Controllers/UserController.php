<?php

namespace Controllers;

use Models\UserModel;

/**
 * просто клас UserController
 */

class UserController {
    /**
         * Виводить повідомлення з міткою даного класу
         */
    public function showMessage() {
        $model = new UserModel();
        echo $model->getMessage('Controller');
    }
}