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
        Job2ID = ' . $_GET['job2id']
        . ' and SizeID = ' . $_GET['sizeid']
        . ' and TypeID = ' . $_GET['typeid']
        . ' and IsOpen = 1 '
        . ' and IsShow = 1 '
    ;
$r = ExecuteRows($q);
?>

<div class="col-md-12">
    <div class="card">
        <!-- <div class="card-body"> -->
        <div class="card-body table-responsive p-0">
            <!-- <table class="table table-bordered table-sm"> -->
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Lokasi</th>
                    <th>Pelabuhan</th>
                    <th>BL Extra</th>
                    <th>Depo</th>
                    <th>Ongkos</th>
                </tr>
                </thead>
                <tbody>

                    <?php foreach($r as $row) { ?>
                    <tr>
                        <td><?= $row['Tanggal'] ?></td>
                        <td><?= $row['LokasiNama'] ?></td>
                        <td><?= $row['PelabuhanNama'] ?></td>
                        <td><?= $row['BL_Extra'] ?></td>
                        <td><?= $row['DepoNama'] ?></td>
                        <td><a href="https://wa.me/6288996628963">CALL</a></td>
                    </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.col -->

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
