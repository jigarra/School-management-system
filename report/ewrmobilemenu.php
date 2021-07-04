<!-- Begin Main Menu -->
<?php

// Generate all menu items
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(1, "mmi_admin_profile", $ReportLanguage->Phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("1", "MenuText") . $ReportLanguage->Phrase("SimpleReportMenuItemSuffix"), "admin_profilerpt.php", -1, "", TRUE, FALSE);
$RootMenu->AddMenuItem(2, "mmi_login_admin", $ReportLanguage->Phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("2", "MenuText") . $ReportLanguage->Phrase("SimpleReportMenuItemSuffix"), "login_adminrpt.php", -1, "", TRUE, FALSE);
$RootMenu->AddMenuItem(3, "mmi_student_login", $ReportLanguage->Phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("3", "MenuText") . $ReportLanguage->Phrase("SimpleReportMenuItemSuffix"), "student_loginrpt.php", -1, "", TRUE, FALSE);
$RootMenu->AddMenuItem(4, "mmi_teacher_login", $ReportLanguage->Phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("4", "MenuText") . $ReportLanguage->Phrase("SimpleReportMenuItemSuffix"), "teacher_loginrpt.php", -1, "", TRUE, FALSE);
$RootMenu->AddMenuItem(5, "mmi_report", $ReportLanguage->Phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("5", "MenuText") . $ReportLanguage->Phrase("SimpleReportMenuItemSuffix"), "reportrpt.php", -1, "", TRUE, FALSE);
$RootMenu->Render();
?>
<!-- End Main Menu -->
