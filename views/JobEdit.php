<?php

namespace PHPMaker2024\prj_job_trucking;

// Page object
$JobEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fjobedit" id="fjobedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { job: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fjobedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjobedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["JobID", [fields.JobID.visible && fields.JobID.required ? ew.Validators.required(fields.JobID.caption) : null], fields.JobID.isInvalid],
            ["Tanggal", [fields.Tanggal.visible && fields.Tanggal.required ? ew.Validators.required(fields.Tanggal.caption) : null, ew.Validators.datetime(fields.Tanggal.clientFormatPattern)], fields.Tanggal.isInvalid],
            ["Nomor", [fields.Nomor.visible && fields.Nomor.required ? ew.Validators.required(fields.Nomor.caption) : null], fields.Nomor.isInvalid],
            ["Tanggal_Muat", [fields.Tanggal_Muat.visible && fields.Tanggal_Muat.required ? ew.Validators.required(fields.Tanggal_Muat.caption) : null, ew.Validators.datetime(fields.Tanggal_Muat.clientFormatPattern)], fields.Tanggal_Muat.isInvalid],
            ["Customer", [fields.Customer.visible && fields.Customer.required ? ew.Validators.required(fields.Customer.caption) : null, ew.Validators.integer], fields.Customer.isInvalid],
            ["Shipper", [fields.Shipper.visible && fields.Shipper.required ? ew.Validators.required(fields.Shipper.caption) : null, ew.Validators.integer], fields.Shipper.isInvalid],
            ["Lokasi", [fields.Lokasi.visible && fields.Lokasi.required ? ew.Validators.required(fields.Lokasi.caption) : null, ew.Validators.integer], fields.Lokasi.isInvalid]
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
<input type="hidden" name="t" value="job">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->JobID->Visible) { // JobID ?>
    <div id="r_JobID"<?= $Page->JobID->rowAttributes() ?>>
        <label id="elh_job_JobID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->JobID->caption() ?><?= $Page->JobID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->JobID->cellAttributes() ?>>
<span id="el_job_JobID">
<span<?= $Page->JobID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->JobID->getDisplayValue($Page->JobID->EditValue))) ?>"></span>
<input type="hidden" data-table="job" data-field="x_JobID" data-hidden="1" name="x_JobID" id="x_JobID" value="<?= HtmlEncode($Page->JobID->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Tanggal->Visible) { // Tanggal ?>
    <div id="r_Tanggal"<?= $Page->Tanggal->rowAttributes() ?>>
        <label id="elh_job_Tanggal" for="x_Tanggal" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Tanggal->caption() ?><?= $Page->Tanggal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Tanggal->cellAttributes() ?>>
