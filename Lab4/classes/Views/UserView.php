<?php
// Views.php
namespace Views;
/**
 * Просто клас UserView
 */
class UserView {
    /**
         * Виводить повідомлення з міткою даного класу
         */
    public function render($message) {
        
        echo "View: $message <br>";
    }
}