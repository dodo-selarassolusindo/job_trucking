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
 * Table class for job_order
 */
class JobOrder extends DbTable
{
    protected $SqlFrom = "";
    protected $SqlSelect = null;
    protected $SqlSelectList = null;
    protected $SqlWhere = "";
    protected $SqlGroupBy = "";
    protected $SqlHaving = "";
    protected $SqlOrderBy = "";
    public $DbErrorMessage = "";
    public $UseSessionForListSql = true;

    // Column CSS classes
    public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
    public $RightColumnClass = "col-sm-10";
    public $OffsetColumnClass = "col-sm-10 offset-sm-2";
    public $TableLeftColumnClass = "w-col-2";

    // Audit trail
    public $AuditTrailOnAdd = true;
    public $AuditTrailOnEdit = true;
    public $AuditTrailOnDelete = true;
    public $AuditTrailOnView = false;
    public $AuditTrailOnViewData = false;
    public $AuditTrailOnSearch = false;

    // Ajax / Modal
    public $UseAjaxActions = false;
    public $ModalSearch = false;
    public $ModalView = false;
    public $ModalAdd = false;
    public $ModalEdit = false;
    public $ModalUpdate = false;
    public $InlineDelete = false;
    public $ModalGridAdd = false;
    public $ModalGridEdit = false;
    public $ModalMultiEdit = false;

    // Fields
    public $JobOrderID;
    public $Job2ID;
    public $SizeID;
    public $TypeID;
    public $Tanggal;
    public $LokasiID;
    public $PelabuhanID;
    public $BL_Extra;
    public $DepoID;
    public $Ongkos;
    public $IsShow;
    public $IsOpen;
    public $TakenByID;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $CurrentLanguage, $CurrentLocale;

        // Language object
        $Language = Container("app.language");
        $this->TableVar = "job_order";
        $this->TableName = 'job_order';
        $this->TableType = "TABLE";
        $this->ImportUseTransaction = $this->supportsTransaction() && Config("IMPORT_USE_TRANSACTION");
        $this->UseTransaction = $this->supportsTransaction() && Config("USE_TRANSACTION");

