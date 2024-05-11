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

<?php $rec_num = 0 ?>

<?php foreach($r as $row) { ?>
    <?php // $warna = $rec_num % 2 == 0 ? 'bg-warning' : 'bg-danger' ?>
    <div class="small-box <?= $rec_num % 2 == 0 ? 'bg-warning' : 'bg-danger' ?>">
        <div class="inner">
            <h3><?= $row['Ukuran'] ?></h3>
            <p>&nbsp;</p>
        </div>
        <div class="icon">
            <i class="ion ion-bag"></i>
        </div>
        <a href="size2" class="small-box-footer">Lanjut <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    <?php $rec_num++ ?>
<?php } ?>

<div class="small-box bg-info">
    <a href="beranda" class="small-box-footer"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
</div>
<?= GetDebugMessage() ?>
