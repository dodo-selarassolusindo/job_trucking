<?php

namespace PHPMaker2024\prj_job_trucking;

// Page object
$PelabuhanEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fpelabuhanedit" id="fpelabuhanedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { pelabuhan: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fpelabuhanedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpelabuhanedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["PelabuhanID", [fields.PelabuhanID.visible && fields.PelabuhanID.required ? ew.Validators.required(fields.PelabuhanID.caption) : null], fields.PelabuhanID.isInvalid],
            ["Kode", [fields.Kode.visible && fields.Kode.required ? ew.Validators.required(fields.Kode.caption) : null], fields.Kode.isInvalid],
            ["Nama", [fields.Nama.visible && fields.Nama.required ? ew.Validators.required(fields.Nama.caption) : null], fields.Nama.isInvalid]
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
<input type="hidden" name="t" value="pelabuhan">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->PelabuhanID->Visible) { // PelabuhanID ?>
    <div id="r_PelabuhanID"<?= $Page->PelabuhanID->rowAttributes() ?>>
        <label id="elh_pelabuhan_PelabuhanID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PelabuhanID->caption() ?><?= $Page->PelabuhanID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->PelabuhanID->cellAttributes() ?>>
<span id="el_pelabuhan_PelabuhanID">
<span<?= $Page->PelabuhanID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->PelabuhanID->getDisplayValue($Page->PelabuhanID->EditValue))) ?>"></span>
<input type="hidden" data-table="pelabuhan" data-field="x_PelabuhanID" data-hidden="1" name="x_PelabuhanID" id="x_PelabuhanID" value="<?= HtmlEncode($Page->PelabuhanID->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Kode->Visible) { // Kode ?>
    <div id="r_Kode"<?= $Page->Kode->rowAttributes() ?>>
        <label id="elh_pelabuhan_Kode" for="x_Kode" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Kode->caption() ?><?= $Page->Kode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Kode->cellAttributes() ?>>
<span id="el_pelabuhan_Kode">
<input type="<?= $Page->Kode->getInputTextType() ?>" name="x_Kode" id="x_Kode" data-table="pelabuhan" data-field="x_Kode" value="<?= $Page->Kode->EditValue ?>" size="30" maxlength="25" placeholder="<?= HtmlEncode($Page->Kode->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->Kode->formatPattern()) ?>"<?= $Page->Kode->editAttributes() ?> aria-describedby="x_Kode_help">
<?= $Page->Kode->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Kode->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Nama->Visible) { // Nama ?>
    <div id="r_Nama"<?= $Page->Nama->rowAttributes() ?>>
        <label id="elh_pelabuhan_Nama" for="x_Nama" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Nama->caption() ?><?= $Page->Nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Nama->cellAttributes() ?>>
<span id="el_pelabuhan_Nama">
<input type="<?= $Page->Nama->getInputTextType() ?>" name="x_Nama" id="x_Nama" data-table="pelabuhan" data-field="x_Nama" value="<?= $Page->Nama->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->Nama->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->Nama->formatPattern()) ?>"<?= $Page->Nama->editAttributes() ?> aria-describedby="x_Nama_help">
<?= $Page->Nama->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Nama->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fpelabuhanedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fpelabuhanedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("pelabuhan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
