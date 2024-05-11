<?php

namespace PHPMaker2024\prj_job_trucking;

// Page object
$Size22Delete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { size22: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fsize22delete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fsize22delete")
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
<form name="fsize22delete" id="fsize22delete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="size22">
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
<?php if ($Page->SizeID->Visible) { // SizeID ?>
        <th class="<?= $Page->SizeID->headerCellClass() ?>"><span id="elh_size22_SizeID" class="size22_SizeID"><?= $Page->SizeID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Ukuran->Visible) { // Ukuran ?>
        <th class="<?= $Page->Ukuran->headerCellClass() ?>"><span id="elh_size22_Ukuran" class="size22_Ukuran"><?= $Page->Ukuran->caption() ?></span></th>
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
<?php if ($Page->SizeID->Visible) { // SizeID ?>
        <td<?= $Page->SizeID->cellAttributes() ?>>
<span id="">
<span<?= $Page->SizeID->viewAttributes() ?>>
<?= $Page->SizeID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Ukuran->Visible) { // Ukuran ?>
        <td<?= $Page->Ukuran->cellAttributes() ?>>
<span id="">
<span<?= $Page->Ukuran->viewAttributes() ?>>
<?= $Page->Ukuran->getViewValue() ?></span>
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
