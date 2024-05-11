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
$USER_LEVEL_PRIVS = [["{31D612D4-4474-4C58-A701-27B411C705E8}audittrail","-2","0"],
    ["{31D612D4-4474-4C58-A701-27B411C705E8}audittrail","0","0"],
    ["{31D612D4-4474-4C58-A701-27B411C705E8}customer","-2","0"],
    ["{31D612D4-4474-4C58-A701-27B411C705E8}customer","0","0"],
    ["{31D612D4-4474-4C58-A701-27B411C705E8}employees","-2","0"],
    ["{31D612D4-4474-4C58-A701-27B411C705E8}employees","0","0"],
    ["{31D612D4-4474-4C58-A701-27B411C705E8}job","-2","0"],
    ["{31D612D4-4474-4C58-A701-27B411C705E8}job","0","0"],
    ["{31D612D4-4474-4C58-A701-27B411C705E8}lokasi","-2","0"],
    ["{31D612D4-4474-4C58-A701-27B411C705E8}lokasi","0","0"],
    ["{31D612D4-4474-4C58-A701-27B411C705E8}shipper","-2","0"],
    ["{31D612D4-4474-4C58-A701-27B411C705E8}shipper","0","0"],
    ["{31D612D4-4474-4C58-A701-27B411C705E8}size","-2","0"],
    ["{31D612D4-4474-4C58-A701-27B411C705E8}size","0","0"],
    ["{31D612D4-4474-4C58-A701-27B411C705E8}userlevelpermissions","-2","0"],
    ["{31D612D4-4474-4C58-A701-27B411C705E8}userlevelpermissions","0","0"],
    ["{31D612D4-4474-4C58-A701-27B411C705E8}userlevels","-2","0"],
    ["{31D612D4-4474-4C58-A701-27B411C705E8}userlevels","0","0"],
    ["{31D612D4-4474-4C58-A701-27B411C705E8}beranda.php","-2","72"],
    ["{31D612D4-4474-4C58-A701-27B411C705E8}beranda.php","0","0"],
    ["{31D612D4-4474-4C58-A701-27B411C705E8}list_size.php","-2","72"],
    ["{31D612D4-4474-4C58-A701-27B411C705E8}list_size.php","0","0"],
    ["{31D612D4-4474-4C58-A701-27B411C705E8}tanpaunderscore.php","-2","72"],
    ["{31D612D4-4474-4C58-A701-27B411C705E8}tanpaunderscore.php","0","0"]];

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
$USER_LEVEL_TABLES = [["audittrail","audittrail","Log Activity",true,"{31D612D4-4474-4C58-A701-27B411C705E8}","AudittrailList"],
    ["customer","customer","Customer",true,"{31D612D4-4474-4C58-A701-27B411C705E8}","CustomerList"],
    ["employees","employees","Users",true,"{31D612D4-4474-4C58-A701-27B411C705E8}","EmployeesList"],
    ["job","job","Job",true,"{31D612D4-4474-4C58-A701-27B411C705E8}","JobList"],
    ["lokasi","lokasi","Lokasi",true,"{31D612D4-4474-4C58-A701-27B411C705E8}","LokasiList"],
    ["shipper","shipper","Shipper",true,"{31D612D4-4474-4C58-A701-27B411C705E8}","ShipperList"],
    ["size","size","Size",true,"{31D612D4-4474-4C58-A701-27B411C705E8}","SizeList"],
    ["userlevelpermissions","userlevelpermissions","Detail",true,"{31D612D4-4474-4C58-A701-27B411C705E8}","UserlevelpermissionsList"],
    ["userlevels","userlevels","Hak Akses",true,"{31D612D4-4474-4C58-A701-27B411C705E8}","UserlevelsList"],
    ["beranda.php","beranda","Beranda",true,"{31D612D4-4474-4C58-A701-27B411C705E8}","Beranda"],
    ["list_size.php","list_size","Daftar Size",true,"{31D612D4-4474-4C58-A701-27B411C705E8}","ListSize"],
    ["tanpaunderscore.php","tanpaunderscore","Tanpa Under Score",true,"{31D612D4-4474-4C58-A701-27B411C705E8}","Tanpaunderscore"]];
