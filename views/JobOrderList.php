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

        // Dynamic selection lists
        .setLists({
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
<div class="row mb-0">
    <div class="col-sm-auto px-0 pe-sm-2">
        <div class="ew-basic-search input-group">
            <input type="search" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control ew-basic-search-keyword" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>" aria-label="<?= HtmlEncode($Language->phrase("Search")) ?>">
            <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" class="ew-basic-search-type" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
            <button type="button" data-bs-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false">
                <span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fjob_ordersrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fjob_ordersrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fjob_ordersrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fjob_ordersrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
            </div>
        </div>
    </div>
    <div class="col-sm-auto mb-3">
        <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
    </div>
</div>
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
