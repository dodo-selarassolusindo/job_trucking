<?php

namespace PHPMaker2024\prj_job_trucking;

// Page object
$JobOrderList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { job_order: currentTable } });
var currentPageID = ew.PAGE_ID = "list";
var currentForm;
var <?= $Page->FormName ?>;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("<?= $Page->FormName ?>")
        .setPageId("list")
        .setSubmitWithFetch(<?= $Page->UseAjaxActions ? "true" : "false" ?>)
        .setFormKeyCountName("<?= $Page->FormKeyCountName ?>")

        // Dynamic selection lists
        .setLists({
            "Job2ID": <?= $Page->Job2ID->toClientList($Page) ?>,
            "SizeID": <?= $Page->SizeID->toClientList($Page) ?>,
            "TypeID": <?= $Page->TypeID->toClientList($Page) ?>,
            "Tanggal": <?= $Page->Tanggal->toClientList($Page) ?>,
            "LokasiID": <?= $Page->LokasiID->toClientList($Page) ?>,
            "PelabuhanID": <?= $Page->PelabuhanID->toClientList($Page) ?>,
            "BL_Extra": <?= $Page->BL_Extra->toClientList($Page) ?>,
            "DepoID": <?= $Page->DepoID->toClientList($Page) ?>,
            "Ongkos": <?= $Page->Ongkos->toClientList($Page) ?>,
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
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
</div>
<?php } ?>
<?php if ($Page->ShowCurrentFilter) { ?>
<?php $Page->showFilterList() ?>
<?php } ?>
<?php if (!$Page->IsModal) { ?>
<form name="fjob_ordersrch" id="fjob_ordersrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="off">
<div id="fjob_ordersrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { job_order: currentTable } });
var currentForm;
var fjob_ordersrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fjob_ordersrch")
        .setPageId("list")
<?php if ($Page->UseAjaxActions) { ?>
        .setSubmitWithFetch(true)
<?php } ?>

        // Add fields
        .addFields([
        ])
        // Validate form
        .setValidate(
            async function () {
                if (!this.validateRequired)
                    return true; // Ignore validation
                let fobj = this.getForm();

                // Validate fields
                if (!this.validateFields())
                    return false;

                // Call Form_CustomValidate event
                if (!(await this.customValidate?.(fobj) ?? true)) {
                    this.focus();
                    return false;
                }
                return true;
            }
        )

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
            "Tanggal": <?= $Page->Tanggal->toClientList($Page) ?>,
            "LokasiID": <?= $Page->LokasiID->toClientList($Page) ?>,
            "PelabuhanID": <?= $Page->PelabuhanID->toClientList($Page) ?>,
            "BL_Extra": <?= $Page->BL_Extra->toClientList($Page) ?>,
            "DepoID": <?= $Page->DepoID->toClientList($Page) ?>,
            "Ongkos": <?= $Page->Ongkos->toClientList($Page) ?>,
            "IsShow": <?= $Page->IsShow->toClientList($Page) ?>,
            "IsOpen": <?= $Page->IsOpen->toClientList($Page) ?>,
            "TakenByID": <?= $Page->TakenByID->toClientList($Page) ?>,
        })

        // Filters
        .setFilterList(<?= $Page->getFilterList() ?>)
        .build();
    window[form.id] = form;
    currentSearchForm = form;
    loadjs.done(form.id);
});
</script>
<input type="hidden" name="cmd" value="search">
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !($Page->CurrentAction && $Page->CurrentAction != "search") && $Page->hasSearchFields()) { ?>
<div class="ew-extended-search container-fluid ps-2">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = RowType::SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->Job2ID->Visible) { // Job2ID ?>
<?php
if (!$Page->Job2ID->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_Job2ID" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->Job2ID->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_Job2ID"
            name="x_Job2ID[]"
            class="form-control ew-select<?= $Page->Job2ID->isInvalidClass() ?>"
            data-select2-id="fjob_ordersrch_x_Job2ID"
            data-table="job_order"
            data-field="x_Job2ID"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->Job2ID->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->Job2ID->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->Job2ID->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->Job2ID->editAttributes() ?>>
            <?= $Page->Job2ID->selectOptionListHtml("x_Job2ID", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->Job2ID->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fjob_ordersrch", function() {
            var options = {
                name: "x_Job2ID",
                selectId: "fjob_ordersrch_x_Job2ID",
                ajax: { id: "x_Job2ID", form: "fjob_ordersrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.job_order.fields.Job2ID.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->SizeID->Visible) { // SizeID ?>
<?php
if (!$Page->SizeID->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_SizeID" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->SizeID->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_SizeID"
            name="x_SizeID[]"
            class="form-control ew-select<?= $Page->SizeID->isInvalidClass() ?>"
            data-select2-id="fjob_ordersrch_x_SizeID"
            data-table="job_order"
            data-field="x_SizeID"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->SizeID->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->SizeID->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->SizeID->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->SizeID->editAttributes() ?>>
            <?= $Page->SizeID->selectOptionListHtml("x_SizeID", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->SizeID->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fjob_ordersrch", function() {
            var options = {
                name: "x_SizeID",
                selectId: "fjob_ordersrch_x_SizeID",
                ajax: { id: "x_SizeID", form: "fjob_ordersrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.job_order.fields.SizeID.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->TypeID->Visible) { // TypeID ?>
<?php
if (!$Page->TypeID->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_TypeID" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->TypeID->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_TypeID"
            name="x_TypeID[]"
            class="form-control ew-select<?= $Page->TypeID->isInvalidClass() ?>"
            data-select2-id="fjob_ordersrch_x_TypeID"
            data-table="job_order"
            data-field="x_TypeID"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->TypeID->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->TypeID->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->TypeID->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->TypeID->editAttributes() ?>>
            <?= $Page->TypeID->selectOptionListHtml("x_TypeID", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->TypeID->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fjob_ordersrch", function() {
            var options = {
                name: "x_TypeID",
                selectId: "fjob_ordersrch_x_TypeID",
                ajax: { id: "x_TypeID", form: "fjob_ordersrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.job_order.fields.TypeID.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->Tanggal->Visible) { // Tanggal ?>
<?php
if (!$Page->Tanggal->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_Tanggal" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->Tanggal->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_Tanggal"
            name="x_Tanggal[]"
            class="form-control ew-select<?= $Page->Tanggal->isInvalidClass() ?>"
            data-select2-id="fjob_ordersrch_x_Tanggal"
            data-table="job_order"
            data-field="x_Tanggal"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->Tanggal->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->Tanggal->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->Tanggal->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->Tanggal->editAttributes() ?>>
            <?= $Page->Tanggal->selectOptionListHtml("x_Tanggal", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->Tanggal->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fjob_ordersrch", function() {
            var options = {
                name: "x_Tanggal",
                selectId: "fjob_ordersrch_x_Tanggal",
                ajax: { id: "x_Tanggal", form: "fjob_ordersrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.job_order.fields.Tanggal.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->LokasiID->Visible) { // LokasiID ?>
<?php
if (!$Page->LokasiID->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_LokasiID" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->LokasiID->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_LokasiID"
            name="x_LokasiID[]"
            class="form-control ew-select<?= $Page->LokasiID->isInvalidClass() ?>"
            data-select2-id="fjob_ordersrch_x_LokasiID"
            data-table="job_order"
            data-field="x_LokasiID"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->LokasiID->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->LokasiID->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->LokasiID->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->LokasiID->editAttributes() ?>>
            <?= $Page->LokasiID->selectOptionListHtml("x_LokasiID", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->LokasiID->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fjob_ordersrch", function() {
            var options = {
                name: "x_LokasiID",
                selectId: "fjob_ordersrch_x_LokasiID",
                ajax: { id: "x_LokasiID", form: "fjob_ordersrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.job_order.fields.LokasiID.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->PelabuhanID->Visible) { // PelabuhanID ?>
<?php
if (!$Page->PelabuhanID->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_PelabuhanID" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->PelabuhanID->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_PelabuhanID"
            name="x_PelabuhanID[]"
            class="form-control ew-select<?= $Page->PelabuhanID->isInvalidClass() ?>"
            data-select2-id="fjob_ordersrch_x_PelabuhanID"
            data-table="job_order"
            data-field="x_PelabuhanID"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->PelabuhanID->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->PelabuhanID->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->PelabuhanID->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->PelabuhanID->editAttributes() ?>>
            <?= $Page->PelabuhanID->selectOptionListHtml("x_PelabuhanID", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->PelabuhanID->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fjob_ordersrch", function() {
            var options = {
                name: "x_PelabuhanID",
                selectId: "fjob_ordersrch_x_PelabuhanID",
                ajax: { id: "x_PelabuhanID", form: "fjob_ordersrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.job_order.fields.PelabuhanID.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->BL_Extra->Visible) { // BL_Extra ?>
<?php
if (!$Page->BL_Extra->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_BL_Extra" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->BL_Extra->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_BL_Extra"
            name="x_BL_Extra[]"
            class="form-control ew-select<?= $Page->BL_Extra->isInvalidClass() ?>"
            data-select2-id="fjob_ordersrch_x_BL_Extra"
            data-table="job_order"
            data-field="x_BL_Extra"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->BL_Extra->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->BL_Extra->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->BL_Extra->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->BL_Extra->editAttributes() ?>>
            <?= $Page->BL_Extra->selectOptionListHtml("x_BL_Extra", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->BL_Extra->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fjob_ordersrch", function() {
            var options = {
                name: "x_BL_Extra",
                selectId: "fjob_ordersrch_x_BL_Extra",
                ajax: { id: "x_BL_Extra", form: "fjob_ordersrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.job_order.fields.BL_Extra.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->DepoID->Visible) { // DepoID ?>
<?php
if (!$Page->DepoID->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_DepoID" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->DepoID->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_DepoID"
            name="x_DepoID[]"
            class="form-control ew-select<?= $Page->DepoID->isInvalidClass() ?>"
            data-select2-id="fjob_ordersrch_x_DepoID"
            data-table="job_order"
            data-field="x_DepoID"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->DepoID->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->DepoID->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->DepoID->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->DepoID->editAttributes() ?>>
            <?= $Page->DepoID->selectOptionListHtml("x_DepoID", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->DepoID->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fjob_ordersrch", function() {
            var options = {
                name: "x_DepoID",
                selectId: "fjob_ordersrch_x_DepoID",
                ajax: { id: "x_DepoID", form: "fjob_ordersrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.job_order.fields.DepoID.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->Ongkos->Visible) { // Ongkos ?>
<?php
if (!$Page->Ongkos->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_Ongkos" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->Ongkos->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_Ongkos"
            name="x_Ongkos[]"
            class="form-control ew-select<?= $Page->Ongkos->isInvalidClass() ?>"
            data-select2-id="fjob_ordersrch_x_Ongkos"
            data-table="job_order"
            data-field="x_Ongkos"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->Ongkos->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->Ongkos->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->Ongkos->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->Ongkos->editAttributes() ?>>
            <?= $Page->Ongkos->selectOptionListHtml("x_Ongkos", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->Ongkos->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fjob_ordersrch", function() {
            var options = {
                name: "x_Ongkos",
                selectId: "fjob_ordersrch_x_Ongkos",
                ajax: { id: "x_Ongkos", form: "fjob_ordersrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.job_order.fields.Ongkos.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->IsShow->Visible) { // IsShow ?>
<?php
if (!$Page->IsShow->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_IsShow" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->IsShow->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_IsShow"
            name="x_IsShow[]"
            class="form-control ew-select<?= $Page->IsShow->isInvalidClass() ?>"
            data-select2-id="fjob_ordersrch_x_IsShow"
            data-table="job_order"
            data-field="x_IsShow"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->IsShow->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->IsShow->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->IsShow->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->IsShow->editAttributes() ?>>
            <?= $Page->IsShow->selectOptionListHtml("x_IsShow", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->IsShow->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fjob_ordersrch", function() {
            var options = {
                name: "x_IsShow",
                selectId: "fjob_ordersrch_x_IsShow",
                ajax: { id: "x_IsShow", form: "fjob_ordersrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.job_order.fields.IsShow.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->IsOpen->Visible) { // IsOpen ?>
<?php
if (!$Page->IsOpen->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_IsOpen" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->IsOpen->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_IsOpen"
            name="x_IsOpen[]"
            class="form-control ew-select<?= $Page->IsOpen->isInvalidClass() ?>"
            data-select2-id="fjob_ordersrch_x_IsOpen"
            data-table="job_order"
            data-field="x_IsOpen"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->IsOpen->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->IsOpen->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->IsOpen->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->IsOpen->editAttributes() ?>>
            <?= $Page->IsOpen->selectOptionListHtml("x_IsOpen", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->IsOpen->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fjob_ordersrch", function() {
            var options = {
                name: "x_IsOpen",
                selectId: "fjob_ordersrch_x_IsOpen",
                ajax: { id: "x_IsOpen", form: "fjob_ordersrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.job_order.fields.IsOpen.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->TakenByID->Visible) { // TakenByID ?>
<?php
if (!$Page->TakenByID->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_TakenByID" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->TakenByID->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_TakenByID"
            name="x_TakenByID[]"
            class="form-control ew-select<?= $Page->TakenByID->isInvalidClass() ?>"
            data-select2-id="fjob_ordersrch_x_TakenByID"
            data-table="job_order"
            data-field="x_TakenByID"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->TakenByID->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->TakenByID->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->TakenByID->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->TakenByID->editAttributes() ?>>
            <?= $Page->TakenByID->selectOptionListHtml("x_TakenByID", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->TakenByID->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fjob_ordersrch", function() {
            var options = {
                name: "x_TakenByID",
                selectId: "fjob_ordersrch_x_TakenByID",
                ajax: { id: "x_TakenByID", form: "fjob_ordersrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.job_order.fields.TakenByID.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->SearchColumnCount > 0) { ?>
   <div class="col-sm-auto mb-3">
       <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
   </div>
<?php } ?>
</div><!-- /.row -->
</div><!-- /.ew-extended-search -->
<?php } ?>
<?php } ?>
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="list<?= ($Page->TotalRecords == 0 && !$Page->isAdd()) ? " ew-no-record" : "" ?>">
<div id="ew-header-options">
<?php $Page->HeaderOptions?->render("body") ?>
</div>
<div id="ew-list">
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?= $Page->isAddOrEdit() ? " ew-grid-add-edit" : "" ?> <?= $Page->TableGridClass ?>">
<form name="<?= $Page->FormName ?>" id="<?= $Page->FormName ?>" class="ew-form ew-list-form" action="<?= $Page->PageAction ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="job_order">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div id="gmp_job_order" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_job_orderlist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = RowType::HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->JobOrderID->Visible) { // JobOrderID ?>
        <th data-name="JobOrderID" class="<?= $Page->JobOrderID->headerCellClass() ?>"><div id="elh_job_order_JobOrderID" class="job_order_JobOrderID"><?= $Page->renderFieldHeader($Page->JobOrderID) ?></div></th>
<?php } ?>
<?php if ($Page->Job2ID->Visible) { // Job2ID ?>
        <th data-name="Job2ID" class="<?= $Page->Job2ID->headerCellClass() ?>"><div id="elh_job_order_Job2ID" class="job_order_Job2ID"><?= $Page->renderFieldHeader($Page->Job2ID) ?></div></th>
<?php } ?>
<?php if ($Page->SizeID->Visible) { // SizeID ?>
        <th data-name="SizeID" class="<?= $Page->SizeID->headerCellClass() ?>"><div id="elh_job_order_SizeID" class="job_order_SizeID"><?= $Page->renderFieldHeader($Page->SizeID) ?></div></th>
<?php } ?>
<?php if ($Page->TypeID->Visible) { // TypeID ?>
        <th data-name="TypeID" class="<?= $Page->TypeID->headerCellClass() ?>"><div id="elh_job_order_TypeID" class="job_order_TypeID"><?= $Page->renderFieldHeader($Page->TypeID) ?></div></th>
<?php } ?>
<?php if ($Page->Tanggal->Visible) { // Tanggal ?>
        <th data-name="Tanggal" class="<?= $Page->Tanggal->headerCellClass() ?>"><div id="elh_job_order_Tanggal" class="job_order_Tanggal"><?= $Page->renderFieldHeader($Page->Tanggal) ?></div></th>
<?php } ?>
<?php if ($Page->LokasiID->Visible) { // LokasiID ?>
        <th data-name="LokasiID" class="<?= $Page->LokasiID->headerCellClass() ?>"><div id="elh_job_order_LokasiID" class="job_order_LokasiID"><?= $Page->renderFieldHeader($Page->LokasiID) ?></div></th>
<?php } ?>
<?php if ($Page->PelabuhanID->Visible) { // PelabuhanID ?>
        <th data-name="PelabuhanID" class="<?= $Page->PelabuhanID->headerCellClass() ?>"><div id="elh_job_order_PelabuhanID" class="job_order_PelabuhanID"><?= $Page->renderFieldHeader($Page->PelabuhanID) ?></div></th>
<?php } ?>
<?php if ($Page->BL_Extra->Visible) { // BL_Extra ?>
        <th data-name="BL_Extra" class="<?= $Page->BL_Extra->headerCellClass() ?>"><div id="elh_job_order_BL_Extra" class="job_order_BL_Extra"><?= $Page->renderFieldHeader($Page->BL_Extra) ?></div></th>
<?php } ?>
<?php if ($Page->DepoID->Visible) { // DepoID ?>
        <th data-name="DepoID" class="<?= $Page->DepoID->headerCellClass() ?>"><div id="elh_job_order_DepoID" class="job_order_DepoID"><?= $Page->renderFieldHeader($Page->DepoID) ?></div></th>
<?php } ?>
<?php if ($Page->Ongkos->Visible) { // Ongkos ?>
        <th data-name="Ongkos" class="<?= $Page->Ongkos->headerCellClass() ?>"><div id="elh_job_order_Ongkos" class="job_order_Ongkos"><?= $Page->renderFieldHeader($Page->Ongkos) ?></div></th>
<?php } ?>
<?php if ($Page->IsShow->Visible) { // IsShow ?>
        <th data-name="IsShow" class="<?= $Page->IsShow->headerCellClass() ?>"><div id="elh_job_order_IsShow" class="job_order_IsShow"><?= $Page->renderFieldHeader($Page->IsShow) ?></div></th>
<?php } ?>
<?php if ($Page->IsOpen->Visible) { // IsOpen ?>
        <th data-name="IsOpen" class="<?= $Page->IsOpen->headerCellClass() ?>"><div id="elh_job_order_IsOpen" class="job_order_IsOpen"><?= $Page->renderFieldHeader($Page->IsOpen) ?></div></th>
<?php } ?>
<?php if ($Page->TakenByID->Visible) { // TakenByID ?>
        <th data-name="TakenByID" class="<?= $Page->TakenByID->headerCellClass() ?>"><div id="elh_job_order_TakenByID" class="job_order_TakenByID"><?= $Page->renderFieldHeader($Page->TakenByID) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody data-page="<?= $Page->getPageNumber() ?>">
<?php
$Page->setupGrid();
while ($Page->RecordCount < $Page->StopRecord || $Page->RowIndex === '$rowindex$') {
    if (
        $Page->CurrentRow !== false &&
        $Page->RowIndex !== '$rowindex$' &&
        (!$Page->isGridAdd() || $Page->CurrentMode == "copy") &&
        (!(($Page->isCopy() || $Page->isAdd()) && $Page->RowIndex == 0))
    ) {
        $Page->fetch();
    }
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->setupRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->JobOrderID->Visible) { // JobOrderID ?>
        <td data-name="JobOrderID"<?= $Page->JobOrderID->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_job_order_JobOrderID" class="el_job_order_JobOrderID">
<span<?= $Page->JobOrderID->viewAttributes() ?>>
<?= $Page->JobOrderID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Job2ID->Visible) { // Job2ID ?>
        <td data-name="Job2ID"<?= $Page->Job2ID->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_job_order_Job2ID" class="el_job_order_Job2ID">
<span<?= $Page->Job2ID->viewAttributes() ?>>
<?= $Page->Job2ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->SizeID->Visible) { // SizeID ?>
        <td data-name="SizeID"<?= $Page->SizeID->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_job_order_SizeID" class="el_job_order_SizeID">
<span<?= $Page->SizeID->viewAttributes() ?>>
<?= $Page->SizeID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->TypeID->Visible) { // TypeID ?>
        <td data-name="TypeID"<?= $Page->TypeID->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_job_order_TypeID" class="el_job_order_TypeID">
<span<?= $Page->TypeID->viewAttributes() ?>>
<?= $Page->TypeID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Tanggal->Visible) { // Tanggal ?>
        <td data-name="Tanggal"<?= $Page->Tanggal->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_job_order_Tanggal" class="el_job_order_Tanggal">
<span<?= $Page->Tanggal->viewAttributes() ?>>
<?= $Page->Tanggal->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->LokasiID->Visible) { // LokasiID ?>
        <td data-name="LokasiID"<?= $Page->LokasiID->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_job_order_LokasiID" class="el_job_order_LokasiID">
<span<?= $Page->LokasiID->viewAttributes() ?>>
<?= $Page->LokasiID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->PelabuhanID->Visible) { // PelabuhanID ?>
        <td data-name="PelabuhanID"<?= $Page->PelabuhanID->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_job_order_PelabuhanID" class="el_job_order_PelabuhanID">
<span<?= $Page->PelabuhanID->viewAttributes() ?>>
<?= $Page->PelabuhanID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->BL_Extra->Visible) { // BL_Extra ?>
        <td data-name="BL_Extra"<?= $Page->BL_Extra->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_job_order_BL_Extra" class="el_job_order_BL_Extra">
<span<?= $Page->BL_Extra->viewAttributes() ?>>
<?= $Page->BL_Extra->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->DepoID->Visible) { // DepoID ?>
        <td data-name="DepoID"<?= $Page->DepoID->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_job_order_DepoID" class="el_job_order_DepoID">
<span<?= $Page->DepoID->viewAttributes() ?>>
<?= $Page->DepoID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Ongkos->Visible) { // Ongkos ?>
        <td data-name="Ongkos"<?= $Page->Ongkos->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_job_order_Ongkos" class="el_job_order_Ongkos">
<span<?= $Page->Ongkos->viewAttributes() ?>>
<?= $Page->Ongkos->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->IsShow->Visible) { // IsShow ?>
        <td data-name="IsShow"<?= $Page->IsShow->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_job_order_IsShow" class="el_job_order_IsShow">
<span<?= $Page->IsShow->viewAttributes() ?>>
<?= $Page->IsShow->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->IsOpen->Visible) { // IsOpen ?>
        <td data-name="IsOpen"<?= $Page->IsOpen->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_job_order_IsOpen" class="el_job_order_IsOpen">
<span<?= $Page->IsOpen->viewAttributes() ?>>
<?= $Page->IsOpen->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->TakenByID->Visible) { // TakenByID ?>
        <td data-name="TakenByID"<?= $Page->TakenByID->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_job_order_TakenByID" class="el_job_order_TakenByID">
<span<?= $Page->TakenByID->viewAttributes() ?>>
<?= $Page->TakenByID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }

    // Reset for template row
    if ($Page->RowIndex === '$rowindex$') {
        $Page->RowIndex = 0;
    }
    // Reset inline add/copy row
    if (($Page->isCopy() || $Page->isAdd()) && $Page->RowIndex == 0) {
        $Page->RowIndex = 1;
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction && !$Page->UseAjaxActions) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close result set
$Page->Recordset?->free();
?>
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd() && !($Page->isGridEdit() && $Page->ModalGridEdit) && !$Page->isMultiEdit()) { ?>
<?= $Page->Pager->render() ?>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
</div>
<div id="ew-footer-options">
<?php $Page->FooterOptions?->render("body") ?>
</div>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
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
<?php } ?>
