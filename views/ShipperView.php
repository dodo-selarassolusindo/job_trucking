<?php

namespace PHPMaker2024\prj_job_trucking;

// Page object
$ShipperView = &$Page;
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
<form name="fshipperview" id="fshipperview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { shipper: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fshipperview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fshipperview")
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
<input type="hidden" name="t" value="shipper">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->ShipperID->Visible) { // ShipperID ?>
    <tr id="r_ShipperID"<?= $Page->ShipperID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_shipper_ShipperID"><?= $Page->ShipperID->caption() ?></span></td>
        <td data-name="ShipperID"<?= $Page->ShipperID->cellAttributes() ?>>
<span id="el_shipper_ShipperID">
<span<?= $Page->ShipperID->viewAttributes() ?>>
<?= $Page->ShipperID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Nama->Visible) { // Nama ?>
    <tr id="r_Nama"<?= $Page->Nama->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_shipper_Nama"><?= $Page->Nama->caption() ?></span></td>
        <td data-name="Nama"<?= $Page->Nama->cellAttributes() ?>>
<span id="el_shipper_Nama">
<span<?= $Page->Nama->viewAttributes() ?>>
<?= $Page->Nama->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Nomor_Telepon->Visible) { // Nomor_Telepon ?>
    <tr id="r_Nomor_Telepon"<?= $Page->Nomor_Telepon->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_shipper_Nomor_Telepon"><?= $Page->Nomor_Telepon->caption() ?></span></td>
        <td data-name="Nomor_Telepon"<?= $Page->Nomor_Telepon->cellAttributes() ?>>
<span id="el_shipper_Nomor_Telepon">
<span<?= $Page->Nomor_Telepon->viewAttributes() ?>>
<?= $Page->Nomor_Telepon->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Contact_Person->Visible) { // Contact_Person ?>
    <tr id="r_Contact_Person"<?= $Page->Contact_Person->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_shipper_Contact_Person"><?= $Page->Contact_Person->caption() ?></span></td>
        <td data-name="Contact_Person"<?= $Page->Contact_Person->cellAttributes() ?>>
<span id="el_shipper_Contact_Person">
<span<?= $Page->Contact_Person->viewAttributes() ?>>
<?= $Page->Contact_Person->getViewValue() ?></span>
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
