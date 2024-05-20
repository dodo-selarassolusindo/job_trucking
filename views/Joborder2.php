<?php

namespace PHPMaker2024\prj_job_trucking;

// Page object
$Joborder2 = &$Page;
?>
<?php
$Page->showMessage();
?>
<?php
$q = '
    select
        jo.*
    from
        job_order jo
    where
        Job2ID = ' . $_GET['job2id'] . '
        SizeID = ' . $_GET['sizeid'] . '
        TypeID = ' . $_GET['typeid'] . '
    ';
$r = ExecuteRows($q);
?>

<table>
    <thead>
        <tr>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($r as $row)
        {
        ?>
        <tr>
            <td><?= $row['Tanggal'] ?></td>
        </tr>
        <?php
        }
        ?>
    <tbody>
</table>

<?php // echo 'Hello - this detail page' ?>

<!--
this detail is ::
<br>
<?= $_GET['job2id'] ?>
<br>
<?= $_GET['sizeid'] ?>
<br>
<?= $_GET['typeid'] ?>
<br>
-->


<?= GetDebugMessage() ?>
