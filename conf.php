<?php
// Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Set timezone
date_default_timezone_set('Africa/Nairobi');

// Site Information
$conf['site_name'] = 'ThoughtNest';
$conf['site_url'] = 'http://localhost/183870-IAP';
$conf['admin_email'] = 'admin@thoughtnest.com';

// Database Configuration
$conf['db_type'] = 'pdo';
$conf['db_host'] = 'localhost';
$conf['db_user'] = 'root';
$conf['db_pass'] = 'khillon';
$conf['db_name'] = '183870-IAP';
$conf['db_port'] = 3307; 

// Site Language
$conf['site_lang'] = 'en';

// Email COnfigurations
$conf['mail_type'] = 'smtp'; // Options: 'smtp' or 'mail'
$conf['smtp_host'] = 'smtp.gmail.com';
$conf['smtp_user'] = 'khillon.makwana@strathmore.edu';
$conf['smtp_pass'] = 'uofa qdld nztu veym';
$conf['smtp_port'] = 465;
$conf['smtp_secure'] = 'ssl';

// Valid password length
$conf['min_password_length'] = 8;

// Valid email domains
$conf['valid_email_domains'] = ['thoughtnest.com', 'gmail.com', 'yahoo.com', 'outlook.com', 'strathmore.edu'];