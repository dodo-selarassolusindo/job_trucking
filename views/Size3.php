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
    
    <div class="small-box <?= $rec_num % 2 == 0 ? 'bg-warning' : 'bg-danger' ?>">
        <div class="inner">
            <h3 class="text-center"><?= $row['Ukuran'] ?></h3>
            <p>&nbsp;</p>
        </div>
        <div class="icon">
            <i class="ion ion-bag"></i>
        </div>
        <a href="type2?job=<?= $_GET['job'] ?>&size=<?= $row['SizeID'] ?>&ukuran=<?= htmlspecialchars($row['Ukuran'], ENT_QUOTES) ?>" class="small-box-footer">Lanjut <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    <?php $rec_num++ ?>

<?php } ?>

<div class="small-box bg-info">
    <a href="beranda" class="small-box-footer"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
</div>
<?= GetDebugMessage() ?>
