<?php
require 'ClassAutoLoad.php';

$ObjLayout->header($conf);
$ObjLayout->nav($conf);
$ObjLayout->banner($conf);
$ObjLayout->form_content($conf, $ObjForm);
$ObjLayout->footer($conf);