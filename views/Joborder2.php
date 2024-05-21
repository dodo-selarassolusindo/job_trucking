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
        , date_format(jo.Tanggal, "%d-%m-%Y") as Tanggal_Indo
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
        <?php foreach($r as $row) { ?>
        <div class="card-body table-responsive p-0">
            <!-- <table class="table table-bordered table-sm"> -->
            <table class="table table-hover text-nowrap">
                <!--
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
                -->
                <tbody>

                    <?php // foreach($r as $row) { ?>
                    <tr>
                        <th>Tanggal</th><td><?= $row['Tanggal_Indo'] ?></td>
                    </tr>
                    <tr>
                        <th>Lokasi</th><td><?= $row['LokasiNama'] ?></td>
                    </tr>
                    <tr>
                        <th>Pelabuhan</th><td><?= $row['PelabuhanNama'] ?></td>
                    </tr>
                    <tr>
                        <th>BL Extra</th><td><?= $row['BL_Extra'] ?></td>
                    </tr>
                    <tr>
                        <th>Depo</th><td><?= $row['DepoNama'] ?></td>
                    </tr>
                    <tr>
                        <th>Ongkos</th><td><a href="https://wa.me/6288996628963">CALL</a></td>
                    </tr>
                    <!--
                    <tr>
                        <td>&nbsp;</td><td>&nbsp;</td>
                    </tr>
                    -->
                    <?php // } ?>

                </tbody>
            </table>
            
        </div>
        <?php } ?>
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
