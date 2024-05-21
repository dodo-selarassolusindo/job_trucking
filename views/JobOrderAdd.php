<?php

namespace PHPMaker2024\prj_job_trucking;

// Page object
$JobOrderAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { job_order: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fjob_orderadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjob_orderadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["Job2ID", [fields.Job2ID.visible && fields.Job2ID.required ? ew.Validators.required(fields.Job2ID.caption) : null], fields.Job2ID.isInvalid],
            ["SizeID", [fields.SizeID.visible && fields.SizeID.required ? ew.Validators.required(fields.SizeID.caption) : null], fields.SizeID.isInvalid],
            ["TypeID", [fields.TypeID.visible && fields.TypeID.required ? ew.Validators.required(fields.TypeID.caption) : null, ew.Validators.integer], fields.TypeID.isInvalid],
            ["Tanggal", [fields.Tanggal.visible && fields.Tanggal.required ? ew.Validators.required(fields.Tanggal.caption) : null, ew.Validators.datetime(fields.Tanggal.clientFormatPattern)], fields.Tanggal.isInvalid],
            ["LokasiID", [fields.LokasiID.visible && fields.LokasiID.required ? ew.Validators.required(fields.LokasiID.caption) : null], fields.LokasiID.isInvalid],
            ["PelabuhanID", [fields.PelabuhanID.visible && fields.PelabuhanID.required ? ew.Validators.required(fields.PelabuhanID.caption) : null], fields.PelabuhanID.isInvalid],
            ["BL_Extra", [fields.BL_Extra.visible && fields.BL_Extra.required ? ew.Validators.required(fields.BL_Extra.caption) : null, ew.Validators.float], fields.BL_Extra.isInvalid],
            ["DepoID", [fields.DepoID.visible && fields.DepoID.required ? ew.Validators.required(fields.DepoID.caption) : null], fields.DepoID.isInvalid],
            ["Ongkos", [fields.Ongkos.visible && fields.Ongkos.required ? ew.Validators.required(fields.Ongkos.caption) : null, ew.Validators.float], fields.Ongkos.isInvalid],
            ["IsShow", [fields.IsShow.visible && fields.IsShow.required ? ew.Validators.required(fields.IsShow.caption) : null], fields.IsShow.isInvalid],
            ["IsOpen", [fields.IsOpen.visible && fields.IsOpen.required ? ew.Validators.required(fields.IsOpen.caption) : null], fields.IsOpen.isInvalid],
            ["TakenByID", [fields.TakenByID.visible && fields.TakenByID.required ? ew.Validators.required(fields.TakenByID.caption) : null], fields.TakenByID.isInvalid]
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
            "Job2ID": <?= $Page->Job2ID->toClientList($Page) ?>,
            "SizeID": <?= $Page->SizeID->toClientList($Page) ?>,
            "TypeID": <?= $Page->TypeID->toClientList($Page) ?>,
            "LokasiID": <?= $Page->LokasiID->toClientList($Page) ?>,
            "PelabuhanID": <?= $Page->PelabuhanID->toClientList($Page) ?>,
            "DepoID": <?= $Page->DepoID->toClientList($Page) ?>,
            "IsShow": <?= $Page->IsShow->toClientList($Page) ?>,
            "IsOpen": <?= $Page->IsOpen->toClientList($Page) ?>,
            "TakenByID": <?= $Page->TakenByID->toClientList($Page) ?>,
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
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fjob_orderadd" id="fjob_orderadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="job_order">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->Job2ID->Visible) { // Job2ID ?>
    <div id="r_Job2ID"<?= $Page->Job2ID->rowAttributes() ?>>
        <label id="elh_job_order_Job2ID" for="x_Job2ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Job2ID->caption() ?><?= $Page->Job2ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Job2ID->cellAttributes() ?>>
<span id="el_job_order_Job2ID">
    <select
        id="x_Job2ID"
        name="x_Job2ID"
        class="form-control ew-select<?= $Page->Job2ID->isInvalidClass() ?>"
        data-select2-id="fjob_orderadd_x_Job2ID"
        data-table="job_order"
        data-field="x_Job2ID"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->Job2ID->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->Job2ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->Job2ID->getPlaceHolder()) ?>"
        <?= $Page->Job2ID->editAttributes() ?>>
        <?= $Page->Job2ID->selectOptionListHtml("x_Job2ID") ?>
    </select>
    <?= $Page->Job2ID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->Job2ID->getErrorMessage() ?></div>