<span id="el_job_Tanggal">
<input type="<?= $Page->Tanggal->getInputTextType() ?>" name="x_Tanggal" id="x_Tanggal" data-table="job" data-field="x_Tanggal" value="<?= $Page->Tanggal->EditValue ?>" placeholder="<?= HtmlEncode($Page->Tanggal->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->Tanggal->formatPattern()) ?>"<?= $Page->Tanggal->editAttributes() ?> aria-describedby="x_Tanggal_help">
<?= $Page->Tanggal->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Tanggal->getErrorMessage() ?></div>
<?php if (!$Page->Tanggal->ReadOnly && !$Page->Tanggal->Disabled && !isset($Page->Tanggal->EditAttrs["readonly"]) && !isset($Page->Tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjobedit", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID + "-u-nu-" + ew.getNumberingSystem(),
                hourCycle: format.match(/H/) ? "h24" : "h12",
                format,
                ...ew.language.phrase("datetimepicker")
            },
            display: {
                icons: {
                    previous: ew.IS_RTL ? "fa-solid fa-chevron-right" : "fa-solid fa-chevron-left",
                    next: ew.IS_RTL ? "fa-solid fa-chevron-left" : "fa-solid fa-chevron-right"
                },
                components: {
                    clock: !!format.match(/h/i) || !!format.match(/m/) || !!format.match(/s/i),
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i)
                },
                theme: ew.getPreferredTheme()
            }
        };
    ew.createDateTimePicker("fjobedit", "x_Tanggal", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Nomor->Visible) { // Nomor ?>
    <div id="r_Nomor"<?= $Page->Nomor->rowAttributes() ?>>
        <label id="elh_job_Nomor" for="x_Nomor" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Nomor->caption() ?><?= $Page->Nomor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Nomor->cellAttributes() ?>>
<span id="el_job_Nomor">
<input type="<?= $Page->Nomor->getInputTextType() ?>" name="x_Nomor" id="x_Nomor" data-table="job" data-field="x_Nomor" value="<?= $Page->Nomor->EditValue ?>" size="30" maxlength="9" placeholder="<?= HtmlEncode($Page->Nomor->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->Nomor->formatPattern()) ?>"<?= $Page->Nomor->editAttributes() ?> aria-describedby="x_Nomor_help">
<?= $Page->Nomor->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Nomor->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Tanggal_Muat->Visible) { // Tanggal_Muat ?>
    <div id="r_Tanggal_Muat"<?= $Page->Tanggal_Muat->rowAttributes() ?>>
        <label id="elh_job_Tanggal_Muat" for="x_Tanggal_Muat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Tanggal_Muat->caption() ?><?= $Page->Tanggal_Muat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Tanggal_Muat->cellAttributes() ?>>
<span id="el_job_Tanggal_Muat">
<input type="<?= $Page->Tanggal_Muat->getInputTextType() ?>" name="x_Tanggal_Muat" id="x_Tanggal_Muat" data-table="job" data-field="x_Tanggal_Muat" value="<?= $Page->Tanggal_Muat->EditValue ?>" placeholder="<?= HtmlEncode($Page->Tanggal_Muat->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->Tanggal_Muat->formatPattern()) ?>"<?= $Page->Tanggal_Muat->editAttributes() ?> aria-describedby="x_Tanggal_Muat_help">
<?= $Page->Tanggal_Muat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Tanggal_Muat->getErrorMessage() ?></div>
<?php if (!$Page->Tanggal_Muat->ReadOnly && !$Page->Tanggal_Muat->Disabled && !isset($Page->Tanggal_Muat->EditAttrs["readonly"]) && !isset($Page->Tanggal_Muat->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjobedit", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID + "-u-nu-" + ew.getNumberingSystem(),
                hourCycle: format.match(/H/) ? "h24" : "h12",
                format,
                ...ew.language.phrase("datetimepicker")
            },
            display: {
                icons: {
                    previous: ew.IS_RTL ? "fa-solid fa-chevron-right" : "fa-solid fa-chevron-left",
                    next: ew.IS_RTL ? "fa-solid fa-chevron-left" : "fa-solid fa-chevron-right"
                },
                components: {
                    clock: !!format.match(/h/i) || !!format.match(/m/) || !!format.match(/s/i),
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i)
                },
                theme: ew.getPreferredTheme()
            }
        };
    ew.createDateTimePicker("fjobedit", "x_Tanggal_Muat", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Customer->Visible) { // Customer ?>
    <div id="r_Customer"<?= $Page->Customer->rowAttributes() ?>>
        <label id="elh_job_Customer" for="x_Customer" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Customer->caption() ?><?= $Page->Customer->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Customer->cellAttributes() ?>>
<span id="el_job_Customer">
<input type="<?= $Page->Customer->getInputTextType() ?>" name="x_Customer" id="x_Customer" data-table="job" data-field="x_Customer" value="<?= $Page->Customer->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->Customer->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->Customer->formatPattern()) ?>"<?= $Page->Customer->editAttributes() ?> aria-describedby="x_Customer_help">
<?= $Page->Customer->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Customer->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Shipper->Visible) { // Shipper ?>
    <div id="r_Shipper"<?= $Page->Shipper->rowAttributes() ?>>
        <label id="elh_job_Shipper" for="x_Shipper" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Shipper->caption() ?><?= $Page->Shipper->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Shipper->cellAttributes() ?>>
<span id="el_job_Shipper">
<input type="<?= $Page->Shipper->getInputTextType() ?>" name="x_Shipper" id="x_Shipper" data-table="job" data-field="x_Shipper" value="<?= $Page->Shipper->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->Shipper->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->Shipper->formatPattern()) ?>"<?= $Page->Shipper->editAttributes() ?> aria-describedby="x_Shipper_help">
<?= $Page->Shipper->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Shipper->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Lokasi->Visible) { // Lokasi ?>
    <div id="r_Lokasi"<?= $Page->Lokasi->rowAttributes() ?>>
        <label id="elh_job_Lokasi" for="x_Lokasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Lokasi->caption() ?><?= $Page->Lokasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Lokasi->cellAttributes() ?>>
<span id="el_job_Lokasi">
<input type="<?= $Page->Lokasi->getInputTextType() ?>" name="x_Lokasi" id="x_Lokasi" data-table="job" data-field="x_Lokasi" value="<?= $Page->Lokasi->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->Lokasi->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->Lokasi->formatPattern()) ?>"<?= $Page->Lokasi->editAttributes() ?> aria-describedby="x_Lokasi_help">
<?= $Page->Lokasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Lokasi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjobedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjobedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("job");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
