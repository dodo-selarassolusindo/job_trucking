<?php

namespace PHPMaker2024\prj_job_trucking;

// Page object
$Type2 = &$Page;
?>
<?php
$Page->showMessage();
?>
<?php
$q = '
    select
        t.*
    from
        size_type st
        left join type t on st.TypeID = t.TypeID
    where
        st.SizeID = '.$_GET['size'].'
    ';
$r = ExecuteRows($q);
?>

<?php $rec_num = 0 ?>

<?php foreach($r as $row) { ?>
    
    <div class="small-box <?= $rec_num % 2 == 0 ? 'bg-info' : 'bg-success' ?>">
        <div class="inner">
            <h3 class="text-center"><?= $row['Nama'] ?></h3>
            <p>&nbsp;</p>
        </div>
        <div class="icon">
            <i class="ion ion-bag"></i>
        </div>
        <a href="joblist" class="small-box-footer">Lanjut <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    <?php $rec_num++ ?>

<?php } ?>

<div class="small-box bg-info">
    <a href="size3" class="small-box-footer"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
</div>
<?= GetDebugMessage() ?>
