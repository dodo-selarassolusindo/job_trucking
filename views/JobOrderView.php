<?php

namespace PHPMaker2024\prj_job_trucking;

// Page object
$JobOrderView = &$Page;
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
<form name="fjob_orderview" id="fjob_orderview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { job_order: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fjob_orderview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjob_orderview")
        .setPageId("view")
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
<input type="hidden" name="t" value="job_order">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->JobOrderID->Visible) { // JobOrderID ?>
    <tr id="r_JobOrderID"<?= $Page->JobOrderID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_job_order_JobOrderID"><?= $Page->JobOrderID->caption() ?></span></td>
        <td data-name="JobOrderID"<?= $Page->JobOrderID->cellAttributes() ?>>
<span id="el_job_order_JobOrderID">
<span<?= $Page->JobOrderID->viewAttributes() ?>>
<?= $Page->JobOrderID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Job2ID->Visible) { // Job2ID ?>
    <tr id="r_Job2ID"<?= $Page->Job2ID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_job_order_Job2ID"><?= $Page->Job2ID->caption() ?></span></td>
        <td data-name="Job2ID"<?= $Page->Job2ID->cellAttributes() ?>>
<span id="el_job_order_Job2ID">
<span<?= $Page->Job2ID->viewAttributes() ?>>
<?= $Page->Job2ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->SizeID->Visible) { // SizeID ?>
    <tr id="r_SizeID"<?= $Page->SizeID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_job_order_SizeID"><?= $Page->SizeID->caption() ?></span></td>
        <td data-name="SizeID"<?= $Page->SizeID->cellAttributes() ?>>
<span id="el_job_order_SizeID">
<span<?= $Page->SizeID->viewAttributes() ?>>
<?= $Page->SizeID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->TypeID->Visible) { // TypeID ?>
    <tr id="r_TypeID"<?= $Page->TypeID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_job_order_TypeID"><?= $Page->TypeID->caption() ?></span></td>
        <td data-name="TypeID"<?= $Page->TypeID->cellAttributes() ?>>
<span id="el_job_order_TypeID">
<span<?= $Page->TypeID->viewAttributes() ?>>
<?= $Page->TypeID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Tanggal->Visible) { // Tanggal ?>
    <tr id="r_Tanggal"<?= $Page->Tanggal->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_job_order_Tanggal"><?= $Page->Tanggal->caption() ?></span></td>
        <td data-name="Tanggal"<?= $Page->Tanggal->cellAttributes() ?>>
<span id="el_job_order_Tanggal">
<span<?= $Page->Tanggal->viewAttributes() ?>>
<?= $Page->Tanggal->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->LokasiID->Visible) { // LokasiID ?>
    <tr id="r_LokasiID"<?= $Page->LokasiID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_job_order_LokasiID"><?= $Page->LokasiID->caption() ?></span></td>
        <td data-name="LokasiID"<?= $Page->LokasiID->cellAttributes() ?>>
<span id="el_job_order_LokasiID">
<span<?= $Page->LokasiID->viewAttributes() ?>>
<?= $Page->LokasiID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PelabuhanID->Visible) { // PelabuhanID ?>
    <tr id="r_PelabuhanID"<?= $Page->PelabuhanID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_job_order_PelabuhanID"><?= $Page->PelabuhanID->caption() ?></span></td>
        <td data-name="PelabuhanID"<?= $Page->PelabuhanID->cellAttributes() ?>>
<span id="el_job_order_PelabuhanID">
<span<?= $Page->PelabuhanID->viewAttributes() ?>>
<?= $Page->PelabuhanID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->BL_Extra->Visible) { // BL_Extra ?>
    <tr id="r_BL_Extra"<?= $Page->BL_Extra->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_job_order_BL_Extra"><?= $Page->BL_Extra->caption() ?></span></td>
        <td data-name="BL_Extra"<?= $Page->BL_Extra->cellAttributes() ?>>
<span id="el_job_order_BL_Extra">
<span<?= $Page->BL_Extra->viewAttributes() ?>>
<?= $Page->BL_Extra->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->DepoID->Visible) { // DepoID ?>
    <tr id="r_DepoID"<?= $Page->DepoID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_job_order_DepoID"><?= $Page->DepoID->caption() ?></span></td>
        <td data-name="DepoID"<?= $Page->DepoID->cellAttributes() ?>>
<span id="el_job_order_DepoID">
<span<?= $Page->DepoID->viewAttributes() ?>>
<?= $Page->DepoID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Ongkos->Visible) { // Ongkos ?>
    <tr id="r_Ongkos"<?= $Page->Ongkos->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_job_order_Ongkos"><?= $Page->Ongkos->caption() ?></span></td>
        <td data-name="Ongkos"<?= $Page->Ongkos->cellAttributes() ?>>
<span id="el_job_order_Ongkos">
<span<?= $Page->Ongkos->viewAttributes() ?>>
<?= $Page->Ongkos->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
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
