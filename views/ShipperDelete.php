<?php

namespace PHPMaker2024\prj_job_trucking;

// Page object
$ShipperDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { shipper: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fshipperdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fshipperdelete")
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
<form name="fshipperdelete" id="fshipperdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="shipper">
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
<?php if ($Page->ShipperID->Visible) { // ShipperID ?>
        <th class="<?= $Page->ShipperID->headerCellClass() ?>"><span id="elh_shipper_ShipperID" class="shipper_ShipperID"><?= $Page->ShipperID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Nama->Visible) { // Nama ?>
        <th class="<?= $Page->Nama->headerCellClass() ?>"><span id="elh_shipper_Nama" class="shipper_Nama"><?= $Page->Nama->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Nomor_Telepon->Visible) { // Nomor_Telepon ?>
        <th class="<?= $Page->Nomor_Telepon->headerCellClass() ?>"><span id="elh_shipper_Nomor_Telepon" class="shipper_Nomor_Telepon"><?= $Page->Nomor_Telepon->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Contact_Person->Visible) { // Contact_Person ?>
        <th class="<?= $Page->Contact_Person->headerCellClass() ?>"><span id="elh_shipper_Contact_Person" class="shipper_Contact_Person"><?= $Page->Contact_Person->caption() ?></span></th>
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
<?php if ($Page->ShipperID->Visible) { // ShipperID ?>
        <td<?= $Page->ShipperID->cellAttributes() ?>>
<span id="">
<span<?= $Page->ShipperID->viewAttributes() ?>>
<?= $Page->ShipperID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Nama->Visible) { // Nama ?>
        <td<?= $Page->Nama->cellAttributes() ?>>
<span id="">
<span<?= $Page->Nama->viewAttributes() ?>>
<?= $Page->Nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Nomor_Telepon->Visible) { // Nomor_Telepon ?>
        <td<?= $Page->Nomor_Telepon->cellAttributes() ?>>
<span id="">
<span<?= $Page->Nomor_Telepon->viewAttributes() ?>>
<?= $Page->Nomor_Telepon->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Contact_Person->Visible) { // Contact_Person ?>
        <td<?= $Page->Contact_Person->cellAttributes() ?>>
<span id="">
<span<?= $Page->Contact_Person->viewAttributes() ?>>
<?= $Page->Contact_Person->getViewValue() ?></span>
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
