<?php

namespace PHPMaker2024\prj_job_trucking;

// Navbar menu
$topMenu = new Menu("navbar", true, true);
$topMenu->addMenuItem(14, "mi_tanpaunderscore", $Language->menuPhrase("14", "MenuText"), "tanpaunderscore", -1, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}tanpaunderscore.php'), false, false, "", "", true, false);
$topMenu->addMenuItem(10, "mi_beranda", $Language->menuPhrase("10", "MenuText"), "beranda", -1, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}beranda.php'), false, false, "", "", true, false);
$topMenu->addMenuItem(11, "mci_Master", $Language->menuPhrase("11", "MenuText"), "", -1, "", true, false, true, "", "", true, false);
$topMenu->addMenuItem(7, "mi_size", $Language->menuPhrase("7", "MenuText"), "sizelist", 11, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}size'), false, false, "", "", true, false);
$topMenu->addMenuItem(5, "mi_lokasi", $Language->menuPhrase("5", "MenuText"), "lokasilist", 11, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}lokasi'), false, false, "", "", true, false);
$topMenu->addMenuItem(4, "mi_job", $Language->menuPhrase("4", "MenuText"), "joblist", 11, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}job'), false, false, "", "", true, false);
$topMenu->addMenuItem(2, "mi_customer", $Language->menuPhrase("2", "MenuText"), "customerlist", 11, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}customer'), false, false, "", "", true, false);
$topMenu->addMenuItem(6, "mi_shipper", $Language->menuPhrase("6", "MenuText"), "shipperlist", 11, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}shipper'), false, false, "", "", true, false);
$topMenu->addMenuItem(3, "mi_employees", $Language->menuPhrase("3", "MenuText"), "employeeslist", 11, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}employees'), false, false, "", "", true, false);
$topMenu->addMenuItem(12, "mci_Setting", $Language->menuPhrase("12", "MenuText"), "", -1, "", true, false, true, "", "", true, false);
$topMenu->addMenuItem(9, "mi_userlevels", $Language->menuPhrase("9", "MenuText"), "userlevelslist", 12, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}userlevels'), false, false, "", "", true, false);
$topMenu->addMenuItem(1, "mi_audittrail", $Language->menuPhrase("1", "MenuText"), "audittraillist", -1, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}audittrail'), false, false, "", "", true, false);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(14, "mi_tanpaunderscore", $Language->menuPhrase("14", "MenuText"), "tanpaunderscore", -1, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}tanpaunderscore.php'), false, false, "", "", true, true);
$sideMenu->addMenuItem(10, "mi_beranda", $Language->menuPhrase("10", "MenuText"), "beranda", -1, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}beranda.php'), false, false, "", "", true, true);
$sideMenu->addMenuItem(11, "mci_Master", $Language->menuPhrase("11", "MenuText"), "", -1, "", true, false, true, "", "", true, true);
$sideMenu->addMenuItem(7, "mi_size", $Language->menuPhrase("7", "MenuText"), "sizelist", 11, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}size'), false, false, "", "", true, true);
$sideMenu->addMenuItem(5, "mi_lokasi", $Language->menuPhrase("5", "MenuText"), "lokasilist", 11, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}lokasi'), false, false, "", "", true, true);
$sideMenu->addMenuItem(4, "mi_job", $Language->menuPhrase("4", "MenuText"), "joblist", 11, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}job'), false, false, "", "", true, true);
$sideMenu->addMenuItem(2, "mi_customer", $Language->menuPhrase("2", "MenuText"), "customerlist", 11, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}customer'), false, false, "", "", true, true);
$sideMenu->addMenuItem(6, "mi_shipper", $Language->menuPhrase("6", "MenuText"), "shipperlist", 11, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}shipper'), false, false, "", "", true, true);
$sideMenu->addMenuItem(3, "mi_employees", $Language->menuPhrase("3", "MenuText"), "employeeslist", 11, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}employees'), false, false, "", "", true, true);
$sideMenu->addMenuItem(12, "mci_Setting", $Language->menuPhrase("12", "MenuText"), "", -1, "", true, false, true, "", "", true, true);
$sideMenu->addMenuItem(9, "mi_userlevels", $Language->menuPhrase("9", "MenuText"), "userlevelslist", 12, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}userlevels'), false, false, "", "", true, true);
$sideMenu->addMenuItem(1, "mi_audittrail", $Language->menuPhrase("1", "MenuText"), "audittraillist", -1, "", AllowListMenu('{31D612D4-4474-4C58-A701-27B411C705E8}audittrail'), false, false, "", "", true, true);
echo $sideMenu->toScript();
