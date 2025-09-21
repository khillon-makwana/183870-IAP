
<?php
require_once 'ClassAutoLoad.php';

$ObjLayout->header($conf);
$ObjLayout->nav($conf);
$ObjLayout->banner($conf);
$ObjLayout->form_content($conf, $ObjForm, $ObjFncs);
$ObjLayout->footer($conf);
?>