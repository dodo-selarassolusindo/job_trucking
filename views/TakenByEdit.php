<?php

namespace PHPMaker2024\prj_job_trucking;

// Page object
$TakenByEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="ftaken_byedit" id="ftaken_byedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { taken_by: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var ftaken_byedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("ftaken_byedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["TakenByID", [fields.TakenByID.visible && fields.TakenByID.required ? ew.Validators.required(fields.TakenByID.caption) : null], fields.TakenByID.isInvalid],
            ["Nama", [fields.Nama.visible && fields.Nama.required ? ew.Validators.required(fields.Nama.caption) : null], fields.Nama.isInvalid],
            ["NomorHP", [fields.NomorHP.visible && fields.NomorHP.required ? ew.Validators.required(fields.NomorHP.caption) : null], fields.NomorHP.isInvalid]
        ])

        // Form_CustomValidate
        .setCustomValidate(
            function (fobj) { // DO NOT CHANGE THIS LINE! (except for adding "async" keyword)!
                    // Your custom validation code here, return false if invalid.
                    return true;
                }
        )

        // Use JavaScript validation or not
        .setValidateRequired(ew.CLIENT_VALIDATE)

        // Dynamic selection lists
        .setLists({
        })
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
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="taken_by">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->TakenByID->Visible) { // TakenByID ?>
    <div id="r_TakenByID"<?= $Page->TakenByID->rowAttributes() ?>>
        <label id="elh_taken_by_TakenByID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->TakenByID->caption() ?><?= $Page->TakenByID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->TakenByID->cellAttributes() ?>>
<span id="el_taken_by_TakenByID">
<span<?= $Page->TakenByID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->TakenByID->getDisplayValue($Page->TakenByID->EditValue))) ?>"></span>
<input type="hidden" data-table="taken_by" data-field="x_TakenByID" data-hidden="1" name="x_TakenByID" id="x_TakenByID" value="<?= HtmlEncode($Page->TakenByID->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Nama->Visible) { // Nama ?>
    <div id="r_Nama"<?= $Page->Nama->rowAttributes() ?>>
        <label id="elh_taken_by_Nama" for="x_Nama" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Nama->caption() ?><?= $Page->Nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Nama->cellAttributes() ?>>
<span id="el_taken_by_Nama">
<input type="<?= $Page->Nama->getInputTextType() ?>" name="x_Nama" id="x_Nama" data-table="taken_by" data-field="x_Nama" value="<?= $Page->Nama->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->Nama->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->Nama->formatPattern()) ?>"<?= $Page->Nama->editAttributes() ?> aria-describedby="x_Nama_help">
<?= $Page->Nama->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Nama->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NomorHP->Visible) { // NomorHP ?>
    <div id="r_NomorHP"<?= $Page->NomorHP->rowAttributes() ?>>
        <label id="elh_taken_by_NomorHP" for="x_NomorHP" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NomorHP->caption() ?><?= $Page->NomorHP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->NomorHP->cellAttributes() ?>>
<span id="el_taken_by_NomorHP">
<input type="<?= $Page->NomorHP->getInputTextType() ?>" name="x_NomorHP" id="x_NomorHP" data-table="taken_by" data-field="x_NomorHP" value="<?= $Page->NomorHP->EditValue ?>" size="30" maxlength="25" placeholder="<?= HtmlEncode($Page->NomorHP->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->NomorHP->formatPattern()) ?>"<?= $Page->NomorHP->editAttributes() ?> aria-describedby="x_NomorHP_help">
<?= $Page->NomorHP->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NomorHP->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="ftaken_byedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="ftaken_byedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
<?php } ?>
    </div><!-- /buttons offset -->
<?= $Page->IsModal ? "</template>" : "</div>" ?><!-- /buttons .row -->
</form>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("taken_by");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
