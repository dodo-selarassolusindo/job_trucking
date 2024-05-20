<?php

namespace PHPMaker2024\prj_job_trucking;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface;
use Slim\Routing\RouteCollectorProxy;
use Slim\App;
use Closure;

/**
 * Page class
 */
class JobOrderAdd extends JobOrder
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "JobOrderAdd";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "joborderadd";

    // Audit Trail
    public $AuditTrailOnAdd = true;
    public $AuditTrailOnEdit = true;
    public $AuditTrailOnDelete = true;
    public $AuditTrailOnView = false;
    public $AuditTrailOnViewData = false;
    public $AuditTrailOnSearch = false;

    // Page headings
    public $Heading = "";
    public $Subheading = "";
    public $PageHeader;
    public $PageFooter;

    // Page layout
    public $UseLayout = true;

    // Page terminated
    private $terminated = false;

    // Page heading
    public function pageHeading()
    {
        global $Language;
        if ($this->Heading != "") {
            return $this->Heading;
        }
        if (method_exists($this, "tableCaption")) {
            return $this->tableCaption();
        }
        return "";
    }

    // Page subheading
    public function pageSubheading()
    {
        global $Language;
        if ($this->Subheading != "") {
            return $this->Subheading;
        }
        if ($this->TableName) {
            return $Language->phrase($this->PageID);
        }
        return "";
    }

    // Page name
    public function pageName()
    {
        return CurrentPageName();
    }

    // Page URL
    public function pageUrl($withArgs = true)
    {
        $route = GetRoute();
        $args = RemoveXss($route->getArguments());
        if (!$withArgs) {
            foreach ($args as $key => &$val) {
                $val = "";
            }
            unset($val);
        }
        return rtrim(UrlFor($route->getName(), $args), "/") . "?";
    }

    // Show Page Header
    public function showPageHeader()
    {
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        if ($header != "") { // Header exists, display
            echo '<div id="ew-page-header">' . $header . '</div>';
        }
    }

    // Show Page Footer
    public function showPageFooter()
    {
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        if ($footer != "") { // Footer exists, display
            echo '<div id="ew-page-footer">' . $footer . '</div>';
        }
    }

    // Set field visibility
    public function setVisibility()
    {
        $this->JobOrderID->Visible = false;
        $this->Job2ID->setVisibility();
        $this->SizeID->setVisibility();
        $this->TypeID->setVisibility();
        $this->Tanggal->setVisibility();
        $this->LokasiID->setVisibility();
        $this->PelabuhanID->setVisibility();
        $this->BL_Extra->setVisibility();
        $this->DepoID->setVisibility();
        $this->Ongkos->setVisibility();
        $this->IsShow->setVisibility();
        $this->IsOpen->setVisibility();
        $this->TakenByID->setVisibility();
    }

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $DashboardReport, $DebugTimer, $UserTable;
        $this->TableVar = 'job_order';
        $this->TableName = 'job_order';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-add-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("app.language");

        // Table object (job_order)
        if (!isset($GLOBALS["job_order"]) || $GLOBALS["job_order"]::class == PROJECT_NAMESPACE . "job_order") {
            $GLOBALS["job_order"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'job_order');
        }

        // Start timer
        $DebugTimer = Container("debug.timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] ??= $this->getConnection();

        // User table object
        $UserTable = Container("usertable");
    }

    // Get content from stream
    public function getContents(): string
    {
        global $Response;
        return $Response?->getBody() ?? ob_get_clean();
    }

    // Is lookup
    public function isLookup()
    {
        return SameText(Route(0), Config("API_LOOKUP_ACTION"));
    }

    // Is AutoFill
    public function isAutoFill()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autofill");
    }

    // Is AutoSuggest
    public function isAutoSuggest()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autosuggest");
    }

    // Is modal lookup
    public function isModalLookup()
    {
        return $this->isLookup() && SameText(Post("ajax"), "modal");
    }

    // Is terminated
    public function isTerminated()
    {
        return $this->terminated;
    }

    /**
     * Terminate page
     *
     * @param string $url URL for direction
     * @return void
     */
    public function terminate($url = "")
    {
        if ($this->terminated) {
            return;
        }
        global $TempImages, $DashboardReport, $Response;

        // Page is terminated
        $this->terminated = true;

        // Page Unload event
        if (method_exists($this, "pageUnload")) {
            $this->pageUnload();
        }
        DispatchEvent(new PageUnloadedEvent($this), PageUnloadedEvent::NAME);
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Close connection
        CloseConnections();

        // Return for API
        if (IsApi()) {
            $res = $url === true;
            if (!$res) { // Show response for API
                $ar = array_merge($this->getMessages(), $url ? ["url" => GetUrl($url)] : []);
                WriteJson($ar);
            }
            $this->clearMessages(); // Clear messages for API request
            return;
        } else { // Check if response is JSON
            if (WithJsonResponse()) { // With JSON response
                $this->clearMessages();
                return;
            }
        }

        // Go to URL if specified
        if ($url != "") {
            if (!Config("DEBUG") && ob_get_length()) {
                ob_end_clean();
            }

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $pageName = GetPageName($url);
                $result = ["url" => GetUrl($url), "modal" => "1"];  // Assume return to modal for simplicity
                if (
                    SameString($pageName, GetPageName($this->getListUrl())) ||
                    SameString($pageName, GetPageName($this->getViewUrl())) ||
                    SameString($pageName, GetPageName(CurrentMasterTable()?->getViewUrl() ?? ""))
                ) { // List / View / Master View page
                    if (!SameString($pageName, GetPageName($this->getListUrl()))) { // Not List page
                        $result["caption"] = $this->getModalCaption($pageName);
                        $result["view"] = SameString($pageName, "joborderview"); // If View page, no primary button
                    } else { // List page
                        $result["error"] = $this->getFailureMessage(); // List page should not be shown as modal => error
                        $this->clearFailureMessage();
                    }
                } else { // Other pages (add messages and then clear messages)
                    $result = array_merge($this->getMessages(), ["modal" => "1"]);
                    $this->clearMessages();
                }
                WriteJson($result);
            } else {
                SaveDebugMessage();
                Redirect(GetUrl($url));
            }
        }
        return; // Return to controller
    }

    // Get records from result set
    protected function getRecordsFromRecordset($rs, $current = false)
    {
        $rows = [];
        if (is_object($rs)) { // Result set
            while ($row = $rs->fetch()) {
                $this->loadRowValues($row); // Set up DbValue/CurrentValue
                $row = $this->getRecordFromArray($row);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        } elseif (is_array($rs)) {
            foreach ($rs as $ar) {
                $row = $this->getRecordFromArray($ar);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        }
        return $rows;
    }

    // Get record from array
    protected function getRecordFromArray($ar)
    {
        $row = [];
        if (is_array($ar)) {
            foreach ($ar as $fldname => $val) {
                if (array_key_exists($fldname, $this->Fields) && ($this->Fields[$fldname]->Visible || $this->Fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
                    $fld = &$this->Fields[$fldname];
                    if ($fld->HtmlTag == "FILE") { // Upload field
                        if (EmptyValue($val)) {
                            $row[$fldname] = null;
                        } else {
                            if ($fld->DataType == DataType::BLOB) {
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))));
                                $row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
                            } elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $val)));
                                $row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
                            } else { // Multiple files
                                $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                                $ar = [];
                                foreach ($files as $file) {
                                    $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                        "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                                    if (!EmptyValue($file)) {
                                        $ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
                                    }
                                }
                                $row[$fldname] = $ar;
                            }
                        }
                    } else {
                        $row[$fldname] = $val;
                    }
                }
            }
        }
        return $row;
    }

    // Get record key value from array
    protected function getRecordKeyValue($ar)
    {
        $key = "";
        if (is_array($ar)) {
            $key .= @$ar['JobOrderID'];
        }
        return $key;
    }

    /**
     * Hide fields for add/edit
     *
     * @return void
     */
    protected function hideFieldsForAddEdit()
    {
        if ($this->isAdd() || $this->isCopy() || $this->isGridAdd()) {
            $this->JobOrderID->Visible = false;
        }
    }

    // Lookup data
    public function lookup(array $req = [], bool $response = true)
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = $req["field"] ?? null;
        if (!$fieldName) {
            return [];
        }
        $fld = $this->Fields[$fieldName];
        $lookup = $fld->Lookup;
        $name = $req["name"] ?? "";
        if (ContainsString($name, "query_builder_rule")) {
            $lookup->FilterFields = []; // Skip parent fields if any
        }

        // Get lookup parameters
        $lookupType = $req["ajax"] ?? "unknown";
        $pageSize = -1;
        $offset = -1;
        $searchValue = "";
        if (SameText($lookupType, "modal") || SameText($lookupType, "filter")) {
            $searchValue = $req["q"] ?? $req["sv"] ?? "";
            $pageSize = $req["n"] ?? $req["recperpage"] ?? 10;
        } elseif (SameText($lookupType, "autosuggest")) {
            $searchValue = $req["q"] ?? "";
            $pageSize = $req["n"] ?? -1;
            $pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
        }
        $start = $req["start"] ?? -1;
        $start = is_numeric($start) ? (int)$start : -1;
        $page = $req["page"] ?? -1;
        $page = is_numeric($page) ? (int)$page : -1;
        $offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
        $userSelect = Decrypt($req["s"] ?? "");
        $userFilter = Decrypt($req["f"] ?? "");
        $userOrderBy = Decrypt($req["o"] ?? "");
        $keys = $req["keys"] ?? null;
        $lookup->LookupType = $lookupType; // Lookup type
        $lookup->FilterValues = []; // Clear filter values first
        if ($keys !== null) { // Selected records from modal
            if (is_array($keys)) {
                $keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
            }
            $lookup->FilterFields = []; // Skip parent fields if any
            $lookup->FilterValues[] = $keys; // Lookup values
            $pageSize = -1; // Show all records
        } else { // Lookup values
            $lookup->FilterValues[] = $req["v0"] ?? $req["lookupValue"] ?? "";
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = $req["v" . $i] ?? "";
        }
        $lookup->SearchValue = $searchValue;
        $lookup->PageSize = $pageSize;
        $lookup->Offset = $offset;
        if ($userSelect != "") {
            $lookup->UserSelect = $userSelect;
        }
        if ($userFilter != "") {
            $lookup->UserFilter = $userFilter;
        }
        if ($userOrderBy != "") {
            $lookup->UserOrderBy = $userOrderBy;
        }
        return $lookup->toJson($this, $response); // Use settings from current page
    }
    public $FormClassName = "ew-form ew-add-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $Priv = 0;
    public $CopyRecord;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $Language, $Security, $CurrentForm, $SkipHeaderFooter;

        // Is modal
        $this->IsModal = ConvertToBool(Param("modal"));
        $this->UseLayout = $this->UseLayout && !$this->IsModal;

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param(Config("PAGE_LAYOUT"), true));

        // View
        $this->View = Get(Config("VIEW"));

        // Load user profile
        if (IsLoggedIn()) {
            Profile()->setUserName(CurrentUserName())->loadFromStorage();
        }

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
        $this->setVisibility();

        // Set lookup cache
        if (!in_array($this->PageID, Config("LOOKUP_CACHE_PAGE_IDS"))) {
            $this->setUseLookupCache(false);
        }

        // Global Page Loading event (in userfn*.php)
        DispatchEvent(new PageLoadingEvent($this), PageLoadingEvent::NAME);

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Hide fields for add/edit
        if (!$this->UseAjaxActions) {
            $this->hideFieldsForAddEdit();
        }
        // Use inline delete
        if ($this->UseAjaxActions) {
            $this->InlineDelete = true;
        }

        // Set up lookup cache
        $this->setupLookupOptions($this->Job2ID);
        $this->setupLookupOptions($this->SizeID);
        $this->setupLookupOptions($this->TypeID);
        $this->setupLookupOptions($this->LokasiID);
        $this->setupLookupOptions($this->PelabuhanID);
        $this->setupLookupOptions($this->DepoID);
        $this->setupLookupOptions($this->IsShow);
        $this->setupLookupOptions($this->IsOpen);

        // Load default values for add
        $this->loadDefaultValues();

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $postBack = false;

        // Set up current action
        if (IsApi()) {
            $this->CurrentAction = "insert"; // Add record directly
            $postBack = true;
        } elseif (Post("action", "") !== "") {
            $this->CurrentAction = Post("action"); // Get form action
            $this->setKey(Post($this->OldKeyName));
            $postBack = true;
        } else {
            // Load key values from QueryString
            if (($keyValue = Get("JobOrderID") ?? Route("JobOrderID")) !== null) {
                $this->JobOrderID->setQueryStringValue($keyValue);
            }
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $this->CopyRecord = !EmptyValue($this->OldKey);
            if ($this->CopyRecord) {
                $this->CurrentAction = "copy"; // Copy record
                $this->setKey($this->OldKey); // Set up record key
            } else {
                $this->CurrentAction = "show"; // Display blank record
            }
        }

        // Load old record or default values
        $rsold = $this->loadOldRecord();

        // Load form values
        if ($postBack) {
            $this->loadFormValues(); // Load form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues(); // Restore form values
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = "show"; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "copy": // Copy an existing record
                if (!$rsold) { // Record not loaded
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("joborderlist"); // No matching record, return to list
                    return;
                }
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($rsold)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    $returnUrl = $this->getReturnUrl();
                    if (GetPageName($returnUrl) == "joborderlist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "joborderview") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }

                    // Handle UseAjaxActions with return page
                    if ($this->IsModal && $this->UseAjaxActions) {
                        $this->IsModal = false;
                        if (GetPageName($returnUrl) != "joborderlist") {
                            Container("app.flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                            $returnUrl = "joborderlist"; // Return list page content
                        }
                    }
                    if (IsJsonResponse()) { // Return to caller
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl);
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } elseif ($this->IsModal && $this->UseAjaxActions) { // Return JSON error message
                    WriteJson(["success" => false, "validation" => $this->getValidationErrors(), "error" => $this->getFailureMessage()]);
                    $this->clearFailureMessage();
                    $this->terminate();
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Add failed, restore form values
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render row based on row type
        $this->RowType = RowType::ADD; // Render add type

        // Render row
        $this->resetAttributes();
        $this->renderRow();

        // Set LoginStatus / Page_Rendering / Page_Render
        if (!IsApi() && !$this->isTerminated()) {
            // Setup login status
            SetupLoginStatus();

            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            DispatchEvent(new PageRenderingEvent($this), PageRenderingEvent::NAME);

            // Page Render event
            if (method_exists($this, "pageRender")) {
                $this->pageRender();
            }

            // Render search option
            if (method_exists($this, "renderSearchOptions")) {
                $this->renderSearchOptions();
            }
        }
    }

    // Get upload files
    protected function getUploadFiles()
    {
        global $CurrentForm, $Language;
    }

    // Load default values
    protected function loadDefaultValues()
    {
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'Job2ID' first before field var 'x_Job2ID'
        $val = $CurrentForm->hasValue("Job2ID") ? $CurrentForm->getValue("Job2ID") : $CurrentForm->getValue("x_Job2ID");
        if (!$this->Job2ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Job2ID->Visible = false; // Disable update for API request
            } else {
                $this->Job2ID->setFormValue($val);
            }
        }

        // Check field name 'SizeID' first before field var 'x_SizeID'
        $val = $CurrentForm->hasValue("SizeID") ? $CurrentForm->getValue("SizeID") : $CurrentForm->getValue("x_SizeID");
        if (!$this->SizeID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SizeID->Visible = false; // Disable update for API request
            } else {
                $this->SizeID->setFormValue($val);
            }
        }

        // Check field name 'TypeID' first before field var 'x_TypeID'
        $val = $CurrentForm->hasValue("TypeID") ? $CurrentForm->getValue("TypeID") : $CurrentForm->getValue("x_TypeID");
        if (!$this->TypeID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->TypeID->Visible = false; // Disable update for API request
            } else {
                $this->TypeID->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'Tanggal' first before field var 'x_Tanggal'
        $val = $CurrentForm->hasValue("Tanggal") ? $CurrentForm->getValue("Tanggal") : $CurrentForm->getValue("x_Tanggal");
        if (!$this->Tanggal->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Tanggal->Visible = false; // Disable update for API request
            } else {
                $this->Tanggal->setFormValue($val, true, $validate);
            }
            $this->Tanggal->CurrentValue = UnFormatDateTime($this->Tanggal->CurrentValue, $this->Tanggal->formatPattern());
        }

        // Check field name 'LokasiID' first before field var 'x_LokasiID'
        $val = $CurrentForm->hasValue("LokasiID") ? $CurrentForm->getValue("LokasiID") : $CurrentForm->getValue("x_LokasiID");
        if (!$this->LokasiID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->LokasiID->Visible = false; // Disable update for API request
            } else {
                $this->LokasiID->setFormValue($val);
            }
        }

        // Check field name 'PelabuhanID' first before field var 'x_PelabuhanID'
        $val = $CurrentForm->hasValue("PelabuhanID") ? $CurrentForm->getValue("PelabuhanID") : $CurrentForm->getValue("x_PelabuhanID");
        if (!$this->PelabuhanID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PelabuhanID->Visible = false; // Disable update for API request
            } else {
                $this->PelabuhanID->setFormValue($val);
            }
        }

        // Check field name 'BL_Extra' first before field var 'x_BL_Extra'
        $val = $CurrentForm->hasValue("BL_Extra") ? $CurrentForm->getValue("BL_Extra") : $CurrentForm->getValue("x_BL_Extra");
        if (!$this->BL_Extra->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->BL_Extra->Visible = false; // Disable update for API request
            } else {
                $this->BL_Extra->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'DepoID' first before field var 'x_DepoID'
        $val = $CurrentForm->hasValue("DepoID") ? $CurrentForm->getValue("DepoID") : $CurrentForm->getValue("x_DepoID");
        if (!$this->DepoID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->DepoID->Visible = false; // Disable update for API request
            } else {
                $this->DepoID->setFormValue($val);
            }
        }

        // Check field name 'Ongkos' first before field var 'x_Ongkos'
        $val = $CurrentForm->hasValue("Ongkos") ? $CurrentForm->getValue("Ongkos") : $CurrentForm->getValue("x_Ongkos");
        if (!$this->Ongkos->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Ongkos->Visible = false; // Disable update for API request
            } else {
                $this->Ongkos->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'IsShow' first before field var 'x_IsShow'
        $val = $CurrentForm->hasValue("IsShow") ? $CurrentForm->getValue("IsShow") : $CurrentForm->getValue("x_IsShow");
        if (!$this->IsShow->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->IsShow->Visible = false; // Disable update for API request
            } else {
                $this->IsShow->setFormValue($val);
            }
        }

        // Check field name 'IsOpen' first before field var 'x_IsOpen'
        $val = $CurrentForm->hasValue("IsOpen") ? $CurrentForm->getValue("IsOpen") : $CurrentForm->getValue("x_IsOpen");
        if (!$this->IsOpen->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->IsOpen->Visible = false; // Disable update for API request
            } else {
                $this->IsOpen->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'TakenByID' first before field var 'x_TakenByID'
        $val = $CurrentForm->hasValue("TakenByID") ? $CurrentForm->getValue("TakenByID") : $CurrentForm->getValue("x_TakenByID");
        if (!$this->TakenByID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->TakenByID->Visible = false; // Disable update for API request
            } else {
                $this->TakenByID->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'JobOrderID' first before field var 'x_JobOrderID'
        $val = $CurrentForm->hasValue("JobOrderID") ? $CurrentForm->getValue("JobOrderID") : $CurrentForm->getValue("x_JobOrderID");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->Job2ID->CurrentValue = $this->Job2ID->FormValue;
        $this->SizeID->CurrentValue = $this->SizeID->FormValue;
        $this->TypeID->CurrentValue = $this->TypeID->FormValue;
        $this->Tanggal->CurrentValue = $this->Tanggal->FormValue;
        $this->Tanggal->CurrentValue = UnFormatDateTime($this->Tanggal->CurrentValue, $this->Tanggal->formatPattern());
        $this->LokasiID->CurrentValue = $this->LokasiID->FormValue;
        $this->PelabuhanID->CurrentValue = $this->PelabuhanID->FormValue;
        $this->BL_Extra->CurrentValue = $this->BL_Extra->FormValue;
        $this->DepoID->CurrentValue = $this->DepoID->FormValue;
        $this->Ongkos->CurrentValue = $this->Ongkos->FormValue;
        $this->IsShow->CurrentValue = $this->IsShow->FormValue;
        $this->IsOpen->CurrentValue = $this->IsOpen->FormValue;
        $this->TakenByID->CurrentValue = $this->TakenByID->FormValue;
    }

    /**
     * Load row based on key values
     *
     * @return void
     */
    public function loadRow()
    {
        global $Security, $Language;
        $filter = $this->getRecordFilter();

        // Call Row Selecting event
        $this->rowSelecting($filter);

        // Load SQL based on filter
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $res = false;
        $row = $conn->fetchAssociative($sql);
        if ($row) {
            $res = true;
            $this->loadRowValues($row); // Load row values
        }
        return $res;
    }

    /**
     * Load row values from result set or record
     *
     * @param array $row Record
     * @return void
     */
    public function loadRowValues($row = null)
    {
        $row = is_array($row) ? $row : $this->newRow();

        // Call Row Selected event
        $this->rowSelected($row);
        $this->JobOrderID->setDbValue($row['JobOrderID']);
        $this->Job2ID->setDbValue($row['Job2ID']);
        $this->SizeID->setDbValue($row['SizeID']);
        $this->TypeID->setDbValue($row['TypeID']);
        $this->Tanggal->setDbValue($row['Tanggal']);
        $this->LokasiID->setDbValue($row['LokasiID']);
        $this->PelabuhanID->setDbValue($row['PelabuhanID']);
        $this->BL_Extra->setDbValue($row['BL_Extra']);
        $this->DepoID->setDbValue($row['DepoID']);
        $this->Ongkos->setDbValue($row['Ongkos']);
        $this->IsShow->setDbValue($row['IsShow']);
        $this->IsOpen->setDbValue($row['IsOpen']);
        $this->TakenByID->setDbValue($row['TakenByID']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['JobOrderID'] = $this->JobOrderID->DefaultValue;
        $row['Job2ID'] = $this->Job2ID->DefaultValue;
        $row['SizeID'] = $this->SizeID->DefaultValue;
        $row['TypeID'] = $this->TypeID->DefaultValue;
        $row['Tanggal'] = $this->Tanggal->DefaultValue;
        $row['LokasiID'] = $this->LokasiID->DefaultValue;
        $row['PelabuhanID'] = $this->PelabuhanID->DefaultValue;
        $row['BL_Extra'] = $this->BL_Extra->DefaultValue;
        $row['DepoID'] = $this->DepoID->DefaultValue;
        $row['Ongkos'] = $this->Ongkos->DefaultValue;
        $row['IsShow'] = $this->IsShow->DefaultValue;
        $row['IsOpen'] = $this->IsOpen->DefaultValue;
        $row['TakenByID'] = $this->TakenByID->DefaultValue;
        return $row;
    }

    // Load old record
    protected function loadOldRecord()
    {
        // Load old record
        if ($this->OldKey != "") {
            $this->setKey($this->OldKey);
            $this->CurrentFilter = $this->getRecordFilter();
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $rs = ExecuteQuery($sql, $conn);
            if ($row = $rs->fetch()) {
                $this->loadRowValues($row); // Load row values
                return $row;
            }
        }
        $this->loadRowValues(); // Load default row values
        return null;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // JobOrderID
        $this->JobOrderID->RowCssClass = "row";

        // Job2ID
        $this->Job2ID->RowCssClass = "row";

        // SizeID
        $this->SizeID->RowCssClass = "row";

        // TypeID
        $this->TypeID->RowCssClass = "row";

        // Tanggal
        $this->Tanggal->RowCssClass = "row";

        // LokasiID
        $this->LokasiID->RowCssClass = "row";

        // PelabuhanID
        $this->PelabuhanID->RowCssClass = "row";

        // BL_Extra
        $this->BL_Extra->RowCssClass = "row";

        // DepoID
        $this->DepoID->RowCssClass = "row";

        // Ongkos
        $this->Ongkos->RowCssClass = "row";

        // IsShow
        $this->IsShow->RowCssClass = "row";

        // IsOpen
        $this->IsOpen->RowCssClass = "row";

        // TakenByID
        $this->TakenByID->RowCssClass = "row";

        // View row
        if ($this->RowType == RowType::VIEW) {
            // JobOrderID
            $this->JobOrderID->ViewValue = $this->JobOrderID->CurrentValue;

            // Job2ID
            $curVal = strval($this->Job2ID->CurrentValue);
            if ($curVal != "") {
                $this->Job2ID->ViewValue = $this->Job2ID->lookupCacheOption($curVal);
                if ($this->Job2ID->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter($this->Job2ID->Lookup->getTable()->Fields["Job2ID"]->searchExpression(), "=", $curVal, $this->Job2ID->Lookup->getTable()->Fields["Job2ID"]->searchDataType(), "");
                    $sqlWrk = $this->Job2ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCache($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->Job2ID->Lookup->renderViewRow($rswrk[0]);
                        $this->Job2ID->ViewValue = $this->Job2ID->displayValue($arwrk);
                    } else {
                        $this->Job2ID->ViewValue = FormatNumber($this->Job2ID->CurrentValue, $this->Job2ID->formatPattern());
                    }
                }
            } else {
                $this->Job2ID->ViewValue = null;
            }

            // SizeID
            $curVal = strval($this->SizeID->CurrentValue);
            if ($curVal != "") {
                $this->SizeID->ViewValue = $this->SizeID->lookupCacheOption($curVal);
                if ($this->SizeID->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter($this->SizeID->Lookup->getTable()->Fields["SizeID"]->searchExpression(), "=", $curVal, $this->SizeID->Lookup->getTable()->Fields["SizeID"]->searchDataType(), "");
                    $sqlWrk = $this->SizeID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCache($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->SizeID->Lookup->renderViewRow($rswrk[0]);
                        $this->SizeID->ViewValue = $this->SizeID->displayValue($arwrk);
                    } else {
                        $this->SizeID->ViewValue = FormatNumber($this->SizeID->CurrentValue, $this->SizeID->formatPattern());
                    }
                }
            } else {
                $this->SizeID->ViewValue = null;
            }

            // TypeID
            $this->TypeID->ViewValue = $this->TypeID->CurrentValue;
            $curVal = strval($this->TypeID->CurrentValue);
            if ($curVal != "") {
                $this->TypeID->ViewValue = $this->TypeID->lookupCacheOption($curVal);
                if ($this->TypeID->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter($this->TypeID->Lookup->getTable()->Fields["TypeID"]->searchExpression(), "=", $curVal, $this->TypeID->Lookup->getTable()->Fields["TypeID"]->searchDataType(), "");
                    $sqlWrk = $this->TypeID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCache($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->TypeID->Lookup->renderViewRow($rswrk[0]);
                        $this->TypeID->ViewValue = $this->TypeID->displayValue($arwrk);
                    } else {
                        $this->TypeID->ViewValue = FormatNumber($this->TypeID->CurrentValue, $this->TypeID->formatPattern());
                    }
                }
            } else {
                $this->TypeID->ViewValue = null;
            }

            // Tanggal
            $this->Tanggal->ViewValue = $this->Tanggal->CurrentValue;
            $this->Tanggal->ViewValue = FormatDateTime($this->Tanggal->ViewValue, $this->Tanggal->formatPattern());

            // LokasiID
            $curVal = strval($this->LokasiID->CurrentValue);
            if ($curVal != "") {
                $this->LokasiID->ViewValue = $this->LokasiID->lookupCacheOption($curVal);
                if ($this->LokasiID->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter($this->LokasiID->Lookup->getTable()->Fields["LokasiID"]->searchExpression(), "=", $curVal, $this->LokasiID->Lookup->getTable()->Fields["LokasiID"]->searchDataType(), "");
                    $sqlWrk = $this->LokasiID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCache($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->LokasiID->Lookup->renderViewRow($rswrk[0]);
                        $this->LokasiID->ViewValue = $this->LokasiID->displayValue($arwrk);
                    } else {
                        $this->LokasiID->ViewValue = FormatNumber($this->LokasiID->CurrentValue, $this->LokasiID->formatPattern());
                    }
                }
            } else {
                $this->LokasiID->ViewValue = null;
            }

            // PelabuhanID
            $curVal = strval($this->PelabuhanID->CurrentValue);
            if ($curVal != "") {
                $this->PelabuhanID->ViewValue = $this->PelabuhanID->lookupCacheOption($curVal);
                if ($this->PelabuhanID->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter($this->PelabuhanID->Lookup->getTable()->Fields["PelabuhanID"]->searchExpression(), "=", $curVal, $this->PelabuhanID->Lookup->getTable()->Fields["PelabuhanID"]->searchDataType(), "");
                    $sqlWrk = $this->PelabuhanID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCache($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->PelabuhanID->Lookup->renderViewRow($rswrk[0]);
                        $this->PelabuhanID->ViewValue = $this->PelabuhanID->displayValue($arwrk);
                    } else {
                        $this->PelabuhanID->ViewValue = FormatNumber($this->PelabuhanID->CurrentValue, $this->PelabuhanID->formatPattern());
                    }
                }
            } else {
                $this->PelabuhanID->ViewValue = null;
            }

            // BL_Extra
            $this->BL_Extra->ViewValue = $this->BL_Extra->CurrentValue;
            $this->BL_Extra->ViewValue = FormatNumber($this->BL_Extra->ViewValue, $this->BL_Extra->formatPattern());

            // DepoID
            $curVal = strval($this->DepoID->CurrentValue);
            if ($curVal != "") {
                $this->DepoID->ViewValue = $this->DepoID->lookupCacheOption($curVal);
                if ($this->DepoID->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter($this->DepoID->Lookup->getTable()->Fields["DepoID"]->searchExpression(), "=", $curVal, $this->DepoID->Lookup->getTable()->Fields["DepoID"]->searchDataType(), "");
                    $sqlWrk = $this->DepoID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCache($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->DepoID->Lookup->renderViewRow($rswrk[0]);
                        $this->DepoID->ViewValue = $this->DepoID->displayValue($arwrk);
                    } else {
                        $this->DepoID->ViewValue = FormatNumber($this->DepoID->CurrentValue, $this->DepoID->formatPattern());
                    }
                }
            } else {
                $this->DepoID->ViewValue = null;
            }

            // Ongkos
            $this->Ongkos->ViewValue = $this->Ongkos->CurrentValue;
            $this->Ongkos->ViewValue = FormatNumber($this->Ongkos->ViewValue, $this->Ongkos->formatPattern());

            // IsShow
            if (strval($this->IsShow->CurrentValue) != "") {
                $this->IsShow->ViewValue = $this->IsShow->optionCaption($this->IsShow->CurrentValue);
            } else {
                $this->IsShow->ViewValue = null;
            }

            // IsOpen
            $this->IsOpen->ViewValue = $this->IsOpen->CurrentValue;

            // TakenByID
            $this->TakenByID->ViewValue = $this->TakenByID->CurrentValue;
            $this->TakenByID->ViewValue = FormatNumber($this->TakenByID->ViewValue, $this->TakenByID->formatPattern());

            // Job2ID
            $this->Job2ID->HrefValue = "";

            // SizeID
            $this->SizeID->HrefValue = "";

            // TypeID
            $this->TypeID->HrefValue = "";

            // Tanggal
            $this->Tanggal->HrefValue = "";

            // LokasiID
            $this->LokasiID->HrefValue = "";

            // PelabuhanID
            $this->PelabuhanID->HrefValue = "";

            // BL_Extra
            $this->BL_Extra->HrefValue = "";

            // DepoID
            $this->DepoID->HrefValue = "";

            // Ongkos
            $this->Ongkos->HrefValue = "";

            // IsShow
            $this->IsShow->HrefValue = "";

            // IsOpen
            $this->IsOpen->HrefValue = "";

            // TakenByID
            $this->TakenByID->HrefValue = "";
        } elseif ($this->RowType == RowType::ADD) {
            // Job2ID
            $curVal = trim(strval($this->Job2ID->CurrentValue));
            if ($curVal != "") {
                $this->Job2ID->ViewValue = $this->Job2ID->lookupCacheOption($curVal);
            } else {
                $this->Job2ID->ViewValue = $this->Job2ID->Lookup !== null && is_array($this->Job2ID->lookupOptions()) && count($this->Job2ID->lookupOptions()) > 0 ? $curVal : null;
            }
            if ($this->Job2ID->ViewValue !== null) { // Load from cache
                $this->Job2ID->EditValue = array_values($this->Job2ID->lookupOptions());
                if ($this->Job2ID->ViewValue == "") {
                    $this->Job2ID->ViewValue = $Language->phrase("PleaseSelect");
                }
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = SearchFilter($this->Job2ID->Lookup->getTable()->Fields["Job2ID"]->searchExpression(), "=", $this->Job2ID->CurrentValue, $this->Job2ID->Lookup->getTable()->Fields["Job2ID"]->searchDataType(), "");
                }
                $sqlWrk = $this->Job2ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCache($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->Job2ID->Lookup->renderViewRow($rswrk[0]);
                    $this->Job2ID->ViewValue = $this->Job2ID->displayValue($arwrk);
                } else {
                    $this->Job2ID->ViewValue = $Language->phrase("PleaseSelect");
                }
                $arwrk = $rswrk;
                $this->Job2ID->EditValue = $arwrk;
            }
            $this->Job2ID->PlaceHolder = RemoveHtml($this->Job2ID->caption());

            // SizeID
            $curVal = trim(strval($this->SizeID->CurrentValue));
            if ($curVal != "") {
                $this->SizeID->ViewValue = $this->SizeID->lookupCacheOption($curVal);
            } else {
                $this->SizeID->ViewValue = $this->SizeID->Lookup !== null && is_array($this->SizeID->lookupOptions()) && count($this->SizeID->lookupOptions()) > 0 ? $curVal : null;
            }
            if ($this->SizeID->ViewValue !== null) { // Load from cache
                $this->SizeID->EditValue = array_values($this->SizeID->lookupOptions());
                if ($this->SizeID->ViewValue == "") {
                    $this->SizeID->ViewValue = $Language->phrase("PleaseSelect");
                }
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = SearchFilter($this->SizeID->Lookup->getTable()->Fields["SizeID"]->searchExpression(), "=", $this->SizeID->CurrentValue, $this->SizeID->Lookup->getTable()->Fields["SizeID"]->searchDataType(), "");
                }
                $sqlWrk = $this->SizeID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCache($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->SizeID->Lookup->renderViewRow($rswrk[0]);
                    $this->SizeID->ViewValue = $this->SizeID->displayValue($arwrk);
                } else {
                    $this->SizeID->ViewValue = $Language->phrase("PleaseSelect");
                }
                $arwrk = $rswrk;
                $this->SizeID->EditValue = $arwrk;
            }
            $this->SizeID->PlaceHolder = RemoveHtml($this->SizeID->caption());

            // TypeID
            $this->TypeID->setupEditAttributes();
            $this->TypeID->EditValue = $this->TypeID->CurrentValue;
            $curVal = strval($this->TypeID->CurrentValue);
            if ($curVal != "") {
                $this->TypeID->EditValue = $this->TypeID->lookupCacheOption($curVal);
                if ($this->TypeID->EditValue === null) { // Lookup from database
                    $filterWrk = SearchFilter($this->TypeID->Lookup->getTable()->Fields["TypeID"]->searchExpression(), "=", $curVal, $this->TypeID->Lookup->getTable()->Fields["TypeID"]->searchDataType(), "");
                    $sqlWrk = $this->TypeID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCache($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->TypeID->Lookup->renderViewRow($rswrk[0]);
                        $this->TypeID->EditValue = $this->TypeID->displayValue($arwrk);
                    } else {
                        $this->TypeID->EditValue = HtmlEncode(FormatNumber($this->TypeID->CurrentValue, $this->TypeID->formatPattern()));
                    }
                }
            } else {
                $this->TypeID->EditValue = null;
            }
            $this->TypeID->PlaceHolder = RemoveHtml($this->TypeID->caption());

            // Tanggal
            $this->Tanggal->setupEditAttributes();
            $this->Tanggal->EditValue = HtmlEncode(FormatDateTime($this->Tanggal->CurrentValue, $this->Tanggal->formatPattern()));
            $this->Tanggal->PlaceHolder = RemoveHtml($this->Tanggal->caption());

            // LokasiID
            $curVal = trim(strval($this->LokasiID->CurrentValue));
            if ($curVal != "") {
                $this->LokasiID->ViewValue = $this->LokasiID->lookupCacheOption($curVal);
            } else {
                $this->LokasiID->ViewValue = $this->LokasiID->Lookup !== null && is_array($this->LokasiID->lookupOptions()) && count($this->LokasiID->lookupOptions()) > 0 ? $curVal : null;
            }
            if ($this->LokasiID->ViewValue !== null) { // Load from cache
                $this->LokasiID->EditValue = array_values($this->LokasiID->lookupOptions());
                if ($this->LokasiID->ViewValue == "") {
                    $this->LokasiID->ViewValue = $Language->phrase("PleaseSelect");
                }
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = SearchFilter($this->LokasiID->Lookup->getTable()->Fields["LokasiID"]->searchExpression(), "=", $this->LokasiID->CurrentValue, $this->LokasiID->Lookup->getTable()->Fields["LokasiID"]->searchDataType(), "");
                }
                $sqlWrk = $this->LokasiID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCache($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->LokasiID->Lookup->renderViewRow($rswrk[0]);
                    $this->LokasiID->ViewValue = $this->LokasiID->displayValue($arwrk);
                } else {
                    $this->LokasiID->ViewValue = $Language->phrase("PleaseSelect");
                }
                $arwrk = $rswrk;
                $this->LokasiID->EditValue = $arwrk;
            }
            $this->LokasiID->PlaceHolder = RemoveHtml($this->LokasiID->caption());

            // PelabuhanID
            $curVal = trim(strval($this->PelabuhanID->CurrentValue));
            if ($curVal != "") {
                $this->PelabuhanID->ViewValue = $this->PelabuhanID->lookupCacheOption($curVal);
            } else {
                $this->PelabuhanID->ViewValue = $this->PelabuhanID->Lookup !== null && is_array($this->PelabuhanID->lookupOptions()) && count($this->PelabuhanID->lookupOptions()) > 0 ? $curVal : null;
            }
            if ($this->PelabuhanID->ViewValue !== null) { // Load from cache
                $this->PelabuhanID->EditValue = array_values($this->PelabuhanID->lookupOptions());
                if ($this->PelabuhanID->ViewValue == "") {
                    $this->PelabuhanID->ViewValue = $Language->phrase("PleaseSelect");
                }
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = SearchFilter($this->PelabuhanID->Lookup->getTable()->Fields["PelabuhanID"]->searchExpression(), "=", $this->PelabuhanID->CurrentValue, $this->PelabuhanID->Lookup->getTable()->Fields["PelabuhanID"]->searchDataType(), "");
                }
                $sqlWrk = $this->PelabuhanID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCache($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->PelabuhanID->Lookup->renderViewRow($rswrk[0]);
                    $this->PelabuhanID->ViewValue = $this->PelabuhanID->displayValue($arwrk);
                } else {
                    $this->PelabuhanID->ViewValue = $Language->phrase("PleaseSelect");
                }
                $arwrk = $rswrk;
                $this->PelabuhanID->EditValue = $arwrk;
            }
            $this->PelabuhanID->PlaceHolder = RemoveHtml($this->PelabuhanID->caption());

            // BL_Extra
            $this->BL_Extra->setupEditAttributes();
            $this->BL_Extra->EditValue = $this->BL_Extra->CurrentValue;
            $this->BL_Extra->PlaceHolder = RemoveHtml($this->BL_Extra->caption());
            if (strval($this->BL_Extra->EditValue) != "" && is_numeric($this->BL_Extra->EditValue)) {
                $this->BL_Extra->EditValue = FormatNumber($this->BL_Extra->EditValue, null);
            }

            // DepoID
            $curVal = trim(strval($this->DepoID->CurrentValue));
            if ($curVal != "") {
                $this->DepoID->ViewValue = $this->DepoID->lookupCacheOption($curVal);
            } else {
                $this->DepoID->ViewValue = $this->DepoID->Lookup !== null && is_array($this->DepoID->lookupOptions()) && count($this->DepoID->lookupOptions()) > 0 ? $curVal : null;
            }
            if ($this->DepoID->ViewValue !== null) { // Load from cache
                $this->DepoID->EditValue = array_values($this->DepoID->lookupOptions());
                if ($this->DepoID->ViewValue == "") {
                    $this->DepoID->ViewValue = $Language->phrase("PleaseSelect");
                }
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = SearchFilter($this->DepoID->Lookup->getTable()->Fields["DepoID"]->searchExpression(), "=", $this->DepoID->CurrentValue, $this->DepoID->Lookup->getTable()->Fields["DepoID"]->searchDataType(), "");
                }
                $sqlWrk = $this->DepoID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCache($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->DepoID->Lookup->renderViewRow($rswrk[0]);
                    $this->DepoID->ViewValue = $this->DepoID->displayValue($arwrk);
                } else {
                    $this->DepoID->ViewValue = $Language->phrase("PleaseSelect");
                }
                $arwrk = $rswrk;
                $this->DepoID->EditValue = $arwrk;
            }
            $this->DepoID->PlaceHolder = RemoveHtml($this->DepoID->caption());

            // Ongkos
            $this->Ongkos->setupEditAttributes();
            $this->Ongkos->EditValue = $this->Ongkos->CurrentValue;
            $this->Ongkos->PlaceHolder = RemoveHtml($this->Ongkos->caption());
            if (strval($this->Ongkos->EditValue) != "" && is_numeric($this->Ongkos->EditValue)) {
                $this->Ongkos->EditValue = FormatNumber($this->Ongkos->EditValue, null);
            }

            // IsShow
            $this->IsShow->EditValue = $this->IsShow->options(false);
            $this->IsShow->PlaceHolder = RemoveHtml($this->IsShow->caption());

            // IsOpen
            $this->IsOpen->setupEditAttributes();
            $this->IsOpen->EditValue = $this->IsOpen->CurrentValue;
            $this->IsOpen->PlaceHolder = RemoveHtml($this->IsOpen->caption());

            // TakenByID
            $this->TakenByID->setupEditAttributes();
            $this->TakenByID->EditValue = $this->TakenByID->CurrentValue;
            $this->TakenByID->PlaceHolder = RemoveHtml($this->TakenByID->caption());
            if (strval($this->TakenByID->EditValue) != "" && is_numeric($this->TakenByID->EditValue)) {
                $this->TakenByID->EditValue = FormatNumber($this->TakenByID->EditValue, null);
            }

            // Add refer script

            // Job2ID
            $this->Job2ID->HrefValue = "";

            // SizeID
            $this->SizeID->HrefValue = "";

            // TypeID
            $this->TypeID->HrefValue = "";

            // Tanggal
            $this->Tanggal->HrefValue = "";

            // LokasiID
            $this->LokasiID->HrefValue = "";

            // PelabuhanID
            $this->PelabuhanID->HrefValue = "";

            // BL_Extra
            $this->BL_Extra->HrefValue = "";

            // DepoID
            $this->DepoID->HrefValue = "";

            // Ongkos
            $this->Ongkos->HrefValue = "";

            // IsShow
            $this->IsShow->HrefValue = "";

            // IsOpen
            $this->IsOpen->HrefValue = "";

            // TakenByID
            $this->TakenByID->HrefValue = "";
        }
        if ($this->RowType == RowType::ADD || $this->RowType == RowType::EDIT || $this->RowType == RowType::SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != RowType::AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate form
    protected function validateForm()
    {
        global $Language, $Security;

        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        $validateForm = true;
            if ($this->Job2ID->Visible && $this->Job2ID->Required) {
                if (!$this->Job2ID->IsDetailKey && EmptyValue($this->Job2ID->FormValue)) {
                    $this->Job2ID->addErrorMessage(str_replace("%s", $this->Job2ID->caption(), $this->Job2ID->RequiredErrorMessage));
                }
            }
            if ($this->SizeID->Visible && $this->SizeID->Required) {
                if (!$this->SizeID->IsDetailKey && EmptyValue($this->SizeID->FormValue)) {
                    $this->SizeID->addErrorMessage(str_replace("%s", $this->SizeID->caption(), $this->SizeID->RequiredErrorMessage));
                }
            }
            if ($this->TypeID->Visible && $this->TypeID->Required) {
                if (!$this->TypeID->IsDetailKey && EmptyValue($this->TypeID->FormValue)) {
                    $this->TypeID->addErrorMessage(str_replace("%s", $this->TypeID->caption(), $this->TypeID->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->TypeID->FormValue)) {
                $this->TypeID->addErrorMessage($this->TypeID->getErrorMessage(false));
            }
            if ($this->Tanggal->Visible && $this->Tanggal->Required) {
                if (!$this->Tanggal->IsDetailKey && EmptyValue($this->Tanggal->FormValue)) {
                    $this->Tanggal->addErrorMessage(str_replace("%s", $this->Tanggal->caption(), $this->Tanggal->RequiredErrorMessage));
                }
            }
            if (!CheckDate($this->Tanggal->FormValue, $this->Tanggal->formatPattern())) {
                $this->Tanggal->addErrorMessage($this->Tanggal->getErrorMessage(false));
            }
            if ($this->LokasiID->Visible && $this->LokasiID->Required) {
                if (!$this->LokasiID->IsDetailKey && EmptyValue($this->LokasiID->FormValue)) {
                    $this->LokasiID->addErrorMessage(str_replace("%s", $this->LokasiID->caption(), $this->LokasiID->RequiredErrorMessage));
                }
            }
            if ($this->PelabuhanID->Visible && $this->PelabuhanID->Required) {
                if (!$this->PelabuhanID->IsDetailKey && EmptyValue($this->PelabuhanID->FormValue)) {
                    $this->PelabuhanID->addErrorMessage(str_replace("%s", $this->PelabuhanID->caption(), $this->PelabuhanID->RequiredErrorMessage));
                }
            }
            if ($this->BL_Extra->Visible && $this->BL_Extra->Required) {
                if (!$this->BL_Extra->IsDetailKey && EmptyValue($this->BL_Extra->FormValue)) {
                    $this->BL_Extra->addErrorMessage(str_replace("%s", $this->BL_Extra->caption(), $this->BL_Extra->RequiredErrorMessage));
                }
            }
            if (!CheckNumber($this->BL_Extra->FormValue)) {
                $this->BL_Extra->addErrorMessage($this->BL_Extra->getErrorMessage(false));
            }
            if ($this->DepoID->Visible && $this->DepoID->Required) {
                if (!$this->DepoID->IsDetailKey && EmptyValue($this->DepoID->FormValue)) {
                    $this->DepoID->addErrorMessage(str_replace("%s", $this->DepoID->caption(), $this->DepoID->RequiredErrorMessage));
                }
            }
            if ($this->Ongkos->Visible && $this->Ongkos->Required) {
                if (!$this->Ongkos->IsDetailKey && EmptyValue($this->Ongkos->FormValue)) {
                    $this->Ongkos->addErrorMessage(str_replace("%s", $this->Ongkos->caption(), $this->Ongkos->RequiredErrorMessage));
                }
            }
            if (!CheckNumber($this->Ongkos->FormValue)) {
                $this->Ongkos->addErrorMessage($this->Ongkos->getErrorMessage(false));
            }
            if ($this->IsShow->Visible && $this->IsShow->Required) {
                if ($this->IsShow->FormValue == "") {
                    $this->IsShow->addErrorMessage(str_replace("%s", $this->IsShow->caption(), $this->IsShow->RequiredErrorMessage));
                }
            }
            if ($this->IsOpen->Visible && $this->IsOpen->Required) {
                if (!$this->IsOpen->IsDetailKey && EmptyValue($this->IsOpen->FormValue)) {
                    $this->IsOpen->addErrorMessage(str_replace("%s", $this->IsOpen->caption(), $this->IsOpen->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->IsOpen->FormValue)) {
                $this->IsOpen->addErrorMessage($this->IsOpen->getErrorMessage(false));
            }
            if ($this->TakenByID->Visible && $this->TakenByID->Required) {
                if (!$this->TakenByID->IsDetailKey && EmptyValue($this->TakenByID->FormValue)) {
                    $this->TakenByID->addErrorMessage(str_replace("%s", $this->TakenByID->caption(), $this->TakenByID->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->TakenByID->FormValue)) {
                $this->TakenByID->addErrorMessage($this->TakenByID->getErrorMessage(false));
            }

        // Return validate result
        $validateForm = $validateForm && !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;

        // Get new row
        $rsnew = $this->getAddRow();

        // Update current values
        $this->setCurrentValues($rsnew);
        $conn = $this->getConnection();

        // Load db values from old row
        $this->loadDbValues($rsold);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);
        if ($insertRow) {
            $addRow = $this->insert($rsnew);
            if ($addRow) {
            } elseif (!EmptyValue($this->DbErrorMessage)) { // Show database error
                $this->setFailureMessage($this->DbErrorMessage);
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("InsertCancelled"));
            }
            $addRow = false;
        }
        if ($addRow) {
            // Call Row Inserted event
            $this->rowInserted($rsold, $rsnew);
        }

        // Write JSON response
        if (IsJsonResponse() && $addRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            $table = $this->TableVar;
            WriteJson(["success" => true, "action" => Config("API_ADD_ACTION"), $table => $row]);
        }
        return $addRow;
    }

    /**
     * Get add row
     *
     * @return array
     */
    protected function getAddRow()
    {
        global $Security;
        $rsnew = [];

        // Job2ID
        $this->Job2ID->setDbValueDef($rsnew, $this->Job2ID->CurrentValue, false);

        // SizeID
        $this->SizeID->setDbValueDef($rsnew, $this->SizeID->CurrentValue, false);

        // TypeID
        $this->TypeID->setDbValueDef($rsnew, $this->TypeID->CurrentValue, false);

        // Tanggal
        $this->Tanggal->setDbValueDef($rsnew, UnFormatDateTime($this->Tanggal->CurrentValue, $this->Tanggal->formatPattern()), false);

        // LokasiID
        $this->LokasiID->setDbValueDef($rsnew, $this->LokasiID->CurrentValue, false);

        // PelabuhanID
        $this->PelabuhanID->setDbValueDef($rsnew, $this->PelabuhanID->CurrentValue, false);

        // BL_Extra
        $this->BL_Extra->setDbValueDef($rsnew, $this->BL_Extra->CurrentValue, false);

        // DepoID
        $this->DepoID->setDbValueDef($rsnew, $this->DepoID->CurrentValue, false);

        // Ongkos
        $this->Ongkos->setDbValueDef($rsnew, $this->Ongkos->CurrentValue, false);

        // IsShow
        $this->IsShow->setDbValueDef($rsnew, $this->IsShow->CurrentValue, false);

        // IsOpen
        $this->IsOpen->setDbValueDef($rsnew, $this->IsOpen->CurrentValue, false);

        // TakenByID
        $this->TakenByID->setDbValueDef($rsnew, $this->TakenByID->CurrentValue, false);
        return $rsnew;
    }

    /**
     * Restore add form from row
     * @param array $row Row
     */
    protected function restoreAddFormFromRow($row)
    {
        if (isset($row['Job2ID'])) { // Job2ID
            $this->Job2ID->setFormValue($row['Job2ID']);
        }
        if (isset($row['SizeID'])) { // SizeID
            $this->SizeID->setFormValue($row['SizeID']);
        }
        if (isset($row['TypeID'])) { // TypeID
            $this->TypeID->setFormValue($row['TypeID']);
        }
        if (isset($row['Tanggal'])) { // Tanggal
            $this->Tanggal->setFormValue($row['Tanggal']);
        }
        if (isset($row['LokasiID'])) { // LokasiID
            $this->LokasiID->setFormValue($row['LokasiID']);
        }
        if (isset($row['PelabuhanID'])) { // PelabuhanID
            $this->PelabuhanID->setFormValue($row['PelabuhanID']);
        }
        if (isset($row['BL_Extra'])) { // BL_Extra
            $this->BL_Extra->setFormValue($row['BL_Extra']);
        }
        if (isset($row['DepoID'])) { // DepoID
            $this->DepoID->setFormValue($row['DepoID']);
        }
        if (isset($row['Ongkos'])) { // Ongkos
            $this->Ongkos->setFormValue($row['Ongkos']);
        }
        if (isset($row['IsShow'])) { // IsShow
            $this->IsShow->setFormValue($row['IsShow']);
        }
        if (isset($row['IsOpen'])) { // IsOpen
            $this->IsOpen->setFormValue($row['IsOpen']);
        }
        if (isset($row['TakenByID'])) { // TakenByID
            $this->TakenByID->setFormValue($row['TakenByID']);
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("joborderlist"), "", $this->TableVar, true);
        $pageId = ($this->isCopy()) ? "Copy" : "Add";
        $Breadcrumb->add("add", $pageId, $url);
    }

    // Setup lookup options
    public function setupLookupOptions($fld)
    {
        if ($fld->Lookup && $fld->Lookup->Options === null) {
            // Get default connection and filter
            $conn = $this->getConnection();
            $lookupFilter = "";

            // No need to check any more
            $fld->Lookup->Options = [];

            // Set up lookup SQL and connection
            switch ($fld->FieldVar) {
                case "x_Job2ID":
                    break;
                case "x_SizeID":
                    break;
                case "x_TypeID":
                    break;
                case "x_LokasiID":
                    break;
                case "x_PelabuhanID":
                    break;
                case "x_DepoID":
                    break;
                case "x_IsShow":
                    break;
                case "x_IsOpen":
                    break;
                default:
                    $lookupFilter = "";
                    break;
            }

            // Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
            $sql = $fld->Lookup->getSql(false, "", $lookupFilter, $this);

            // Set up lookup cache
            if (!$fld->hasLookupOptions() && $fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0 && count($fld->Lookup->FilterFields) == 0) {
                $totalCnt = $this->getRecordCount($sql, $conn);
                if ($totalCnt > $fld->LookupCacheCount) { // Total count > cache count, do not cache
                    return;
                }
                $rows = $conn->executeQuery($sql)->fetchAll();
                $ar = [];
                foreach ($rows as $row) {
                    $row = $fld->Lookup->renderViewRow($row, Container($fld->Lookup->LinkTable));
                    $key = $row["lf"];
                    if (IsFloatType($fld->Type)) { // Handle float field
                        $key = (float)$key;
                    }
                    $ar[strval($key)] = $row;
                }
                $fld->Lookup->Options = $ar;
            }
        }
    }

    // Page Load event
    public function pageLoad()
    {
        //Log("Page Load");
    }

    // Page Unload event
    public function pageUnload()
    {
        //Log("Page Unload");
    }

    // Page Redirecting event
    public function pageRedirecting(&$url)
    {
        // Example:
        //$url = "your URL";
    }

    // Message Showing event
    // $type = ''|'success'|'failure'|'warning'
    public function messageShowing(&$msg, $type)
    {
        if ($type == "success") {
            //$msg = "your success message";
        } elseif ($type == "failure") {
            //$msg = "your failure message";
        } elseif ($type == "warning") {
            //$msg = "your warning message";
        } else {
            //$msg = "your message";
        }
    }

    // Page Render event
    public function pageRender()
    {
        //Log("Page Render");
    }

    // Page Data Rendering event
    public function pageDataRendering(&$header)
    {
        // Example:
        //$header = "your header";
    }

    // Page Data Rendered event
    public function pageDataRendered(&$footer)
    {
        // Example:
        //$footer = "your footer";
    }

    // Page Breaking event
    public function pageBreaking(&$break, &$content)
    {
        // Example:
        //$break = false; // Skip page break, or
        //$content = "<div style=\"break-after:page;\"></div>"; // Modify page break content
    }

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in $customError
        return true;
    }
}
