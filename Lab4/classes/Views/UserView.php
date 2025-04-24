<?php

namespace Views;
/**
 * Просто клас UserView
 */
class UserView {
    /**
         * Виводить задане повідомлення з міткою даного класу
         */
    public function message ($message) {
        
        echo "View: $message <br>";
    }
}