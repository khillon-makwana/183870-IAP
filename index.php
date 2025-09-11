<?php
//print "<h1>Hello, ICS C Community!</h1>";
//print " <p>Today is " . date("l") . "</p>";

// Include the HelloWorld class
//require_once 'classes.php';

//Include the AutoLoad class
require_once 'ClassAutoLoad.php';

//create an instance of HelloWorld
//$hello = new HelloWorld();

$ObjLayout->header($conf);
$ObjLayout->nav($conf);
$ObjLayout->banner($conf);
$ObjLayout->content($conf);
$ObjLayout->footer($conf);