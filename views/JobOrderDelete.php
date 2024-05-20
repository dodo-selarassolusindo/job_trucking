<?php

namespace PHPMaker2024\prj_job_trucking;

// Page object
$JobOrderDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { job_order: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fjob_orderdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjob_orderdelete")
        .setPageId("delete")
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
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fjob_orderdelete" id="fjob_orderdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="job_order">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid <?= $Page->TableGridClass ?>">
<div class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<table class="<?= $Page->TableClass ?>">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->JobOrderID->Visible) { // JobOrderID ?>
        <th class="<?= $Page->JobOrderID->headerCellClass() ?>"><span id="elh_job_order_JobOrderID" class="job_order_JobOrderID"><?= $Page->JobOrderID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Job2ID->Visible) { // Job2ID ?>
        <th class="<?= $Page->Job2ID->headerCellClass() ?>"><span id="elh_job_order_Job2ID" class="job_order_Job2ID"><?= $Page->Job2ID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->SizeID->Visible) { // SizeID ?>
        <th class="<?= $Page->SizeID->headerCellClass() ?>"><span id="elh_job_order_SizeID" class="job_order_SizeID"><?= $Page->SizeID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->TypeID->Visible) { // TypeID ?>
        <th class="<?= $Page->TypeID->headerCellClass() ?>"><span id="elh_job_order_TypeID" class="job_order_TypeID"><?= $Page->TypeID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Tanggal->Visible) { // Tanggal ?>
        <th class="<?= $Page->Tanggal->headerCellClass() ?>"><span id="elh_job_order_Tanggal" class="job_order_Tanggal"><?= $Page->Tanggal->caption() ?></span></th>
<?php } ?>
<?php if ($Page->LokasiID->Visible) { // LokasiID ?>
        <th class="<?= $Page->LokasiID->headerCellClass() ?>"><span id="elh_job_order_LokasiID" class="job_order_LokasiID"><?= $Page->LokasiID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->PelabuhanID->Visible) { // PelabuhanID ?>
        <th class="<?= $Page->PelabuhanID->headerCellClass() ?>"><span id="elh_job_order_PelabuhanID" class="job_order_PelabuhanID"><?= $Page->PelabuhanID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->BL_Extra->Visible) { // BL_Extra ?>
        <th class="<?= $Page->BL_Extra->headerCellClass() ?>"><span id="elh_job_order_BL_Extra" class="job_order_BL_Extra"><?= $Page->BL_Extra->caption() ?></span></th>
<?php } ?>
<?php if ($Page->DepoID->Visible) { // DepoID ?>
        <th class="<?= $Page->DepoID->headerCellClass() ?>"><span id="elh_job_order_DepoID" class="job_order_DepoID"><?= $Page->DepoID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Ongkos->Visible) { // Ongkos ?>
        <th class="<?= $Page->Ongkos->headerCellClass() ?>"><span id="elh_job_order_Ongkos" class="job_order_Ongkos"><?= $Page->Ongkos->caption() ?></span></th>
<?php } ?>
<?php if ($Page->IsShow->Visible) { // IsShow ?>
        <th class="<?= $Page->IsShow->headerCellClass() ?>"><span id="elh_job_order_IsShow" class="job_order_IsShow"><?= $Page->IsShow->caption() ?></span></th>
<?php } ?>
<?php if ($Page->IsOpen->Visible) { // IsOpen ?>
        <th class="<?= $Page->IsOpen->headerCellClass() ?>"><span id="elh_job_order_IsOpen" class="job_order_IsOpen"><?= $Page->IsOpen->caption() ?></span></th>
<?php } ?>
<?php if ($Page->TakenByID->Visible) { // TakenByID ?>
        <th class="<?= $Page->TakenByID->headerCellClass() ?>"><span id="elh_job_order_TakenByID" class="job_order_TakenByID"><?= $Page->TakenByID->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while ($Page->fetch()) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = RowType::VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->CurrentRow);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->JobOrderID->Visible) { // JobOrderID ?>
        <td<?= $Page->JobOrderID->cellAttributes() ?>>
<span id="">
<span<?= $Page->JobOrderID->viewAttributes() ?>>
<?= $Page->JobOrderID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Job2ID->Visible) { // Job2ID ?>
        <td<?= $Page->Job2ID->cellAttributes() ?>>
<span id="">
<span<?= $Page->Job2ID->viewAttributes() ?>>
<?= $Page->Job2ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->SizeID->Visible) { // SizeID ?>
        <td<?= $Page->SizeID->cellAttributes() ?>>
<span id="">
<span<?= $Page->SizeID->viewAttributes() ?>>
<?= $Page->SizeID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->TypeID->Visible) { // TypeID ?>
        <td<?= $Page->TypeID->cellAttributes() ?>>
<span id="">
<span<?= $Page->TypeID->viewAttributes() ?>>
<?= $Page->TypeID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Tanggal->Visible) { // Tanggal ?>
        <td<?= $Page->Tanggal->cellAttributes() ?>>
<span id="">
<span<?= $Page->Tanggal->viewAttributes() ?>>
<?= $Page->Tanggal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->LokasiID->Visible) { // LokasiID ?>
        <td<?= $Page->LokasiID->cellAttributes() ?>>
<span id="">
<span<?= $Page->LokasiID->viewAttributes() ?>>
<?= $Page->LokasiID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->PelabuhanID->Visible) { // PelabuhanID ?>
        <td<?= $Page->PelabuhanID->cellAttributes() ?>>
<span id="">
<span<?= $Page->PelabuhanID->viewAttributes() ?>>
<?= $Page->PelabuhanID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->BL_Extra->Visible) { // BL_Extra ?>
        <td<?= $Page->BL_Extra->cellAttributes() ?>>
<span id="">
<span<?= $Page->BL_Extra->viewAttributes() ?>>
<?= $Page->BL_Extra->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->DepoID->Visible) { // DepoID ?>
        <td<?= $Page->DepoID->cellAttributes() ?>>
<span id="">
<span<?= $Page->DepoID->viewAttributes() ?>>
<?= $Page->DepoID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Ongkos->Visible) { // Ongkos ?>
        <td<?= $Page->Ongkos->cellAttributes() ?>>
<span id="">
<span<?= $Page->Ongkos->viewAttributes() ?>>
<?= $Page->Ongkos->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->IsShow->Visible) { // IsShow ?>
        <td<?= $Page->IsShow->cellAttributes() ?>>
<span id="">
<span<?= $Page->IsShow->viewAttributes() ?>>
<?= $Page->IsShow->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->IsOpen->Visible) { // IsOpen ?>
        <td<?= $Page->IsOpen->cellAttributes() ?>>
<span id="">
<span<?= $Page->IsOpen->viewAttributes() ?>>
<?= $Page->IsOpen->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->TakenByID->Visible) { // TakenByID ?>
        <td<?= $Page->TakenByID->cellAttributes() ?>>
<span id="">
<span<?= $Page->TakenByID->viewAttributes() ?>>
<?= $Page->TakenByID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
}
$Page->Recordset?->free();
?>
</tbody>
</table>
</div>
</div>
<div class="ew-buttons ew-desktop-buttons">
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
