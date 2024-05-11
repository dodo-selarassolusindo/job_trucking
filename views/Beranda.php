<?php

namespace PHPMaker2024\prj_job_trucking;

// Page object
$Beranda = &$Page;
?>
<?php
$Page->showMessage();
?>
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
        <div class="inner">
            <h3>EXPORT</h3>
            <p>&nbsp;</p>
        </div>
        <div class="icon">
            <i class="ion ion-bag"></i>
        </div>
        <a href="/size" class="small-box-footer">Klik di sini <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
        <div class="inner">
            <h3>IMPORT</h3>
            <p>&nbsp;</p>
        </div>
        <div class="icon">
            <i class="ion ion-stats-bars"></i>
        </div>
        <a href="daftar_size" class="small-box-footer">Klik di sini <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<?= GetDebugMessage() ?>
