<?php

namespace PHPMaker2024\prj_job_trucking;

// Page object
$SizeTypeView = &$Page;
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
<form name="fsize_typeview" id="fsize_typeview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { size_type: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fsize_typeview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fsize_typeview")
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
<input type="hidden" name="t" value="size_type">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->Size_Type_ID->Visible) { // Size_Type_ID ?>
    <tr id="r_Size_Type_ID"<?= $Page->Size_Type_ID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_size_type_Size_Type_ID"><?= $Page->Size_Type_ID->caption() ?></span></td>
        <td data-name="Size_Type_ID"<?= $Page->Size_Type_ID->cellAttributes() ?>>
<span id="el_size_type_Size_Type_ID">
<span<?= $Page->Size_Type_ID->viewAttributes() ?>>
<?= $Page->Size_Type_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->SizeID->Visible) { // SizeID ?>
    <tr id="r_SizeID"<?= $Page->SizeID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_size_type_SizeID"><?= $Page->SizeID->caption() ?></span></td>
        <td data-name="SizeID"<?= $Page->SizeID->cellAttributes() ?>>
<span id="el_size_type_SizeID">
<span<?= $Page->SizeID->viewAttributes() ?>>
<?= $Page->SizeID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->TypeID->Visible) { // TypeID ?>
    <tr id="r_TypeID"<?= $Page->TypeID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_size_type_TypeID"><?= $Page->TypeID->caption() ?></span></td>
        <td data-name="TypeID"<?= $Page->TypeID->cellAttributes() ?>>
<span id="el_size_type_TypeID">
<span<?= $Page->TypeID->viewAttributes() ?>>
<?= $Page->TypeID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->TypeNama->Visible) { // TypeNama ?>
    <tr id="r_TypeNama"<?= $Page->TypeNama->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_size_type_TypeNama"><?= $Page->TypeNama->caption() ?></span></td>
        <td data-name="TypeNama"<?= $Page->TypeNama->cellAttributes() ?>>
<span id="el_size_type_TypeNama">
<span<?= $Page->TypeNama->viewAttributes() ?>>
<?= $Page->TypeNama->getViewValue() ?></span>
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
