<?php

namespace PHPMaker2024\prj_job_trucking;

// Page object
$Size22View = &$Page;
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
<form name="fsize22view" id="fsize22view" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { size22: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fsize22view;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fsize22view")
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
<input type="hidden" name="t" value="size22">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->SizeID->Visible) { // SizeID ?>
    <tr id="r_SizeID"<?= $Page->SizeID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_size22_SizeID"><?= $Page->SizeID->caption() ?></span></td>
        <td data-name="SizeID"<?= $Page->SizeID->cellAttributes() ?>>
<span id="el_size22_SizeID">
<span<?= $Page->SizeID->viewAttributes() ?>>
<?= $Page->SizeID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Ukuran->Visible) { // Ukuran ?>
    <tr id="r_Ukuran"<?= $Page->Ukuran->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_size22_Ukuran"><?= $Page->Ukuran->caption() ?></span></td>
        <td data-name="Ukuran"<?= $Page->Ukuran->cellAttributes() ?>>
<span id="el_size22_Ukuran">
<span<?= $Page->Ukuran->viewAttributes() ?>>
<?= $Page->Ukuran->getViewValue() ?></span>
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