        // Update Table
        $this->UpdateTable = "job_order";
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)

        // PDF
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)

        // PhpSpreadsheet
        $this->ExportExcelPageOrientation = null; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = null; // Page size (PhpSpreadsheet only)

        // PHPWord
        $this->ExportWordPageOrientation = ""; // Page orientation (PHPWord only)
        $this->ExportWordPageSize = ""; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = false; // Allow detail add
        $this->DetailEdit = false; // Allow detail edit
        $this->DetailView = false; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UseAjaxActions = $this->UseAjaxActions || Config("USE_AJAX_ACTIONS");
        $this->UseColumnVisibility = true;
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this);

        // JobOrderID
        $this->JobOrderID = new DbField(
            $this, // Table
            'x_JobOrderID', // Variable name
            'JobOrderID', // Name
            '`JobOrderID`', // Expression
            '`JobOrderID`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`JobOrderID`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'NO' // Edit Tag
        );
        $this->JobOrderID->InputTextType = "text";
        $this->JobOrderID->Raw = true;
        $this->JobOrderID->IsAutoIncrement = true; // Autoincrement field
        $this->JobOrderID->IsPrimaryKey = true; // Primary key field
        $this->JobOrderID->Nullable = false; // NOT NULL field
        $this->JobOrderID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->JobOrderID->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['JobOrderID'] = &$this->JobOrderID;

        // Job2ID
        $this->Job2ID = new DbField(
            $this, // Table
            'x_Job2ID', // Variable name
            'Job2ID', // Name
            '`Job2ID`', // Expression
            '`Job2ID`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`Job2ID`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'SELECT' // Edit Tag
        );
        $this->Job2ID->InputTextType = "text";
        $this->Job2ID->Raw = true;
        $this->Job2ID->Nullable = false; // NOT NULL field
        $this->Job2ID->Required = true; // Required field
        $this->Job2ID->setSelectMultiple(false); // Select one
        $this->Job2ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->Job2ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->Job2ID->UseFilter = true; // Table header filter
        $this->Job2ID->Lookup = new Lookup($this->Job2ID, 'job2', true, 'Job2ID', ["Nama","","",""], '', '', [], [], [], [], [], [], false, '', '', "`Nama`");
        $this->Job2ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Job2ID->SearchOperators = ["=", "<>", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['Job2ID'] = &$this->Job2ID;

        // SizeID
        $this->SizeID = new DbField(
            $this, // Table
            'x_SizeID', // Variable name
            'SizeID', // Name
            '`SizeID`', // Expression
            '`SizeID`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`SizeID`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'SELECT' // Edit Tag
        );
        $this->SizeID->InputTextType = "text";
        $this->SizeID->Raw = true;
        $this->SizeID->Nullable = false; // NOT NULL field
        $this->SizeID->Required = true; // Required field
        $this->SizeID->setSelectMultiple(false); // Select one
        $this->SizeID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->SizeID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->SizeID->UseFilter = true; // Table header filter
        $this->SizeID->Lookup = new Lookup($this->SizeID, 'size', true, 'SizeID', ["Ukuran","","",""], '', '', [], ["x_TypeID"], [], [], [], [], false, '', '', "`Ukuran`");
        $this->SizeID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->SizeID->SearchOperators = ["=", "<>", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['SizeID'] = &$this->SizeID;

        // TypeID
        $this->TypeID = new DbField(
            $this, // Table
            'x_TypeID', // Variable name
            'TypeID', // Name
            '`TypeID`', // Expression
            '`TypeID`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`TypeID`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->TypeID->InputTextType = "text";
        $this->TypeID->Raw = true;
        $this->TypeID->Nullable = false; // NOT NULL field
        $this->TypeID->Required = true; // Required field
        $this->TypeID->UseFilter = true; // Table header filter
        $this->TypeID->Lookup = new Lookup($this->TypeID, 'size_type', true, 'TypeID', ["TypeNama","","",""], '', '', ["x_SizeID"], [], ["SizeID"], ["x_SizeID"], [], [], false, '', '', "(select Nama from type where type.TypeID = size_type.TypeID)");
        $this->TypeID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->TypeID->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['TypeID'] = &$this->TypeID;

        // Tanggal
        $this->Tanggal = new DbField(
            $this, // Table
            'x_Tanggal', // Variable name
            'Tanggal', // Name
            '`Tanggal`', // Expression
            CastDateFieldForLike("`Tanggal`", 7, "DB"), // Basic search expression
            133, // Type
            10, // Size
            7, // Date/Time format
            false, // Is upload field
            '`Tanggal`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->Tanggal->InputTextType = "text";
        $this->Tanggal->Raw = true;
        $this->Tanggal->Nullable = false; // NOT NULL field
        $this->Tanggal->Required = true; // Required field
        $this->Tanggal->UseFilter = true; // Table header filter
        $this->Tanggal->Lookup = new Lookup($this->Tanggal, 'job_order', true, 'Tanggal', ["Tanggal","","",""], '', '', [], [], [], [], [], [], false, '', '', "");
        $this->Tanggal->DefaultErrorMessage = str_replace("%s", DateFormat(7), $Language->phrase("IncorrectDate"));
        $this->Tanggal->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['Tanggal'] = &$this->Tanggal;

        // LokasiID
        $this->LokasiID = new DbField(
            $this, // Table
            'x_LokasiID', // Variable name
            'LokasiID', // Name
            '`LokasiID`', // Expression
            '`LokasiID`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`LokasiID`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'SELECT' // Edit Tag
        );
        $this->LokasiID->InputTextType = "text";
        $this->LokasiID->Raw = true;
        $this->LokasiID->Nullable = false; // NOT NULL field
        $this->LokasiID->Required = true; // Required field
        $this->LokasiID->setSelectMultiple(false); // Select one
        $this->LokasiID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->LokasiID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->LokasiID->UseFilter = true; // Table header filter
        $this->LokasiID->Lookup = new Lookup($this->LokasiID, 'lokasi', true, 'LokasiID', ["Nama","","",""], '', '', [], [], [], [], [], [], false, '', '', "`Nama`");
        $this->LokasiID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->LokasiID->SearchOperators = ["=", "<>", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['LokasiID'] = &$this->LokasiID;

        // PelabuhanID
        $this->PelabuhanID = new DbField(
            $this, // Table
            'x_PelabuhanID', // Variable name
            'PelabuhanID', // Name
            '`PelabuhanID`', // Expression
            '`PelabuhanID`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`PelabuhanID`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'SELECT' // Edit Tag
        );
        $this->PelabuhanID->InputTextType = "text";
        $this->PelabuhanID->Raw = true;
        $this->PelabuhanID->Nullable = false; // NOT NULL field
        $this->PelabuhanID->Required = true; // Required field
        $this->PelabuhanID->setSelectMultiple(false); // Select one
        $this->PelabuhanID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->PelabuhanID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->PelabuhanID->UseFilter = true; // Table header filter
        $this->PelabuhanID->Lookup = new Lookup($this->PelabuhanID, 'pelabuhan', true, 'PelabuhanID', ["Kode","Nama","",""], '', '', [], [], [], [], [], [], false, '', '', "CONCAT(COALESCE(`Kode`, ''),'" . ValueSeparator(1, $this->PelabuhanID) . "',COALESCE(`Nama`,''))");
        $this->PelabuhanID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->PelabuhanID->SearchOperators = ["=", "<>", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['PelabuhanID'] = &$this->PelabuhanID;

        // BL_Extra
        $this->BL_Extra = new DbField(
            $this, // Table
            'x_BL_Extra', // Variable name
            'BL_Extra', // Name
            '`BL_Extra`', // Expression
            '`BL_Extra`', // Basic search expression
            5, // Type
            22, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`BL_Extra`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->BL_Extra->InputTextType = "text";
        $this->BL_Extra->Raw = true;
        $this->BL_Extra->Nullable = false; // NOT NULL field
        $this->BL_Extra->Required = true; // Required field
        $this->BL_Extra->UseFilter = true; // Table header filter
        $this->BL_Extra->Lookup = new Lookup($this->BL_Extra, 'job_order', true, 'BL_Extra', ["BL_Extra","","",""], '', '', [], [], [], [], [], [], false, '', '', "");
        $this->BL_Extra->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->BL_Extra->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['BL_Extra'] = &$this->BL_Extra;

        // DepoID
        $this->DepoID = new DbField(
            $this, // Table
            'x_DepoID', // Variable name
            'DepoID', // Name
            '`DepoID`', // Expression
            '`DepoID`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`DepoID`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'SELECT' // Edit Tag
        );
        $this->DepoID->InputTextType = "text";
        $this->DepoID->Raw = true;
        $this->DepoID->Nullable = false; // NOT NULL field
        $this->DepoID->Required = true; // Required field
        $this->DepoID->setSelectMultiple(false); // Select one
        $this->DepoID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->DepoID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->DepoID->UseFilter = true; // Table header filter
        $this->DepoID->Lookup = new Lookup($this->DepoID, 'depo', true, 'DepoID', ["Kode","Nama","",""], '', '', [], [], [], [], [], [], false, '', '', "CONCAT(COALESCE(`Kode`, ''),'" . ValueSeparator(1, $this->DepoID) . "',COALESCE(`Nama`,''))");
        $this->DepoID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->DepoID->SearchOperators = ["=", "<>", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['DepoID'] = &$this->DepoID;

        // Ongkos
        $this->Ongkos = new DbField(
            $this, // Table
            'x_Ongkos', // Variable name
            'Ongkos', // Name
            '`Ongkos`', // Expression
            '`Ongkos`', // Basic search expression
            5, // Type
            22, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`Ongkos`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->Ongkos->InputTextType = "text";
        $this->Ongkos->Raw = true;
        $this->Ongkos->Nullable = false; // NOT NULL field
        $this->Ongkos->Required = true; // Required field
        $this->Ongkos->UseFilter = true; // Table header filter
        $this->Ongkos->Lookup = new Lookup($this->Ongkos, 'job_order', true, 'Ongkos', ["Ongkos","","",""], '', '', [], [], [], [], [], [], false, '', '', "");
        $this->Ongkos->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Ongkos->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['Ongkos'] = &$this->Ongkos;

        // IsShow
        $this->IsShow = new DbField(
            $this, // Table
            'x_IsShow', // Variable name
            'IsShow', // Name
            '`IsShow`', // Expression
            '`IsShow`', // Basic search expression
            16, // Type
            4, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`IsShow`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'SELECT' // Edit Tag
        );
        $this->IsShow->InputTextType = "text";
        $this->IsShow->Raw = true;
        $this->IsShow->Nullable = false; // NOT NULL field
        $this->IsShow->Required = true; // Required field
        $this->IsShow->setSelectMultiple(false); // Select one
        $this->IsShow->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->IsShow->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->IsShow->UseFilter = true; // Table header filter
        $this->IsShow->Lookup = new Lookup($this->IsShow, 'job_order', true, 'IsShow', ["IsShow","","",""], '', '', [], [], [], [], [], [], false, '', '', "");
        $this->IsShow->OptionCount = 2;
        $this->IsShow->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->IsShow->SearchOperators = ["=", "<>", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['IsShow'] = &$this->IsShow;

        // IsOpen
        $this->IsOpen = new DbField(
            $this, // Table
            'x_IsOpen', // Variable name
            'IsOpen', // Name
            '`IsOpen`', // Expression
            '`IsOpen`', // Basic search expression
            16, // Type
            4, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`IsOpen`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'SELECT' // Edit Tag
        );
        $this->IsOpen->InputTextType = "text";
        $this->IsOpen->Raw = true;
        $this->IsOpen->Nullable = false; // NOT NULL field
        $this->IsOpen->Required = true; // Required field
        $this->IsOpen->setSelectMultiple(false); // Select one
        $this->IsOpen->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->IsOpen->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->IsOpen->UseFilter = true; // Table header filter
        $this->IsOpen->Lookup = new Lookup($this->IsOpen, 'job_order', true, 'IsOpen', ["IsOpen","","",""], '', '', [], [], [], [], [], [], false, '', '', "");
        $this->IsOpen->OptionCount = 2;
        $this->IsOpen->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->IsOpen->SearchOperators = ["=", "<>", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['IsOpen'] = &$this->IsOpen;

        // TakenByID
        $this->TakenByID = new DbField(
            $this, // Table
            'x_TakenByID', // Variable name
            'TakenByID', // Name
            '`TakenByID`', // Expression
            '`TakenByID`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`TakenByID`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'SELECT' // Edit Tag
        );
        $this->TakenByID->InputTextType = "text";
        $this->TakenByID->Raw = true;
        $this->TakenByID->Nullable = false; // NOT NULL field
        $this->TakenByID->Required = true; // Required field
        $this->TakenByID->setSelectMultiple(false); // Select one
        $this->TakenByID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->TakenByID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->TakenByID->UseFilter = true; // Table header filter
        $this->TakenByID->Lookup = new Lookup($this->TakenByID, 'taken_by', true, 'TakenByID', ["Nama","NomorHP","",""], '', '', [], [], [], [], [], [], false, '', '', "CONCAT(COALESCE(`Nama`, ''),'" . ValueSeparator(1, $this->TakenByID) . "',COALESCE(`NomorHP`,''))");
        $this->TakenByID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->TakenByID->SearchOperators = ["=", "<>", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['TakenByID'] = &$this->TakenByID;

        // Add Doctrine Cache
        $this->Cache = new \Symfony\Component\Cache\Adapter\ArrayAdapter();
        $this->CacheProfile = new \Doctrine\DBAL\Cache\QueryCacheProfile(0, $this->TableVar);

        // Call Table Load event
        $this->tableLoad();
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
    public function setLeftColumnClass($class)
    {
        if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
            $this->LeftColumnClass = $class . " col-form-label ew-label";
            $this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
            $this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
            $this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
        }
    }

    // Single column sort
    public function updateSort(&$fld)
    {
        if ($this->CurrentOrder == $fld->Name) {
            $sortField = $fld->Expression;
            $lastSort = $fld->getSort();
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            $this->setSessionOrderBy($orderBy); // Save to Session
        }
    }

    // Update field sort
    public function updateFieldSort()
    {
        $orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
        $flds = GetSortFields($orderBy);
        foreach ($this->Fields as $field) {
            $fldSort = "";
            foreach ($flds as $fld) {
                if ($fld[0] == $field->Expression || $fld[0] == $field->VirtualExpression) {
                    $fldSort = $fld[1];
                }
            }
            $field->setSort($fldSort);
        }
    }

    // Render X Axis for chart
    public function renderChartXAxis($chartVar, $chartRow)
    {
        return $chartRow;
    }

    // Get FROM clause
    public function getSqlFrom()
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "job_order";
    }

    // Get FROM clause (for backward compatibility)
    public function sqlFrom()
    {
        return $this->getSqlFrom();
    }

    // Set FROM clause
    public function setSqlFrom($v)
    {
        $this->SqlFrom = $v;
    }

    // Get SELECT clause
    public function getSqlSelect() // Select
    {
        return $this->SqlSelect ?? $this->getQueryBuilder()->select($this->sqlSelectFields());
    }

    // Get list of fields
    private function sqlSelectFields()
    {
        $useFieldNames = false;
        $fieldNames = [];
        $platform = $this->getConnection()->getDatabasePlatform();
        foreach ($this->Fields as $field) {
            $expr = $field->Expression;
            $customExpr = $field->CustomDataType?->convertToPHPValueSQL($expr, $platform) ?? $expr;
            if ($customExpr != $expr) {
                $fieldNames[] = $customExpr . " AS " . QuotedName($field->Name, $this->Dbid);
                $useFieldNames = true;
            } else {
                $fieldNames[] = $expr;
            }
        }
        return $useFieldNames ? implode(", ", $fieldNames) : "*";
    }

    // Get SELECT clause (for backward compatibility)
    public function sqlSelect()
    {
        return $this->getSqlSelect();
    }

    // Set SELECT clause
    public function setSqlSelect($v)
    {
        $this->SqlSelect = $v;
    }

    // Get WHERE clause
    public function getSqlWhere()
    {
        $where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
        $this->DefaultFilter = "";
        AddFilter($where, $this->DefaultFilter);
        return $where;
    }

    // Get WHERE clause (for backward compatibility)
    public function sqlWhere()
    {
        return $this->getSqlWhere();
    }

    // Set WHERE clause
    public function setSqlWhere($v)
    {
        $this->SqlWhere = $v;
    }

    // Get GROUP BY clause
    public function getSqlGroupBy()
    {
        return $this->SqlGroupBy != "" ? $this->SqlGroupBy : "";
    }

    // Get GROUP BY clause (for backward compatibility)
    public function sqlGroupBy()
    {
        return $this->getSqlGroupBy();
    }

    // set GROUP BY clause
    public function setSqlGroupBy($v)
    {
        $this->SqlGroupBy = $v;
    }

    // Get HAVING clause
    public function getSqlHaving() // Having
    {
        return ($this->SqlHaving != "") ? $this->SqlHaving : "";
    }

    // Get HAVING clause (for backward compatibility)
    public function sqlHaving()
    {
        return $this->getSqlHaving();
    }

    // Set HAVING clause
    public function setSqlHaving($v)
    {
        $this->SqlHaving = $v;
    }

    // Get ORDER BY clause
    public function getSqlOrderBy()
    {
        return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
    }

    // Get ORDER BY clause (for backward compatibility)
    public function sqlOrderBy()
    {
        return $this->getSqlOrderBy();
    }

    // set ORDER BY clause
    public function setSqlOrderBy($v)
    {
        $this->SqlOrderBy = $v;
    }

    // Apply User ID filters
    public function applyUserIDFilters($filter, $id = "")
    {
        return $filter;
    }

    // Check if User ID security allows view all
    public function userIDAllow($id = "")
    {
        $allow = $this->UserIDAllowSecurity;
        switch ($id) {
            case "add":
            case "copy":
            case "gridadd":
            case "register":
            case "addopt":
                return ($allow & Allow::ADD->value) == Allow::ADD->value;
            case "edit":
            case "gridedit":
            case "update":
            case "changepassword":
            case "resetpassword":
                return ($allow & Allow::EDIT->value) == Allow::EDIT->value;
            case "delete":
                return ($allow & Allow::DELETE->value) == Allow::DELETE->value;
            case "view":
                return ($allow & Allow::VIEW->value) == Allow::VIEW->value;
            case "search":
                return ($allow & Allow::SEARCH->value) == Allow::SEARCH->value;
            case "lookup":
                return ($allow & Allow::LOOKUP->value) == Allow::LOOKUP->value;
            default:
                return ($allow & Allow::LIST->value) == Allow::LIST->value;
        }
    }

    /**
     * Get record count
     *
     * @param string|QueryBuilder $sql SQL or QueryBuilder
     * @param mixed $c Connection
     * @return int
     */
    public function getRecordCount($sql, $c = null)
    {
        $cnt = -1;
        $sqlwrk = $sql instanceof QueryBuilder // Query builder
            ? (clone $sql)->resetQueryPart("orderBy")->getSQL()
            : $sql;
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            in_array($this->TableType, ["TABLE", "VIEW", "LINKTABLE"]) &&
            preg_match($pattern, $sqlwrk) &&
            !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sqlwrk) &&
            !preg_match('/^\s*SELECT\s+DISTINCT\s+/i', $sqlwrk) &&
            !preg_match('/\s+ORDER\s+BY\s+/i', $sqlwrk)
        ) {
            $sqlcnt = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sqlwrk);
        } else {
            $sqlcnt = "SELECT COUNT(*) FROM (" . $sqlwrk . ") COUNT_TABLE";
        }
        $conn = $c ?? $this->getConnection();
        $cnt = $conn->fetchOne($sqlcnt);
        if ($cnt !== false) {
            return (int)$cnt;
        }
        // Unable to get count by SELECT COUNT(*), execute the SQL to get record count directly
        $result = $conn->executeQuery($sqlwrk);
        $cnt = $result->rowCount();
        if ($cnt == 0) { // Unable to get record count, count directly
            while ($result->fetch()) {
                $cnt++;
            }
        }
        return $cnt;
    }

    // Get SQL
    public function getSql($where, $orderBy = "")
    {
        return $this->getSqlAsQueryBuilder($where, $orderBy)->getSQL();
    }

    // Get QueryBuilder
    public function getSqlAsQueryBuilder($where, $orderBy = "")
    {
        return $this->buildSelectSql(
            $this->getSqlSelect(),
            $this->getSqlFrom(),
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $where,
            $orderBy
        );
    }

    // Table SQL
    public function getCurrentSql()
    {
        $filter = $this->CurrentFilter;
        $filter = $this->applyUserIDFilters($filter);
        $sort = $this->getSessionOrderBy();
        return $this->getSql($filter, $sort);
    }

    /**
     * Table SQL with List page filter
     *
     * @return QueryBuilder
     */
    public function getListSql()
    {
        $filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->getSqlSelect();
        $from = $this->getSqlFrom();
        $sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
        $this->Sort = $sort;
        return $this->buildSelectSql(
            $select,
            $from,
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $filter,
            $sort
        );
    }

    // Get ORDER BY clause
    public function getOrderBy()
    {
        $orderBy = $this->getSqlOrderBy();
        $sort = $this->getSessionOrderBy();
        if ($orderBy != "" && $sort != "") {
            $orderBy .= ", " . $sort;
        } elseif ($sort != "") {
            $orderBy = $sort;
        }
        return $orderBy;
    }

    // Get record count based on filter (for detail record count in master table pages)
    public function loadRecordCount($filter)
    {
        $origFilter = $this->CurrentFilter;
        $this->CurrentFilter = $filter;
        $this->recordsetSelecting($this->CurrentFilter);
        $isCustomView = $this->TableType == "CUSTOMVIEW";
        $select = $isCustomView ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $isCustomView ? $this->getSqlGroupBy() : "";
        $having = $isCustomView ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
        $cnt = $this->getRecordCount($sql);
        $this->CurrentFilter = $origFilter;
        return $cnt;
    }

    // Get record count (for current List page)
    public function listRecordCount()
    {
        $filter = $this->getSessionWhere();
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $isCustomView = $this->TableType == "CUSTOMVIEW";
        $select = $isCustomView ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $isCustomView ? $this->getSqlGroupBy() : "";
        $having = $isCustomView ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
        $cnt = $this->getRecordCount($sql);
        return $cnt;
    }

    /**
     * INSERT statement
     *
     * @param mixed $rs
     * @return QueryBuilder
     */
    public function insertSql(&$rs)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->insert($this->UpdateTable);
        $platform = $this->getConnection()->getDatabasePlatform();
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom) {
                continue;
            }
            $field = $this->Fields[$name];
            $parm = $queryBuilder->createPositionalParameter($value, $field->getParameterType());
            $parm = $field->CustomDataType?->convertToDatabaseValueSQL($parm, $platform) ?? $parm; // Convert database SQL
            $queryBuilder->setValue($field->Expression, $parm);
        }
        return $queryBuilder;
    }

    // Insert
    public function insert(&$rs)
    {
        $conn = $this->getConnection();
        try {
            $queryBuilder = $this->insertSql($rs);
            $result = $queryBuilder->executeStatement();
            $this->DbErrorMessage = "";
        } catch (\Exception $e) {
            $result = false;
            $this->DbErrorMessage = $e->getMessage();
        }
        if ($result) {
            $this->JobOrderID->setDbValue($conn->lastInsertId());
            $rs['JobOrderID'] = $this->JobOrderID->DbValue;
            if ($this->AuditTrailOnAdd) {
                $this->writeAuditTrailOnAdd($rs);
            }
        }
        return $result;
    }

    /**
     * UPDATE statement
     *
     * @param array $rs Data to be updated
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function updateSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->update($this->UpdateTable);
        $platform = $this->getConnection()->getDatabasePlatform();
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom || $this->Fields[$name]->IsAutoIncrement) {
                continue;
            }
            $field = $this->Fields[$name];
            $parm = $queryBuilder->createPositionalParameter($value, $field->getParameterType());
            $parm = $field->CustomDataType?->convertToDatabaseValueSQL($parm, $platform) ?? $parm; // Convert database SQL
            $queryBuilder->set($field->Expression, $parm);
        }
        $filter = $curfilter ? $this->CurrentFilter : "";
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        AddFilter($filter, $where);
        if ($filter != "") {
            $queryBuilder->where($filter);
        }
        return $queryBuilder;
    }

    // Update
    public function update(&$rs, $where = "", $rsold = null, $curfilter = true)
    {
        // If no field is updated, execute may return 0. Treat as success
        try {
            $success = $this->updateSql($rs, $where, $curfilter)->executeStatement();
            $success = $success > 0 ? $success : true;
            $this->DbErrorMessage = "";
        } catch (\Exception $e) {
            $success = false;
            $this->DbErrorMessage = $e->getMessage();
        }

        // Return auto increment field
        if ($success) {
            if (!isset($rs['JobOrderID']) && !EmptyValue($this->JobOrderID->CurrentValue)) {
                $rs['JobOrderID'] = $this->JobOrderID->CurrentValue;
            }
        }
        if ($success && $this->AuditTrailOnEdit && $rsold) {
            $rsaudit = $rs;
            $fldname = 'JobOrderID';
            if (!array_key_exists($fldname, $rsaudit)) {
                $rsaudit[$fldname] = $rsold[$fldname];
            }
            $this->writeAuditTrailOnEdit($rsold, $rsaudit);
        }
        return $success;
    }

    /**
     * DELETE statement
     *
     * @param array $rs Key values
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function deleteSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->delete($this->UpdateTable);
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        if ($rs) {
            if (array_key_exists('JobOrderID', $rs)) {
                AddFilter($where, QuotedName('JobOrderID', $this->Dbid) . '=' . QuotedValue($rs['JobOrderID'], $this->JobOrderID->DataType, $this->Dbid));
            }
        }
        $filter = $curfilter ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;
        if ($success) {
            try {
                $success = $this->deleteSql($rs, $where, $curfilter)->executeStatement();
                $this->DbErrorMessage = "";
            } catch (\Exception $e) {
                $success = false;
                $this->DbErrorMessage = $e->getMessage();
            }
        }
        if ($success && $this->AuditTrailOnDelete) {
            $this->writeAuditTrailOnDelete($rs);
        }
        return $success;
    }

    // Load DbValue from result set or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->JobOrderID->DbValue = $row['JobOrderID'];
        $this->Job2ID->DbValue = $row['Job2ID'];
        $this->SizeID->DbValue = $row['SizeID'];
        $this->TypeID->DbValue = $row['TypeID'];
        $this->Tanggal->DbValue = $row['Tanggal'];
        $this->LokasiID->DbValue = $row['LokasiID'];
        $this->PelabuhanID->DbValue = $row['PelabuhanID'];
        $this->BL_Extra->DbValue = $row['BL_Extra'];
        $this->DepoID->DbValue = $row['DepoID'];
        $this->Ongkos->DbValue = $row['Ongkos'];
        $this->IsShow->DbValue = $row['IsShow'];
        $this->IsOpen->DbValue = $row['IsOpen'];
        $this->TakenByID->DbValue = $row['TakenByID'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`JobOrderID` = @JobOrderID@";
    }

    // Get Key
    public function getKey($current = false, $keySeparator = null)
    {
        $keys = [];
        $val = $current ? $this->JobOrderID->CurrentValue : $this->JobOrderID->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        $keySeparator ??= Config("COMPOSITE_KEY_SEPARATOR");
        return implode($keySeparator, $keys);
    }

    // Set Key
    public function setKey($key, $current = false, $keySeparator = null)
    {
        $keySeparator ??= Config("COMPOSITE_KEY_SEPARATOR");
        $this->OldKey = strval($key);
        $keys = explode($keySeparator, $this->OldKey);
        if (count($keys) == 1) {
            if ($current) {
                $this->JobOrderID->CurrentValue = $keys[0];
            } else {
                $this->JobOrderID->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null, $current = false)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('JobOrderID', $row) ? $row['JobOrderID'] : null;
        } else {
            $val = !EmptyValue($this->JobOrderID->OldValue) && !$current ? $this->JobOrderID->OldValue : $this->JobOrderID->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@JobOrderID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        return $keyFilter;
    }

    // Return page URL
    public function getReturnUrl()
    {
        $referUrl = ReferUrl();
        $referPageName = ReferPageName();
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if ($referUrl != "" && $referPageName != CurrentPageName() && $referPageName != "login") { // Referer not same page or login page
            $_SESSION[$name] = $referUrl; // Save to Session
        }
        return $_SESSION[$name] ?? GetUrl("joborderlist");
    }

    // Set return page URL
    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        return match ($pageName) {
            "joborderview" => $Language->phrase("View"),
            "joborderedit" => $Language->phrase("Edit"),
            "joborderadd" => $Language->phrase("Add"),
            default => ""
        };
    }

    // Default route URL
    public function getDefaultRouteUrl()
    {
        return "joborderlist";
    }

    // API page name
    public function getApiPageName($action)
    {
        return match (strtolower($action)) {
            Config("API_VIEW_ACTION") => "JobOrderView",
            Config("API_ADD_ACTION") => "JobOrderAdd",
            Config("API_EDIT_ACTION") => "JobOrderEdit",
            Config("API_DELETE_ACTION") => "JobOrderDelete",
            Config("API_LIST_ACTION") => "JobOrderList",
            default => ""
        };
    }

    // Current URL
    public function getCurrentUrl($parm = "")
    {
        $url = CurrentPageUrl(false);
        if ($parm != "") {
            $url = $this->keyUrl($url, $parm);
        } else {
            $url = $this->keyUrl($url, Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // List URL
    public function getListUrl()
    {
        return "joborderlist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("joborderview", $parm);
        } else {
            $url = $this->keyUrl("joborderview", Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "joborderadd?" . $parm;
        } else {
            $url = "joborderadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("joborderedit", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl("joborderlist", "action=edit");
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("joborderadd", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl("joborderlist", "action=copy");
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl($parm = "")
    {
        if ($this->UseAjaxActions && ConvertToBool(Param("infinitescroll")) && CurrentPageID() == "list") {
            return $this->keyUrl(GetApiUrl(Config("API_DELETE_ACTION") . "/" . $this->TableVar));
        } else {
            return $this->keyUrl("joborderdelete", $parm);
        }
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "\"JobOrderID\":" . VarToJson($this->JobOrderID->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->JobOrderID->CurrentValue !== null) {
            $url .= "/" . $this->encodeKeyValue($this->JobOrderID->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderFieldHeader($fld)
    {
        global $Security, $Language;
        $sortUrl = "";
        $attrs = "";
        if ($this->PageID != "grid" && $fld->Sortable) {
            $sortUrl = $this->sortUrl($fld);
            $attrs = ' role="button" data-ew-action="sort" data-ajax="' . ($this->UseAjaxActions ? "true" : "false") . '" data-sort-url="' . $sortUrl . '" data-sort-type="1"';
            if ($this->ContextClass) { // Add context
                $attrs .= ' data-context="' . HtmlEncode($this->ContextClass) . '"';
            }
        }
        $html = '<div class="ew-table-header-caption"' . $attrs . '>' . $fld->caption() . '</div>';
        if ($sortUrl) {
            $html .= '<div class="ew-table-header-sort">' . $fld->getSortIcon() . '</div>';
        }
        if ($this->PageID != "grid" && !$this->isExport() && $fld->UseFilter && $Security->canSearch()) {
            $html .= '<div class="ew-filter-dropdown-btn" data-ew-action="filter" data-table="' . $fld->TableVar . '" data-field="' . $fld->FieldVar .
                '"><div class="ew-table-header-filter" role="button" aria-haspopup="true">' . $Language->phrase("Filter") .
                (is_array($fld->EditValue) ? str_replace("%c", count($fld->EditValue), $Language->phrase("FilterCount")) : '') .
                '</div></div>';
        }
        $html = '<div class="ew-table-header-btn">' . $html . '</div>';
        if ($this->UseCustomTemplate) {
            $scriptId = str_replace("{id}", $fld->TableVar . "_" . $fld->Param, "tpc_{id}");
            $html = '<template id="' . $scriptId . '">' . $html . '</template>';
        }
        return $html;
    }

    // Sort URL
    public function sortUrl($fld)
    {
        global $DashboardReport;
        if (
            $this->CurrentAction || $this->isExport() ||
            in_array($fld->Type, [128, 204, 205])
        ) { // Unsortable data type
                return "";
        } elseif ($fld->Sortable) {
            $urlParm = "order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->getNextSort();
            if ($DashboardReport) {
                $urlParm .= "&amp;" . Config("PAGE_DASHBOARD") . "=" . $DashboardReport;
            }
            return $this->addMasterUrl($this->CurrentPageName . "?" . $urlParm);
        } else {
            return "";
        }
    }

    // Get record keys from Post/Get/Session
    public function getRecordKeys()
    {
        $arKeys = [];
        $arKey = [];
        if (Param("key_m") !== null) {
            $arKeys = Param("key_m");
            $cnt = count($arKeys);
        } else {
            $isApi = IsApi();
            $keyValues = $isApi
                ? (Route(0) == "export"
                    ? array_map(fn ($i) => Route($i + 3), range(0, 0))  // Export API
                    : array_map(fn ($i) => Route($i + 2), range(0, 0))) // Other API
                : []; // Non-API
            if (($keyValue = Param("JobOrderID") ?? Route("JobOrderID")) !== null) {
                $arKeys[] = $keyValue;
            } elseif ($isApi && (($keyValue = Key(0) ?? $keyValues[0] ?? null) !== null)) {
                $arKeys[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                if (!is_numeric($key)) {
                    continue;
                }
                $ar[] = $key;
            }
        }
        return $ar;
    }

    // Get filter from records
    public function getFilterFromRecords($rows)
    {
        $keyFilter = "";
        foreach ($rows as $row) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            $keyFilter .= "(" . $this->getRecordFilter($row) . ")";
        }
        return $keyFilter;
    }

    // Get filter from record keys
    public function getFilterFromRecordKeys($setCurrent = true)
    {
        $arKeys = $this->getRecordKeys();
        $keyFilter = "";
        foreach ($arKeys as $key) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            if ($setCurrent) {
                $this->JobOrderID->CurrentValue = $key;
            } else {
                $this->JobOrderID->OldValue = $key;
            }
            $keyFilter .= "(" . $this->getRecordFilter() . ")";
        }
        return $keyFilter;
    }

    // Load result set based on filter/sort
    public function loadRs($filter, $sort = "")
    {
        $sql = $this->getSql($filter, $sort); // Set up filter (WHERE Clause) / sort (ORDER BY Clause)
        $conn = $this->getConnection();
        return $conn->executeQuery($sql);
    }

    // Load row values from record
    public function loadListRowValues(&$rs)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            return;
        }
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

    // Render list content
    public function renderListContent($filter)
    {
        global $Response;
        $listPage = "JobOrderList";
        $listClass = PROJECT_NAMESPACE . $listPage;
        $page = new $listClass();
        $page->loadRecordsetFromFilter($filter);
        $view = Container("app.view");
        $template = $listPage . ".php"; // View
        $GLOBALS["Title"] ??= $page->Title; // Title
        try {
            $Response = $view->render($Response, $template, $GLOBALS);
        } finally {
            $page->terminate(); // Terminate page and clean up
        }
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // JobOrderID

        // Job2ID

        // SizeID

        // TypeID

        // Tanggal

        // LokasiID

        // PelabuhanID

        // BL_Extra

        // DepoID

        // Ongkos

        // IsShow

        // IsOpen

        // TakenByID

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
        if (strval($this->IsOpen->CurrentValue) != "") {
            $this->IsOpen->ViewValue = $this->IsOpen->optionCaption($this->IsOpen->CurrentValue);
        } else {
            $this->IsOpen->ViewValue = null;
        }

        // TakenByID
        $curVal = strval($this->TakenByID->CurrentValue);
        if ($curVal != "") {
            $this->TakenByID->ViewValue = $this->TakenByID->lookupCacheOption($curVal);
            if ($this->TakenByID->ViewValue === null) { // Lookup from database
                $filterWrk = SearchFilter($this->TakenByID->Lookup->getTable()->Fields["TakenByID"]->searchExpression(), "=", $curVal, $this->TakenByID->Lookup->getTable()->Fields["TakenByID"]->searchDataType(), "");
                $sqlWrk = $this->TakenByID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCache($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->TakenByID->Lookup->renderViewRow($rswrk[0]);
                    $this->TakenByID->ViewValue = $this->TakenByID->displayValue($arwrk);
                } else {
                    $this->TakenByID->ViewValue = FormatNumber($this->TakenByID->CurrentValue, $this->TakenByID->formatPattern());
                }
            }
        } else {
            $this->TakenByID->ViewValue = null;
        }

        // JobOrderID
        $this->JobOrderID->HrefValue = "";
        $this->JobOrderID->TooltipValue = "";

        // Job2ID
        $this->Job2ID->HrefValue = "";
        $this->Job2ID->TooltipValue = "";

        // SizeID
        $this->SizeID->HrefValue = "";
        $this->SizeID->TooltipValue = "";

        // TypeID
        $this->TypeID->HrefValue = "";
        $this->TypeID->TooltipValue = "";

        // Tanggal
        $this->Tanggal->HrefValue = "";
        $this->Tanggal->TooltipValue = "";

        // LokasiID
        $this->LokasiID->HrefValue = "";
        $this->LokasiID->TooltipValue = "";

        // PelabuhanID
        $this->PelabuhanID->HrefValue = "";
        $this->PelabuhanID->TooltipValue = "";

        // BL_Extra
        $this->BL_Extra->HrefValue = "";
        $this->BL_Extra->TooltipValue = "";

        // DepoID
        $this->DepoID->HrefValue = "";
        $this->DepoID->TooltipValue = "";

        // Ongkos
        $this->Ongkos->HrefValue = "";
        $this->Ongkos->TooltipValue = "";

        // IsShow
        $this->IsShow->HrefValue = "";
        $this->IsShow->TooltipValue = "";

        // IsOpen
        $this->IsOpen->HrefValue = "";
        $this->IsOpen->TooltipValue = "";

        // TakenByID
        $this->TakenByID->HrefValue = "";
        $this->TakenByID->TooltipValue = "";

        // Call Row Rendered event
        $this->rowRendered();

        // Save data for Custom Template
        $this->Rows[] = $this->customTemplateFieldValues();
    }

    // Render edit row values
    public function renderEditRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // JobOrderID
        $this->JobOrderID->setupEditAttributes();
        $this->JobOrderID->EditValue = $this->JobOrderID->CurrentValue;

        // Job2ID
        $this->Job2ID->setupEditAttributes();
        $this->Job2ID->PlaceHolder = RemoveHtml($this->Job2ID->caption());

        // SizeID
        $this->SizeID->setupEditAttributes();
        $this->SizeID->PlaceHolder = RemoveHtml($this->SizeID->caption());

        // TypeID
        $this->TypeID->setupEditAttributes();
        $this->TypeID->EditValue = $this->TypeID->CurrentValue;
        $this->TypeID->PlaceHolder = RemoveHtml($this->TypeID->caption());

        // Tanggal
        $this->Tanggal->setupEditAttributes();
        $this->Tanggal->EditValue = FormatDateTime($this->Tanggal->CurrentValue, $this->Tanggal->formatPattern());
        $this->Tanggal->PlaceHolder = RemoveHtml($this->Tanggal->caption());

        // LokasiID
        $this->LokasiID->setupEditAttributes();
        $this->LokasiID->PlaceHolder = RemoveHtml($this->LokasiID->caption());

        // PelabuhanID
        $this->PelabuhanID->setupEditAttributes();
        $this->PelabuhanID->PlaceHolder = RemoveHtml($this->PelabuhanID->caption());

        // BL_Extra
        $this->BL_Extra->setupEditAttributes();
        $this->BL_Extra->EditValue = $this->BL_Extra->CurrentValue;
        $this->BL_Extra->PlaceHolder = RemoveHtml($this->BL_Extra->caption());
        if (strval($this->BL_Extra->EditValue) != "" && is_numeric($this->BL_Extra->EditValue)) {
            $this->BL_Extra->EditValue = FormatNumber($this->BL_Extra->EditValue, null);
        }

        // DepoID
        $this->DepoID->setupEditAttributes();
        $this->DepoID->PlaceHolder = RemoveHtml($this->DepoID->caption());

        // Ongkos
        $this->Ongkos->setupEditAttributes();
        $this->Ongkos->EditValue = $this->Ongkos->CurrentValue;
        $this->Ongkos->PlaceHolder = RemoveHtml($this->Ongkos->caption());
        if (strval($this->Ongkos->EditValue) != "" && is_numeric($this->Ongkos->EditValue)) {
            $this->Ongkos->EditValue = FormatNumber($this->Ongkos->EditValue, null);
        }

        // IsShow
        $this->IsShow->setupEditAttributes();
        $this->IsShow->EditValue = $this->IsShow->options(true);
        $this->IsShow->PlaceHolder = RemoveHtml($this->IsShow->caption());

        // IsOpen
        $this->IsOpen->setupEditAttributes();
        $this->IsOpen->EditValue = $this->IsOpen->options(true);
        $this->IsOpen->PlaceHolder = RemoveHtml($this->IsOpen->caption());

        // TakenByID
        $this->TakenByID->setupEditAttributes();
        $this->TakenByID->PlaceHolder = RemoveHtml($this->TakenByID->caption());

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
        // Call Row Rendered event
        $this->rowRendered();
    }

    // Export data in HTML/CSV/Word/Excel/Email/PDF format
    public function exportDocument($doc, $result, $startRec = 1, $stopRec = 1, $exportPageType = "")
    {
        if (!$result || !$doc) {
            return;
        }
        if (!$doc->ExportCustom) {
            // Write header
            $doc->exportTableHeader();
            if ($doc->Horizontal) { // Horizontal format, write header
                $doc->beginExportRow();
                if ($exportPageType == "view") {
                    $doc->exportCaption($this->JobOrderID);
                    $doc->exportCaption($this->Job2ID);
                    $doc->exportCaption($this->SizeID);
                    $doc->exportCaption($this->TypeID);
                    $doc->exportCaption($this->Tanggal);
                    $doc->exportCaption($this->LokasiID);
                    $doc->exportCaption($this->PelabuhanID);
                    $doc->exportCaption($this->BL_Extra);
                    $doc->exportCaption($this->DepoID);
                    $doc->exportCaption($this->Ongkos);
                    $doc->exportCaption($this->IsShow);
                    $doc->exportCaption($this->IsOpen);
                    $doc->exportCaption($this->TakenByID);
                } else {
                    $doc->exportCaption($this->JobOrderID);
                    $doc->exportCaption($this->Job2ID);
                    $doc->exportCaption($this->SizeID);
                    $doc->exportCaption($this->TypeID);
                    $doc->exportCaption($this->Tanggal);
                    $doc->exportCaption($this->LokasiID);
                    $doc->exportCaption($this->PelabuhanID);
                    $doc->exportCaption($this->BL_Extra);
                    $doc->exportCaption($this->DepoID);
                    $doc->exportCaption($this->Ongkos);
                    $doc->exportCaption($this->IsShow);
                    $doc->exportCaption($this->IsOpen);
                    $doc->exportCaption($this->TakenByID);
                }
                $doc->endExportRow();
            }
        }
        $recCnt = $startRec - 1;
        $stopRec = $stopRec > 0 ? $stopRec : PHP_INT_MAX;
        while (($row = $result->fetch()) && $recCnt < $stopRec) {
            $recCnt++;
            if ($recCnt >= $startRec) {
                $rowCnt = $recCnt - $startRec + 1;

                // Page break
                if ($this->ExportPageBreakCount > 0) {
                    if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0) {
                        $doc->exportPageBreak();
                    }
                }
                $this->loadListRowValues($row);

                // Render row
                $this->RowType = RowType::VIEW; // Render view
                $this->resetAttributes();
                $this->renderListRow();
                if (!$doc->ExportCustom) {
                    $doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
                    if ($exportPageType == "view") {
                        $doc->exportField($this->JobOrderID);
                        $doc->exportField($this->Job2ID);
                        $doc->exportField($this->SizeID);
                        $doc->exportField($this->TypeID);
                        $doc->exportField($this->Tanggal);
                        $doc->exportField($this->LokasiID);
                        $doc->exportField($this->PelabuhanID);
                        $doc->exportField($this->BL_Extra);
                        $doc->exportField($this->DepoID);
                        $doc->exportField($this->Ongkos);
                        $doc->exportField($this->IsShow);
                        $doc->exportField($this->IsOpen);
                        $doc->exportField($this->TakenByID);
                    } else {
                        $doc->exportField($this->JobOrderID);
                        $doc->exportField($this->Job2ID);
                        $doc->exportField($this->SizeID);
                        $doc->exportField($this->TypeID);
                        $doc->exportField($this->Tanggal);
                        $doc->exportField($this->LokasiID);
                        $doc->exportField($this->PelabuhanID);
                        $doc->exportField($this->BL_Extra);
                        $doc->exportField($this->DepoID);
                        $doc->exportField($this->Ongkos);
                        $doc->exportField($this->IsShow);
                        $doc->exportField($this->IsOpen);
                        $doc->exportField($this->TakenByID);
                    }
                    $doc->endExportRow($rowCnt);
                }
            }

            // Call Row Export server event
            if ($doc->ExportCustom) {
                $this->rowExport($doc, $row);
            }
        }
        if (!$doc->ExportCustom) {
            $doc->exportTableFooter();
        }
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        global $DownloadFileName;

        // No binary fields
        return false;
    }

    // Write audit trail start/end for grid update
    public function writeAuditTrailDummy($typ)
    {
        WriteAuditLog(CurrentUserIdentifier(), $typ, 'job_order');
    }

    // Write audit trail (add page)
    public function writeAuditTrailOnAdd(&$rs)
    {
        global $Language;
        if (!$this->AuditTrailOnAdd) {
            return;
        }

        // Get key value
        $key = "";
        if ($key != "") {
            $key .= Config("COMPOSITE_KEY_SEPARATOR");
        }
        $key .= $rs['JobOrderID'];

        // Write audit trail
        $usr = CurrentUserIdentifier();
        foreach (array_keys($rs) as $fldname) {
            if (array_key_exists($fldname, $this->Fields) && $this->Fields[$fldname]->DataType != DataType::BLOB) { // Ignore BLOB fields
                if ($this->Fields[$fldname]->HtmlTag == "PASSWORD") { // Password Field
                    $newvalue = $Language->phrase("PasswordMask");
                } elseif ($this->Fields[$fldname]->DataType == DataType::MEMO) { // Memo Field
                    $newvalue = Config("AUDIT_TRAIL_TO_DATABASE") ? $rs[$fldname] : "[MEMO]";
                } elseif ($this->Fields[$fldname]->DataType == DataType::XML) { // XML Field
                    $newvalue = "[XML]";
                } else {
                    $newvalue = $rs[$fldname];
                }
                WriteAuditLog($usr, "A", 'job_order', $fldname, $key, "", $newvalue);
            }
        }
    }

    // Write audit trail (edit page)
    public function writeAuditTrailOnEdit(&$rsold, &$rsnew)
    {
        global $Language;
        if (!$this->AuditTrailOnEdit) {
            return;
        }

        // Get key value
        $key = "";
        if ($key != "") {
            $key .= Config("COMPOSITE_KEY_SEPARATOR");
        }
        $key .= $rsold['JobOrderID'];

        // Write audit trail
        $usr = CurrentUserIdentifier();
        foreach (array_keys($rsnew) as $fldname) {
            if (array_key_exists($fldname, $this->Fields) && array_key_exists($fldname, $rsold) && $this->Fields[$fldname]->DataType != DataType::BLOB) { // Ignore BLOB fields
                if ($this->Fields[$fldname]->DataType == DataType::DATE) { // DateTime field
                    $modified = (FormatDateTime($rsold[$fldname], 0) != FormatDateTime($rsnew[$fldname], 0));
                } else {
                    $modified = !CompareValue($rsold[$fldname], $rsnew[$fldname]);
                }
                if ($modified) {
                    if ($this->Fields[$fldname]->HtmlTag == "PASSWORD") { // Password Field
                        $oldvalue = $Language->phrase("PasswordMask");
                        $newvalue = $Language->phrase("PasswordMask");
                    } elseif ($this->Fields[$fldname]->DataType == DataType::MEMO) { // Memo field
                        $oldvalue = Config("AUDIT_TRAIL_TO_DATABASE") ? $rsold[$fldname] : "[MEMO]";
                        $newvalue = Config("AUDIT_TRAIL_TO_DATABASE") ? $rsnew[$fldname] : "[MEMO]";
                    } elseif ($this->Fields[$fldname]->DataType == DataType::XML) { // XML field
                        $oldvalue = "[XML]";
                        $newvalue = "[XML]";
                    } else {
                        $oldvalue = $rsold[$fldname];
                        $newvalue = $rsnew[$fldname];
                    }
                    WriteAuditLog($usr, "U", 'job_order', $fldname, $key, $oldvalue, $newvalue);
                }
            }
        }
    }

    // Write audit trail (delete page)
    public function writeAuditTrailOnDelete(&$rs)
    {
        global $Language;
        if (!$this->AuditTrailOnDelete) {
            return;
        }

        // Get key value
        $key = "";
        if ($key != "") {
            $key .= Config("COMPOSITE_KEY_SEPARATOR");
        }
        $key .= $rs['JobOrderID'];

        // Write audit trail
        $usr = CurrentUserIdentifier();
        foreach (array_keys($rs) as $fldname) {
            if (array_key_exists($fldname, $this->Fields) && $this->Fields[$fldname]->DataType != DataType::BLOB) { // Ignore BLOB fields
                if ($this->Fields[$fldname]->HtmlTag == "PASSWORD") { // Password Field
                    $oldvalue = $Language->phrase("PasswordMask");
                } elseif ($this->Fields[$fldname]->DataType == DataType::MEMO) { // Memo field
                    $oldvalue = Config("AUDIT_TRAIL_TO_DATABASE") ? $rs[$fldname] : "[MEMO]";
                } elseif ($this->Fields[$fldname]->DataType == DataType::XML) { // XML field
                    $oldvalue = "[XML]";
                } else {
                    $oldvalue = $rs[$fldname];
                }
                WriteAuditLog($usr, "D", 'job_order', $fldname, $key, $oldvalue);
            }
        }
    }

    // Table level events

    // Table Load event
    public function tableLoad()
    {
        // Enter your code here
    }

    // Recordset Selecting event
    public function recordsetSelecting(&$filter)
    {
        // Enter your code here
    }

    // Recordset Selected event
    public function recordsetSelected($rs)
    {
        //Log("Recordset Selected");
    }

    // Recordset Search Validated event
    public function recordsetSearchValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Recordset Searching event
    public function recordsetSearching(&$filter)
    {
        // Enter your code here
    }

    // Row_Selecting event
    public function rowSelecting(&$filter)
    {
        // Enter your code here
    }

    // Row Selected event
    public function rowSelected(&$rs)
    {
        //Log("Row Selected");
    }

    // Row Inserting event
    public function rowInserting($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Inserted event
    public function rowInserted($rsold, $rsnew)
    {
        //Log("Row Inserted");
    }

    // Row Updating event
    public function rowUpdating($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Updated event
    public function rowUpdated($rsold, $rsnew)
    {
        //Log("Row Updated");
    }

    // Row Update Conflict event
    public function rowUpdateConflict($rsold, &$rsnew)
    {
        // Enter your code here
        // To ignore conflict, set return value to false
        return true;
    }

    // Grid Inserting event
    public function gridInserting()
    {
        // Enter your code here
        // To reject grid insert, set return value to false
        return true;
    }

    // Grid Inserted event
    public function gridInserted($rsnew)
    {
        //Log("Grid Inserted");
    }

    // Grid Updating event
    public function gridUpdating($rsold)
    {
        // Enter your code here
        // To reject grid update, set return value to false
        return true;
    }

    // Grid Updated event
    public function gridUpdated($rsold, $rsnew)
    {
        //Log("Grid Updated");
    }

    // Row Deleting event
    public function rowDeleting(&$rs)
    {
        // Enter your code here
        // To cancel, set return value to False
        return true;
    }

    // Row Deleted event
    public function rowDeleted($rs)
    {
        //Log("Row Deleted");
    }

    // Email Sending event
    public function emailSending($email, $args)
    {
        //var_dump($email, $args); exit();
        return true;
    }

    // Lookup Selecting event
    public function lookupSelecting($fld, &$filter)
    {
        //var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
        // Enter your code here
    }

    // Row Rendering event
    public function rowRendering()
    {
        // Enter your code here
    }

    // Row Rendered event
    public function rowRendered()
    {
        // To view properties of field class, use:
        //var_dump($this-><FieldName>);
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
