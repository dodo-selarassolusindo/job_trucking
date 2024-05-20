<?php

namespace PHPMaker2024\prj_job_trucking;

// Page object
$TakenByView = &$Page;
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
<form name="ftaken_byview" id="ftaken_byview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { taken_by: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var ftaken_byview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("ftaken_byview")
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
<input type="hidden" name="t" value="taken_by">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->TakenByID->Visible) { // TakenByID ?>
    <tr id="r_TakenByID"<?= $Page->TakenByID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_taken_by_TakenByID"><?= $Page->TakenByID->caption() ?></span></td>
        <td data-name="TakenByID"<?= $Page->TakenByID->cellAttributes() ?>>
<span id="el_taken_by_TakenByID">
<span<?= $Page->TakenByID->viewAttributes() ?>>
<?= $Page->TakenByID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Nama->Visible) { // Nama ?>
    <tr id="r_Nama"<?= $Page->Nama->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_taken_by_Nama"><?= $Page->Nama->caption() ?></span></td>
        <td data-name="Nama"<?= $Page->Nama->cellAttributes() ?>>
<span id="el_taken_by_Nama">
<span<?= $Page->Nama->viewAttributes() ?>>
<?= $Page->Nama->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NomorHP->Visible) { // NomorHP ?>
    <tr id="r_NomorHP"<?= $Page->NomorHP->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_taken_by_NomorHP"><?= $Page->NomorHP->caption() ?></span></td>
        <td data-name="NomorHP"<?= $Page->NomorHP->cellAttributes() ?>>
<span id="el_taken_by_NomorHP">
<span<?= $Page->NomorHP->viewAttributes() ?>>
<?= $Page->NomorHP->getViewValue() ?></span>
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
