<?php

namespace PHPMaker2024\prj_job_trucking;

// Page object
$Size3 = &$Page;
?>
<?php
$Page->showMessage();
?>
<?php
$q = 'select * from size';
$r = ExecuteRows($q);
?>

<?php foreach($r as $row) { ?>

<div class="small-box bg-warning">
    <div class="inner">
        <h3><?= $row['Ukuran'] ?></h3>
        <p>&nbsp;</p>
    </div>
    <div class="icon">
        <i class="ion ion-bag"></i>
    </div>
    <a href="size2" class="small-box-footer">Lanjut <i class="fas fa-arrow-circle-right"></i></a>
</div>

<?php } ?>
<?= GetDebugMessage() ?>
