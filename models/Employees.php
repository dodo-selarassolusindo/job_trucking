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
 * Table class for employees
 */
class Employees extends DbTable
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
    public $EmployeeID;
    public $LastName;
    public $FirstName;
    public $_Title;
    public $TitleOfCourtesy;
    public $BirthDate;
    public $HireDate;
    public $Address;
    public $City;
    public $Region;
    public $PostalCode;
    public $Country;
    public $HomePhone;
    public $Extension;
    public $Photo;
    public $Notes;
    public $ReportsTo;
    public $_Username;
    public $_Password;
    public $_Email;
    public $Activated;
    public $_Profile;
    public $_UserLevel;
    public $Avatar;
    public $ActiveStatus;
    public $MessengerColor;
    public $CreatedAt;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $CurrentLanguage, $CurrentLocale;

        // Language object
        $Language = Container("app.language");
        $this->TableVar = "employees";
        $this->TableName = 'employees';
        $this->TableType = "TABLE";
        $this->ImportUseTransaction = $this->supportsTransaction() && Config("IMPORT_USE_TRANSACTION");
        $this->UseTransaction = $this->supportsTransaction() && Config("USE_TRANSACTION");

        // Update Table
        $this->UpdateTable = "employees";
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
        $this->BasicSearch = new BasicSearch($this);

        // EmployeeID
        $this->EmployeeID = new DbField(
            $this, // Table
            'x_EmployeeID', // Variable name
            'EmployeeID', // Name
            '`EmployeeID`', // Expression
            '`EmployeeID`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`EmployeeID`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'NO' // Edit Tag
        );
        $this->EmployeeID->InputTextType = "text";
        $this->EmployeeID->Raw = true;
        $this->EmployeeID->IsAutoIncrement = true; // Autoincrement field
        $this->EmployeeID->IsPrimaryKey = true; // Primary key field
        $this->EmployeeID->Nullable = false; // NOT NULL field
        $this->EmployeeID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->EmployeeID->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['EmployeeID'] = &$this->EmployeeID;

        // LastName
        $this->LastName = new DbField(
            $this, // Table
            'x_LastName', // Variable name
            'LastName', // Name
            '`LastName`', // Expression
            '`LastName`', // Basic search expression
            200, // Type
            20, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`LastName`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->LastName->InputTextType = "text";
        $this->LastName->Nullable = false; // NOT NULL field
        $this->LastName->Required = true; // Required field
        $this->LastName->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['LastName'] = &$this->LastName;

        // FirstName
        $this->FirstName = new DbField(
            $this, // Table
            'x_FirstName', // Variable name
            'FirstName', // Name
            '`FirstName`', // Expression
            '`FirstName`', // Basic search expression
            200, // Type
            10, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`FirstName`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->FirstName->InputTextType = "text";
        $this->FirstName->Nullable = false; // NOT NULL field
        $this->FirstName->Required = true; // Required field
        $this->FirstName->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['FirstName'] = &$this->FirstName;

        // Title
        $this->_Title = new DbField(
            $this, // Table
            'x__Title', // Variable name
            'Title', // Name
            '`Title`', // Expression
            '`Title`', // Basic search expression
            200, // Type
            30, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`Title`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->_Title->InputTextType = "text";
        $this->_Title->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['Title'] = &$this->_Title;

        // TitleOfCourtesy
        $this->TitleOfCourtesy = new DbField(
            $this, // Table
            'x_TitleOfCourtesy', // Variable name
            'TitleOfCourtesy', // Name
            '`TitleOfCourtesy`', // Expression
            '`TitleOfCourtesy`', // Basic search expression
            200, // Type
            25, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`TitleOfCourtesy`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->TitleOfCourtesy->InputTextType = "text";
        $this->TitleOfCourtesy->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['TitleOfCourtesy'] = &$this->TitleOfCourtesy;

        // BirthDate
        $this->BirthDate = new DbField(
            $this, // Table
            'x_BirthDate', // Variable name
            'BirthDate', // Name
            '`BirthDate`', // Expression
            CastDateFieldForLike("`BirthDate`", 0, "DB"), // Basic search expression
            135, // Type
            19, // Size
            0, // Date/Time format
            false, // Is upload field
            '`BirthDate`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->BirthDate->InputTextType = "text";
        $this->BirthDate->Raw = true;
        $this->BirthDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->BirthDate->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['BirthDate'] = &$this->BirthDate;

        // HireDate
        $this->HireDate = new DbField(
            $this, // Table
            'x_HireDate', // Variable name
            'HireDate', // Name
            '`HireDate`', // Expression
            CastDateFieldForLike("`HireDate`", 0, "DB"), // Basic search expression
            135, // Type
            19, // Size
            0, // Date/Time format
            false, // Is upload field
            '`HireDate`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->HireDate->InputTextType = "text";
        $this->HireDate->Raw = true;
        $this->HireDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->HireDate->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['HireDate'] = &$this->HireDate;

        // Address
        $this->Address = new DbField(
            $this, // Table
            'x_Address', // Variable name
            'Address', // Name
            '`Address`', // Expression
            '`Address`', // Basic search expression
            200, // Type
            60, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`Address`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->Address->InputTextType = "text";
        $this->Address->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['Address'] = &$this->Address;

        // City
        $this->City = new DbField(
            $this, // Table
            'x_City', // Variable name
            'City', // Name
            '`City`', // Expression
            '`City`', // Basic search expression
            200, // Type
            15, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`City`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->City->InputTextType = "text";
        $this->City->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['City'] = &$this->City;

        // Region
        $this->Region = new DbField(
            $this, // Table
            'x_Region', // Variable name
            'Region', // Name
            '`Region`', // Expression
            '`Region`', // Basic search expression
            200, // Type
            15, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`Region`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->Region->InputTextType = "text";
        $this->Region->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['Region'] = &$this->Region;

        // PostalCode
        $this->PostalCode = new DbField(
            $this, // Table
            'x_PostalCode', // Variable name
            'PostalCode', // Name
            '`PostalCode`', // Expression
            '`PostalCode`', // Basic search expression
            200, // Type
            10, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`PostalCode`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->PostalCode->InputTextType = "text";
        $this->PostalCode->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['PostalCode'] = &$this->PostalCode;

        // Country
        $this->Country = new DbField(
            $this, // Table
            'x_Country', // Variable name
            'Country', // Name
            '`Country`', // Expression
            '`Country`', // Basic search expression
            200, // Type
            15, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`Country`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->Country->InputTextType = "text";
        $this->Country->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['Country'] = &$this->Country;

        // HomePhone
        $this->HomePhone = new DbField(
            $this, // Table
            'x_HomePhone', // Variable name
            'HomePhone', // Name
            '`HomePhone`', // Expression
            '`HomePhone`', // Basic search expression
            200, // Type
            24, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`HomePhone`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->HomePhone->InputTextType = "text";
        $this->HomePhone->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['HomePhone'] = &$this->HomePhone;

        // Extension
        $this->Extension = new DbField(
            $this, // Table
            'x_Extension', // Variable name
            'Extension', // Name
            '`Extension`', // Expression
            '`Extension`', // Basic search expression
            200, // Type
            4, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`Extension`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->Extension->InputTextType = "text";
        $this->Extension->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['Extension'] = &$this->Extension;

        // Photo
        $this->Photo = new DbField(
            $this, // Table
            'x_Photo', // Variable name
            'Photo', // Name
            '`Photo`', // Expression
            '`Photo`', // Basic search expression
            200, // Type
            50, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`Photo`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->Photo->InputTextType = "text";
        $this->Photo->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['Photo'] = &$this->Photo;

        // Notes
        $this->Notes = new DbField(
            $this, // Table
            'x_Notes', // Variable name
            'Notes', // Name
            '`Notes`', // Expression
            '`Notes`', // Basic search expression
            201, // Type
            2147483647, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`Notes`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXTAREA' // Edit Tag
        );
        $this->Notes->InputTextType = "text";
        $this->Notes->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['Notes'] = &$this->Notes;

        // ReportsTo
        $this->ReportsTo = new DbField(
            $this, // Table
            'x_ReportsTo', // Variable name
            'ReportsTo', // Name
            '`ReportsTo`', // Expression
            '`ReportsTo`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`ReportsTo`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->ReportsTo->InputTextType = "text";
        $this->ReportsTo->Raw = true;
        $this->ReportsTo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->ReportsTo->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['ReportsTo'] = &$this->ReportsTo;

        // Username
        $this->_Username = new DbField(
            $this, // Table
            'x__Username', // Variable name
            'Username', // Name
            '`Username`', // Expression
            '`Username`', // Basic search expression
            200, // Type
            50, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`Username`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->_Username->InputTextType = "text";
        $this->_Username->Raw = true;
        $this->_Username->Required = true; // Required field
        $this->_Username->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['Username'] = &$this->_Username;

        // Password
        $this->_Password = new DbField(
            $this, // Table
            'x__Password', // Variable name
            'Password', // Name
            '`Password`', // Expression
            '`Password`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`Password`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->_Password->InputTextType = "text";
        $this->_Password->Raw = true;
        $this->_Password->Required = true; // Required field
        $this->_Password->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['Password'] = &$this->_Password;

        // Email
        $this->_Email = new DbField(
            $this, // Table
            'x__Email', // Variable name
            'Email', // Name
            '`Email`', // Expression
            '`Email`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`Email`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->_Email->InputTextType = "text";
        $this->_Email->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['Email'] = &$this->_Email;

        // Activated
        $this->Activated = new DbField(
            $this, // Table
            'x_Activated', // Variable name
            'Activated', // Name
            '`Activated`', // Expression
            '`Activated`', // Basic search expression
            200, // Type
            1, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`Activated`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'RADIO' // Edit Tag
        );
        $this->Activated->InputTextType = "text";
        $this->Activated->Raw = true;
        $this->Activated->setDataType(DataType::BOOLEAN);
        $this->Activated->TrueValue = "Y";
        $this->Activated->FalseValue = "N";
        $this->Activated->Lookup = new Lookup($this->Activated, 'employees', false, '', ["","","",""], '', '', [], [], [], [], [], [], false, '', '', "");
        $this->Activated->OptionCount = 2;
        $this->Activated->SearchOperators = ["=", "<>", "IS NULL", "IS NOT NULL"];
        $this->Fields['Activated'] = &$this->Activated;

        // Profile
        $this->_Profile = new DbField(
            $this, // Table
            'x__Profile', // Variable name
            'Profile', // Name
            '`Profile`', // Expression
            '`Profile`', // Basic search expression
            201, // Type
            2147483647, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`Profile`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXTAREA' // Edit Tag
        );
        $this->_Profile->InputTextType = "text";
        $this->_Profile->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['Profile'] = &$this->_Profile;

        // UserLevel
        $this->_UserLevel = new DbField(
            $this, // Table
            'x__UserLevel', // Variable name
            'UserLevel', // Name
            '`UserLevel`', // Expression
            '`UserLevel`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`UserLevel`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'SELECT' // Edit Tag
        );
        $this->_UserLevel->addMethod("getDefault", fn() => 0);
        $this->_UserLevel->InputTextType = "text";
        $this->_UserLevel->Raw = true;
        $this->_UserLevel->setSelectMultiple(false); // Select one
        $this->_UserLevel->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->_UserLevel->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->_UserLevel->Lookup = new Lookup($this->_UserLevel, 'userlevels', false, 'userlevelid', ["userlevelname","","",""], '', '', [], [], [], [], [], [], false, '', '', "`userlevelname`");
        $this->_UserLevel->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->_UserLevel->SearchOperators = ["=", "<>", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['UserLevel'] = &$this->_UserLevel;

        // Avatar
        $this->Avatar = new DbField(
            $this, // Table
            'x_Avatar', // Variable name
            'Avatar', // Name
            '`Avatar`', // Expression
            '`Avatar`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`Avatar`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->Avatar->InputTextType = "text";
        $this->Avatar->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['Avatar'] = &$this->Avatar;

        // ActiveStatus
        $this->ActiveStatus = new DbField(
            $this, // Table
            'x_ActiveStatus', // Variable name
            'ActiveStatus', // Name
            '`ActiveStatus`', // Expression
            '`ActiveStatus`', // Basic search expression
            16, // Type
            1, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`ActiveStatus`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'CHECKBOX' // Edit Tag
        );
        $this->ActiveStatus->InputTextType = "text";
        $this->ActiveStatus->Raw = true;
        $this->ActiveStatus->setDataType(DataType::BOOLEAN);
        $this->ActiveStatus->Lookup = new Lookup($this->ActiveStatus, 'employees', false, '', ["","","",""], '', '', [], [], [], [], [], [], false, '', '', "");
        $this->ActiveStatus->OptionCount = 2;
        $this->ActiveStatus->DefaultErrorMessage = $Language->phrase("IncorrectField");
        $this->ActiveStatus->SearchOperators = ["=", "<>", "IS NULL", "IS NOT NULL"];
        $this->Fields['ActiveStatus'] = &$this->ActiveStatus;

        // MessengerColor
        $this->MessengerColor = new DbField(
            $this, // Table
            'x_MessengerColor', // Variable name
            'MessengerColor', // Name
            '`MessengerColor`', // Expression
            '`MessengerColor`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`MessengerColor`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->MessengerColor->InputTextType = "text";
        $this->MessengerColor->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['MessengerColor'] = &$this->MessengerColor;

        // CreatedAt
        $this->CreatedAt = new DbField(
            $this, // Table
            'x_CreatedAt', // Variable name
            'CreatedAt', // Name
            '`CreatedAt`', // Expression
            CastDateFieldForLike("`CreatedAt`", 0, "DB"), // Basic search expression
            135, // Type
            19, // Size
            0, // Date/Time format
            false, // Is upload field
            '`CreatedAt`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->CreatedAt->InputTextType = "text";
        $this->CreatedAt->Raw = true;
        $this->CreatedAt->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->CreatedAt->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['CreatedAt'] = &$this->CreatedAt;

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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "employees";
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
        global $Security;
        // Add User ID filter
        if ($Security->currentUserID() != "" && !$Security->isAdmin()) { // Non system admin
            $filter = $this->addUserIDFilter($filter, $id);
        }
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
            if (Config("ENCRYPTED_PASSWORD") && $name == Config("LOGIN_PASSWORD_FIELD_NAME")) {
                $value = EncryptPassword(Config("CASE_SENSITIVE_PASSWORD") ? $value : strtolower($value));
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
            $this->EmployeeID->setDbValue($conn->lastInsertId());
            $rs['EmployeeID'] = $this->EmployeeID->DbValue;
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
            if (Config("ENCRYPTED_PASSWORD") && $name == Config("LOGIN_PASSWORD_FIELD_NAME")) {
                if ($value == $this->Fields[$name]->OldValue) { // No need to update hashed password if not changed
                    continue;
                }
                $value = EncryptPassword(Config("CASE_SENSITIVE_PASSWORD") ? $value : strtolower($value));
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
            if (!isset($rs['EmployeeID']) && !EmptyValue($this->EmployeeID->CurrentValue)) {
                $rs['EmployeeID'] = $this->EmployeeID->CurrentValue;
            }
        }
        if ($success && $this->AuditTrailOnEdit && $rsold) {
            $rsaudit = $rs;
            $fldname = 'EmployeeID';
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
            if (array_key_exists('EmployeeID', $rs)) {
                AddFilter($where, QuotedName('EmployeeID', $this->Dbid) . '=' . QuotedValue($rs['EmployeeID'], $this->EmployeeID->DataType, $this->Dbid));
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
        $this->EmployeeID->DbValue = $row['EmployeeID'];
        $this->LastName->DbValue = $row['LastName'];
        $this->FirstName->DbValue = $row['FirstName'];
        $this->_Title->DbValue = $row['Title'];
        $this->TitleOfCourtesy->DbValue = $row['TitleOfCourtesy'];
        $this->BirthDate->DbValue = $row['BirthDate'];
        $this->HireDate->DbValue = $row['HireDate'];
        $this->Address->DbValue = $row['Address'];
        $this->City->DbValue = $row['City'];
        $this->Region->DbValue = $row['Region'];
        $this->PostalCode->DbValue = $row['PostalCode'];
        $this->Country->DbValue = $row['Country'];
        $this->HomePhone->DbValue = $row['HomePhone'];
        $this->Extension->DbValue = $row['Extension'];
        $this->Photo->DbValue = $row['Photo'];
        $this->Notes->DbValue = $row['Notes'];
        $this->ReportsTo->DbValue = $row['ReportsTo'];
        $this->_Username->DbValue = $row['Username'];
        $this->_Password->DbValue = $row['Password'];
        $this->_Email->DbValue = $row['Email'];
        $this->Activated->DbValue = $row['Activated'];
        $this->_Profile->DbValue = $row['Profile'];
        $this->_UserLevel->DbValue = $row['UserLevel'];
        $this->Avatar->DbValue = $row['Avatar'];
        $this->ActiveStatus->DbValue = $row['ActiveStatus'];
        $this->MessengerColor->DbValue = $row['MessengerColor'];
        $this->CreatedAt->DbValue = $row['CreatedAt'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`EmployeeID` = @EmployeeID@";
    }

    // Get Key
    public function getKey($current = false, $keySeparator = null)
    {
        $keys = [];
        $val = $current ? $this->EmployeeID->CurrentValue : $this->EmployeeID->OldValue;
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
                $this->EmployeeID->CurrentValue = $keys[0];
            } else {
                $this->EmployeeID->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null, $current = false)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('EmployeeID', $row) ? $row['EmployeeID'] : null;
        } else {
            $val = !EmptyValue($this->EmployeeID->OldValue) && !$current ? $this->EmployeeID->OldValue : $this->EmployeeID->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@EmployeeID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("EmployeesList");
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
            "EmployeesView" => $Language->phrase("View"),
            "EmployeesEdit" => $Language->phrase("Edit"),
            "EmployeesAdd" => $Language->phrase("Add"),
            default => ""
        };
    }

    // Default route URL
    public function getDefaultRouteUrl()
    {
        return "EmployeesList";
    }

    // API page name
    public function getApiPageName($action)
    {
        return match (strtolower($action)) {
            Config("API_VIEW_ACTION") => "EmployeesView",
            Config("API_ADD_ACTION") => "EmployeesAdd",
            Config("API_EDIT_ACTION") => "EmployeesEdit",
            Config("API_DELETE_ACTION") => "EmployeesDelete",
            Config("API_LIST_ACTION") => "EmployeesList",
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
        return "EmployeesList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("EmployeesView", $parm);
        } else {
            $url = $this->keyUrl("EmployeesView", Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "EmployeesAdd?" . $parm;
        } else {
            $url = "EmployeesAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("EmployeesEdit", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl("EmployeesList", "action=edit");
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("EmployeesAdd", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl("EmployeesList", "action=copy");
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl($parm = "")
    {
        if ($this->UseAjaxActions && ConvertToBool(Param("infinitescroll")) && CurrentPageID() == "list") {
            return $this->keyUrl(GetApiUrl(Config("API_DELETE_ACTION") . "/" . $this->TableVar));
        } else {
            return $this->keyUrl("EmployeesDelete", $parm);
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
        $json .= "\"EmployeeID\":" . VarToJson($this->EmployeeID->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->EmployeeID->CurrentValue !== null) {
            $url .= "/" . $this->encodeKeyValue($this->EmployeeID->CurrentValue);
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
            if (($keyValue = Param("EmployeeID") ?? Route("EmployeeID")) !== null) {
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
                $this->EmployeeID->CurrentValue = $key;
            } else {
                $this->EmployeeID->OldValue = $key;
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
        $this->EmployeeID->setDbValue($row['EmployeeID']);
        $this->LastName->setDbValue($row['LastName']);
        $this->FirstName->setDbValue($row['FirstName']);
        $this->_Title->setDbValue($row['Title']);
        $this->TitleOfCourtesy->setDbValue($row['TitleOfCourtesy']);
        $this->BirthDate->setDbValue($row['BirthDate']);
        $this->HireDate->setDbValue($row['HireDate']);
        $this->Address->setDbValue($row['Address']);
        $this->City->setDbValue($row['City']);
        $this->Region->setDbValue($row['Region']);
        $this->PostalCode->setDbValue($row['PostalCode']);
        $this->Country->setDbValue($row['Country']);
        $this->HomePhone->setDbValue($row['HomePhone']);
        $this->Extension->setDbValue($row['Extension']);
        $this->Photo->setDbValue($row['Photo']);
        $this->Notes->setDbValue($row['Notes']);
        $this->ReportsTo->setDbValue($row['ReportsTo']);
        $this->_Username->setDbValue($row['Username']);
        $this->_Password->setDbValue($row['Password']);
        $this->_Email->setDbValue($row['Email']);
        $this->Activated->setDbValue($row['Activated']);
        $this->_Profile->setDbValue($row['Profile']);
        $this->_UserLevel->setDbValue($row['UserLevel']);
        $this->Avatar->setDbValue($row['Avatar']);
        $this->ActiveStatus->setDbValue($row['ActiveStatus']);
        $this->MessengerColor->setDbValue($row['MessengerColor']);
        $this->CreatedAt->setDbValue($row['CreatedAt']);
    }

    // Render list content
    public function renderListContent($filter)
    {
        global $Response;
        $listPage = "EmployeesList";
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

        // EmployeeID

        // LastName

        // FirstName

        // Title

        // TitleOfCourtesy

        // BirthDate

        // HireDate

        // Address

        // City

        // Region

        // PostalCode

        // Country

        // HomePhone

        // Extension

        // Photo

        // Notes

        // ReportsTo

        // Username

        // Password

        // Email

        // Activated

        // Profile

        // UserLevel

        // Avatar

        // ActiveStatus

        // MessengerColor

        // CreatedAt

        // EmployeeID
        $this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;

        // LastName
        $this->LastName->ViewValue = $this->LastName->CurrentValue;

        // FirstName
        $this->FirstName->ViewValue = $this->FirstName->CurrentValue;

        // Title
        $this->_Title->ViewValue = $this->_Title->CurrentValue;

        // TitleOfCourtesy
        $this->TitleOfCourtesy->ViewValue = $this->TitleOfCourtesy->CurrentValue;

        // BirthDate
        $this->BirthDate->ViewValue = $this->BirthDate->CurrentValue;
        $this->BirthDate->ViewValue = FormatDateTime($this->BirthDate->ViewValue, $this->BirthDate->formatPattern());

        // HireDate
        $this->HireDate->ViewValue = $this->HireDate->CurrentValue;
        $this->HireDate->ViewValue = FormatDateTime($this->HireDate->ViewValue, $this->HireDate->formatPattern());

        // Address
        $this->Address->ViewValue = $this->Address->CurrentValue;

        // City
        $this->City->ViewValue = $this->City->CurrentValue;

        // Region
        $this->Region->ViewValue = $this->Region->CurrentValue;

        // PostalCode
        $this->PostalCode->ViewValue = $this->PostalCode->CurrentValue;

        // Country
        $this->Country->ViewValue = $this->Country->CurrentValue;

        // HomePhone
        $this->HomePhone->ViewValue = $this->HomePhone->CurrentValue;

        // Extension
        $this->Extension->ViewValue = $this->Extension->CurrentValue;

        // Photo
        $this->Photo->ViewValue = $this->Photo->CurrentValue;

        // Notes
        $this->Notes->ViewValue = $this->Notes->CurrentValue;

        // ReportsTo
        $this->ReportsTo->ViewValue = $this->ReportsTo->CurrentValue;
        $this->ReportsTo->ViewValue = FormatNumber($this->ReportsTo->ViewValue, $this->ReportsTo->formatPattern());

        // Username
        $this->_Username->ViewValue = $this->_Username->CurrentValue;

        // Password
        $this->_Password->ViewValue = $this->_Password->CurrentValue;

        // Email
        $this->_Email->ViewValue = $this->_Email->CurrentValue;

        // Activated
        if (ConvertToBool($this->Activated->CurrentValue)) {
            $this->Activated->ViewValue = $this->Activated->tagCaption(1) != "" ? $this->Activated->tagCaption(1) : "Y";
        } else {
            $this->Activated->ViewValue = $this->Activated->tagCaption(2) != "" ? $this->Activated->tagCaption(2) : "N";
        }

        // Profile
        $this->_Profile->ViewValue = $this->_Profile->CurrentValue;

        // UserLevel
        if ($Security->canAdmin()) { // System admin
            $curVal = strval($this->_UserLevel->CurrentValue);
            if ($curVal != "") {
                $this->_UserLevel->ViewValue = $this->_UserLevel->lookupCacheOption($curVal);
                if ($this->_UserLevel->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter($this->_UserLevel->Lookup->getTable()->Fields["userlevelid"]->searchExpression(), "=", $curVal, $this->_UserLevel->Lookup->getTable()->Fields["userlevelid"]->searchDataType(), "");
                    $sqlWrk = $this->_UserLevel->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCache($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->_UserLevel->Lookup->renderViewRow($rswrk[0]);
                        $this->_UserLevel->ViewValue = $this->_UserLevel->displayValue($arwrk);
                    } else {
                        $this->_UserLevel->ViewValue = FormatNumber($this->_UserLevel->CurrentValue, $this->_UserLevel->formatPattern());
                    }
                }
            } else {
                $this->_UserLevel->ViewValue = null;
            }
        } else {
            $this->_UserLevel->ViewValue = $Language->phrase("PasswordMask");
        }

        // Avatar
        $this->Avatar->ViewValue = $this->Avatar->CurrentValue;

        // ActiveStatus
        if (ConvertToBool($this->ActiveStatus->CurrentValue)) {
            $this->ActiveStatus->ViewValue = $this->ActiveStatus->tagCaption(1) != "" ? $this->ActiveStatus->tagCaption(1) : "Yes";
        } else {
            $this->ActiveStatus->ViewValue = $this->ActiveStatus->tagCaption(2) != "" ? $this->ActiveStatus->tagCaption(2) : "No";
        }

        // MessengerColor
        $this->MessengerColor->ViewValue = $this->MessengerColor->CurrentValue;

        // CreatedAt
        $this->CreatedAt->ViewValue = $this->CreatedAt->CurrentValue;
        $this->CreatedAt->ViewValue = FormatDateTime($this->CreatedAt->ViewValue, $this->CreatedAt->formatPattern());

        // EmployeeID
        $this->EmployeeID->HrefValue = "";
        $this->EmployeeID->TooltipValue = "";

        // LastName
        $this->LastName->HrefValue = "";
        $this->LastName->TooltipValue = "";

        // FirstName
        $this->FirstName->HrefValue = "";
        $this->FirstName->TooltipValue = "";

        // Title
        $this->_Title->HrefValue = "";
        $this->_Title->TooltipValue = "";

        // TitleOfCourtesy
        $this->TitleOfCourtesy->HrefValue = "";
        $this->TitleOfCourtesy->TooltipValue = "";

        // BirthDate
        $this->BirthDate->HrefValue = "";
        $this->BirthDate->TooltipValue = "";

        // HireDate
        $this->HireDate->HrefValue = "";
        $this->HireDate->TooltipValue = "";

        // Address
        $this->Address->HrefValue = "";
        $this->Address->TooltipValue = "";

        // City
        $this->City->HrefValue = "";
        $this->City->TooltipValue = "";

        // Region
        $this->Region->HrefValue = "";
        $this->Region->TooltipValue = "";

        // PostalCode
        $this->PostalCode->HrefValue = "";
        $this->PostalCode->TooltipValue = "";

        // Country
        $this->Country->HrefValue = "";
        $this->Country->TooltipValue = "";

        // HomePhone
        $this->HomePhone->HrefValue = "";
        $this->HomePhone->TooltipValue = "";

        // Extension
        $this->Extension->HrefValue = "";
        $this->Extension->TooltipValue = "";

        // Photo
        $this->Photo->HrefValue = "";
        $this->Photo->TooltipValue = "";

        // Notes
        $this->Notes->HrefValue = "";
        $this->Notes->TooltipValue = "";

        // ReportsTo
        $this->ReportsTo->HrefValue = "";
        $this->ReportsTo->TooltipValue = "";

        // Username
        $this->_Username->HrefValue = "";
        $this->_Username->TooltipValue = "";

        // Password
        $this->_Password->HrefValue = "";
        $this->_Password->TooltipValue = "";

        // Email
        $this->_Email->HrefValue = "";
        $this->_Email->TooltipValue = "";

        // Activated
        $this->Activated->HrefValue = "";
        $this->Activated->TooltipValue = "";

        // Profile
        $this->_Profile->HrefValue = "";
        $this->_Profile->TooltipValue = "";

        // UserLevel
        $this->_UserLevel->HrefValue = "";
        $this->_UserLevel->TooltipValue = "";

        // Avatar
        $this->Avatar->HrefValue = "";
        $this->Avatar->TooltipValue = "";

        // ActiveStatus
        $this->ActiveStatus->HrefValue = "";
        $this->ActiveStatus->TooltipValue = "";

        // MessengerColor
        $this->MessengerColor->HrefValue = "";
        $this->MessengerColor->TooltipValue = "";

        // CreatedAt
        $this->CreatedAt->HrefValue = "";
        $this->CreatedAt->TooltipValue = "";

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

        // EmployeeID
        $this->EmployeeID->setupEditAttributes();
        $this->EmployeeID->EditValue = $this->EmployeeID->CurrentValue;

        // LastName
        $this->LastName->setupEditAttributes();
        if (!$this->LastName->Raw) {
            $this->LastName->CurrentValue = HtmlDecode($this->LastName->CurrentValue);
        }
        $this->LastName->EditValue = $this->LastName->CurrentValue;
        $this->LastName->PlaceHolder = RemoveHtml($this->LastName->caption());

        // FirstName
        $this->FirstName->setupEditAttributes();
        if (!$this->FirstName->Raw) {
            $this->FirstName->CurrentValue = HtmlDecode($this->FirstName->CurrentValue);
        }
        $this->FirstName->EditValue = $this->FirstName->CurrentValue;
        $this->FirstName->PlaceHolder = RemoveHtml($this->FirstName->caption());

        // Title
        $this->_Title->setupEditAttributes();
        if (!$this->_Title->Raw) {
            $this->_Title->CurrentValue = HtmlDecode($this->_Title->CurrentValue);
        }
        $this->_Title->EditValue = $this->_Title->CurrentValue;
        $this->_Title->PlaceHolder = RemoveHtml($this->_Title->caption());

        // TitleOfCourtesy
        $this->TitleOfCourtesy->setupEditAttributes();
        if (!$this->TitleOfCourtesy->Raw) {
            $this->TitleOfCourtesy->CurrentValue = HtmlDecode($this->TitleOfCourtesy->CurrentValue);
        }
        $this->TitleOfCourtesy->EditValue = $this->TitleOfCourtesy->CurrentValue;
        $this->TitleOfCourtesy->PlaceHolder = RemoveHtml($this->TitleOfCourtesy->caption());

        // BirthDate
        $this->BirthDate->setupEditAttributes();
        $this->BirthDate->EditValue = FormatDateTime($this->BirthDate->CurrentValue, $this->BirthDate->formatPattern());
        $this->BirthDate->PlaceHolder = RemoveHtml($this->BirthDate->caption());

        // HireDate
        $this->HireDate->setupEditAttributes();
        $this->HireDate->EditValue = FormatDateTime($this->HireDate->CurrentValue, $this->HireDate->formatPattern());
        $this->HireDate->PlaceHolder = RemoveHtml($this->HireDate->caption());

        // Address
        $this->Address->setupEditAttributes();
        if (!$this->Address->Raw) {
            $this->Address->CurrentValue = HtmlDecode($this->Address->CurrentValue);
        }
        $this->Address->EditValue = $this->Address->CurrentValue;
        $this->Address->PlaceHolder = RemoveHtml($this->Address->caption());

        // City
        $this->City->setupEditAttributes();
        if (!$this->City->Raw) {
            $this->City->CurrentValue = HtmlDecode($this->City->CurrentValue);
        }
        $this->City->EditValue = $this->City->CurrentValue;
        $this->City->PlaceHolder = RemoveHtml($this->City->caption());

        // Region
        $this->Region->setupEditAttributes();
        if (!$this->Region->Raw) {
            $this->Region->CurrentValue = HtmlDecode($this->Region->CurrentValue);
        }
        $this->Region->EditValue = $this->Region->CurrentValue;
        $this->Region->PlaceHolder = RemoveHtml($this->Region->caption());

        // PostalCode
        $this->PostalCode->setupEditAttributes();
        if (!$this->PostalCode->Raw) {
            $this->PostalCode->CurrentValue = HtmlDecode($this->PostalCode->CurrentValue);
        }
        $this->PostalCode->EditValue = $this->PostalCode->CurrentValue;
        $this->PostalCode->PlaceHolder = RemoveHtml($this->PostalCode->caption());

        // Country
        $this->Country->setupEditAttributes();
        if (!$this->Country->Raw) {
            $this->Country->CurrentValue = HtmlDecode($this->Country->CurrentValue);
        }
        $this->Country->EditValue = $this->Country->CurrentValue;
        $this->Country->PlaceHolder = RemoveHtml($this->Country->caption());

        // HomePhone
        $this->HomePhone->setupEditAttributes();
        if (!$this->HomePhone->Raw) {
            $this->HomePhone->CurrentValue = HtmlDecode($this->HomePhone->CurrentValue);
        }
        $this->HomePhone->EditValue = $this->HomePhone->CurrentValue;
        $this->HomePhone->PlaceHolder = RemoveHtml($this->HomePhone->caption());

        // Extension
        $this->Extension->setupEditAttributes();
        if (!$this->Extension->Raw) {
            $this->Extension->CurrentValue = HtmlDecode($this->Extension->CurrentValue);
        }
        $this->Extension->EditValue = $this->Extension->CurrentValue;
        $this->Extension->PlaceHolder = RemoveHtml($this->Extension->caption());

        // Photo
        $this->Photo->setupEditAttributes();
        if (!$this->Photo->Raw) {
            $this->Photo->CurrentValue = HtmlDecode($this->Photo->CurrentValue);
        }
        $this->Photo->EditValue = $this->Photo->CurrentValue;
        $this->Photo->PlaceHolder = RemoveHtml($this->Photo->caption());

        // Notes
        $this->Notes->setupEditAttributes();
        $this->Notes->EditValue = $this->Notes->CurrentValue;
        $this->Notes->PlaceHolder = RemoveHtml($this->Notes->caption());

        // ReportsTo
        $this->ReportsTo->setupEditAttributes();
        if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin
            if (SameString($this->EmployeeID->CurrentValue, CurrentUserID())) {
                $this->ReportsTo->EditValue = $this->ReportsTo->CurrentValue;
                $this->ReportsTo->EditValue = FormatNumber($this->ReportsTo->EditValue, $this->ReportsTo->formatPattern());
            } else {
            }
        } else {
            $this->ReportsTo->EditValue = $this->ReportsTo->CurrentValue;
            $this->ReportsTo->PlaceHolder = RemoveHtml($this->ReportsTo->caption());
            if (strval($this->ReportsTo->EditValue) != "" && is_numeric($this->ReportsTo->EditValue)) {
                $this->ReportsTo->EditValue = FormatNumber($this->ReportsTo->EditValue, null);
            }
        }

        // Username
        $this->_Username->setupEditAttributes();
        if (!$this->_Username->Raw) {
            $this->_Username->CurrentValue = HtmlDecode($this->_Username->CurrentValue);
        }
        $this->_Username->EditValue = $this->_Username->CurrentValue;
        $this->_Username->PlaceHolder = RemoveHtml($this->_Username->caption());

        // Password
        $this->_Password->setupEditAttributes();
        if (!$this->_Password->Raw) {
            $this->_Password->CurrentValue = HtmlDecode($this->_Password->CurrentValue);
        }
        $this->_Password->EditValue = $this->_Password->CurrentValue;
        $this->_Password->PlaceHolder = RemoveHtml($this->_Password->caption());

        // Email
        $this->_Email->setupEditAttributes();
        if (!$this->_Email->Raw) {
            $this->_Email->CurrentValue = HtmlDecode($this->_Email->CurrentValue);
        }
        $this->_Email->EditValue = $this->_Email->CurrentValue;
        $this->_Email->PlaceHolder = RemoveHtml($this->_Email->caption());

        // Activated
        $this->Activated->EditValue = $this->Activated->options(false);
        $this->Activated->PlaceHolder = RemoveHtml($this->Activated->caption());

        // Profile
        $this->_Profile->setupEditAttributes();
        $this->_Profile->EditValue = $this->_Profile->CurrentValue;
        $this->_Profile->PlaceHolder = RemoveHtml($this->_Profile->caption());

        // UserLevel
        $this->_UserLevel->setupEditAttributes();
        if (!$Security->canAdmin()) { // System admin
            $this->_UserLevel->EditValue = $Language->phrase("PasswordMask");
        } else {
            $this->_UserLevel->PlaceHolder = RemoveHtml($this->_UserLevel->caption());
        }

        // Avatar
        $this->Avatar->setupEditAttributes();
        if (!$this->Avatar->Raw) {
            $this->Avatar->CurrentValue = HtmlDecode($this->Avatar->CurrentValue);
        }
        $this->Avatar->EditValue = $this->Avatar->CurrentValue;
        $this->Avatar->PlaceHolder = RemoveHtml($this->Avatar->caption());

        // ActiveStatus
        $this->ActiveStatus->EditValue = $this->ActiveStatus->options(false);
        $this->ActiveStatus->PlaceHolder = RemoveHtml($this->ActiveStatus->caption());

        // MessengerColor
        $this->MessengerColor->setupEditAttributes();
        if (!$this->MessengerColor->Raw) {
            $this->MessengerColor->CurrentValue = HtmlDecode($this->MessengerColor->CurrentValue);
        }
        $this->MessengerColor->EditValue = $this->MessengerColor->CurrentValue;
        $this->MessengerColor->PlaceHolder = RemoveHtml($this->MessengerColor->caption());

        // CreatedAt
        $this->CreatedAt->setupEditAttributes();
        $this->CreatedAt->EditValue = FormatDateTime($this->CreatedAt->CurrentValue, $this->CreatedAt->formatPattern());
        $this->CreatedAt->PlaceHolder = RemoveHtml($this->CreatedAt->caption());

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
                    $doc->exportCaption($this->EmployeeID);
                    $doc->exportCaption($this->LastName);
                    $doc->exportCaption($this->FirstName);
                    $doc->exportCaption($this->_Title);
                    $doc->exportCaption($this->TitleOfCourtesy);
                    $doc->exportCaption($this->BirthDate);
                    $doc->exportCaption($this->HireDate);
                    $doc->exportCaption($this->Address);
                    $doc->exportCaption($this->City);
                    $doc->exportCaption($this->Region);
                    $doc->exportCaption($this->PostalCode);
                    $doc->exportCaption($this->Country);
                    $doc->exportCaption($this->HomePhone);
                    $doc->exportCaption($this->Extension);
                    $doc->exportCaption($this->Photo);
                    $doc->exportCaption($this->Notes);
                    $doc->exportCaption($this->ReportsTo);
                    $doc->exportCaption($this->_Username);
                    $doc->exportCaption($this->_Password);
                    $doc->exportCaption($this->_Email);
                    $doc->exportCaption($this->Activated);
                    $doc->exportCaption($this->_Profile);
                    $doc->exportCaption($this->_UserLevel);
                    $doc->exportCaption($this->Avatar);
                    $doc->exportCaption($this->ActiveStatus);
                    $doc->exportCaption($this->MessengerColor);
                    $doc->exportCaption($this->CreatedAt);
                } else {
                    $doc->exportCaption($this->EmployeeID);
                    $doc->exportCaption($this->LastName);
                    $doc->exportCaption($this->FirstName);
                    $doc->exportCaption($this->_Title);
                    $doc->exportCaption($this->TitleOfCourtesy);
                    $doc->exportCaption($this->BirthDate);
                    $doc->exportCaption($this->HireDate);
                    $doc->exportCaption($this->Address);
                    $doc->exportCaption($this->City);
                    $doc->exportCaption($this->Region);
                    $doc->exportCaption($this->PostalCode);
                    $doc->exportCaption($this->Country);
                    $doc->exportCaption($this->HomePhone);
                    $doc->exportCaption($this->Extension);
                    $doc->exportCaption($this->Photo);
                    $doc->exportCaption($this->ReportsTo);
                    $doc->exportCaption($this->_Username);
                    $doc->exportCaption($this->_Password);
                    $doc->exportCaption($this->_Email);
                    $doc->exportCaption($this->Activated);
                    $doc->exportCaption($this->_UserLevel);
                    $doc->exportCaption($this->Avatar);
                    $doc->exportCaption($this->ActiveStatus);
                    $doc->exportCaption($this->MessengerColor);
                    $doc->exportCaption($this->CreatedAt);
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
                        $doc->exportField($this->EmployeeID);
                        $doc->exportField($this->LastName);
                        $doc->exportField($this->FirstName);
                        $doc->exportField($this->_Title);
                        $doc->exportField($this->TitleOfCourtesy);
                        $doc->exportField($this->BirthDate);
                        $doc->exportField($this->HireDate);
                        $doc->exportField($this->Address);
                        $doc->exportField($this->City);
                        $doc->exportField($this->Region);
                        $doc->exportField($this->PostalCode);
                        $doc->exportField($this->Country);
                        $doc->exportField($this->HomePhone);
                        $doc->exportField($this->Extension);
                        $doc->exportField($this->Photo);
                        $doc->exportField($this->Notes);
                        $doc->exportField($this->ReportsTo);
                        $doc->exportField($this->_Username);
                        $doc->exportField($this->_Password);
                        $doc->exportField($this->_Email);
                        $doc->exportField($this->Activated);
                        $doc->exportField($this->_Profile);
                        $doc->exportField($this->_UserLevel);
                        $doc->exportField($this->Avatar);
                        $doc->exportField($this->ActiveStatus);
                        $doc->exportField($this->MessengerColor);
                        $doc->exportField($this->CreatedAt);
                    } else {
                        $doc->exportField($this->EmployeeID);
                        $doc->exportField($this->LastName);
                        $doc->exportField($this->FirstName);
                        $doc->exportField($this->_Title);
                        $doc->exportField($this->TitleOfCourtesy);
                        $doc->exportField($this->BirthDate);
                        $doc->exportField($this->HireDate);
                        $doc->exportField($this->Address);
                        $doc->exportField($this->City);
                        $doc->exportField($this->Region);
                        $doc->exportField($this->PostalCode);
                        $doc->exportField($this->Country);
                        $doc->exportField($this->HomePhone);
                        $doc->exportField($this->Extension);
                        $doc->exportField($this->Photo);
                        $doc->exportField($this->ReportsTo);
                        $doc->exportField($this->_Username);
                        $doc->exportField($this->_Password);
                        $doc->exportField($this->_Email);
                        $doc->exportField($this->Activated);
                        $doc->exportField($this->_UserLevel);
                        $doc->exportField($this->Avatar);
                        $doc->exportField($this->ActiveStatus);
                        $doc->exportField($this->MessengerColor);
                        $doc->exportField($this->CreatedAt);
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

    // User ID filter
    public function getUserIDFilter($userId)
    {
        global $Security;
        $userIdFilter = '`EmployeeID` = ' . QuotedValue($userId, DataType::NUMBER, Config("USER_TABLE_DBID"));
        $parentUserIdFilter = '`EmployeeID` IN (SELECT `EmployeeID` FROM ' . "employees" . ' WHERE `ReportsTo` = ' . QuotedValue($userId, DataType::NUMBER, Config("USER_TABLE_DBID")) . ')';
        $userIdFilter = "(" . $userIdFilter . ") OR (" . $parentUserIdFilter . ")";
        return $userIdFilter;
    }

    // Add User ID filter
    public function addUserIDFilter($filter = "", $id = "")
    {
        global $Security;
        $filterWrk = "";
        if ($id == "") {
            $id = CurrentPageID() == "list" ? $this->CurrentAction : CurrentPageID();
        }
        if (!$this->userIDAllow($id) && !$Security->isAdmin()) {
            $filterWrk = $Security->userIdList();
            if ($filterWrk != "") {
                $filterWrk = '`EmployeeID` IN (' . $filterWrk . ')';
            }
        }

        // Call User ID Filtering event
        $this->userIdFiltering($filterWrk);
        AddFilter($filter, $filterWrk);
        return $filter;
    }

    // Add Parent User ID filter
    public function addParentUserIDFilter($userId)
    {
        global $Security;
        if (!$Security->isAdmin()) {
            $result = $Security->parentUserIDList($userId);
            if ($result != "") {
                $result = '`EmployeeID` IN (' . $result . ')';
            }
            return $result;
        }
        return "";
    }

    // User ID subquery
    public function getUserIDSubquery(&$fld, &$masterfld)
    {
        global $UserTable;
        $wrk = "";
        $sql = "SELECT " . $masterfld->Expression . " FROM employees";
        $filter = $this->addUserIDFilter("");
        if ($filter != "") {
            $sql .= " WHERE " . $filter;
        }

        // List all values
        $conn = Conn($UserTable->Dbid);
        $config = $conn->getConfiguration();
        $config->setResultCache($this->Cache);
        if ($rs = $conn->executeCacheQuery($sql, [], [], $this->CacheProfile)->fetchAllNumeric()) {
            foreach ($rs as $row) {
                if ($wrk != "") {
                    $wrk .= ",";
                }
                $wrk .= QuotedValue($row[0], $masterfld->DataType, Config("USER_TABLE_DBID"));
            }
        }
        if ($wrk != "") {
            $wrk = $fld->Expression . " IN (" . $wrk . ")";
        } else { // No User ID value found
            $wrk = "0=1";
        }
        return $wrk;
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
        WriteAuditLog(CurrentUserIdentifier(), $typ, 'employees');
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
        $key .= $rs['EmployeeID'];

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
                if ($fldname == Config("LOGIN_PASSWORD_FIELD_NAME")) {
                    $newvalue = $Language->phrase("PasswordMask");
                }
                WriteAuditLog($usr, "A", 'employees', $fldname, $key, "", $newvalue);
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
        $key .= $rsold['EmployeeID'];

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
                    if ($fldname == Config("LOGIN_PASSWORD_FIELD_NAME")) {
                        $oldvalue = $Language->phrase("PasswordMask");
                        $newvalue = $Language->phrase("PasswordMask");
                    }
                    WriteAuditLog($usr, "U", 'employees', $fldname, $key, $oldvalue, $newvalue);
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
        $key .= $rs['EmployeeID'];

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
                if ($fldname == Config("LOGIN_PASSWORD_FIELD_NAME")) {
                    $oldvalue = $Language->phrase("PasswordMask");
                }
                WriteAuditLog($usr, "D", 'employees', $fldname, $key, $oldvalue);
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
