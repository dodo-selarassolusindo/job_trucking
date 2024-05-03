<?php
/**
 * PHPMaker 2024 User Level Settings
 */
namespace PHPMaker2024\prj_job_trucking;

/**
 * User levels
 *
 * @var array<int, string>
 * [0] int User level ID
 * [1] string User level name
 */
$USER_LEVELS = [["-2","Anonymous"],
    ["0","Default"]];

/**
 * User level permissions
 *
 * @var array<string, int, int>
 * [0] string Project ID + Table name
 * [1] int User level ID
 * [2] int Permissions
 */
$USER_LEVEL_PRIVS = [["{DB904388-BBCA-46DF-8766-6547B7E1D6C1}audittrail","-2","0"],
    ["{DB904388-BBCA-46DF-8766-6547B7E1D6C1}audittrail","0","0"],
    ["{DB904388-BBCA-46DF-8766-6547B7E1D6C1}employees","-2","0"],
    ["{DB904388-BBCA-46DF-8766-6547B7E1D6C1}employees","0","0"],
    ["{DB904388-BBCA-46DF-8766-6547B7E1D6C1}userlevelpermissions","-2","0"],
    ["{DB904388-BBCA-46DF-8766-6547B7E1D6C1}userlevelpermissions","0","0"],
    ["{DB904388-BBCA-46DF-8766-6547B7E1D6C1}userlevels","-2","0"],
    ["{DB904388-BBCA-46DF-8766-6547B7E1D6C1}userlevels","0","0"],
    ["{DB904388-BBCA-46DF-8766-6547B7E1D6C1}beranda.php","-2","0"],
    ["{DB904388-BBCA-46DF-8766-6547B7E1D6C1}beranda.php","0","0"],
    ["{DB904388-BBCA-46DF-8766-6547B7E1D6C1}job","-2","72"],
    ["{DB904388-BBCA-46DF-8766-6547B7E1D6C1}job","0","0"],
    ["{DB904388-BBCA-46DF-8766-6547B7E1D6C1}lokasi","-2","0"],
    ["{DB904388-BBCA-46DF-8766-6547B7E1D6C1}lokasi","0","0"],
    ["{DB904388-BBCA-46DF-8766-6547B7E1D6C1}customer","-2","0"],
    ["{DB904388-BBCA-46DF-8766-6547B7E1D6C1}customer","0","0"],
    ["{DB904388-BBCA-46DF-8766-6547B7E1D6C1}shipper","-2","0"],
    ["{DB904388-BBCA-46DF-8766-6547B7E1D6C1}shipper","0","0"]];

/**
 * Tables
 *
 * @var array<string, string, string, bool, string>
 * [0] string Table name
 * [1] string Table variable name
 * [2] string Table caption
 * [3] bool Allowed for update (for userpriv.php)
 * [4] string Project ID
 * [5] string URL (for OthersController::index)
 */
$USER_LEVEL_TABLES = [["audittrail","audittrail","audittrail",true,"{DB904388-BBCA-46DF-8766-6547B7E1D6C1}","audittraillist"],
    ["employees","employees","User",true,"{DB904388-BBCA-46DF-8766-6547B7E1D6C1}","employeeslist"],
    ["userlevelpermissions","userlevelpermissions","userlevelpermissions",true,"{DB904388-BBCA-46DF-8766-6547B7E1D6C1}","userlevelpermissionslist"],
    ["userlevels","userlevels","Hak Akses",true,"{DB904388-BBCA-46DF-8766-6547B7E1D6C1}","userlevelslist"],
    ["beranda.php","beranda","Beranda",true,"{DB904388-BBCA-46DF-8766-6547B7E1D6C1}","beranda"],
    ["job","job","Job",true,"{DB904388-BBCA-46DF-8766-6547B7E1D6C1}","joblist"],
    ["lokasi","lokasi","Lokasi",true,"{DB904388-BBCA-46DF-8766-6547B7E1D6C1}","lokasilist"],
    ["customer","customer","Customer",true,"{DB904388-BBCA-46DF-8766-6547B7E1D6C1}","customerlist"],
    ["shipper","shipper","Shipper",true,"{DB904388-BBCA-46DF-8766-6547B7E1D6C1}","shipperlist"]];
