<?php

namespace PHPMaker2024\prj_job_trucking;

// Page object
$Beranda = &$Page;
?>
<?php
$Page->showMessage();
?>
<?php
$q = 'select * from job2';
$r = ExecuteRows($q);
?>

<?php $rec_num = 0 ?>

<?php foreach($r as $row) { ?>

    <?php
    $job_num = ExecuteScalar('
        select
            count(JobOrderID) as rec_num
        from
            job_order
        where
            Job2ID = ' . $row['Job2ID']
            . ' and IsOpen = 1 '
            . ' and IsShow = 1 '
    );
    if ($job_num == 0) {
        // continue;
    } else {
    ?>    
        <div class="small-box <?= $rec_num % 2 == 0 ? 'bg-info' : 'bg-success' ?>">
            <div class="inner">
                <h3 class="text-center"><?= $row['Nama'] ?></h3>
                <p class="text-center">Ada <?= $job_num ?> Job</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="size3?job2id=<?= $row['Job2ID'] ?>&job2nama=<?= $row['Nama'] ?>" class="small-box-footer">Lanjut <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    <?php } ?>
    <?php $rec_num++ ?>

<?php } ?>

<!--
log
20-05-2024 12:13
[ ] t job order, tambah field :: IsShow >> 1 show - 0 hide
[ ] t job order, tambah field :: IsOpen >> 1 open - 0 close
[ ] t job order, tambah field :: TakenBy >> UserTakenID
-->

<!--
<div class="small-box bg-info">
    <a href="beranda" class="small-box-footer"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
</div>

<div class="small-box bg-info">
    <div class="inner">
        <h3 class="text-center">EXPORT</h3>
        <p>&nbsp;</p>
    </div>
    <div class="icon">
        <i class="ion ion-bag"></i>
    </div>
    <a href="size3" class="small-box-footer">Lanjut <i class="fas fa-arrow-circle-right"></i></a>
</div>

<div class="small-box bg-success">
    <div class="inner">
        <h3 class="text-center">IMPORT</h3>
        <p>&nbsp;</p>
    </div>
    <div class="icon">
        <i class="ion ion-bag"></i>
    </div>
    <a href="size3" class="small-box-footer">Lanjut <i class="fas fa-arrow-circle-right"></i></a>
</div>
--!>
<?= GetDebugMessage() ?>
