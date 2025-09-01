<?php
//print "<h1>Hello, ICS C Community!</h1>";
//print " <p>Today is " . date("l") . "</p>";

// Include the HelloWorld class
//require_once 'classes.php';

//Include the AutoLoad class
require_once 'ClassAutoLoad.php';

//create an instance of HelloWorld
//$hello = new HelloWorld();

$layout->header($conf);
print $hello->today();
$form->signup();
$layout->footer($conf);