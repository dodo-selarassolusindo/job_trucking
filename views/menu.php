<?php

namespace PHPMaker2024\prj_job_trucking;

// Navbar menu
$topMenu = new Menu("navbar", true, true);
$topMenu->addMenuItem(11, "mi_beranda", $Language->menuPhrase("11", "MenuText"), "beranda", -1, "", AllowListMenu('{E946C152-A6FA-4AD7-93DD-22C0E875338D}beranda.php'), false, false, "", "", true, false);
$topMenu->addMenuItem(12, "mci_Master", $Language->menuPhrase("12", "MenuText"), "", -1, "", true, false, true, "", "", true, false);
$topMenu->addMenuItem(7, "mi_size", $Language->menuPhrase("7", "MenuText"), "sizelist", 12, "", AllowListMenu('{E946C152-A6FA-4AD7-93DD-22C0E875338D}size'), false, false, "", "", true, false);
$topMenu->addMenuItem(5, "mi_lokasi", $Language->menuPhrase("5", "MenuText"), "lokasilist", 12, "", AllowListMenu('{E946C152-A6FA-4AD7-93DD-22C0E875338D}lokasi'), false, false, "", "", true, false);
$topMenu->addMenuItem(2, "mi_customer", $Language->menuPhrase("2", "MenuText"), "customerlist", 12, "", AllowListMenu('{E946C152-A6FA-4AD7-93DD-22C0E875338D}customer'), false, false, "", "", true, false);
$topMenu->addMenuItem(6, "mi_shipper", $Language->menuPhrase("6", "MenuText"), "shipperlist", 12, "", AllowListMenu('{E946C152-A6FA-4AD7-93DD-22C0E875338D}shipper'), false, false, "", "", true, false);
$topMenu->addMenuItem(4, "mi_job", $Language->menuPhrase("4", "MenuText"), "joblist", -1, "", AllowListMenu('{E946C152-A6FA-4AD7-93DD-22C0E875338D}job'), false, false, "", "", true, false);
$topMenu->addMenuItem(13, "mci_Report", $Language->menuPhrase("13", "MenuText"), "", -1, "", true, false, true, "", "", true, false);
$topMenu->addMenuItem(1, "mi_audittrail", $Language->menuPhrase("1", "MenuText"), "audittraillist", 13, "", AllowListMenu('{E946C152-A6FA-4AD7-93DD-22C0E875338D}audittrail'), false, false, "", "", true, false);
$topMenu->addMenuItem(10, "mi_exportlog", $Language->menuPhrase("10", "MenuText"), "exportloglist", 13, "", AllowListMenu('{E946C152-A6FA-4AD7-93DD-22C0E875338D}exportlog'), false, false, "", "", true, false);
$topMenu->addMenuItem(15, "mci_Setting", $Language->menuPhrase("15", "MenuText"), "", -1, "", true, false, true, "", "", true, false);
$topMenu->addMenuItem(3, "mi_employees", $Language->menuPhrase("3", "MenuText"), "employeeslist", 15, "", AllowListMenu('{E946C152-A6FA-4AD7-93DD-22C0E875338D}employees'), false, false, "", "", true, false);
$topMenu->addMenuItem(9, "mi_userlevels", $Language->menuPhrase("9", "MenuText"), "userlevelslist", 15, "", AllowListMenu('{E946C152-A6FA-4AD7-93DD-22C0E875338D}userlevels'), false, false, "", "", true, false);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(11, "mi_beranda", $Language->menuPhrase("11", "MenuText"), "beranda", -1, "", AllowListMenu('{E946C152-A6FA-4AD7-93DD-22C0E875338D}beranda.php'), false, false, "", "", true, true);
$sideMenu->addMenuItem(12, "mci_Master", $Language->menuPhrase("12", "MenuText"), "", -1, "", true, false, true, "", "", true, true);
$sideMenu->addMenuItem(7, "mi_size", $Language->menuPhrase("7", "MenuText"), "sizelist", 12, "", AllowListMenu('{E946C152-A6FA-4AD7-93DD-22C0E875338D}size'), false, false, "", "", true, true);
$sideMenu->addMenuItem(5, "mi_lokasi", $Language->menuPhrase("5", "MenuText"), "lokasilist", 12, "", AllowListMenu('{E946C152-A6FA-4AD7-93DD-22C0E875338D}lokasi'), false, false, "", "", true, true);
$sideMenu->addMenuItem(2, "mi_customer", $Language->menuPhrase("2", "MenuText"), "customerlist", 12, "", AllowListMenu('{E946C152-A6FA-4AD7-93DD-22C0E875338D}customer'), false, false, "", "", true, true);
$sideMenu->addMenuItem(6, "mi_shipper", $Language->menuPhrase("6", "MenuText"), "shipperlist", 12, "", AllowListMenu('{E946C152-A6FA-4AD7-93DD-22C0E875338D}shipper'), false, false, "", "", true, true);
$sideMenu->addMenuItem(4, "mi_job", $Language->menuPhrase("4", "MenuText"), "joblist", -1, "", AllowListMenu('{E946C152-A6FA-4AD7-93DD-22C0E875338D}job'), false, false, "", "", true, true);
$sideMenu->addMenuItem(13, "mci_Report", $Language->menuPhrase("13", "MenuText"), "", -1, "", true, false, true, "", "", true, true);
$sideMenu->addMenuItem(1, "mi_audittrail", $Language->menuPhrase("1", "MenuText"), "audittraillist", 13, "", AllowListMenu('{E946C152-A6FA-4AD7-93DD-22C0E875338D}audittrail'), false, false, "", "", true, true);
$sideMenu->addMenuItem(10, "mi_exportlog", $Language->menuPhrase("10", "MenuText"), "exportloglist", 13, "", AllowListMenu('{E946C152-A6FA-4AD7-93DD-22C0E875338D}exportlog'), false, false, "", "", true, true);
$sideMenu->addMenuItem(15, "mci_Setting", $Language->menuPhrase("15", "MenuText"), "", -1, "", true, false, true, "", "", true, true);
$sideMenu->addMenuItem(3, "mi_employees", $Language->menuPhrase("3", "MenuText"), "employeeslist", 15, "", AllowListMenu('{E946C152-A6FA-4AD7-93DD-22C0E875338D}employees'), false, false, "", "", true, true);
$sideMenu->addMenuItem(9, "mi_userlevels", $Language->menuPhrase("9", "MenuText"), "userlevelslist", 15, "", AllowListMenu('{E946C152-A6FA-4AD7-93DD-22C0E875338D}userlevels'), false, false, "", "", true, true);
echo $sideMenu->toScript();
