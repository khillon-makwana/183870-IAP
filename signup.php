<?php
require 'ClassAutoLoad.php';
$ObjAuth->signup($conf, $ObjFncs); // Delegate everything to Auth::signup()

$ObjLayout->header($conf);
$ObjLayout->nav($conf);
$ObjLayout->banner($conf);
?>
<div class="container mt-4">
    <?php echo $ObjFncs->getMsg('msg'); ?>
</div>
<?php
$ObjLayout->form_content($conf, $ObjForm, $ObjFncs);
$ObjLayout->footer($conf);


