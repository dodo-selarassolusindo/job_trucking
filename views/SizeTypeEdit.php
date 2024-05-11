<?php

namespace PHPMaker2024\prj_job_trucking;

// Page object
$SizeTypeEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fsize_typeedit" id="fsize_typeedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { size_type: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fsize_typeedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fsize_typeedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["Size_Type_ID", [fields.Size_Type_ID.visible && fields.Size_Type_ID.required ? ew.Validators.required(fields.Size_Type_ID.caption) : null], fields.Size_Type_ID.isInvalid],
            ["SizeID", [fields.SizeID.visible && fields.SizeID.required ? ew.Validators.required(fields.SizeID.caption) : null, ew.Validators.integer], fields.SizeID.isInvalid],
            ["TypeID", [fields.TypeID.visible && fields.TypeID.required ? ew.Validators.required(fields.TypeID.caption) : null, ew.Validators.integer], fields.TypeID.isInvalid]
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
<input type="hidden" name="t" value="size_type">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->Size_Type_ID->Visible) { // Size_Type_ID ?>
    <div id="r_Size_Type_ID"<?= $Page->Size_Type_ID->rowAttributes() ?>>
        <label id="elh_size_type_Size_Type_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Size_Type_ID->caption() ?><?= $Page->Size_Type_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Size_Type_ID->cellAttributes() ?>>
<span id="el_size_type_Size_Type_ID">
<span<?= $Page->Size_Type_ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->Size_Type_ID->getDisplayValue($Page->Size_Type_ID->EditValue))) ?>"></span>
<input type="hidden" data-table="size_type" data-field="x_Size_Type_ID" data-hidden="1" name="x_Size_Type_ID" id="x_Size_Type_ID" value="<?= HtmlEncode($Page->Size_Type_ID->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SizeID->Visible) { // SizeID ?>
    <div id="r_SizeID"<?= $Page->SizeID->rowAttributes() ?>>
        <label id="elh_size_type_SizeID" for="x_SizeID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SizeID->caption() ?><?= $Page->SizeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->SizeID->cellAttributes() ?>>
<span id="el_size_type_SizeID">
<input type="<?= $Page->SizeID->getInputTextType() ?>" name="x_SizeID" id="x_SizeID" data-table="size_type" data-field="x_SizeID" value="<?= $Page->SizeID->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->SizeID->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->SizeID->formatPattern()) ?>"<?= $Page->SizeID->editAttributes() ?> aria-describedby="x_SizeID_help">
<?= $Page->SizeID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->SizeID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->TypeID->Visible) { // TypeID ?>
    <div id="r_TypeID"<?= $Page->TypeID->rowAttributes() ?>>
        <label id="elh_size_type_TypeID" for="x_TypeID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->TypeID->caption() ?><?= $Page->TypeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->TypeID->cellAttributes() ?>>
<span id="el_size_type_TypeID">
<input type="<?= $Page->TypeID->getInputTextType() ?>" name="x_TypeID" id="x_TypeID" data-table="size_type" data-field="x_TypeID" value="<?= $Page->TypeID->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->TypeID->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->TypeID->formatPattern()) ?>"<?= $Page->TypeID->editAttributes() ?> aria-describedby="x_TypeID_help">
<?= $Page->TypeID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->TypeID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fsize_typeedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fsize_typeedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("size_type");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
