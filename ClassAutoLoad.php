<?php
//Load Composer's autoloader (created by composer, not included with PHPMailer)
require 'Plugins/PHPMailer/vendor/autoload.php';
require_once 'conf.php';

$directories = ["forms","layouts","global"];

spl_autoload_register(function ($className) use ($directories) {
    foreach ($directories as $directory) {
        $filePath = __DIR__ . "/$directory/" . $className . '.php';
        if (file_exists($filePath)) {
            require_once $filePath;
            return;
        }
    }
});


//create an instance
$ObjSendMail = new SendMail();
$ObjForm = new forms();
$ObjLayout = new layouts();