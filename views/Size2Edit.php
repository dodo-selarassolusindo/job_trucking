<?php

namespace PHPMaker2024\prj_job_trucking;

// Page object
$Size2Edit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fsize2edit" id="fsize2edit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { size2: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fsize2edit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fsize2edit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["SizeID", [fields.SizeID.visible && fields.SizeID.required ? ew.Validators.required(fields.SizeID.caption) : null], fields.SizeID.isInvalid],
            ["Ukuran", [fields.Ukuran.visible && fields.Ukuran.required ? ew.Validators.required(fields.Ukuran.caption) : null], fields.Ukuran.isInvalid]
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
<input type="hidden" name="t" value="size2">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->SizeID->Visible) { // SizeID ?>
    <div id="r_SizeID"<?= $Page->SizeID->rowAttributes() ?>>
        <label id="elh_size2_SizeID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SizeID->caption() ?><?= $Page->SizeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->SizeID->cellAttributes() ?>>
<span id="el_size2_SizeID">
<span<?= $Page->SizeID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->SizeID->getDisplayValue($Page->SizeID->EditValue))) ?>"></span>
<input type="hidden" data-table="size2" data-field="x_SizeID" data-hidden="1" name="x_SizeID" id="x_SizeID" value="<?= HtmlEncode($Page->SizeID->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Ukuran->Visible) { // Ukuran ?>
    <div id="r_Ukuran"<?= $Page->Ukuran->rowAttributes() ?>>
        <label id="elh_size2_Ukuran" for="x_Ukuran" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Ukuran->caption() ?><?= $Page->Ukuran->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Ukuran->cellAttributes() ?>>
<span id="el_size2_Ukuran">
<input type="<?= $Page->Ukuran->getInputTextType() ?>" name="x_Ukuran" id="x_Ukuran" data-table="size2" data-field="x_Ukuran" value="<?= $Page->Ukuran->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->Ukuran->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->Ukuran->formatPattern()) ?>"<?= $Page->Ukuran->editAttributes() ?> aria-describedby="x_Ukuran_help">
<?= $Page->Ukuran->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Ukuran->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fsize2edit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fsize2edit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("size2");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
