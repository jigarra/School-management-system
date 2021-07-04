<!-- Begin Main Menu -->
<div class="ewMenu">
<?php $RootMenu = new crMenu(EWR_MENUBAR_ID); ?>
<?php

// Generate all menu items
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(1, "mi_admin_profile", $ReportLanguage->Phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("1", "MenuText") . $ReportLanguage->Phrase("SimpleReportMenuItemSuffix"), "admin_profilerpt.php", -1, "", TRUE, FALSE);
$RootMenu->AddMenuItem(2, "mi_login_admin", $ReportLanguage->Phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("2", "MenuText") . $ReportLanguage->Phrase("SimpleReportMenuItemSuffix"), "login_adminrpt.php", -1, "", TRUE, FALSE);
$RootMenu->AddMenuItem(3, "mi_student_login", $ReportLanguage->Phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("3", "MenuText") . $ReportLanguage->Phrase("SimpleReportMenuItemSuffix"), "student_loginrpt.php", -1, "", TRUE, FALSE);
$RootMenu->AddMenuItem(4, "mi_teacher_login", $ReportLanguage->Phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("4", "MenuText") . $ReportLanguage->Phrase("SimpleReportMenuItemSuffix"), "teacher_loginrpt.php", -1, "", TRUE, FALSE);
$RootMenu->AddMenuItem(5, "mi_report", $ReportLanguage->Phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("5", "MenuText") . $ReportLanguage->Phrase("SimpleReportMenuItemSuffix"), "reportrpt.php", -1, "", TRUE, FALSE);
$RootMenu->Render();
?>
</div>
<!-- End Main Menu -->
