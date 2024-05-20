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

    <?php
    $job_num = ExecuteScalar('
        select
            count(JobOrderID) as rec_num
        from
            job_order
        where
            SizeID = ' . $row['SizeID']
            . ' and Job2ID = ' . $_GET['job2id']
    );
    if ($job_num == 0) {
        // continue;
    } else {
    ?>
        <div class="small-box <?= $rec_num % 2 == 0 ? 'bg-warning' : 'bg-danger' ?>">
            <div class="inner">
                <h3 class="text-center"><?= $row['Ukuran'] ?></h3>
                <p class="text-center">Ada <?= $job_num ?> Job</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="type2?job=<?= $_GET['job'] ?>&job2id=<?= $_GET['job2id'] ?>&sizeid=<?= $row['SizeID'] ?>&ukuran=<?= htmlspecialchars($row['Ukuran'], ENT_QUOTES) ?>" class="small-box-footer">Lanjut <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    <?php } ?>
    <?php $rec_num++ ?>

<?php } ?>

<div class="small-box bg-info">
    <a href="javascript:history.back()" class="small-box-footer"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
</div>
<?= GetDebugMessage() ?>
