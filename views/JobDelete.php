<?php

namespace PHPMaker2024\prj_job_trucking;

// Page object
$JobDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { job: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fjobdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjobdelete")
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
<form name="fjobdelete" id="fjobdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="job">
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
<?php if ($Page->Tanggal->Visible) { // Tanggal ?>
        <th class="<?= $Page->Tanggal->headerCellClass() ?>"><span id="elh_job_Tanggal" class="job_Tanggal"><?= $Page->Tanggal->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Nomor->Visible) { // Nomor ?>
        <th class="<?= $Page->Nomor->headerCellClass() ?>"><span id="elh_job_Nomor" class="job_Nomor"><?= $Page->Nomor->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Tanggal_Muat->Visible) { // Tanggal_Muat ?>
        <th class="<?= $Page->Tanggal_Muat->headerCellClass() ?>"><span id="elh_job_Tanggal_Muat" class="job_Tanggal_Muat"><?= $Page->Tanggal_Muat->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Customer->Visible) { // Customer ?>
        <th class="<?= $Page->Customer->headerCellClass() ?>"><span id="elh_job_Customer" class="job_Customer"><?= $Page->Customer->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Shipper->Visible) { // Shipper ?>
        <th class="<?= $Page->Shipper->headerCellClass() ?>"><span id="elh_job_Shipper" class="job_Shipper"><?= $Page->Shipper->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Lokasi->Visible) { // Lokasi ?>
        <th class="<?= $Page->Lokasi->headerCellClass() ?>"><span id="elh_job_Lokasi" class="job_Lokasi"><?= $Page->Lokasi->caption() ?></span></th>
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
<?php if ($Page->Tanggal->Visible) { // Tanggal ?>
        <td<?= $Page->Tanggal->cellAttributes() ?>>
<span id="">
<span<?= $Page->Tanggal->viewAttributes() ?>>
<?= $Page->Tanggal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Nomor->Visible) { // Nomor ?>
        <td<?= $Page->Nomor->cellAttributes() ?>>
<span id="">
<span<?= $Page->Nomor->viewAttributes() ?>>
<?= $Page->Nomor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Tanggal_Muat->Visible) { // Tanggal_Muat ?>
        <td<?= $Page->Tanggal_Muat->cellAttributes() ?>>
<span id="">
<span<?= $Page->Tanggal_Muat->viewAttributes() ?>>
<?= $Page->Tanggal_Muat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Customer->Visible) { // Customer ?>
        <td<?= $Page->Customer->cellAttributes() ?>>
<span id="">
<span<?= $Page->Customer->viewAttributes() ?>>
<?= $Page->Customer->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Shipper->Visible) { // Shipper ?>
        <td<?= $Page->Shipper->cellAttributes() ?>>
<span id="">
<span<?= $Page->Shipper->viewAttributes() ?>>
<?= $Page->Shipper->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Lokasi->Visible) { // Lokasi ?>
        <td<?= $Page->Lokasi->cellAttributes() ?>>
<span id="">
<span<?= $Page->Lokasi->viewAttributes() ?>>
<?= $Page->Lokasi->getViewValue() ?></span>
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
