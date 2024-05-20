<?php

namespace PHPMaker2024\prj_job_trucking;

// Page object
$Joborder2 = &$Page;
?>
<?php
$Page->showMessage();
?>
<?php echo 'Hello - this detail page' ?>

this detail is ::
<?= $_GET['job2id'] ?>
<br>
<?= $_GET['sizeid'] ?>
<br>
<?= $_GET['typeid'] ?>
<br>
<?= GetDebugMessage() ?>
