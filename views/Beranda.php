<?php

namespace PHPMaker2024\prj_job_trucking;

// Page object
$Beranda = &$Page;
?>
<?php
$Page->showMessage();
?>
<!--
<div class="card">
    <div class="card-header">
        <h5 class="m-0">Latest News</h5>
    </div>
    <div class="card-body">
        <h6 class="card-title">2023/09/05 - PHPMaker 2024 Released</h6>
        <p class="card-text">For more information, please visit PHPMaker website.</p>
        <a href="https://phpmaker.dev" class="btn btn-primary">Go to PHPMaker website</a>
    </div>
</div>
-->

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Job</h3>
    </div>
    <div class="card-body p-0">
<?php
    $q = '
        select
            date_format(job.tanggal, "%d-%m-%Y") as tanggal,
            job.nomor,
            job.customer,
            job.shipper,
            concat("<a href=\"jobview/",job.id,"?showdetail=\">",lokasi.nama,"</a>") as Lokasi
        from
            job
            left join lokasi on job.lokasi = lokasi.id
    ';
    Write(ExecuteHtml($q, ['fieldcaption' => true, 'tablename' => ['job'],]));
    // $sql = "SELECT DISTINCT " .
    //     "`categories`.`CategoryName` AS `CategoryName`," .
    //     "`products`.`ProductName` AS `ProductName`," .
    //     "`products`.`QuantityPerUnit` AS `QuantityPerUnit`" .
    //     " FROM `categories` JOIN `products` ON (`categories`.`CategoryID` = `products`.`CategoryID`)" .
    //     " WHERE " .
    //     "`products`.`UnitsInStock` <= 0";
    // Write(ExecuteHtml($sql, ["fieldcaption" => true, "tablename" => ["products", "categories"]]));
?>
    </div>
</div>
<?= GetDebugMessage() ?>
