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
class JobAdd extends Job
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "JobAdd";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "jobadd";

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
        $this->JobID->Visible = false;
        $this->Tanggal->setVisibility();
        $this->Nomor->setVisibility();
        $this->Tanggal_Muat->setVisibility();
        $this->Customer->setVisibility();
        $this->Shipper->setVisibility();
        $this->Lokasi->setVisibility();
    }

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $DashboardReport, $DebugTimer, $UserTable;
        $this->TableVar = 'job';
        $this->TableName = 'job';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-add-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("app.language");

        // Table object (job)
        if (!isset($GLOBALS["job"]) || $GLOBALS["job"]::class == PROJECT_NAMESPACE . "job") {
            $GLOBALS["job"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'job');
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
                        $result["view"] = SameString($pageName, "jobview"); // If View page, no primary button
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
            $key .= @$ar['JobID'];
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
            $this->JobID->Visible = false;
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
            if (($keyValue = Get("JobID") ?? Route("JobID")) !== null) {
                $this->JobID->setQueryStringValue($keyValue);
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
                    $this->terminate("joblist"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "joblist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "jobview") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }

                    // Handle UseAjaxActions
                    if ($this->IsModal && $this->UseAjaxActions) {
                        $this->IsModal = false;
                        if (GetPageName($returnUrl) != "joblist") {
                            Container("app.flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                            $returnUrl = "joblist"; // Return list page content
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

        // Check field name 'Nomor' first before field var 'x_Nomor'
        $val = $CurrentForm->hasValue("Nomor") ? $CurrentForm->getValue("Nomor") : $CurrentForm->getValue("x_Nomor");
        if (!$this->Nomor->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Nomor->Visible = false; // Disable update for API request
            } else {
                $this->Nomor->setFormValue($val);
            }
        }

        // Check field name 'Tanggal_Muat' first before field var 'x_Tanggal_Muat'
        $val = $CurrentForm->hasValue("Tanggal_Muat") ? $CurrentForm->getValue("Tanggal_Muat") : $CurrentForm->getValue("x_Tanggal_Muat");
        if (!$this->Tanggal_Muat->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Tanggal_Muat->Visible = false; // Disable update for API request
            } else {
                $this->Tanggal_Muat->setFormValue($val, true, $validate);
            }
            $this->Tanggal_Muat->CurrentValue = UnFormatDateTime($this->Tanggal_Muat->CurrentValue, $this->Tanggal_Muat->formatPattern());
        }

        // Check field name 'Customer' first before field var 'x_Customer'
        $val = $CurrentForm->hasValue("Customer") ? $CurrentForm->getValue("Customer") : $CurrentForm->getValue("x_Customer");
        if (!$this->Customer->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Customer->Visible = false; // Disable update for API request
            } else {
                $this->Customer->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'Shipper' first before field var 'x_Shipper'
        $val = $CurrentForm->hasValue("Shipper") ? $CurrentForm->getValue("Shipper") : $CurrentForm->getValue("x_Shipper");
        if (!$this->Shipper->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Shipper->Visible = false; // Disable update for API request
            } else {
                $this->Shipper->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'Lokasi' first before field var 'x_Lokasi'
        $val = $CurrentForm->hasValue("Lokasi") ? $CurrentForm->getValue("Lokasi") : $CurrentForm->getValue("x_Lokasi");
        if (!$this->Lokasi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Lokasi->Visible = false; // Disable update for API request
            } else {
                $this->Lokasi->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'JobID' first before field var 'x_JobID'
        $val = $CurrentForm->hasValue("JobID") ? $CurrentForm->getValue("JobID") : $CurrentForm->getValue("x_JobID");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->Tanggal->CurrentValue = $this->Tanggal->FormValue;
        $this->Tanggal->CurrentValue = UnFormatDateTime($this->Tanggal->CurrentValue, $this->Tanggal->formatPattern());
        $this->Nomor->CurrentValue = $this->Nomor->FormValue;
        $this->Tanggal_Muat->CurrentValue = $this->Tanggal_Muat->FormValue;
        $this->Tanggal_Muat->CurrentValue = UnFormatDateTime($this->Tanggal_Muat->CurrentValue, $this->Tanggal_Muat->formatPattern());
        $this->Customer->CurrentValue = $this->Customer->FormValue;
        $this->Shipper->CurrentValue = $this->Shipper->FormValue;
        $this->Lokasi->CurrentValue = $this->Lokasi->FormValue;
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
        $this->JobID->setDbValue($row['JobID']);
        $this->Tanggal->setDbValue($row['Tanggal']);
        $this->Nomor->setDbValue($row['Nomor']);
        $this->Tanggal_Muat->setDbValue($row['Tanggal_Muat']);
        $this->Customer->setDbValue($row['Customer']);
        $this->Shipper->setDbValue($row['Shipper']);
        $this->Lokasi->setDbValue($row['Lokasi']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['JobID'] = $this->JobID->DefaultValue;
        $row['Tanggal'] = $this->Tanggal->DefaultValue;
        $row['Nomor'] = $this->Nomor->DefaultValue;
        $row['Tanggal_Muat'] = $this->Tanggal_Muat->DefaultValue;
        $row['Customer'] = $this->Customer->DefaultValue;
        $row['Shipper'] = $this->Shipper->DefaultValue;
        $row['Lokasi'] = $this->Lokasi->DefaultValue;
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

        // JobID
        $this->JobID->RowCssClass = "row";

        // Tanggal
        $this->Tanggal->RowCssClass = "row";

        // Nomor
        $this->Nomor->RowCssClass = "row";

        // Tanggal_Muat
        $this->Tanggal_Muat->RowCssClass = "row";

        // Customer
        $this->Customer->RowCssClass = "row";

        // Shipper
        $this->Shipper->RowCssClass = "row";

        // Lokasi
        $this->Lokasi->RowCssClass = "row";

        // View row
        if ($this->RowType == RowType::VIEW) {
            // JobID
            $this->JobID->ViewValue = $this->JobID->CurrentValue;

            // Tanggal
            $this->Tanggal->ViewValue = $this->Tanggal->CurrentValue;
            $this->Tanggal->ViewValue = FormatDateTime($this->Tanggal->ViewValue, $this->Tanggal->formatPattern());

            // Nomor
            $this->Nomor->ViewValue = $this->Nomor->CurrentValue;

            // Tanggal_Muat
            $this->Tanggal_Muat->ViewValue = $this->Tanggal_Muat->CurrentValue;
            $this->Tanggal_Muat->ViewValue = FormatDateTime($this->Tanggal_Muat->ViewValue, $this->Tanggal_Muat->formatPattern());

            // Customer
            $this->Customer->ViewValue = $this->Customer->CurrentValue;
            $this->Customer->ViewValue = FormatNumber($this->Customer->ViewValue, $this->Customer->formatPattern());

            // Shipper
            $this->Shipper->ViewValue = $this->Shipper->CurrentValue;
            $this->Shipper->ViewValue = FormatNumber($this->Shipper->ViewValue, $this->Shipper->formatPattern());

            // Lokasi
            $this->Lokasi->ViewValue = $this->Lokasi->CurrentValue;
            $this->Lokasi->ViewValue = FormatNumber($this->Lokasi->ViewValue, $this->Lokasi->formatPattern());

            // Tanggal
            $this->Tanggal->HrefValue = "";

            // Nomor
            $this->Nomor->HrefValue = "";

            // Tanggal_Muat
            $this->Tanggal_Muat->HrefValue = "";

            // Customer
            $this->Customer->HrefValue = "";

            // Shipper
            $this->Shipper->HrefValue = "";

            // Lokasi
            $this->Lokasi->HrefValue = "";
        } elseif ($this->RowType == RowType::ADD) {
            // Tanggal
            $this->Tanggal->setupEditAttributes();
            $this->Tanggal->EditValue = HtmlEncode(FormatDateTime($this->Tanggal->CurrentValue, $this->Tanggal->formatPattern()));
            $this->Tanggal->PlaceHolder = RemoveHtml($this->Tanggal->caption());

            // Nomor
            $this->Nomor->setupEditAttributes();
            if (!$this->Nomor->Raw) {
                $this->Nomor->CurrentValue = HtmlDecode($this->Nomor->CurrentValue);
            }
            $this->Nomor->EditValue = HtmlEncode($this->Nomor->CurrentValue);
            $this->Nomor->PlaceHolder = RemoveHtml($this->Nomor->caption());

            // Tanggal_Muat
            $this->Tanggal_Muat->setupEditAttributes();
            $this->Tanggal_Muat->EditValue = HtmlEncode(FormatDateTime($this->Tanggal_Muat->CurrentValue, $this->Tanggal_Muat->formatPattern()));
            $this->Tanggal_Muat->PlaceHolder = RemoveHtml($this->Tanggal_Muat->caption());

            // Customer
            $this->Customer->setupEditAttributes();
            $this->Customer->EditValue = $this->Customer->CurrentValue;
            $this->Customer->PlaceHolder = RemoveHtml($this->Customer->caption());
            if (strval($this->Customer->EditValue) != "" && is_numeric($this->Customer->EditValue)) {
                $this->Customer->EditValue = FormatNumber($this->Customer->EditValue, null);
            }

            // Shipper
            $this->Shipper->setupEditAttributes();
            $this->Shipper->EditValue = $this->Shipper->CurrentValue;
            $this->Shipper->PlaceHolder = RemoveHtml($this->Shipper->caption());
            if (strval($this->Shipper->EditValue) != "" && is_numeric($this->Shipper->EditValue)) {
                $this->Shipper->EditValue = FormatNumber($this->Shipper->EditValue, null);
            }

            // Lokasi
            $this->Lokasi->setupEditAttributes();
            $this->Lokasi->EditValue = $this->Lokasi->CurrentValue;
            $this->Lokasi->PlaceHolder = RemoveHtml($this->Lokasi->caption());
            if (strval($this->Lokasi->EditValue) != "" && is_numeric($this->Lokasi->EditValue)) {
                $this->Lokasi->EditValue = FormatNumber($this->Lokasi->EditValue, null);
            }

            // Add refer script

            // Tanggal
            $this->Tanggal->HrefValue = "";

            // Nomor
            $this->Nomor->HrefValue = "";

            // Tanggal_Muat
            $this->Tanggal_Muat->HrefValue = "";

            // Customer
            $this->Customer->HrefValue = "";

            // Shipper
            $this->Shipper->HrefValue = "";

            // Lokasi
            $this->Lokasi->HrefValue = "";
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
            if ($this->Tanggal->Visible && $this->Tanggal->Required) {
                if (!$this->Tanggal->IsDetailKey && EmptyValue($this->Tanggal->FormValue)) {
                    $this->Tanggal->addErrorMessage(str_replace("%s", $this->Tanggal->caption(), $this->Tanggal->RequiredErrorMessage));
                }
            }
            if (!CheckDate($this->Tanggal->FormValue, $this->Tanggal->formatPattern())) {
                $this->Tanggal->addErrorMessage($this->Tanggal->getErrorMessage(false));
            }
            if ($this->Nomor->Visible && $this->Nomor->Required) {
                if (!$this->Nomor->IsDetailKey && EmptyValue($this->Nomor->FormValue)) {
                    $this->Nomor->addErrorMessage(str_replace("%s", $this->Nomor->caption(), $this->Nomor->RequiredErrorMessage));
                }
            }
            if ($this->Tanggal_Muat->Visible && $this->Tanggal_Muat->Required) {
                if (!$this->Tanggal_Muat->IsDetailKey && EmptyValue($this->Tanggal_Muat->FormValue)) {
                    $this->Tanggal_Muat->addErrorMessage(str_replace("%s", $this->Tanggal_Muat->caption(), $this->Tanggal_Muat->RequiredErrorMessage));
                }
            }
            if (!CheckDate($this->Tanggal_Muat->FormValue, $this->Tanggal_Muat->formatPattern())) {
                $this->Tanggal_Muat->addErrorMessage($this->Tanggal_Muat->getErrorMessage(false));
            }
            if ($this->Customer->Visible && $this->Customer->Required) {
                if (!$this->Customer->IsDetailKey && EmptyValue($this->Customer->FormValue)) {
                    $this->Customer->addErrorMessage(str_replace("%s", $this->Customer->caption(), $this->Customer->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->Customer->FormValue)) {
                $this->Customer->addErrorMessage($this->Customer->getErrorMessage(false));
            }
            if ($this->Shipper->Visible && $this->Shipper->Required) {
                if (!$this->Shipper->IsDetailKey && EmptyValue($this->Shipper->FormValue)) {
                    $this->Shipper->addErrorMessage(str_replace("%s", $this->Shipper->caption(), $this->Shipper->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->Shipper->FormValue)) {
                $this->Shipper->addErrorMessage($this->Shipper->getErrorMessage(false));
            }
            if ($this->Lokasi->Visible && $this->Lokasi->Required) {
                if (!$this->Lokasi->IsDetailKey && EmptyValue($this->Lokasi->FormValue)) {
                    $this->Lokasi->addErrorMessage(str_replace("%s", $this->Lokasi->caption(), $this->Lokasi->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->Lokasi->FormValue)) {
                $this->Lokasi->addErrorMessage($this->Lokasi->getErrorMessage(false));
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

        // Tanggal
        $this->Tanggal->setDbValueDef($rsnew, UnFormatDateTime($this->Tanggal->CurrentValue, $this->Tanggal->formatPattern()), false);

        // Nomor
        $this->Nomor->setDbValueDef($rsnew, $this->Nomor->CurrentValue, false);

        // Tanggal_Muat
        $this->Tanggal_Muat->setDbValueDef($rsnew, UnFormatDateTime($this->Tanggal_Muat->CurrentValue, $this->Tanggal_Muat->formatPattern()), false);

        // Customer
        $this->Customer->setDbValueDef($rsnew, $this->Customer->CurrentValue, false);

        // Shipper
        $this->Shipper->setDbValueDef($rsnew, $this->Shipper->CurrentValue, false);

        // Lokasi
        $this->Lokasi->setDbValueDef($rsnew, $this->Lokasi->CurrentValue, false);
        return $rsnew;
    }

    /**
     * Restore add form from row
     * @param array $row Row
     */
    protected function restoreAddFormFromRow($row)
    {
        if (isset($row['Tanggal'])) { // Tanggal
            $this->Tanggal->setFormValue($row['Tanggal']);
        }
        if (isset($row['Nomor'])) { // Nomor
            $this->Nomor->setFormValue($row['Nomor']);
        }
        if (isset($row['Tanggal_Muat'])) { // Tanggal_Muat
            $this->Tanggal_Muat->setFormValue($row['Tanggal_Muat']);
        }
        if (isset($row['Customer'])) { // Customer
            $this->Customer->setFormValue($row['Customer']);
        }
        if (isset($row['Shipper'])) { // Shipper
            $this->Shipper->setFormValue($row['Shipper']);
        }
        if (isset($row['Lokasi'])) { // Lokasi
            $this->Lokasi->setFormValue($row['Lokasi']);
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("joblist"), "", $this->TableVar, true);
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
