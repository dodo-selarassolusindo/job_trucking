<?php

namespace PHPMaker2024\prj_job_trucking;

// Page object
$JobView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="view">
<form name="fjobview" id="fjobview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { job: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fjobview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjobview")
        .setPageId("view")

        // Multi-Page
        .setMultiPage(true)
        .build();
    window[form.id] = form;
    currentForm = form;
    loadjs.done(form.id);
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="job">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (!$Page->isExport()) { ?>
<div class="ew-multi-page"><!-- multi-page -->
<div class="ew-nav<?= $Page->MultiPages->containerClasses() ?>" id="pages_JobView"><!-- multi-page tabs -->
    <ul class="<?= $Page->MultiPages->navClasses() ?>" role="tablist">
        <li class="nav-item"><button class="<?= $Page->MultiPages->navLinkClasses(1) ?>" data-bs-target="#tab_job1" data-bs-toggle="tab" type="button" role="tab" aria-controls="tab_job1" aria-selected="<?= JsonEncode($Page->MultiPages->isActive(1)) ?>"><?= $Page->pageCaption(1) ?></button></li>
        <li class="nav-item"><button class="<?= $Page->MultiPages->navLinkClasses(2) ?>" data-bs-target="#tab_job2" data-bs-toggle="tab" type="button" role="tab" aria-controls="tab_job2" aria-selected="<?= JsonEncode($Page->MultiPages->isActive(2)) ?>"><?= $Page->pageCaption(2) ?></button></li>
    </ul>
    <div class="<?= $Page->MultiPages->tabContentClasses() ?>">
<?php } ?>
<?php if (!$Page->isExport()) { ?>
        <div class="<?= $Page->MultiPages->tabPaneClasses(1) ?>" id="tab_job1" role="tabpanel"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->Lokasi->Visible) { // Lokasi ?>
    <tr id="r_Lokasi"<?= $Page->Lokasi->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_job_Lokasi"><?= $Page->Lokasi->caption() ?></span></td>
        <td data-name="Lokasi"<?= $Page->Lokasi->cellAttributes() ?>>
<span id="el_job_Lokasi" data-page="1">
<span<?= $Page->Lokasi->viewAttributes() ?>>
<?= $Page->Lokasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Tanggal->Visible) { // Tanggal ?>
    <tr id="r_Tanggal"<?= $Page->Tanggal->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_job_Tanggal"><?= $Page->Tanggal->caption() ?></span></td>
        <td data-name="Tanggal"<?= $Page->Tanggal->cellAttributes() ?>>
<span id="el_job_Tanggal" data-page="1">
<span<?= $Page->Tanggal->viewAttributes() ?>>
<?= $Page->Tanggal->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Tanggal_Muat->Visible) { // Tanggal_Muat ?>
    <tr id="r_Tanggal_Muat"<?= $Page->Tanggal_Muat->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_job_Tanggal_Muat"><?= $Page->Tanggal_Muat->caption() ?></span></td>
        <td data-name="Tanggal_Muat"<?= $Page->Tanggal_Muat->cellAttributes() ?>>
<span id="el_job_Tanggal_Muat" data-page="1">
<span<?= $Page->Tanggal_Muat->viewAttributes() ?>>
<?= $Page->Tanggal_Muat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php if (!$Page->isExport()) { ?>
        </div><!-- /multi-page .tab-pane -->
<?php } ?>
<?php if (!$Page->isExport()) { ?>
        <div class="<?= $Page->MultiPages->tabPaneClasses(2) ?>" id="tab_job2" role="tabpanel"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->Nomor->Visible) { // Nomor ?>
    <tr id="r_Nomor"<?= $Page->Nomor->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_job_Nomor"><?= $Page->Nomor->caption() ?></span></td>
        <td data-name="Nomor"<?= $Page->Nomor->cellAttributes() ?>>
<span id="el_job_Nomor" data-page="2">
<span<?= $Page->Nomor->viewAttributes() ?>>
<?= $Page->Nomor->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Customer->Visible) { // Customer ?>
    <tr id="r_Customer"<?= $Page->Customer->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_job_Customer"><?= $Page->Customer->caption() ?></span></td>
        <td data-name="Customer"<?= $Page->Customer->cellAttributes() ?>>
<span id="el_job_Customer" data-page="2">
<span<?= $Page->Customer->viewAttributes() ?>>
<?= $Page->Customer->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Shipper->Visible) { // Shipper ?>
    <tr id="r_Shipper"<?= $Page->Shipper->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_job_Shipper"><?= $Page->Shipper->caption() ?></span></td>
        <td data-name="Shipper"<?= $Page->Shipper->cellAttributes() ?>>
<span id="el_job_Shipper" data-page="2">
<span<?= $Page->Shipper->viewAttributes() ?>>
<?= $Page->Shipper->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php if (!$Page->isExport()) { ?>
        </div><!-- /multi-page .tab-pane -->
<?php } ?>
<?php if (!$Page->isExport()) { ?>
    </div>
</div>
</div>
<?php } ?>
</form>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
