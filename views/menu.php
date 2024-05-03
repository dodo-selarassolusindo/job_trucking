<?php

namespace PHPMaker2024\prj_job_trucking;

// Navbar menu
$topMenu = new Menu("navbar", true, true);
$topMenu->addMenuItem(6, "mi_job", $Language->menuPhrase("6", "MenuText"), "joblist", -1, "", AllowListMenu('{DB904388-BBCA-46DF-8766-6547B7E1D6C1}job'), false, false, "", "", true, false);
$topMenu->addMenuItem(16, "mci_Master", $Language->menuPhrase("16", "MenuText"), "", -1, "", true, false, true, "", "", true, false);
$topMenu->addMenuItem(7, "mi_lokasi", $Language->menuPhrase("7", "MenuText"), "lokasilist", 16, "", AllowListMenu('{DB904388-BBCA-46DF-8766-6547B7E1D6C1}lokasi'), false, false, "", "", true, false);
$topMenu->addMenuItem(8, "mi_customer", $Language->menuPhrase("8", "MenuText"), "customerlist", 16, "", AllowListMenu('{DB904388-BBCA-46DF-8766-6547B7E1D6C1}customer'), false, false, "", "", true, false);
$topMenu->addMenuItem(18, "mi_shipper", $Language->menuPhrase("18", "MenuText"), "shipperlist", 16, "", AllowListMenu('{DB904388-BBCA-46DF-8766-6547B7E1D6C1}shipper'), false, false, "", "", true, false);
$topMenu->addMenuItem(2, "mi_employees", $Language->menuPhrase("2", "MenuText"), "employeeslist", 16, "", AllowListMenu('{DB904388-BBCA-46DF-8766-6547B7E1D6C1}employees'), false, false, "", "", true, false);
$topMenu->addMenuItem(17, "mci_Setting", $Language->menuPhrase("17", "MenuText"), "", -1, "", true, false, true, "", "", true, false);
$topMenu->addMenuItem(4, "mi_userlevels", $Language->menuPhrase("4", "MenuText"), "userlevelslist", 17, "", AllowListMenu('{DB904388-BBCA-46DF-8766-6547B7E1D6C1}userlevels'), false, false, "", "", true, false);
$topMenu->addMenuItem(1, "mi_audittrail", $Language->menuPhrase("1", "MenuText"), "audittraillist", 17, "", AllowListMenu('{DB904388-BBCA-46DF-8766-6547B7E1D6C1}audittrail'), false, false, "", "", true, false);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(6, "mi_job", $Language->menuPhrase("6", "MenuText"), "joblist", -1, "", AllowListMenu('{DB904388-BBCA-46DF-8766-6547B7E1D6C1}job'), false, false, "", "", true, true);
$sideMenu->addMenuItem(16, "mci_Master", $Language->menuPhrase("16", "MenuText"), "", -1, "", true, false, true, "", "", true, true);
$sideMenu->addMenuItem(7, "mi_lokasi", $Language->menuPhrase("7", "MenuText"), "lokasilist", 16, "", AllowListMenu('{DB904388-BBCA-46DF-8766-6547B7E1D6C1}lokasi'), false, false, "", "", true, true);
$sideMenu->addMenuItem(8, "mi_customer", $Language->menuPhrase("8", "MenuText"), "customerlist", 16, "", AllowListMenu('{DB904388-BBCA-46DF-8766-6547B7E1D6C1}customer'), false, false, "", "", true, true);
$sideMenu->addMenuItem(18, "mi_shipper", $Language->menuPhrase("18", "MenuText"), "shipperlist", 16, "", AllowListMenu('{DB904388-BBCA-46DF-8766-6547B7E1D6C1}shipper'), false, false, "", "", true, true);
$sideMenu->addMenuItem(2, "mi_employees", $Language->menuPhrase("2", "MenuText"), "employeeslist", 16, "", AllowListMenu('{DB904388-BBCA-46DF-8766-6547B7E1D6C1}employees'), false, false, "", "", true, true);
$sideMenu->addMenuItem(17, "mci_Setting", $Language->menuPhrase("17", "MenuText"), "", -1, "", true, false, true, "", "", true, true);
$sideMenu->addMenuItem(4, "mi_userlevels", $Language->menuPhrase("4", "MenuText"), "userlevelslist", 17, "", AllowListMenu('{DB904388-BBCA-46DF-8766-6547B7E1D6C1}userlevels'), false, false, "", "", true, true);
$sideMenu->addMenuItem(1, "mi_audittrail", $Language->menuPhrase("1", "MenuText"), "audittraillist", 17, "", AllowListMenu('{DB904388-BBCA-46DF-8766-6547B7E1D6C1}audittrail'), false, false, "", "", true, true);
echo $sideMenu->toScript();
