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
        st.SizeID = '.$_GET['sizeid'].'
    ';
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
            SizeID = ' . $_GET['sizeid']
            . ' and TypeID = ' . $row['TypeID']
            . ' and Job2ID = ' . $_GET['job2id']
    );
    if ($job_num == 0) {
        // continue;
    } else {
    ?>
        <div class="small-box <?= $rec_num % 2 == 0 ? 'bg-info' : 'bg-success' ?>">
            <div class="inner">
                <h4 class="text-center"><?= $row['Nama'] ?></h4>
                <!-- <p>&nbsp;</p> -->
                <p class="text-center">Ada <?= $job_num ?> Job</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="joborder2?job2id=<?= $_GET['job2id'] ?>&job2nama=<?= $_GET['job2nama'] ?>&sizeid=<?= $_GET['sizeid'] ?>&sizeukuran=<?= htmlspecialchars($_GET['sizeukuran'], ENT_QUOTES) ?>&typeid=<?= $row['TypeID'] ?>&typenama=<?= $row['Nama'] ?>" class="small-box-footer">Lanjut <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    <?php } ?>
    <?php $rec_num++ ?>

<?php } ?>

<div class="small-box bg-info">
    <a href="javascript:history.back()" class="small-box-footer"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
</div>
<?= GetDebugMessage() ?>