<?= $Page->Job2ID->Lookup->getParamTag($Page, "p_x_Job2ID") ?>
<script>
loadjs.ready("fjob_orderadd", function() {
    var options = { name: "x_Job2ID", selectId: "fjob_orderadd_x_Job2ID" };
    if (fjob_orderadd.lists.Job2ID?.lookupOptions.length) {
        options.data = { id: "x_Job2ID", form: "fjob_orderadd" };
    } else {
        options.ajax = { id: "x_Job2ID", form: "fjob_orderadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.job_order.fields.Job2ID.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SizeID->Visible) { // SizeID ?>
    <div id="r_SizeID"<?= $Page->SizeID->rowAttributes() ?>>
        <label id="elh_job_order_SizeID" for="x_SizeID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SizeID->caption() ?><?= $Page->SizeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->SizeID->cellAttributes() ?>>
<span id="el_job_order_SizeID">
    <select
        id="x_SizeID"
        name="x_SizeID"
        class="form-control ew-select<?= $Page->SizeID->isInvalidClass() ?>"
        data-select2-id="fjob_orderadd_x_SizeID"
        data-table="job_order"
        data-field="x_SizeID"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->SizeID->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->SizeID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SizeID->getPlaceHolder()) ?>"
        data-ew-action="update-options"
        <?= $Page->SizeID->editAttributes() ?>>
        <?= $Page->SizeID->selectOptionListHtml("x_SizeID") ?>
    </select>
    <?= $Page->SizeID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->SizeID->getErrorMessage() ?></div>
<?= $Page->SizeID->Lookup->getParamTag($Page, "p_x_SizeID") ?>
<script>
loadjs.ready("fjob_orderadd", function() {
    var options = { name: "x_SizeID", selectId: "fjob_orderadd_x_SizeID" };
    if (fjob_orderadd.lists.SizeID?.lookupOptions.length) {
        options.data = { id: "x_SizeID", form: "fjob_orderadd" };
    } else {
        options.ajax = { id: "x_SizeID", form: "fjob_orderadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.job_order.fields.SizeID.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->TypeID->Visible) { // TypeID ?>
    <div id="r_TypeID"<?= $Page->TypeID->rowAttributes() ?>>
        <label id="elh_job_order_TypeID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->TypeID->caption() ?><?= $Page->TypeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->TypeID->cellAttributes() ?>>
<span id="el_job_order_TypeID">
    <select
        id="x_TypeID"
        name="x_TypeID"
        class="form-control ew-select<?= $Page->TypeID->isInvalidClass() ?>"
        data-select2-id="fjob_orderadd_x_TypeID"
        data-table="job_order"
        data-field="x_TypeID"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->TypeID->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->TypeID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->TypeID->getPlaceHolder()) ?>"
        <?= $Page->TypeID->editAttributes() ?>>
        <?= $Page->TypeID->selectOptionListHtml("x_TypeID") ?>
    </select>
    <?= $Page->TypeID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->TypeID->getErrorMessage() ?></div>
<?= $Page->TypeID->Lookup->getParamTag($Page, "p_x_TypeID") ?>
<script>
loadjs.ready("fjob_orderadd", function() {
    var options = { name: "x_TypeID", selectId: "fjob_orderadd_x_TypeID" };
    if (fjob_orderadd.lists.TypeID?.lookupOptions.length) {
        options.data = { id: "x_TypeID", form: "fjob_orderadd" };
    } else {
        options.ajax = { id: "x_TypeID", form: "fjob_orderadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.job_order.fields.TypeID.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Tanggal->Visible) { // Tanggal ?>
    <div id="r_Tanggal"<?= $Page->Tanggal->rowAttributes() ?>>
        <label id="elh_job_order_Tanggal" for="x_Tanggal" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Tanggal->caption() ?><?= $Page->Tanggal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Tanggal->cellAttributes() ?>>
<span id="el_job_order_Tanggal">
<input type="<?= $Page->Tanggal->getInputTextType() ?>" name="x_Tanggal" id="x_Tanggal" data-table="job_order" data-field="x_Tanggal" value="<?= $Page->Tanggal->EditValue ?>" placeholder="<?= HtmlEncode($Page->Tanggal->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->Tanggal->formatPattern()) ?>"<?= $Page->Tanggal->editAttributes() ?> aria-describedby="x_Tanggal_help">
<?= $Page->Tanggal->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Tanggal->getErrorMessage() ?></div>
<?php if (!$Page->Tanggal->ReadOnly && !$Page->Tanggal->Disabled && !isset($Page->Tanggal->EditAttrs["readonly"]) && !isset($Page->Tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjob_orderadd", "datetimepicker"], function () {
    let format = "<?= DateFormat(7) ?>",
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
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i)
                },
                theme: ew.getPreferredTheme()
            }
        };
    ew.createDateTimePicker("fjob_orderadd", "x_Tanggal", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->LokasiID->Visible) { // LokasiID ?>
    <div id="r_LokasiID"<?= $Page->LokasiID->rowAttributes() ?>>
        <label id="elh_job_order_LokasiID" for="x_LokasiID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->LokasiID->caption() ?><?= $Page->LokasiID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->LokasiID->cellAttributes() ?>>
<span id="el_job_order_LokasiID">
    <select
        id="x_LokasiID"
        name="x_LokasiID"
        class="form-control ew-select<?= $Page->LokasiID->isInvalidClass() ?>"
        data-select2-id="fjob_orderadd_x_LokasiID"
        data-table="job_order"
        data-field="x_LokasiID"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->LokasiID->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->LokasiID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->LokasiID->getPlaceHolder()) ?>"
        <?= $Page->LokasiID->editAttributes() ?>>
        <?= $Page->LokasiID->selectOptionListHtml("x_LokasiID") ?>
    </select>
    <?= $Page->LokasiID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->LokasiID->getErrorMessage() ?></div>
<?= $Page->LokasiID->Lookup->getParamTag($Page, "p_x_LokasiID") ?>
<script>
loadjs.ready("fjob_orderadd", function() {
    var options = { name: "x_LokasiID", selectId: "fjob_orderadd_x_LokasiID" };
    if (fjob_orderadd.lists.LokasiID?.lookupOptions.length) {
        options.data = { id: "x_LokasiID", form: "fjob_orderadd" };
    } else {
        options.ajax = { id: "x_LokasiID", form: "fjob_orderadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.job_order.fields.LokasiID.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PelabuhanID->Visible) { // PelabuhanID ?>
    <div id="r_PelabuhanID"<?= $Page->PelabuhanID->rowAttributes() ?>>
        <label id="elh_job_order_PelabuhanID" for="x_PelabuhanID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PelabuhanID->caption() ?><?= $Page->PelabuhanID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->PelabuhanID->cellAttributes() ?>>
<span id="el_job_order_PelabuhanID">
    <select
        id="x_PelabuhanID"
        name="x_PelabuhanID"
        class="form-control ew-select<?= $Page->PelabuhanID->isInvalidClass() ?>"
        data-select2-id="fjob_orderadd_x_PelabuhanID"
        data-table="job_order"
        data-field="x_PelabuhanID"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->PelabuhanID->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->PelabuhanID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PelabuhanID->getPlaceHolder()) ?>"
        <?= $Page->PelabuhanID->editAttributes() ?>>
        <?= $Page->PelabuhanID->selectOptionListHtml("x_PelabuhanID") ?>
    </select>
    <?= $Page->PelabuhanID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->PelabuhanID->getErrorMessage() ?></div>
<?= $Page->PelabuhanID->Lookup->getParamTag($Page, "p_x_PelabuhanID") ?>
<script>
loadjs.ready("fjob_orderadd", function() {
    var options = { name: "x_PelabuhanID", selectId: "fjob_orderadd_x_PelabuhanID" };
    if (fjob_orderadd.lists.PelabuhanID?.lookupOptions.length) {
        options.data = { id: "x_PelabuhanID", form: "fjob_orderadd" };
    } else {
        options.ajax = { id: "x_PelabuhanID", form: "fjob_orderadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.job_order.fields.PelabuhanID.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->BL_Extra->Visible) { // BL_Extra ?>
    <div id="r_BL_Extra"<?= $Page->BL_Extra->rowAttributes() ?>>
        <label id="elh_job_order_BL_Extra" for="x_BL_Extra" class="<?= $Page->LeftColumnClass ?>"><?= $Page->BL_Extra->caption() ?><?= $Page->BL_Extra->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->BL_Extra->cellAttributes() ?>>
<span id="el_job_order_BL_Extra">
<input type="<?= $Page->BL_Extra->getInputTextType() ?>" name="x_BL_Extra" id="x_BL_Extra" data-table="job_order" data-field="x_BL_Extra" value="<?= $Page->BL_Extra->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->BL_Extra->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->BL_Extra->formatPattern()) ?>"<?= $Page->BL_Extra->editAttributes() ?> aria-describedby="x_BL_Extra_help">
<?= $Page->BL_Extra->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->BL_Extra->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DepoID->Visible) { // DepoID ?>
    <div id="r_DepoID"<?= $Page->DepoID->rowAttributes() ?>>
        <label id="elh_job_order_DepoID" for="x_DepoID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DepoID->caption() ?><?= $Page->DepoID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->DepoID->cellAttributes() ?>>
<span id="el_job_order_DepoID">
    <select
        id="x_DepoID"
        name="x_DepoID"
        class="form-control ew-select<?= $Page->DepoID->isInvalidClass() ?>"
        data-select2-id="fjob_orderadd_x_DepoID"
        data-table="job_order"
        data-field="x_DepoID"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->DepoID->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->DepoID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->DepoID->getPlaceHolder()) ?>"
        <?= $Page->DepoID->editAttributes() ?>>
        <?= $Page->DepoID->selectOptionListHtml("x_DepoID") ?>
    </select>
    <?= $Page->DepoID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->DepoID->getErrorMessage() ?></div>
<?= $Page->DepoID->Lookup->getParamTag($Page, "p_x_DepoID") ?>
<script>
loadjs.ready("fjob_orderadd", function() {
    var options = { name: "x_DepoID", selectId: "fjob_orderadd_x_DepoID" };
    if (fjob_orderadd.lists.DepoID?.lookupOptions.length) {
        options.data = { id: "x_DepoID", form: "fjob_orderadd" };
    } else {
        options.ajax = { id: "x_DepoID", form: "fjob_orderadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.job_order.fields.DepoID.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Ongkos->Visible) { // Ongkos ?>
    <div id="r_Ongkos"<?= $Page->Ongkos->rowAttributes() ?>>
        <label id="elh_job_order_Ongkos" for="x_Ongkos" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Ongkos->caption() ?><?= $Page->Ongkos->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Ongkos->cellAttributes() ?>>
<span id="el_job_order_Ongkos">
<input type="<?= $Page->Ongkos->getInputTextType() ?>" name="x_Ongkos" id="x_Ongkos" data-table="job_order" data-field="x_Ongkos" value="<?= $Page->Ongkos->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->Ongkos->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->Ongkos->formatPattern()) ?>"<?= $Page->Ongkos->editAttributes() ?> aria-describedby="x_Ongkos_help">
<?= $Page->Ongkos->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Ongkos->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->IsShow->Visible) { // IsShow ?>
    <div id="r_IsShow"<?= $Page->IsShow->rowAttributes() ?>>
        <label id="elh_job_order_IsShow" for="x_IsShow" class="<?= $Page->LeftColumnClass ?>"><?= $Page->IsShow->caption() ?><?= $Page->IsShow->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->IsShow->cellAttributes() ?>>
<span id="el_job_order_IsShow">
    <select
        id="x_IsShow"
        name="x_IsShow"
        class="form-select ew-select<?= $Page->IsShow->isInvalidClass() ?>"
        <?php if (!$Page->IsShow->IsNativeSelect) { ?>
        data-select2-id="fjob_orderadd_x_IsShow"
        <?php } ?>
        data-table="job_order"
        data-field="x_IsShow"
        data-value-separator="<?= $Page->IsShow->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->IsShow->getPlaceHolder()) ?>"
        <?= $Page->IsShow->editAttributes() ?>>
        <?= $Page->IsShow->selectOptionListHtml("x_IsShow") ?>
    </select>
    <?= $Page->IsShow->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->IsShow->getErrorMessage() ?></div>
<?php if (!$Page->IsShow->IsNativeSelect) { ?>
<script>
loadjs.ready("fjob_orderadd", function() {
    var options = { name: "x_IsShow", selectId: "fjob_orderadd_x_IsShow" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjob_orderadd.lists.IsShow?.lookupOptions.length) {
        options.data = { id: "x_IsShow", form: "fjob_orderadd" };
    } else {
        options.ajax = { id: "x_IsShow", form: "fjob_orderadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.job_order.fields.IsShow.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->IsOpen->Visible) { // IsOpen ?>
    <div id="r_IsOpen"<?= $Page->IsOpen->rowAttributes() ?>>
        <label id="elh_job_order_IsOpen" for="x_IsOpen" class="<?= $Page->LeftColumnClass ?>"><?= $Page->IsOpen->caption() ?><?= $Page->IsOpen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->IsOpen->cellAttributes() ?>>
<span id="el_job_order_IsOpen">
    <select
        id="x_IsOpen"
        name="x_IsOpen"
        class="form-select ew-select<?= $Page->IsOpen->isInvalidClass() ?>"
        <?php if (!$Page->IsOpen->IsNativeSelect) { ?>
        data-select2-id="fjob_orderadd_x_IsOpen"
        <?php } ?>
        data-table="job_order"
        data-field="x_IsOpen"
        data-value-separator="<?= $Page->IsOpen->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->IsOpen->getPlaceHolder()) ?>"
        <?= $Page->IsOpen->editAttributes() ?>>
        <?= $Page->IsOpen->selectOptionListHtml("x_IsOpen") ?>
    </select>
    <?= $Page->IsOpen->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->IsOpen->getErrorMessage() ?></div>
<?php if (!$Page->IsOpen->IsNativeSelect) { ?>
<script>
loadjs.ready("fjob_orderadd", function() {
    var options = { name: "x_IsOpen", selectId: "fjob_orderadd_x_IsOpen" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjob_orderadd.lists.IsOpen?.lookupOptions.length) {
        options.data = { id: "x_IsOpen", form: "fjob_orderadd" };
    } else {
        options.ajax = { id: "x_IsOpen", form: "fjob_orderadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.job_order.fields.IsOpen.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->TakenByID->Visible) { // TakenByID ?>
    <div id="r_TakenByID"<?= $Page->TakenByID->rowAttributes() ?>>
        <label id="elh_job_order_TakenByID" for="x_TakenByID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->TakenByID->caption() ?><?= $Page->TakenByID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->TakenByID->cellAttributes() ?>>
<span id="el_job_order_TakenByID">
    <select
        id="x_TakenByID"
        name="x_TakenByID"
        class="form-control ew-select<?= $Page->TakenByID->isInvalidClass() ?>"
        data-select2-id="fjob_orderadd_x_TakenByID"
        data-table="job_order"
        data-field="x_TakenByID"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->TakenByID->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->TakenByID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->TakenByID->getPlaceHolder()) ?>"
        <?= $Page->TakenByID->editAttributes() ?>>
        <?= $Page->TakenByID->selectOptionListHtml("x_TakenByID") ?>
    </select>
    <?= $Page->TakenByID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->TakenByID->getErrorMessage() ?></div>
<?= $Page->TakenByID->Lookup->getParamTag($Page, "p_x_TakenByID") ?>
<script>
loadjs.ready("fjob_orderadd", function() {
    var options = { name: "x_TakenByID", selectId: "fjob_orderadd_x_TakenByID" };
    if (fjob_orderadd.lists.TakenByID?.lookupOptions.length) {
        options.data = { id: "x_TakenByID", form: "fjob_orderadd" };
    } else {
        options.ajax = { id: "x_TakenByID", form: "fjob_orderadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.job_order.fields.TakenByID.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjob_orderadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjob_orderadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
<?php } ?>
    </div><!-- /buttons offset -->
<?= $Page->IsModal ? "</template>" : "</div>" ?><!-- /buttons .row -->
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("job_order");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
