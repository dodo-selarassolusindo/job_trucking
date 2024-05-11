<?php

namespace PHPMaker2024\prj_job_trucking;

// Navbar menu
$topMenu = new Menu("navbar", true, true);
$topMenu->addMenuItem(14, "mi_tanpaunderscore", $Language->menuPhrase("14", "MenuText"), "Tanpaunderscore", -1, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}tanpaunderscore.php'), false, false, "", "", true, false);
$topMenu->addMenuItem(10, "mi_beranda", $Language->menuPhrase("10", "MenuText"), "Beranda", -1, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}beranda.php'), false, false, "", "", true, false);
$topMenu->addMenuItem(11, "mci_Master", $Language->menuPhrase("11", "MenuText"), "", -1, "", true, false, true, "", "", true, false);
$topMenu->addMenuItem(7, "mi_size", $Language->menuPhrase("7", "MenuText"), "SizeList", 11, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}size'), false, false, "", "", true, false);
$topMenu->addMenuItem(5, "mi_lokasi", $Language->menuPhrase("5", "MenuText"), "LokasiList", 11, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}lokasi'), false, false, "", "", true, false);
$topMenu->addMenuItem(4, "mi_job", $Language->menuPhrase("4", "MenuText"), "JobList", 11, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}job'), false, false, "", "", true, false);
$topMenu->addMenuItem(2, "mi_customer", $Language->menuPhrase("2", "MenuText"), "CustomerList", 11, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}customer'), false, false, "", "", true, false);
$topMenu->addMenuItem(6, "mi_shipper", $Language->menuPhrase("6", "MenuText"), "ShipperList", 11, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}shipper'), false, false, "", "", true, false);
$topMenu->addMenuItem(3, "mi_employees", $Language->menuPhrase("3", "MenuText"), "EmployeesList", 11, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}employees'), false, false, "", "", true, false);
$topMenu->addMenuItem(12, "mci_Setting", $Language->menuPhrase("12", "MenuText"), "", -1, "", true, false, true, "", "", true, false);
$topMenu->addMenuItem(9, "mi_userlevels", $Language->menuPhrase("9", "MenuText"), "UserlevelsList", 12, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}userlevels'), false, false, "", "", true, false);
$topMenu->addMenuItem(1, "mi_audittrail", $Language->menuPhrase("1", "MenuText"), "AudittrailList", -1, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}audittrail'), false, false, "", "", true, false);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(14, "mi_tanpaunderscore", $Language->menuPhrase("14", "MenuText"), "Tanpaunderscore", -1, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}tanpaunderscore.php'), false, false, "", "", true, true);
$sideMenu->addMenuItem(10, "mi_beranda", $Language->menuPhrase("10", "MenuText"), "Beranda", -1, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}beranda.php'), false, false, "", "", true, true);
$sideMenu->addMenuItem(11, "mci_Master", $Language->menuPhrase("11", "MenuText"), "", -1, "", true, false, true, "", "", true, true);
$sideMenu->addMenuItem(7, "mi_size", $Language->menuPhrase("7", "MenuText"), "SizeList", 11, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}size'), false, false, "", "", true, true);
$sideMenu->addMenuItem(5, "mi_lokasi", $Language->menuPhrase("5", "MenuText"), "LokasiList", 11, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}lokasi'), false, false, "", "", true, true);
$sideMenu->addMenuItem(4, "mi_job", $Language->menuPhrase("4", "MenuText"), "JobList", 11, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}job'), false, false, "", "", true, true);
$sideMenu->addMenuItem(2, "mi_customer", $Language->menuPhrase("2", "MenuText"), "CustomerList", 11, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}customer'), false, false, "", "", true, true);
$sideMenu->addMenuItem(6, "mi_shipper", $Language->menuPhrase("6", "MenuText"), "ShipperList", 11, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}shipper'), false, false, "", "", true, true);
$sideMenu->addMenuItem(3, "mi_employees", $Language->menuPhrase("3", "MenuText"), "EmployeesList", 11, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}employees'), false, false, "", "", true, true);
$sideMenu->addMenuItem(12, "mci_Setting", $Language->menuPhrase("12", "MenuText"), "", -1, "", true, false, true, "", "", true, true);
$sideMenu->addMenuItem(9, "mi_userlevels", $Language->menuPhrase("9", "MenuText"), "UserlevelsList", 12, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}userlevels'), false, false, "", "", true, true);
$sideMenu->addMenuItem(1, "mi_audittrail", $Language->menuPhrase("1", "MenuText"), "AudittrailList", -1, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}audittrail'), false, false, "", "", true, true);
echo $sideMenu->toScript();
