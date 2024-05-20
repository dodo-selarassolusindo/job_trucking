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
        , lok.Nama as LokasiNama
        , pel.Nama as PelabuhanNama
        , dep.Nama as DepoNama
    from
        job_order jo
        left join lokasi lok on jo.LokasiID = lok.LokasiID
        left join pelabuhan pel on jo.PelabuhanID = pel.PelabuhanID
        left join depo dep on jo.DepoID = dep.DepoID
    where
        Job2ID = ' . $_GET['job2id'] . '
        and SizeID = ' . $_GET['sizeid'] . '
        and TypeID = ' . $_GET['typeid'] . '
    ';
$r = ExecuteRows($q);
?>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
        <h3 class="card-title">Bordered Table</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Task</th>
                <th>Progress</th>
                <th style="width: 40px">Label</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1.</td>
                <td>Update software</td>
                <td>
                <div class="progress progress-xs">
                    <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                </div>
                </td>
                <td><span class="badge bg-danger">55%</span></td>
            </tr>
            <tr>
                <td>2.</td>
                <td>Clean database</td>
                <td>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-warning" style="width: 70%"></div>
                </div>
                </td>
                <td><span class="badge bg-warning">70%</span></td>
            </tr>
            <tr>
                <td>3.</td>
                <td>Cron job running</td>
                <td>
                <div class="progress progress-xs progress-striped active">
                    <div class="progress-bar bg-primary" style="width: 30%"></div>
                </div>
                </td>
                <td><span class="badge bg-primary">30%</span></td>
            </tr>
            <tr>
                <td>4.</td>
                <td>Fix and squish bugs</td>
                <td>
                <div class="progress progress-xs progress-striped active">
                    <div class="progress-bar bg-success" style="width: 90%"></div>
                </div>
                </td>
                <td><span class="badge bg-success">90%</span></td>
            </tr>
            </tbody>
        </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.col -->

<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Lokasi</th>
            <th>Pelabuhan</th>
            <th>BL Extra</th>
            <th>Depo</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($r as $row)
        {
        ?>
        <tr>
            <td><?= $row['Tanggal'] ?></td>
            <td><?= $row['LokasiNama'] ?></td>
            <td><?= $row['PelabuhanNama'] ?></td>
            <td><?= $row['BL_Extra'] ?></td>
            <td><?= $row['DepoNama'] ?></td>
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
