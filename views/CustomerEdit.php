<?php

namespace PHPMaker2024\prj_job_trucking;

// Page object
$CustomerEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fcustomeredit" id="fcustomeredit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { customer: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fcustomeredit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fcustomeredit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["Nama", [fields.Nama.visible && fields.Nama.required ? ew.Validators.required(fields.Nama.caption) : null], fields.Nama.isInvalid],
            ["Nomor_Telepon", [fields.Nomor_Telepon.visible && fields.Nomor_Telepon.required ? ew.Validators.required(fields.Nomor_Telepon.caption) : null], fields.Nomor_Telepon.isInvalid],
            ["Contact_Person", [fields.Contact_Person.visible && fields.Contact_Person.required ? ew.Validators.required(fields.Contact_Person.caption) : null], fields.Contact_Person.isInvalid]
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
<input type="hidden" name="t" value="customer">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_customer_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_customer_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="customer" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Nama->Visible) { // Nama ?>
    <div id="r_Nama"<?= $Page->Nama->rowAttributes() ?>>
        <label id="elh_customer_Nama" for="x_Nama" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Nama->caption() ?><?= $Page->Nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Nama->cellAttributes() ?>>
<span id="el_customer_Nama">
<input type="<?= $Page->Nama->getInputTextType() ?>" name="x_Nama" id="x_Nama" data-table="customer" data-field="x_Nama" value="<?= $Page->Nama->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->Nama->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->Nama->formatPattern()) ?>"<?= $Page->Nama->editAttributes() ?> aria-describedby="x_Nama_help">
<?= $Page->Nama->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Nama->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Nomor_Telepon->Visible) { // Nomor_Telepon ?>
    <div id="r_Nomor_Telepon"<?= $Page->Nomor_Telepon->rowAttributes() ?>>
        <label id="elh_customer_Nomor_Telepon" for="x_Nomor_Telepon" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Nomor_Telepon->caption() ?><?= $Page->Nomor_Telepon->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Nomor_Telepon->cellAttributes() ?>>
<span id="el_customer_Nomor_Telepon">
<input type="<?= $Page->Nomor_Telepon->getInputTextType() ?>" name="x_Nomor_Telepon" id="x_Nomor_Telepon" data-table="customer" data-field="x_Nomor_Telepon" value="<?= $Page->Nomor_Telepon->EditValue ?>" size="30" maxlength="25" placeholder="<?= HtmlEncode($Page->Nomor_Telepon->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->Nomor_Telepon->formatPattern()) ?>"<?= $Page->Nomor_Telepon->editAttributes() ?> aria-describedby="x_Nomor_Telepon_help">
<?= $Page->Nomor_Telepon->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Nomor_Telepon->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Contact_Person->Visible) { // Contact_Person ?>
    <div id="r_Contact_Person"<?= $Page->Contact_Person->rowAttributes() ?>>
        <label id="elh_customer_Contact_Person" for="x_Contact_Person" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Contact_Person->caption() ?><?= $Page->Contact_Person->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Contact_Person->cellAttributes() ?>>
<span id="el_customer_Contact_Person">
<input type="<?= $Page->Contact_Person->getInputTextType() ?>" name="x_Contact_Person" id="x_Contact_Person" data-table="customer" data-field="x_Contact_Person" value="<?= $Page->Contact_Person->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->Contact_Person->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->Contact_Person->formatPattern()) ?>"<?= $Page->Contact_Person->editAttributes() ?> aria-describedby="x_Contact_Person_help">
<?= $Page->Contact_Person->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Contact_Person->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fcustomeredit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fcustomeredit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("customer");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
