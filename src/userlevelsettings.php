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
$USER_LEVEL_PRIVS = [["{E946C152-A6FA-4AD7-93DD-22C0E875338D}audittrail","-2","0"],
    ["{E946C152-A6FA-4AD7-93DD-22C0E875338D}audittrail","0","0"],
    ["{E946C152-A6FA-4AD7-93DD-22C0E875338D}customer","-2","0"],
    ["{E946C152-A6FA-4AD7-93DD-22C0E875338D}customer","0","0"],
    ["{E946C152-A6FA-4AD7-93DD-22C0E875338D}employees","-2","0"],
    ["{E946C152-A6FA-4AD7-93DD-22C0E875338D}employees","0","0"],
    ["{E946C152-A6FA-4AD7-93DD-22C0E875338D}job","-2","0"],
    ["{E946C152-A6FA-4AD7-93DD-22C0E875338D}job","0","0"],
    ["{E946C152-A6FA-4AD7-93DD-22C0E875338D}lokasi","-2","0"],
    ["{E946C152-A6FA-4AD7-93DD-22C0E875338D}lokasi","0","0"],
    ["{E946C152-A6FA-4AD7-93DD-22C0E875338D}shipper","-2","0"],
    ["{E946C152-A6FA-4AD7-93DD-22C0E875338D}shipper","0","0"],
    ["{E946C152-A6FA-4AD7-93DD-22C0E875338D}size","-2","0"],
    ["{E946C152-A6FA-4AD7-93DD-22C0E875338D}size","0","0"],
    ["{E946C152-A6FA-4AD7-93DD-22C0E875338D}userlevelpermissions","-2","0"],
    ["{E946C152-A6FA-4AD7-93DD-22C0E875338D}userlevelpermissions","0","0"],
    ["{E946C152-A6FA-4AD7-93DD-22C0E875338D}userlevels","-2","0"],
    ["{E946C152-A6FA-4AD7-93DD-22C0E875338D}userlevels","0","0"],
    ["{E946C152-A6FA-4AD7-93DD-22C0E875338D}exportlog","-2","0"],
    ["{E946C152-A6FA-4AD7-93DD-22C0E875338D}exportlog","0","0"],
    ["{E946C152-A6FA-4AD7-93DD-22C0E875338D}beranda.php","-2","72"],
    ["{E946C152-A6FA-4AD7-93DD-22C0E875338D}beranda.php","0","0"],
    ["{E946C152-A6FA-4AD7-93DD-22C0E875338D}size2.php","-2","0"],
    ["{E946C152-A6FA-4AD7-93DD-22C0E875338D}size2.php","0","0"]];

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
$USER_LEVEL_TABLES = [["audittrail","audittrail","Log Activity",true,"{E946C152-A6FA-4AD7-93DD-22C0E875338D}","audittraillist"],
    ["customer","customer","Customer",true,"{E946C152-A6FA-4AD7-93DD-22C0E875338D}","customerlist"],
    ["employees","employees","Users",true,"{E946C152-A6FA-4AD7-93DD-22C0E875338D}","employeeslist"],
    ["job","job","Job",true,"{E946C152-A6FA-4AD7-93DD-22C0E875338D}","joblist"],
    ["lokasi","lokasi","Lokasi",true,"{E946C152-A6FA-4AD7-93DD-22C0E875338D}","lokasilist"],
    ["shipper","shipper","Shipper",true,"{E946C152-A6FA-4AD7-93DD-22C0E875338D}","shipperlist"],
    ["size","size","Size",true,"{E946C152-A6FA-4AD7-93DD-22C0E875338D}","sizelist"],
    ["userlevelpermissions","userlevelpermissions","Hak Akses (Detail)",true,"{E946C152-A6FA-4AD7-93DD-22C0E875338D}","userlevelpermissionslist"],
    ["userlevels","userlevels","Hak Akses",true,"{E946C152-A6FA-4AD7-93DD-22C0E875338D}","userlevelslist"],
    ["exportlog","exportlog","Log Export",true,"{E946C152-A6FA-4AD7-93DD-22C0E875338D}","exportloglist"],
    ["beranda.php","beranda","Beranda",true,"{E946C152-A6FA-4AD7-93DD-22C0E875338D}","beranda"],
    ["size2.php","size2","Size",true,"{E946C152-A6FA-4AD7-93DD-22C0E875338D}","size2"]];