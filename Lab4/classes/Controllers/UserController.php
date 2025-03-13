<?php

namespace Controllers;

use Models\UserModel;

/**
 * просто клас UserController
 */

class UserController {
    public function showMessage() {
        $model = new UserModel();
        echo $model->getMessage('Controller');
    }
}