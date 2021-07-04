<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start();
?>
<?php include_once "phprptinc/ewrcfg10.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "phprptinc/ewmysql.php") ?>
<?php include_once "phprptinc/ewrfn10.php" ?>
<?php include_once "phprptinc/ewrusrfn10.php" ?>
<?php include_once "reportrptinfo.php" ?>
<?php

//
// Page class
//

$report_rpt = NULL; // Initialize page object first

class crreport_rpt extends crreport {

	// Page ID
	var $PageID = 'rpt';

	// Project ID
	var $ProjectID = "{a710cf2e-15c8-4ba4-a625-e0f06e7ad7f7}";

	// Page object name
	var $PageObjName = 'report_rpt';

	// Page name
	function PageName() {
		return ewr_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewr_CurrentPage() . "?";
		if ($this->UseTokenInUrl) $PageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Export URLs
	var $ExportPrintUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportPdfUrl;
	var $ReportTableClass;
	var $ReportTableStyle = "";

	// Custom export
	var $ExportPrintCustom = FALSE;
	var $ExportExcelCustom = FALSE;
	var $ExportWordCustom = FALSE;
	var $ExportPdfCustom = FALSE;
	var $ExportEmailCustom = FALSE;

	// Message
	function getMessage() {
		return @$_SESSION[EWR_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ewr_AddMessage($_SESSION[EWR_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EWR_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ewr_AddMessage($_SESSION[EWR_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EWR_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ewr_AddMessage($_SESSION[EWR_SESSION_SUCCESS_MESSAGE], $v);
	}

	function getWarningMessage() {
		return @$_SESSION[EWR_SESSION_WARNING_MESSAGE];
	}

	function setWarningMessage($v) {
		ewr_AddMessage($_SESSION[EWR_SESSION_WARNING_MESSAGE], $v);
	}

		// Show message
	function ShowMessage() {
		$hidden = FALSE;
		$html = "";

		// Message
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sMessage;
			$html .= "<div class=\"alert alert-info ewInfo\">" . $sMessage . "</div>";
			$_SESSION[EWR_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$sWarningMessage = $this->getWarningMessage();
		$this->Message_Showing($sWarningMessage, "warning");
		if ($sWarningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sWarningMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sWarningMessage;
			$html .= "<div class=\"alert alert-warning ewWarning\">" . $sWarningMessage . "</div>";
			$_SESSION[EWR_SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sSuccessMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sSuccessMessage;
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sSuccessMessage . "</div>";
			$_SESSION[EWR_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sErrorMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sErrorMessage;
			$html .= "<div class=\"alert alert-danger ewError\">" . $sErrorMessage . "</div>";
			$_SESSION[EWR_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo "<div class=\"ewMessageDialog ewDisplayTable\"" . (($hidden) ? " style=\"display: none;\"" : "") . ">" . $html . "</div>";
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") // Header exists, display
			echo $sHeader;
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") // Fotoer exists, display
			echo $sFooter;
	}

	// Validate page request
	function IsPageRequest() {
		if ($this->UseTokenInUrl) {
			if (ewr_IsHttpPost())
				return ($this->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($this->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}
	var $Token = "";
	var $CheckToken = EWR_CHECK_TOKEN;
	var $CheckTokenFn = "ewr_CheckToken";
	var $CreateTokenFn = "ewr_CreateToken";

	// Valid Post
	function ValidPost() {
		if (!$this->CheckToken || !ewr_IsHttpPost())
			return TRUE;
		if (!isset($_POST[EWR_TOKEN_NAME]))
			return FALSE;
		$fn = $this->CheckTokenFn;
		if (is_callable($fn))
			return $fn($_POST[EWR_TOKEN_NAME]);
		return FALSE;
	}

	// Create Token
	function CreateToken() {
		global $gsToken;
		if ($this->CheckToken) {
			$fn = $this->CreateTokenFn;
			if ($this->Token == "" && is_callable($fn)) // Create token
				$this->Token = $fn();
			$gsToken = $this->Token; // Save to global variable
		}
	}

	//
	// Page class constructor
	//
	function __construct() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (report)
		if (!isset($GLOBALS["report"])) {
			$GLOBALS["report"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["report"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";

		// Page ID
		if (!defined("EWR_PAGE_ID"))
			define("EWR_PAGE_ID", 'rpt', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWR_TABLE_NAME"))
			define("EWR_TABLE_NAME", 'report', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new crTimer();

		// Open connection
		if (!isset($conn)) $conn = ewr_Connect($this->DBID);

		// Export options
		$this->ExportOptions = new crListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ewExportOption";

		// Search options
		$this->SearchOptions = new crListOptions();
		$this->SearchOptions->Tag = "div";
		$this->SearchOptions->TagClassName = "ewSearchOption";

		// Filter options
		$this->FilterOptions = new crListOptions();
		$this->FilterOptions->Tag = "div";
		$this->FilterOptions->TagClassName = "ewFilterOption freportrpt";

		// Generate report options
		$this->GenerateOptions = new crListOptions();
		$this->GenerateOptions->Tag = "div";
		$this->GenerateOptions->TagClassName = "ewGenerateOption";
	}

	//
	// Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $gsEmailContentType, $ReportLanguage, $Security;
		global $gsCustomExport;

		// Get export parameters
		if (@$_GET["export"] <> "")
			$this->Export = strtolower($_GET["export"]);
		elseif (@$_POST["export"] <> "")
			$this->Export = strtolower($_POST["export"]);
		$gsExport = $this->Export; // Get export parameter, used in header
		$gsExportFile = $this->TableVar; // Get export file, used in header
		$gsEmailContentType = @$_POST["contenttype"]; // Get email content type

		// Setup placeholder
		// Setup export options

		$this->SetupExportOptions();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->ValidPost()) {
			echo $ReportLanguage->Phrase("InvalidPostRequest");
			$this->Page_Terminate();
			exit();
		}

		// Create Token
		$this->CreateToken();
	}

	// Set up export options
	function SetupExportOptions() {
		global $Security, $ReportLanguage, $ReportOptions;
		$exportid = session_id();
		$ReportTypes = array();

		// Printer friendly
		$item = &$this->ExportOptions->Add("print");
		$item->Body = "<a title=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("PrinterFriendly", TRUE)) . "\" data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("PrinterFriendly", TRUE)) . "\" href=\"" . $this->ExportPrintUrl . "\">" . $ReportLanguage->Phrase("PrinterFriendly") . "</a>";
		$item->Visible = FALSE;
		$ReportTypes["print"] = $item->Visible ? $ReportLanguage->Phrase("ReportFormPrint") : "";

		// Export to Excel
		$item = &$this->ExportOptions->Add("excel");
		$item->Body = "<a title=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToExcel", TRUE)) . "\" data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToExcel", TRUE)) . "\" href=\"" . $this->ExportExcelUrl . "\">" . $ReportLanguage->Phrase("ExportToExcel") . "</a>";
		$item->Visible = FALSE;
		$ReportTypes["excel"] = $item->Visible ? $ReportLanguage->Phrase("ReportFormExcel") : "";

		// Export to Word
		$item = &$this->ExportOptions->Add("word");
		$item->Body = "<a title=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToWord", TRUE)) . "\" data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToWord", TRUE)) . "\" href=\"" . $this->ExportWordUrl . "\">" . $ReportLanguage->Phrase("ExportToWord") . "</a>";

		//$item->Visible = TRUE;
		$item->Visible = TRUE;
		$ReportTypes["word"] = $item->Visible ? $ReportLanguage->Phrase("ReportFormWord") : "";

		// Export to Pdf
		$item = &$this->ExportOptions->Add("pdf");
		$item->Body = "<a title=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToPDF", TRUE)) . "\" data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToPDF", TRUE)) . "\" href=\"" . $this->ExportPdfUrl . "\">" . $ReportLanguage->Phrase("ExportToPDF") . "</a>";
		$item->Visible = FALSE;

		// Uncomment codes below to show export to Pdf link
//		$item->Visible = TRUE;

		$ReportTypes["pdf"] = $item->Visible ? $ReportLanguage->Phrase("ReportFormPdf") : "";

		// Export to Email
		$item = &$this->ExportOptions->Add("email");
		$url = $this->PageUrl() . "export=email";
		$item->Body = "<a title=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToEmail", TRUE)) . "\" data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToEmail", TRUE)) . "\" id=\"emf_report\" href=\"javascript:void(0);\" onclick=\"ewr_EmailDialogShow({lnk:'emf_report',hdr:ewLanguage.Phrase('ExportToEmail'),url:'$url',exportid:'$exportid',el:this});\">" . $ReportLanguage->Phrase("ExportToEmail") . "</a>";
		$item->Visible = FALSE;
		$ReportTypes["email"] = $item->Visible ? $ReportLanguage->Phrase("ReportFormEmail") : "";
		$ReportOptions["ReportTypes"] = $ReportTypes;

		// Drop down button for export
		$this->ExportOptions->UseDropDownButton = TRUE;
		$this->ExportOptions->UseButtonGroup = TRUE;
		$this->ExportOptions->UseImageAndText = $this->ExportOptions->UseDropDownButton;
		$this->ExportOptions->DropDownButtonPhrase = $ReportLanguage->Phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->Add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Filter button
		$item = &$this->FilterOptions->Add("savecurrentfilter");
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"freportrpt\" href=\"#\">" . $ReportLanguage->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"freportrpt\" href=\"#\">" . $ReportLanguage->Phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton; // v8
		$this->FilterOptions->DropDownButtonPhrase = $ReportLanguage->Phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->Add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Set up options (extended)
		$this->SetupExportOptionsExt();

		// Hide options for export
		if ($this->Export <> "") {
			$this->ExportOptions->HideAllOptions();
			$this->FilterOptions->HideAllOptions();
		}

		// Set up table class
		if ($this->Export == "word" || $this->Export == "excel" || $this->Export == "pdf")
			$this->ReportTableClass = "ewTable";
		else
			$this->ReportTableClass = "table ewTable";
	}

	// Set up search options
	function SetupSearchOptions() {
		global $ReportLanguage;

		// Filter panel button
		$item = &$this->SearchOptions->Add("searchtoggle");
		$SearchToggleClass = $this->FilterApplied ? " active" : " active";
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $ReportLanguage->Phrase("SearchBtn", TRUE) . "\" data-caption=\"" . $ReportLanguage->Phrase("SearchBtn", TRUE) . "\" data-toggle=\"button\" data-form=\"freportrpt\">" . $ReportLanguage->Phrase("SearchBtn") . "</button>";
		$item->Visible = FALSE;

		// Reset filter
		$item = &$this->SearchOptions->Add("resetfilter");
		$item->Body = "<button type=\"button\" class=\"btn btn-default\" title=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ResetAllFilter", TRUE)) . "\" data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ResetAllFilter", TRUE)) . "\" onclick=\"location='" . ewr_CurrentPage() . "?cmd=reset'\">" . $ReportLanguage->Phrase("ResetAllFilter") . "</button>";
		$item->Visible = FALSE && $this->FilterApplied;

		// Button group for reset filter
		$this->SearchOptions->UseButtonGroup = TRUE;

		// Add group option item
		$item = &$this->SearchOptions->Add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide options for export
		if ($this->Export <> "")
			$this->SearchOptions->HideAllOptions();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $ReportLanguage, $EWR_EXPORT, $gsExportFile;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		if ($this->Export <> "" && array_key_exists($this->Export, $EWR_EXPORT)) {
			$sContent = ob_get_contents();
			if (ob_get_length())
				ob_end_clean();

			// Remove all <div data-tagid="..." id="orig..." class="hide">...</div> (for customviewtag export, except "googlemaps")
			if (preg_match_all('/<div\s+data-tagid=[\'"]([\s\S]*?)[\'"]\s+id=[\'"]orig([\s\S]*?)[\'"]\s+class\s*=\s*[\'"]hide[\'"]>([\s\S]*?)<\/div\s*>/i', $sContent, $divmatches, PREG_SET_ORDER)) {
				foreach ($divmatches as $divmatch) {
					if ($divmatch[1] <> "googlemaps")
						$sContent = str_replace($divmatch[0], '', $sContent);
				}
			}
			$fn = $EWR_EXPORT[$this->Export];
			if ($this->Export == "email") { // Email
				if (@$this->GenOptions["reporttype"] == "email") {
					$saveResponse = $this->$fn($sContent, $this->GenOptions);
					$this->WriteGenResponse($saveResponse);
				} else {
					echo $this->$fn($sContent, array());
				}
				$url = ""; // Avoid redirect
			} else {
				$saveToFile = $this->$fn($sContent, $this->GenOptions);
				if (@$this->GenOptions["reporttype"] <> "") {
					$saveUrl = ($saveToFile <> "") ? ewr_ConvertFullUrl($saveToFile) : $ReportLanguage->Phrase("GenerateSuccess");
					$this->WriteGenResponse($saveUrl);
					$url = ""; // Avoid redirect
				}
			}
		}

		 // Close connection
		ewr_CloseConn();

		// Go to URL if specified
		if ($url <> "") {
			if (!EWR_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}

	// Initialize common variables
	var $ExportOptions; // Export options
	var $SearchOptions; // Search options
	var $FilterOptions; // Filter options

	// Paging variables
	var $RecIndex = 0; // Record index
	var $RecCount = 0; // Record count
	var $StartGrp = 0; // Start group
	var $StopGrp = 0; // Stop group
	var $TotalGrps = 0; // Total groups
	var $GrpCount = 0; // Group count
	var $GrpCounter = array(); // Group counter
	var $DisplayGrps = 3; // Groups per page
	var $GrpRange = 10;
	var $Sort = "";
	var $Filter = "";
	var $PageFirstGroupFilter = "";
	var $UserIDFilter = "";
	var $DrillDown = FALSE;
	var $DrillDownInPanel = FALSE;
	var $DrillDownList = "";

	// Clear field for ext filter
	var $ClearExtFilter = "";
	var $PopupName = "";
	var $PopupValue = "";
	var $FilterApplied;
	var $SearchCommand = FALSE;
	var $ShowHeader;
	var $GrpColumnCount = 0;
	var $SubGrpColumnCount = 0;
	var $DtlColumnCount = 0;
	var $Cnt, $Col, $Val, $Smry, $Mn, $Mx, $GrandCnt, $GrandSmry, $GrandMn, $GrandMx;
	var $TotCount;
	var $GrandSummarySetup = FALSE;
	var $GrpIdx;
	var $DetailRows = array();

	//
	// Page main
	//
	function Page_Main() {
		global $rs;
		global $rsgrp;
		global $Security;
		global $gsFormError;
		global $gbDrillDownInPanel;
		global $ReportBreadcrumb;
		global $ReportLanguage;

		// Set field visibility for detail fields
		$this->ID->SetVisibility();
		$this->fname->SetVisibility();
		$this->lname->SetVisibility();
		$this->_email->SetVisibility();
		$this->password->SetVisibility();
		$this->bdate->SetVisibility();
		$this->mobileno->SetVisibility();
		$this->Updatetime->SetVisibility();
		$this->ID1->SetVisibility();
		$this->name->SetVisibility();
		$this->email1->SetVisibility();
		$this->password1->SetVisibility();
		$this->date->SetVisibility();
		$this->ID2->SetVisibility();
		$this->firstname->SetVisibility();
		$this->lastname->SetVisibility();
		$this->password2->SetVisibility();
		$this->datetime->SetVisibility();
		$this->ID3->SetVisibility();
		$this->firstname1->SetVisibility();
		$this->lastname1->SetVisibility();
		$this->password3->SetVisibility();
		$this->datetime1->SetVisibility();

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 24;
		$nGrps = 1;
		$this->Val = &ewr_InitArray($nDtls, 0);
		$this->Cnt = &ewr_Init2DArray($nGrps, $nDtls, 0);
		$this->Smry = &ewr_Init2DArray($nGrps, $nDtls, 0);
		$this->Mn = &ewr_Init2DArray($nGrps, $nDtls, NULL);
		$this->Mx = &ewr_Init2DArray($nGrps, $nDtls, NULL);
		$this->GrandCnt = &ewr_InitArray($nDtls, 0);
		$this->GrandSmry = &ewr_InitArray($nDtls, 0);
		$this->GrandMn = &ewr_InitArray($nDtls, NULL);
		$this->GrandMx = &ewr_InitArray($nDtls, NULL);

		// Set up array if accumulation required: array(Accum, SkipNullOrZero)
		$this->Col = array(array(FALSE, FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE));

		// Set up groups per page dynamically
		$this->SetUpDisplayGrps();

		// Set up Breadcrumb
		if ($this->Export == "")
			$this->SetupBreadcrumb();

		// Load custom filters
		$this->Page_FilterLoad();

		// Set up popup filter
		$this->SetupPopup();

		// Load group db values if necessary
		$this->LoadGroupDbValues();

		// Handle Ajax popup
		$this->ProcessAjaxPopup();

		// Extended filter
		$sExtendedFilter = "";

		// Build popup filter
		$sPopupFilter = $this->GetPopupFilter();

		//ewr_SetDebugMsg("popup filter: " . $sPopupFilter);
		ewr_AddFilter($this->Filter, $sPopupFilter);

		// No filter
		$this->FilterApplied = FALSE;
		$this->FilterOptions->GetItem("savecurrentfilter")->Visible = FALSE;
		$this->FilterOptions->GetItem("deletefilter")->Visible = FALSE;

		// Call Page Selecting event
		$this->Page_Selecting($this->Filter);

		// Search options
		$this->SetupSearchOptions();

		// Get sort
		$this->Sort = $this->GetSort($this->GenOptions);

		// Get total count
		$sSql = ewr_BuildReportSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(), $this->Filter, $this->Sort);
		$this->TotalGrps = $this->GetCnt($sSql);
		if ($this->DisplayGrps <= 0 || $this->DrillDown) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowHeader = ($this->TotalGrps > 0);

		// Set up start position if not export all
		if ($this->ExportAll && $this->Export <> "")
			$this->DisplayGrps = $this->TotalGrps;
		else
			$this->SetUpStartGroup($this->GenOptions);

		// Set no record found message
		if ($this->TotalGrps == 0) {
				if ($this->Filter == "0=101") {
					$this->setWarningMessage($ReportLanguage->Phrase("EnterSearchCriteria"));
				} else {
					$this->setWarningMessage($ReportLanguage->Phrase("NoRecord"));
				}
		}

		// Hide export options if export
		if ($this->Export <> "")
			$this->ExportOptions->HideAllOptions();

		// Hide search/filter options if export/drilldown
		if ($this->Export <> "" || $this->DrillDown) {
			$this->SearchOptions->HideAllOptions();
			$this->FilterOptions->HideAllOptions();
			$this->GenerateOptions->HideAllOptions();
		}

		// Get current page records
		$rs = $this->GetRs($sSql, $this->StartGrp, $this->DisplayGrps);
		$this->SetupFieldCount();
	}

	// Accummulate summary
	function AccumulateSummary() {
		$cntx = count($this->Smry);
		for ($ix = 0; $ix < $cntx; $ix++) {
			$cnty = count($this->Smry[$ix]);
			for ($iy = 1; $iy < $cnty; $iy++) {
				if ($this->Col[$iy][0]) { // Accumulate required
					$valwrk = $this->Val[$iy];
					if (is_null($valwrk)) {
						if (!$this->Col[$iy][1])
							$this->Cnt[$ix][$iy]++;
					} else {
						$accum = (!$this->Col[$iy][1] || !is_numeric($valwrk) || $valwrk <> 0);
						if ($accum) {
							$this->Cnt[$ix][$iy]++;
							if (is_numeric($valwrk)) {
								$this->Smry[$ix][$iy] += $valwrk;
								if (is_null($this->Mn[$ix][$iy])) {
									$this->Mn[$ix][$iy] = $valwrk;
									$this->Mx[$ix][$iy] = $valwrk;
								} else {
									if ($this->Mn[$ix][$iy] > $valwrk) $this->Mn[$ix][$iy] = $valwrk;
									if ($this->Mx[$ix][$iy] < $valwrk) $this->Mx[$ix][$iy] = $valwrk;
								}
							}
						}
					}
				}
			}
		}
		$cntx = count($this->Smry);
		for ($ix = 0; $ix < $cntx; $ix++) {
			$this->Cnt[$ix][0]++;
		}
	}

	// Reset level summary
	function ResetLevelSummary($lvl) {

		// Clear summary values
		$cntx = count($this->Smry);
		for ($ix = $lvl; $ix < $cntx; $ix++) {
			$cnty = count($this->Smry[$ix]);
			for ($iy = 1; $iy < $cnty; $iy++) {
				$this->Cnt[$ix][$iy] = 0;
				if ($this->Col[$iy][0]) {
					$this->Smry[$ix][$iy] = 0;
					$this->Mn[$ix][$iy] = NULL;
					$this->Mx[$ix][$iy] = NULL;
				}
			}
		}
		$cntx = count($this->Smry);
		for ($ix = $lvl; $ix < $cntx; $ix++) {
			$this->Cnt[$ix][0] = 0;
		}

		// Reset record count
		$this->RecCount = 0;
	}

	// Accummulate grand summary
	function AccumulateGrandSummary() {
		$this->TotCount++;
		$cntgs = count($this->GrandSmry);
		for ($iy = 1; $iy < $cntgs; $iy++) {
			if ($this->Col[$iy][0]) {
				$valwrk = $this->Val[$iy];
				if (is_null($valwrk) || !is_numeric($valwrk)) {
					if (!$this->Col[$iy][1])
						$this->GrandCnt[$iy]++;
				} else {
					if (!$this->Col[$iy][1] || $valwrk <> 0) {
						$this->GrandCnt[$iy]++;
						$this->GrandSmry[$iy] += $valwrk;
						if (is_null($this->GrandMn[$iy])) {
							$this->GrandMn[$iy] = $valwrk;
							$this->GrandMx[$iy] = $valwrk;
						} else {
							if ($this->GrandMn[$iy] > $valwrk) $this->GrandMn[$iy] = $valwrk;
							if ($this->GrandMx[$iy] < $valwrk) $this->GrandMx[$iy] = $valwrk;
						}
					}
				}
			}
		}
	}

	// Get count
	function GetCnt($sql) {
		$conn = &$this->Connection();
		$rscnt = $conn->Execute($sql);
		$cnt = ($rscnt) ? $rscnt->RecordCount() : 0;
		if ($rscnt) $rscnt->Close();
		return $cnt;
	}

	// Get recordset
	function GetRs($wrksql, $start, $grps) {
		$conn = &$this->Connection();
		$conn->raiseErrorFn = $GLOBALS["EWR_ERROR_FN"];
		$rswrk = $conn->SelectLimit($wrksql, $grps, $start - 1);
		$conn->raiseErrorFn = '';
		return $rswrk;
	}

	// Get row values
	function GetRow($opt) {
		global $rs;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row
			$rs->MoveFirst(); // Move first
				$this->FirstRowData = array();
				$this->FirstRowData['ID'] = ewr_Conv($rs->fields('ID'), 3);
				$this->FirstRowData['fname'] = ewr_Conv($rs->fields('fname'), 200);
				$this->FirstRowData['lname'] = ewr_Conv($rs->fields('lname'), 200);
				$this->FirstRowData['_email'] = ewr_Conv($rs->fields('email'), 200);
				$this->FirstRowData['password'] = ewr_Conv($rs->fields('password'), 200);
				$this->FirstRowData['bdate'] = ewr_Conv($rs->fields('bdate'), 133);
				$this->FirstRowData['mobileno'] = ewr_Conv($rs->fields('mobileno'), 3);
				$this->FirstRowData['Updatetime'] = ewr_Conv($rs->fields('Updatetime'), 133);
				$this->FirstRowData['ID1'] = ewr_Conv($rs->fields('ID1'), 3);
				$this->FirstRowData['name'] = ewr_Conv($rs->fields('name'), 200);
				$this->FirstRowData['email1'] = ewr_Conv($rs->fields('email1'), 3);
				$this->FirstRowData['password1'] = ewr_Conv($rs->fields('password1'), 200);
				$this->FirstRowData['date'] = ewr_Conv($rs->fields('date'), 133);
				$this->FirstRowData['ID2'] = ewr_Conv($rs->fields('ID2'), 3);
				$this->FirstRowData['firstname'] = ewr_Conv($rs->fields('firstname'), 200);
				$this->FirstRowData['lastname'] = ewr_Conv($rs->fields('lastname'), 200);
				$this->FirstRowData['password2'] = ewr_Conv($rs->fields('password2'), 200);
				$this->FirstRowData['datetime'] = ewr_Conv($rs->fields('datetime'), 133);
				$this->FirstRowData['ID3'] = ewr_Conv($rs->fields('ID3'), 3);
				$this->FirstRowData['firstname1'] = ewr_Conv($rs->fields('firstname1'), 200);
				$this->FirstRowData['lastname1'] = ewr_Conv($rs->fields('lastname1'), 200);
				$this->FirstRowData['password3'] = ewr_Conv($rs->fields('password3'), 200);
				$this->FirstRowData['datetime1'] = ewr_Conv($rs->fields('datetime1'), 133);
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$this->ID->setDbValue($rs->fields('ID'));
			$this->fname->setDbValue($rs->fields('fname'));
			$this->lname->setDbValue($rs->fields('lname'));
			$this->_email->setDbValue($rs->fields('email'));
			$this->address->setDbValue($rs->fields('address'));
			$this->password->setDbValue($rs->fields('password'));
			$this->bdate->setDbValue($rs->fields('bdate'));
			$this->mobileno->setDbValue($rs->fields('mobileno'));
			$this->Updatetime->setDbValue($rs->fields('Updatetime'));
			$this->ID1->setDbValue($rs->fields('ID1'));
			$this->name->setDbValue($rs->fields('name'));
			$this->email1->setDbValue($rs->fields('email1'));
			$this->password1->setDbValue($rs->fields('password1'));
			$this->date->setDbValue($rs->fields('date'));
			$this->ID2->setDbValue($rs->fields('ID2'));
			$this->firstname->setDbValue($rs->fields('firstname'));
			$this->lastname->setDbValue($rs->fields('lastname'));
			$this->password2->setDbValue($rs->fields('password2'));
			$this->datetime->setDbValue($rs->fields('datetime'));
			$this->ID3->setDbValue($rs->fields('ID3'));
			$this->firstname1->setDbValue($rs->fields('firstname1'));
			$this->lastname1->setDbValue($rs->fields('lastname1'));
			$this->password3->setDbValue($rs->fields('password3'));
			$this->datetime1->setDbValue($rs->fields('datetime1'));
			$this->Val[1] = $this->ID->CurrentValue;
			$this->Val[2] = $this->fname->CurrentValue;
			$this->Val[3] = $this->lname->CurrentValue;
			$this->Val[4] = $this->_email->CurrentValue;
			$this->Val[5] = $this->password->CurrentValue;
			$this->Val[6] = $this->bdate->CurrentValue;
			$this->Val[7] = $this->mobileno->CurrentValue;
			$this->Val[8] = $this->Updatetime->CurrentValue;
			$this->Val[9] = $this->ID1->CurrentValue;
			$this->Val[10] = $this->name->CurrentValue;
			$this->Val[11] = $this->email1->CurrentValue;
			$this->Val[12] = $this->password1->CurrentValue;
			$this->Val[13] = $this->date->CurrentValue;
			$this->Val[14] = $this->ID2->CurrentValue;
			$this->Val[15] = $this->firstname->CurrentValue;
			$this->Val[16] = $this->lastname->CurrentValue;
			$this->Val[17] = $this->password2->CurrentValue;
			$this->Val[18] = $this->datetime->CurrentValue;
			$this->Val[19] = $this->ID3->CurrentValue;
			$this->Val[20] = $this->firstname1->CurrentValue;
			$this->Val[21] = $this->lastname1->CurrentValue;
			$this->Val[22] = $this->password3->CurrentValue;
			$this->Val[23] = $this->datetime1->CurrentValue;
		} else {
			$this->ID->setDbValue("");
			$this->fname->setDbValue("");
			$this->lname->setDbValue("");
			$this->_email->setDbValue("");
			$this->address->setDbValue("");
			$this->password->setDbValue("");
			$this->bdate->setDbValue("");
			$this->mobileno->setDbValue("");
			$this->Updatetime->setDbValue("");
			$this->ID1->setDbValue("");
			$this->name->setDbValue("");
			$this->email1->setDbValue("");
			$this->password1->setDbValue("");
			$this->date->setDbValue("");
			$this->ID2->setDbValue("");
			$this->firstname->setDbValue("");
			$this->lastname->setDbValue("");
			$this->password2->setDbValue("");
			$this->datetime->setDbValue("");
			$this->ID3->setDbValue("");
			$this->firstname1->setDbValue("");
			$this->lastname1->setDbValue("");
			$this->password3->setDbValue("");
			$this->datetime1->setDbValue("");
		}
	}

	// Set up starting group
	function SetUpStartGroup($options = array()) {

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;
		$startGrp = (@$options["start"] <> "") ? $options["start"] : @$_GET[EWR_TABLE_START_GROUP];
		$pageNo = (@$options["pageno"] <> "") ? $options["pageno"] : @$_GET["pageno"];

		// Check for a 'start' parameter
		if ($startGrp != "") {
			$this->StartGrp = $startGrp;
			$this->setStartGroup($this->StartGrp);
		} elseif ($pageNo != "") {
			$nPageNo = $pageNo;
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$this->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $this->getStartGroup();
			}
		} else {
			$this->StartGrp = $this->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$this->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$this->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$this->setStartGroup($this->StartGrp);
		}
	}

	// Load group db values if necessary
	function LoadGroupDbValues() {
		$conn = &$this->Connection();
	}

	// Process Ajax popup
	function ProcessAjaxPopup() {
		global $ReportLanguage;
		$conn = &$this->Connection();
		$fld = NULL;
		if (@$_GET["popup"] <> "") {
			$popupname = $_GET["popup"];

			// Check popup name
			// Output data as Json

			if (!is_null($fld)) {
				$jsdb = ewr_GetJsDb($fld, $fld->FldType);
				if (ob_get_length())
					ob_end_clean();
				echo $jsdb;
				exit();
			}
		}
	}

	// Set up popup
	function SetupPopup() {
		global $ReportLanguage;
		$conn = &$this->Connection();
		if ($this->DrillDown)
			return;

		// Process post back form
		if (ewr_IsHttpPost()) {
			$sName = @$_POST["popup"]; // Get popup form name
			if ($sName <> "") {
				$cntValues = (is_array(@$_POST["sel_$sName"])) ? count($_POST["sel_$sName"]) : 0;
				if ($cntValues > 0) {
					$arValues = ewr_StripSlashes($_POST["sel_$sName"]);
					if (trim($arValues[0]) == "") // Select all
						$arValues = EWR_INIT_VALUE;
					$_SESSION["sel_$sName"] = $arValues;
					$_SESSION["rf_$sName"] = ewr_StripSlashes(@$_POST["rf_$sName"]);
					$_SESSION["rt_$sName"] = ewr_StripSlashes(@$_POST["rt_$sName"]);
					$this->ResetPager();
				}
			}

		// Get 'reset' command
		} elseif (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];
			if (strtolower($sCmd) == "reset") {
				$this->ResetPager();
			}
		}

		// Load selection criteria to array
	}

	// Reset pager
	function ResetPager() {

		// Reset start position (reset command)
		$this->StartGrp = 1;
		$this->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		$sWrk = @$_GET[EWR_TABLE_GROUP_PER_PAGE];
		if ($sWrk <> "") {
			if (is_numeric($sWrk)) {
				$this->DisplayGrps = intval($sWrk);
			} else {
				if (strtoupper($sWrk) == "ALL") { // Display all groups
					$this->DisplayGrps = -1;
				} else {
					$this->DisplayGrps = 3; // Non-numeric, load default
				}
			}
			$this->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$this->setStartGroup($this->StartGrp);
		} else {
			if ($this->getGroupPerPage() <> "") {
				$this->DisplayGrps = $this->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	// Render row
	function RenderRow() {
		global $rs, $Security, $ReportLanguage;
		$conn = &$this->Connection();
		if (!$this->GrandSummarySetup) { // Get Grand total
			$bGotCount = FALSE;
			$bGotSummary = FALSE;

			// Get total count from sql directly
			$sSql = ewr_BuildReportSql($this->getSqlSelectCount(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
				$bGotCount = TRUE;
			} else {
				$this->TotCount = 0;
			}
		$bGotSummary = TRUE;

			// Accumulate grand summary from detail records
			if (!$bGotCount || !$bGotSummary) {
				$sSql = ewr_BuildReportSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
				$rs = $conn->Execute($sSql);
				if ($rs) {
					$this->GetRow(1);
					while (!$rs->EOF) {
						$this->AccumulateGrandSummary();
						$this->GetRow(2);
					}
					$rs->Close();
				}
			}
			$this->GrandSummarySetup = TRUE; // No need to set up again
		}

		// Call Row_Rendering event
		$this->Row_Rendering();

		//
		// Render view codes
		//

		if ($this->RowType == EWR_ROWTYPE_TOTAL && !($this->RowTotalType == EWR_ROWTOTAL_GROUP && $this->RowTotalSubType == EWR_ROWTOTAL_HEADER)) { // Summary row
			ewr_PrependClass($this->RowAttrs["class"], ($this->RowTotalType == EWR_ROWTOTAL_PAGE || $this->RowTotalType == EWR_ROWTOTAL_GRAND) ? "ewRptGrpAggregate" : "ewRptGrpSummary" . $this->RowGroupLevel); // Set up row class

			// ID
			$this->ID->HrefValue = "";

			// fname
			$this->fname->HrefValue = "";

			// lname
			$this->lname->HrefValue = "";

			// email
			$this->_email->HrefValue = "";

			// password
			$this->password->HrefValue = "";

			// bdate
			$this->bdate->HrefValue = "";

			// mobileno
			$this->mobileno->HrefValue = "";

			// Updatetime
			$this->Updatetime->HrefValue = "";

			// ID1
			$this->ID1->HrefValue = "";

			// name
			$this->name->HrefValue = "";

			// email1
			$this->email1->HrefValue = "";

			// password1
			$this->password1->HrefValue = "";

			// date
			$this->date->HrefValue = "";

			// ID2
			$this->ID2->HrefValue = "";

			// firstname
			$this->firstname->HrefValue = "";

			// lastname
			$this->lastname->HrefValue = "";

			// password2
			$this->password2->HrefValue = "";

			// datetime
			$this->datetime->HrefValue = "";

			// ID3
			$this->ID3->HrefValue = "";

			// firstname1
			$this->firstname1->HrefValue = "";

			// lastname1
			$this->lastname1->HrefValue = "";

			// password3
			$this->password3->HrefValue = "";

			// datetime1
			$this->datetime1->HrefValue = "";
		} else {
			if ($this->RowTotalType == EWR_ROWTOTAL_GROUP && $this->RowTotalSubType == EWR_ROWTOTAL_HEADER) {
			} else {
			}

			// ID
			$this->ID->ViewValue = $this->ID->CurrentValue;
			$this->ID->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// fname
			$this->fname->ViewValue = $this->fname->CurrentValue;
			$this->fname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// lname
			$this->lname->ViewValue = $this->lname->CurrentValue;
			$this->lname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// email
			$this->_email->ViewValue = $this->_email->CurrentValue;
			$this->_email->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// password
			$this->password->ViewValue = $this->password->CurrentValue;
			$this->password->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bdate
			$this->bdate->ViewValue = $this->bdate->CurrentValue;
			$this->bdate->ViewValue = ewr_FormatDateTime($this->bdate->ViewValue, 0);
			$this->bdate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// mobileno
			$this->mobileno->ViewValue = $this->mobileno->CurrentValue;
			$this->mobileno->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Updatetime
			$this->Updatetime->ViewValue = $this->Updatetime->CurrentValue;
			$this->Updatetime->ViewValue = ewr_FormatDateTime($this->Updatetime->ViewValue, 0);
			$this->Updatetime->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// ID1
			$this->ID1->ViewValue = $this->ID1->CurrentValue;
			$this->ID1->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// name
			$this->name->ViewValue = $this->name->CurrentValue;
			$this->name->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// email1
			$this->email1->ViewValue = $this->email1->CurrentValue;
			$this->email1->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// password1
			$this->password1->ViewValue = $this->password1->CurrentValue;
			$this->password1->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// date
			$this->date->ViewValue = $this->date->CurrentValue;
			$this->date->ViewValue = ewr_FormatDateTime($this->date->ViewValue, 0);
			$this->date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// ID2
			$this->ID2->ViewValue = $this->ID2->CurrentValue;
			$this->ID2->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// firstname
			$this->firstname->ViewValue = $this->firstname->CurrentValue;
			$this->firstname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// lastname
			$this->lastname->ViewValue = $this->lastname->CurrentValue;
			$this->lastname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// password2
			$this->password2->ViewValue = $this->password2->CurrentValue;
			$this->password2->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// datetime
			$this->datetime->ViewValue = $this->datetime->CurrentValue;
			$this->datetime->ViewValue = ewr_FormatDateTime($this->datetime->ViewValue, 0);
			$this->datetime->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// ID3
			$this->ID3->ViewValue = $this->ID3->CurrentValue;
			$this->ID3->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// firstname1
			$this->firstname1->ViewValue = $this->firstname1->CurrentValue;
			$this->firstname1->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// lastname1
			$this->lastname1->ViewValue = $this->lastname1->CurrentValue;
			$this->lastname1->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// password3
			$this->password3->ViewValue = $this->password3->CurrentValue;
			$this->password3->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// datetime1
			$this->datetime1->ViewValue = $this->datetime1->CurrentValue;
			$this->datetime1->ViewValue = ewr_FormatDateTime($this->datetime1->ViewValue, 0);
			$this->datetime1->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// ID
			$this->ID->HrefValue = "";

			// fname
			$this->fname->HrefValue = "";

			// lname
			$this->lname->HrefValue = "";

			// email
			$this->_email->HrefValue = "";

			// password
			$this->password->HrefValue = "";

			// bdate
			$this->bdate->HrefValue = "";

			// mobileno
			$this->mobileno->HrefValue = "";

			// Updatetime
			$this->Updatetime->HrefValue = "";

			// ID1
			$this->ID1->HrefValue = "";

			// name
			$this->name->HrefValue = "";

			// email1
			$this->email1->HrefValue = "";

			// password1
			$this->password1->HrefValue = "";

			// date
			$this->date->HrefValue = "";

			// ID2
			$this->ID2->HrefValue = "";

			// firstname
			$this->firstname->HrefValue = "";

			// lastname
			$this->lastname->HrefValue = "";

			// password2
			$this->password2->HrefValue = "";

			// datetime
			$this->datetime->HrefValue = "";

			// ID3
			$this->ID3->HrefValue = "";

			// firstname1
			$this->firstname1->HrefValue = "";

			// lastname1
			$this->lastname1->HrefValue = "";

			// password3
			$this->password3->HrefValue = "";

			// datetime1
			$this->datetime1->HrefValue = "";
		}

		// Call Cell_Rendered event
		if ($this->RowType == EWR_ROWTYPE_TOTAL) { // Summary row
		} else {

			// ID
			$CurrentValue = $this->ID->CurrentValue;
			$ViewValue = &$this->ID->ViewValue;
			$ViewAttrs = &$this->ID->ViewAttrs;
			$CellAttrs = &$this->ID->CellAttrs;
			$HrefValue = &$this->ID->HrefValue;
			$LinkAttrs = &$this->ID->LinkAttrs;
			$this->Cell_Rendered($this->ID, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// fname
			$CurrentValue = $this->fname->CurrentValue;
			$ViewValue = &$this->fname->ViewValue;
			$ViewAttrs = &$this->fname->ViewAttrs;
			$CellAttrs = &$this->fname->CellAttrs;
			$HrefValue = &$this->fname->HrefValue;
			$LinkAttrs = &$this->fname->LinkAttrs;
			$this->Cell_Rendered($this->fname, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// lname
			$CurrentValue = $this->lname->CurrentValue;
			$ViewValue = &$this->lname->ViewValue;
			$ViewAttrs = &$this->lname->ViewAttrs;
			$CellAttrs = &$this->lname->CellAttrs;
			$HrefValue = &$this->lname->HrefValue;
			$LinkAttrs = &$this->lname->LinkAttrs;
			$this->Cell_Rendered($this->lname, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// email
			$CurrentValue = $this->_email->CurrentValue;
			$ViewValue = &$this->_email->ViewValue;
			$ViewAttrs = &$this->_email->ViewAttrs;
			$CellAttrs = &$this->_email->CellAttrs;
			$HrefValue = &$this->_email->HrefValue;
			$LinkAttrs = &$this->_email->LinkAttrs;
			$this->Cell_Rendered($this->_email, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// password
			$CurrentValue = $this->password->CurrentValue;
			$ViewValue = &$this->password->ViewValue;
			$ViewAttrs = &$this->password->ViewAttrs;
			$CellAttrs = &$this->password->CellAttrs;
			$HrefValue = &$this->password->HrefValue;
			$LinkAttrs = &$this->password->LinkAttrs;
			$this->Cell_Rendered($this->password, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// bdate
			$CurrentValue = $this->bdate->CurrentValue;
			$ViewValue = &$this->bdate->ViewValue;
			$ViewAttrs = &$this->bdate->ViewAttrs;
			$CellAttrs = &$this->bdate->CellAttrs;
			$HrefValue = &$this->bdate->HrefValue;
			$LinkAttrs = &$this->bdate->LinkAttrs;
			$this->Cell_Rendered($this->bdate, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// mobileno
			$CurrentValue = $this->mobileno->CurrentValue;
			$ViewValue = &$this->mobileno->ViewValue;
			$ViewAttrs = &$this->mobileno->ViewAttrs;
			$CellAttrs = &$this->mobileno->CellAttrs;
			$HrefValue = &$this->mobileno->HrefValue;
			$LinkAttrs = &$this->mobileno->LinkAttrs;
			$this->Cell_Rendered($this->mobileno, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// Updatetime
			$CurrentValue = $this->Updatetime->CurrentValue;
			$ViewValue = &$this->Updatetime->ViewValue;
			$ViewAttrs = &$this->Updatetime->ViewAttrs;
			$CellAttrs = &$this->Updatetime->CellAttrs;
			$HrefValue = &$this->Updatetime->HrefValue;
			$LinkAttrs = &$this->Updatetime->LinkAttrs;
			$this->Cell_Rendered($this->Updatetime, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// ID1
			$CurrentValue = $this->ID1->CurrentValue;
			$ViewValue = &$this->ID1->ViewValue;
			$ViewAttrs = &$this->ID1->ViewAttrs;
			$CellAttrs = &$this->ID1->CellAttrs;
			$HrefValue = &$this->ID1->HrefValue;
			$LinkAttrs = &$this->ID1->LinkAttrs;
			$this->Cell_Rendered($this->ID1, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// name
			$CurrentValue = $this->name->CurrentValue;
			$ViewValue = &$this->name->ViewValue;
			$ViewAttrs = &$this->name->ViewAttrs;
			$CellAttrs = &$this->name->CellAttrs;
			$HrefValue = &$this->name->HrefValue;
			$LinkAttrs = &$this->name->LinkAttrs;
			$this->Cell_Rendered($this->name, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// email1
			$CurrentValue = $this->email1->CurrentValue;
			$ViewValue = &$this->email1->ViewValue;
			$ViewAttrs = &$this->email1->ViewAttrs;
			$CellAttrs = &$this->email1->CellAttrs;
			$HrefValue = &$this->email1->HrefValue;
			$LinkAttrs = &$this->email1->LinkAttrs;
			$this->Cell_Rendered($this->email1, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// password1
			$CurrentValue = $this->password1->CurrentValue;
			$ViewValue = &$this->password1->ViewValue;
			$ViewAttrs = &$this->password1->ViewAttrs;
			$CellAttrs = &$this->password1->CellAttrs;
			$HrefValue = &$this->password1->HrefValue;
			$LinkAttrs = &$this->password1->LinkAttrs;
			$this->Cell_Rendered($this->password1, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// date
			$CurrentValue = $this->date->CurrentValue;
			$ViewValue = &$this->date->ViewValue;
			$ViewAttrs = &$this->date->ViewAttrs;
			$CellAttrs = &$this->date->CellAttrs;
			$HrefValue = &$this->date->HrefValue;
			$LinkAttrs = &$this->date->LinkAttrs;
			$this->Cell_Rendered($this->date, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// ID2
			$CurrentValue = $this->ID2->CurrentValue;
			$ViewValue = &$this->ID2->ViewValue;
			$ViewAttrs = &$this->ID2->ViewAttrs;
			$CellAttrs = &$this->ID2->CellAttrs;
			$HrefValue = &$this->ID2->HrefValue;
			$LinkAttrs = &$this->ID2->LinkAttrs;
			$this->Cell_Rendered($this->ID2, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// firstname
			$CurrentValue = $this->firstname->CurrentValue;
			$ViewValue = &$this->firstname->ViewValue;
			$ViewAttrs = &$this->firstname->ViewAttrs;
			$CellAttrs = &$this->firstname->CellAttrs;
			$HrefValue = &$this->firstname->HrefValue;
			$LinkAttrs = &$this->firstname->LinkAttrs;
			$this->Cell_Rendered($this->firstname, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// lastname
			$CurrentValue = $this->lastname->CurrentValue;
			$ViewValue = &$this->lastname->ViewValue;
			$ViewAttrs = &$this->lastname->ViewAttrs;
			$CellAttrs = &$this->lastname->CellAttrs;
			$HrefValue = &$this->lastname->HrefValue;
			$LinkAttrs = &$this->lastname->LinkAttrs;
			$this->Cell_Rendered($this->lastname, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// password2
			$CurrentValue = $this->password2->CurrentValue;
			$ViewValue = &$this->password2->ViewValue;
			$ViewAttrs = &$this->password2->ViewAttrs;
			$CellAttrs = &$this->password2->CellAttrs;
			$HrefValue = &$this->password2->HrefValue;
			$LinkAttrs = &$this->password2->LinkAttrs;
			$this->Cell_Rendered($this->password2, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// datetime
			$CurrentValue = $this->datetime->CurrentValue;
			$ViewValue = &$this->datetime->ViewValue;
			$ViewAttrs = &$this->datetime->ViewAttrs;
			$CellAttrs = &$this->datetime->CellAttrs;
			$HrefValue = &$this->datetime->HrefValue;
			$LinkAttrs = &$this->datetime->LinkAttrs;
			$this->Cell_Rendered($this->datetime, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// ID3
			$CurrentValue = $this->ID3->CurrentValue;
			$ViewValue = &$this->ID3->ViewValue;
			$ViewAttrs = &$this->ID3->ViewAttrs;
			$CellAttrs = &$this->ID3->CellAttrs;
			$HrefValue = &$this->ID3->HrefValue;
			$LinkAttrs = &$this->ID3->LinkAttrs;
			$this->Cell_Rendered($this->ID3, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// firstname1
			$CurrentValue = $this->firstname1->CurrentValue;
			$ViewValue = &$this->firstname1->ViewValue;
			$ViewAttrs = &$this->firstname1->ViewAttrs;
			$CellAttrs = &$this->firstname1->CellAttrs;
			$HrefValue = &$this->firstname1->HrefValue;
			$LinkAttrs = &$this->firstname1->LinkAttrs;
			$this->Cell_Rendered($this->firstname1, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// lastname1
			$CurrentValue = $this->lastname1->CurrentValue;
			$ViewValue = &$this->lastname1->ViewValue;
			$ViewAttrs = &$this->lastname1->ViewAttrs;
			$CellAttrs = &$this->lastname1->CellAttrs;
			$HrefValue = &$this->lastname1->HrefValue;
			$LinkAttrs = &$this->lastname1->LinkAttrs;
			$this->Cell_Rendered($this->lastname1, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// password3
			$CurrentValue = $this->password3->CurrentValue;
			$ViewValue = &$this->password3->ViewValue;
			$ViewAttrs = &$this->password3->ViewAttrs;
			$CellAttrs = &$this->password3->CellAttrs;
			$HrefValue = &$this->password3->HrefValue;
			$LinkAttrs = &$this->password3->LinkAttrs;
			$this->Cell_Rendered($this->password3, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// datetime1
			$CurrentValue = $this->datetime1->CurrentValue;
			$ViewValue = &$this->datetime1->ViewValue;
			$ViewAttrs = &$this->datetime1->ViewAttrs;
			$CellAttrs = &$this->datetime1->CellAttrs;
			$HrefValue = &$this->datetime1->HrefValue;
			$LinkAttrs = &$this->datetime1->LinkAttrs;
			$this->Cell_Rendered($this->datetime1, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);
		}

		// Call Row_Rendered event
		$this->Row_Rendered();
		$this->SetupFieldCount();
	}

	// Setup field count
	function SetupFieldCount() {
		$this->GrpColumnCount = 0;
		$this->SubGrpColumnCount = 0;
		$this->DtlColumnCount = 0;
		if ($this->ID->Visible) $this->DtlColumnCount += 1;
		if ($this->fname->Visible) $this->DtlColumnCount += 1;
		if ($this->lname->Visible) $this->DtlColumnCount += 1;
		if ($this->_email->Visible) $this->DtlColumnCount += 1;
		if ($this->password->Visible) $this->DtlColumnCount += 1;
		if ($this->bdate->Visible) $this->DtlColumnCount += 1;
		if ($this->mobileno->Visible) $this->DtlColumnCount += 1;
		if ($this->Updatetime->Visible) $this->DtlColumnCount += 1;
		if ($this->ID1->Visible) $this->DtlColumnCount += 1;
		if ($this->name->Visible) $this->DtlColumnCount += 1;
		if ($this->email1->Visible) $this->DtlColumnCount += 1;
		if ($this->password1->Visible) $this->DtlColumnCount += 1;
		if ($this->date->Visible) $this->DtlColumnCount += 1;
		if ($this->ID2->Visible) $this->DtlColumnCount += 1;
		if ($this->firstname->Visible) $this->DtlColumnCount += 1;
		if ($this->lastname->Visible) $this->DtlColumnCount += 1;
		if ($this->password2->Visible) $this->DtlColumnCount += 1;
		if ($this->datetime->Visible) $this->DtlColumnCount += 1;
		if ($this->ID3->Visible) $this->DtlColumnCount += 1;
		if ($this->firstname1->Visible) $this->DtlColumnCount += 1;
		if ($this->lastname1->Visible) $this->DtlColumnCount += 1;
		if ($this->password3->Visible) $this->DtlColumnCount += 1;
		if ($this->datetime1->Visible) $this->DtlColumnCount += 1;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $ReportBreadcrumb;
		$ReportBreadcrumb = new crBreadcrumb();
		$url = substr(ewr_CurrentUrl(), strrpos(ewr_CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$ReportBreadcrumb->Add("rpt", $this->TableVar, $url, "", $this->TableVar, TRUE);
	}

	function SetupExportOptionsExt() {
		global $ReportLanguage, $ReportOptions;
		$ReportTypes = $ReportOptions["ReportTypes"];
		$item =& $this->ExportOptions->GetItem("pdf");
		$item->Visible = TRUE;
		if ($item->Visible)
			$ReportTypes["pdf"] = $ReportLanguage->Phrase("ReportFormPdf");
		$exportid = session_id();
		$url = $this->ExportPdfUrl;
		$item->Body = "<a title=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToPDF", TRUE)) . "\" data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToPDF", TRUE)) . "\" href=\"javascript:void(0);\" onclick=\"ewr_ExportCharts(this, '" . $url . "', '" . $exportid . "');\">" . $ReportLanguage->Phrase("ExportToPDF") . "</a>";
		$ReportOptions["ReportTypes"] = $ReportTypes;
	}

	// Return popup filter
	function GetPopupFilter() {
		$sWrk = "";
		if ($this->DrillDown)
			return "";
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWR_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort($options = array()) {
		if ($this->DrillDown)
			return "";
		$bResetSort = @$options["resetsort"] == "1" || @$_GET["cmd"] == "resetsort";
		$orderBy = (@$options["order"] <> "") ? @$options["order"] : ewr_StripSlashes(@$_GET["order"]);
		$orderType = (@$options["ordertype"] <> "") ? @$options["ordertype"] : ewr_StripSlashes(@$_GET["ordertype"]);

		// Check for a resetsort command
		if ($bResetSort) {
			$this->setOrderBy("");
			$this->setStartGroup(1);
			$this->ID->setSort("");
			$this->fname->setSort("");
			$this->lname->setSort("");
			$this->_email->setSort("");
			$this->password->setSort("");
			$this->bdate->setSort("");
			$this->mobileno->setSort("");
			$this->Updatetime->setSort("");
			$this->ID1->setSort("");
			$this->name->setSort("");
			$this->email1->setSort("");
			$this->password1->setSort("");
			$this->date->setSort("");
			$this->ID2->setSort("");
			$this->firstname->setSort("");
			$this->lastname->setSort("");
			$this->password2->setSort("");
			$this->datetime->setSort("");
			$this->ID3->setSort("");
			$this->firstname1->setSort("");
			$this->lastname1->setSort("");
			$this->password3->setSort("");
			$this->datetime1->setSort("");

		// Check for an Order parameter
		} elseif ($orderBy <> "") {
			$this->CurrentOrder = $orderBy;
			$this->CurrentOrderType = $orderType;
			$sSortSql = $this->SortSql();
			$this->setOrderBy($sSortSql);
			$this->setStartGroup(1);
		}
		return $this->getOrderBy();
	}

	// Export to WORD
	function ExportWord($html, $options = array()) {
		global $gsExportFile;
		$folder = @$options["folder"];
		$fileName = @$options["filename"];
		$responseType = @$options["responsetype"];
		$saveToFile = "";
		if ($folder <> "" && $fileName <> "" && ($responseType == "json" || $responseType == "file" && EWR_REPORT_SAVE_OUTPUT_ON_SERVER)) {
		 	ewr_SaveFile(ewr_PathCombine(ewr_AppRoot(), $folder, TRUE), $fileName, $html);
			$saveToFile = ewr_UploadPathEx(FALSE, $folder) . $fileName;
		}
		if ($saveToFile == "" || $responseType == "file") {
			header('Content-Type: application/vnd.ms-word' . (EWR_CHARSET <> '' ? ';charset=' . EWR_CHARSET : ''));
			header('Content-Disposition: attachment; filename=' . $gsExportFile . '.doc');
			echo $html;
		}
		return $saveToFile;
	}

	// Export PDF
	function ExportPdf($html, $options = array()) {
		global $gsExportFile;
		@ini_set("memory_limit", EWR_PDF_MEMORY_LIMIT);
		set_time_limit(EWR_PDF_TIME_LIMIT);
		if (EWR_DEBUG_ENABLED) // Add debug message
			$html = str_replace("</body>", ewr_DebugMsg() . "</body>", $html);
		$dompdf = new \Dompdf\Dompdf(array("pdf_backend" => "Cpdf"));
		$doc = new DOMDocument();
		@$doc->loadHTML('<?xml encoding="uft-8">' . ewr_ConvertToUtf8($html)); // Convert to utf-8
		$spans = $doc->getElementsByTagName("span");
		foreach ($spans as $span) {
			if ($span->getAttribute("class") == "ewFilterCaption")
				$span->parentNode->insertBefore($doc->createElement("span", ":&nbsp;"), $span->nextSibling);
		}
		$html = $doc->saveHTML();
		$html = ewr_ConvertFromUtf8($html);
		$dompdf->load_html($html);
		$dompdf->set_paper("a4", "portrait");
		$dompdf->render();
		$folder = @$options["folder"];
		$fileName = @$options["filename"];
		$responseType = @$options["responsetype"];
		$saveToFile = "";
		if ($folder <> "" && $fileName <> "" && ($responseType == "json" || $responseType == "file" && EWR_REPORT_SAVE_OUTPUT_ON_SERVER)) {
			ewr_SaveFile(ewr_PathCombine(ewr_AppRoot(), $folder, TRUE), $fileName, $dompdf->output());
			$saveToFile = ewr_UploadPathEx(FALSE, $folder) . $fileName;
		}
		if ($saveToFile == "" || $responseType == "file") {
			$sExportFile = strtolower(substr($gsExportFile, -4)) == ".pdf" ? $gsExportFile : $gsExportFile . ".pdf";
			$dompdf->stream($sExportFile, array("Attachment" => 1)); // 0 to open in browser, 1 to download
		}
		ewr_DeleteTmpImages($html);
		return $saveToFile;
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
<?php ewr_Header(FALSE) ?>
<?php

// Create page object
if (!isset($report_rpt)) $report_rpt = new crreport_rpt();
if (isset($Page)) $OldPage = $Page;
$Page = &$report_rpt;

// Page init
$Page->Page_Init();

// Page main
$Page->Page_Main();

// Global Page Rendering event (in ewrusrfn*.php)
Page_Rendering();

// Page Rendering event
$Page->Page_Render();
?>
<?php include_once "phprptinc/header.php" ?>
<?php if ($Page->Export == "") { ?>
<script type="text/javascript">

// Create page object
var report_rpt = new ewr_Page("report_rpt");

// Page properties
report_rpt.PageID = "rpt"; // Page ID
var EWR_PAGE_ID = report_rpt.PageID;

// Extend page with Chart_Rendering function
report_rpt.Chart_Rendering = 
 function(chart, chartid) { // DO NOT CHANGE THIS LINE!

 	//alert(chartid);
 }

// Extend page with Chart_Rendered function
report_rpt.Chart_Rendered = 
 function(chart, chartid) { // DO NOT CHANGE THIS LINE!

 	//alert(chartid);
 }
</script>
<?php } ?>
<?php if ($Page->Export == "" && !$Page->DrillDown) { ?>
<?php } ?>
<?php if ($Page->Export == "" && !$Page->DrillDown) { ?>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($Page->Export == "") { ?>
<!-- container (begin) -->
<div id="ewContainer" class="ewContainer">
<!-- top container (begin) -->
<div id="ewTop" class="ewTop">
<a id="top"></a>
<?php } ?>
<?php if (@$Page->GenOptions["showfilter"] == "1") { ?>
<?php $Page->ShowFilterList(TRUE) ?>
<?php } ?>
<!-- top slot -->
<div class="ewToolbar">
<?php if ($Page->Export == "" && (!$Page->DrillDown || !$Page->DrillDownInPanel)) { ?>
<?php if ($ReportBreadcrumb) $ReportBreadcrumb->Render(); ?>
<?php } ?>
<?php
if (!$Page->DrillDownInPanel) {
	$Page->ExportOptions->Render("body");
	$Page->SearchOptions->Render("body");
	$Page->FilterOptions->Render("body");
	$Page->GenerateOptions->Render("body");
}
?>
<?php if ($Page->Export == "" && !$Page->DrillDown) { ?>
<?php echo $ReportLanguage->SelectionForm(); ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php $Page->ShowPageHeader(); ?>
<?php $Page->ShowMessage(); ?>
<?php if ($Page->Export == "") { ?>
</div>
<!-- top container (end) -->
	<!-- left container (begin) -->
	<div id="ewLeft" class="ewLeft">
<?php } ?>
	<!-- Left slot -->
<?php if ($Page->Export == "") { ?>
	</div>
	<!-- left container (end) -->
	<!-- center container - report (begin) -->
	<div id="ewCenter" class="ewCenter">
<?php } ?>
	<!-- center slot -->
<!-- summary report starts -->
<?php if ($Page->Export <> "pdf") { ?>
<div id="report_summary">
<?php } ?>
<?php

// Set the last group to display if not export all
if ($Page->ExportAll && $Page->Export <> "") {
	$Page->StopGrp = $Page->TotalGrps;
} else {
	$Page->StopGrp = $Page->StartGrp + $Page->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($Page->StopGrp) > intval($Page->TotalGrps))
	$Page->StopGrp = $Page->TotalGrps;
$Page->RecCount = 0;
$Page->RecIndex = 0;

// Get first row
if ($Page->TotalGrps > 0) {
	$Page->GetRow(1);
	$Page->GrpCount = 1;
}
$Page->GrpIdx = ewr_InitArray(2, -1);
$Page->GrpIdx[0] = -1;
$Page->GrpIdx[1] = $Page->StopGrp - $Page->StartGrp + 1;
while ($rs && !$rs->EOF && $Page->GrpCount <= $Page->DisplayGrps || $Page->ShowHeader) {

	// Show dummy header for custom template
	// Show header

	if ($Page->ShowHeader) {
?>
<?php if ($Page->Export <> "pdf") { ?>
<?php if ($Page->Export == "word" || $Page->Export == "excel") { ?>
<div class="ewGrid"<?php echo $Page->ReportTableStyle ?>>
<?php } else { ?>
<div class="panel panel-default ewGrid"<?php echo $Page->ReportTableStyle ?>>
<?php } ?>
<?php } ?>
<!-- Report grid (begin) -->
<?php if ($Page->Export <> "pdf") { ?>
<div class="<?php if (ewr_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<?php } ?>
<table class="<?php echo $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($Page->ID->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="ID"><div class="report_ID"><span class="ewTableHeaderCaption"><?php echo $Page->ID->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="ID">
<?php if ($Page->SortUrl($Page->ID) == "") { ?>
		<div class="ewTableHeaderBtn report_ID">
			<span class="ewTableHeaderCaption"><?php echo $Page->ID->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer report_ID" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->ID) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->ID->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->ID->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->ID->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->fname->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="fname"><div class="report_fname"><span class="ewTableHeaderCaption"><?php echo $Page->fname->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="fname">
<?php if ($Page->SortUrl($Page->fname) == "") { ?>
		<div class="ewTableHeaderBtn report_fname">
			<span class="ewTableHeaderCaption"><?php echo $Page->fname->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer report_fname" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->fname) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->fname->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->fname->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->fname->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->lname->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="lname"><div class="report_lname"><span class="ewTableHeaderCaption"><?php echo $Page->lname->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="lname">
<?php if ($Page->SortUrl($Page->lname) == "") { ?>
		<div class="ewTableHeaderBtn report_lname">
			<span class="ewTableHeaderCaption"><?php echo $Page->lname->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer report_lname" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->lname) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->lname->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->lname->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->lname->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->_email->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="_email"><div class="report__email"><span class="ewTableHeaderCaption"><?php echo $Page->_email->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="_email">
<?php if ($Page->SortUrl($Page->_email) == "") { ?>
		<div class="ewTableHeaderBtn report__email">
			<span class="ewTableHeaderCaption"><?php echo $Page->_email->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer report__email" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->_email) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->_email->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->_email->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->_email->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->password->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="password"><div class="report_password"><span class="ewTableHeaderCaption"><?php echo $Page->password->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="password">
<?php if ($Page->SortUrl($Page->password) == "") { ?>
		<div class="ewTableHeaderBtn report_password">
			<span class="ewTableHeaderCaption"><?php echo $Page->password->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer report_password" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->password) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->password->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->password->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->password->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->bdate->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="bdate"><div class="report_bdate"><span class="ewTableHeaderCaption"><?php echo $Page->bdate->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="bdate">
<?php if ($Page->SortUrl($Page->bdate) == "") { ?>
		<div class="ewTableHeaderBtn report_bdate">
			<span class="ewTableHeaderCaption"><?php echo $Page->bdate->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer report_bdate" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->bdate) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->bdate->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->bdate->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->bdate->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->mobileno->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="mobileno"><div class="report_mobileno"><span class="ewTableHeaderCaption"><?php echo $Page->mobileno->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="mobileno">
<?php if ($Page->SortUrl($Page->mobileno) == "") { ?>
		<div class="ewTableHeaderBtn report_mobileno">
			<span class="ewTableHeaderCaption"><?php echo $Page->mobileno->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer report_mobileno" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->mobileno) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->mobileno->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->mobileno->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->mobileno->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Updatetime->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Updatetime"><div class="report_Updatetime"><span class="ewTableHeaderCaption"><?php echo $Page->Updatetime->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Updatetime">
<?php if ($Page->SortUrl($Page->Updatetime) == "") { ?>
		<div class="ewTableHeaderBtn report_Updatetime">
			<span class="ewTableHeaderCaption"><?php echo $Page->Updatetime->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer report_Updatetime" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->Updatetime) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->Updatetime->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->Updatetime->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->Updatetime->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->ID1->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="ID1"><div class="report_ID1"><span class="ewTableHeaderCaption"><?php echo $Page->ID1->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="ID1">
<?php if ($Page->SortUrl($Page->ID1) == "") { ?>
		<div class="ewTableHeaderBtn report_ID1">
			<span class="ewTableHeaderCaption"><?php echo $Page->ID1->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer report_ID1" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->ID1) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->ID1->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->ID1->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->ID1->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->name->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="name"><div class="report_name"><span class="ewTableHeaderCaption"><?php echo $Page->name->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="name">
<?php if ($Page->SortUrl($Page->name) == "") { ?>
		<div class="ewTableHeaderBtn report_name">
			<span class="ewTableHeaderCaption"><?php echo $Page->name->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer report_name" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->name) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->name->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->name->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->name->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->email1->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="email1"><div class="report_email1"><span class="ewTableHeaderCaption"><?php echo $Page->email1->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="email1">
<?php if ($Page->SortUrl($Page->email1) == "") { ?>
		<div class="ewTableHeaderBtn report_email1">
			<span class="ewTableHeaderCaption"><?php echo $Page->email1->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer report_email1" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->email1) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->email1->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->email1->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->email1->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->password1->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="password1"><div class="report_password1"><span class="ewTableHeaderCaption"><?php echo $Page->password1->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="password1">
<?php if ($Page->SortUrl($Page->password1) == "") { ?>
		<div class="ewTableHeaderBtn report_password1">
			<span class="ewTableHeaderCaption"><?php echo $Page->password1->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer report_password1" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->password1) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->password1->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->password1->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->password1->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->date->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="date"><div class="report_date"><span class="ewTableHeaderCaption"><?php echo $Page->date->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="date">
<?php if ($Page->SortUrl($Page->date) == "") { ?>
		<div class="ewTableHeaderBtn report_date">
			<span class="ewTableHeaderCaption"><?php echo $Page->date->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer report_date" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->date) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->date->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->date->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->date->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->ID2->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="ID2"><div class="report_ID2"><span class="ewTableHeaderCaption"><?php echo $Page->ID2->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="ID2">
<?php if ($Page->SortUrl($Page->ID2) == "") { ?>
		<div class="ewTableHeaderBtn report_ID2">
			<span class="ewTableHeaderCaption"><?php echo $Page->ID2->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer report_ID2" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->ID2) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->ID2->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->ID2->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->ID2->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->firstname->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="firstname"><div class="report_firstname"><span class="ewTableHeaderCaption"><?php echo $Page->firstname->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="firstname">
<?php if ($Page->SortUrl($Page->firstname) == "") { ?>
		<div class="ewTableHeaderBtn report_firstname">
			<span class="ewTableHeaderCaption"><?php echo $Page->firstname->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer report_firstname" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->firstname) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->firstname->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->firstname->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->firstname->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->lastname->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="lastname"><div class="report_lastname"><span class="ewTableHeaderCaption"><?php echo $Page->lastname->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="lastname">
<?php if ($Page->SortUrl($Page->lastname) == "") { ?>
		<div class="ewTableHeaderBtn report_lastname">
			<span class="ewTableHeaderCaption"><?php echo $Page->lastname->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer report_lastname" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->lastname) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->lastname->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->lastname->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->lastname->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->password2->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="password2"><div class="report_password2"><span class="ewTableHeaderCaption"><?php echo $Page->password2->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="password2">
<?php if ($Page->SortUrl($Page->password2) == "") { ?>
		<div class="ewTableHeaderBtn report_password2">
			<span class="ewTableHeaderCaption"><?php echo $Page->password2->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer report_password2" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->password2) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->password2->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->password2->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->password2->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->datetime->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="datetime"><div class="report_datetime"><span class="ewTableHeaderCaption"><?php echo $Page->datetime->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="datetime">
<?php if ($Page->SortUrl($Page->datetime) == "") { ?>
		<div class="ewTableHeaderBtn report_datetime">
			<span class="ewTableHeaderCaption"><?php echo $Page->datetime->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer report_datetime" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->datetime) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->datetime->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->datetime->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->datetime->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->ID3->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="ID3"><div class="report_ID3"><span class="ewTableHeaderCaption"><?php echo $Page->ID3->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="ID3">
<?php if ($Page->SortUrl($Page->ID3) == "") { ?>
		<div class="ewTableHeaderBtn report_ID3">
			<span class="ewTableHeaderCaption"><?php echo $Page->ID3->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer report_ID3" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->ID3) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->ID3->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->ID3->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->ID3->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->firstname1->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="firstname1"><div class="report_firstname1"><span class="ewTableHeaderCaption"><?php echo $Page->firstname1->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="firstname1">
<?php if ($Page->SortUrl($Page->firstname1) == "") { ?>
		<div class="ewTableHeaderBtn report_firstname1">
			<span class="ewTableHeaderCaption"><?php echo $Page->firstname1->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer report_firstname1" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->firstname1) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->firstname1->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->firstname1->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->firstname1->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->lastname1->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="lastname1"><div class="report_lastname1"><span class="ewTableHeaderCaption"><?php echo $Page->lastname1->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="lastname1">
<?php if ($Page->SortUrl($Page->lastname1) == "") { ?>
		<div class="ewTableHeaderBtn report_lastname1">
			<span class="ewTableHeaderCaption"><?php echo $Page->lastname1->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer report_lastname1" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->lastname1) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->lastname1->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->lastname1->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->lastname1->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->password3->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="password3"><div class="report_password3"><span class="ewTableHeaderCaption"><?php echo $Page->password3->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="password3">
<?php if ($Page->SortUrl($Page->password3) == "") { ?>
		<div class="ewTableHeaderBtn report_password3">
			<span class="ewTableHeaderCaption"><?php echo $Page->password3->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer report_password3" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->password3) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->password3->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->password3->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->password3->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->datetime1->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="datetime1"><div class="report_datetime1"><span class="ewTableHeaderCaption"><?php echo $Page->datetime1->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="datetime1">
<?php if ($Page->SortUrl($Page->datetime1) == "") { ?>
		<div class="ewTableHeaderBtn report_datetime1">
			<span class="ewTableHeaderCaption"><?php echo $Page->datetime1->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer report_datetime1" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->datetime1) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->datetime1->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->datetime1->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->datetime1->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($Page->TotalGrps == 0) break; // Show header only
		$Page->ShowHeader = FALSE;
	}
	$Page->RecCount++;
	$Page->RecIndex++;
?>
<?php

		// Render detail row
		$Page->ResetAttrs();
		$Page->RowType = EWR_ROWTYPE_DETAIL;
		$Page->RenderRow();
?>
	<tr<?php echo $Page->RowAttributes(); ?>>
<?php if ($Page->ID->Visible) { ?>
		<td data-field="ID"<?php echo $Page->ID->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->RecCount ?>_<?php echo $Page->RecCount ?>_report_ID"<?php echo $Page->ID->ViewAttributes() ?>><?php echo $Page->ID->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->fname->Visible) { ?>
		<td data-field="fname"<?php echo $Page->fname->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->RecCount ?>_<?php echo $Page->RecCount ?>_report_fname"<?php echo $Page->fname->ViewAttributes() ?>><?php echo $Page->fname->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->lname->Visible) { ?>
		<td data-field="lname"<?php echo $Page->lname->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->RecCount ?>_<?php echo $Page->RecCount ?>_report_lname"<?php echo $Page->lname->ViewAttributes() ?>><?php echo $Page->lname->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->_email->Visible) { ?>
		<td data-field="_email"<?php echo $Page->_email->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->RecCount ?>_<?php echo $Page->RecCount ?>_report__email"<?php echo $Page->_email->ViewAttributes() ?>><?php echo $Page->_email->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->password->Visible) { ?>
		<td data-field="password"<?php echo $Page->password->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->RecCount ?>_<?php echo $Page->RecCount ?>_report_password"<?php echo $Page->password->ViewAttributes() ?>><?php echo $Page->password->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->bdate->Visible) { ?>
		<td data-field="bdate"<?php echo $Page->bdate->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->RecCount ?>_<?php echo $Page->RecCount ?>_report_bdate"<?php echo $Page->bdate->ViewAttributes() ?>><?php echo $Page->bdate->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->mobileno->Visible) { ?>
		<td data-field="mobileno"<?php echo $Page->mobileno->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->RecCount ?>_<?php echo $Page->RecCount ?>_report_mobileno"<?php echo $Page->mobileno->ViewAttributes() ?>><?php echo $Page->mobileno->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Updatetime->Visible) { ?>
		<td data-field="Updatetime"<?php echo $Page->Updatetime->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->RecCount ?>_<?php echo $Page->RecCount ?>_report_Updatetime"<?php echo $Page->Updatetime->ViewAttributes() ?>><?php echo $Page->Updatetime->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->ID1->Visible) { ?>
		<td data-field="ID1"<?php echo $Page->ID1->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->RecCount ?>_<?php echo $Page->RecCount ?>_report_ID1"<?php echo $Page->ID1->ViewAttributes() ?>><?php echo $Page->ID1->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->name->Visible) { ?>
		<td data-field="name"<?php echo $Page->name->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->RecCount ?>_<?php echo $Page->RecCount ?>_report_name"<?php echo $Page->name->ViewAttributes() ?>><?php echo $Page->name->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->email1->Visible) { ?>
		<td data-field="email1"<?php echo $Page->email1->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->RecCount ?>_<?php echo $Page->RecCount ?>_report_email1"<?php echo $Page->email1->ViewAttributes() ?>><?php echo $Page->email1->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->password1->Visible) { ?>
		<td data-field="password1"<?php echo $Page->password1->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->RecCount ?>_<?php echo $Page->RecCount ?>_report_password1"<?php echo $Page->password1->ViewAttributes() ?>><?php echo $Page->password1->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->date->Visible) { ?>
		<td data-field="date"<?php echo $Page->date->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->RecCount ?>_<?php echo $Page->RecCount ?>_report_date"<?php echo $Page->date->ViewAttributes() ?>><?php echo $Page->date->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->ID2->Visible) { ?>
		<td data-field="ID2"<?php echo $Page->ID2->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->RecCount ?>_<?php echo $Page->RecCount ?>_report_ID2"<?php echo $Page->ID2->ViewAttributes() ?>><?php echo $Page->ID2->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->firstname->Visible) { ?>
		<td data-field="firstname"<?php echo $Page->firstname->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->RecCount ?>_<?php echo $Page->RecCount ?>_report_firstname"<?php echo $Page->firstname->ViewAttributes() ?>><?php echo $Page->firstname->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->lastname->Visible) { ?>
		<td data-field="lastname"<?php echo $Page->lastname->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->RecCount ?>_<?php echo $Page->RecCount ?>_report_lastname"<?php echo $Page->lastname->ViewAttributes() ?>><?php echo $Page->lastname->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->password2->Visible) { ?>
		<td data-field="password2"<?php echo $Page->password2->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->RecCount ?>_<?php echo $Page->RecCount ?>_report_password2"<?php echo $Page->password2->ViewAttributes() ?>><?php echo $Page->password2->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->datetime->Visible) { ?>
		<td data-field="datetime"<?php echo $Page->datetime->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->RecCount ?>_<?php echo $Page->RecCount ?>_report_datetime"<?php echo $Page->datetime->ViewAttributes() ?>><?php echo $Page->datetime->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->ID3->Visible) { ?>
		<td data-field="ID3"<?php echo $Page->ID3->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->RecCount ?>_<?php echo $Page->RecCount ?>_report_ID3"<?php echo $Page->ID3->ViewAttributes() ?>><?php echo $Page->ID3->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->firstname1->Visible) { ?>
		<td data-field="firstname1"<?php echo $Page->firstname1->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->RecCount ?>_<?php echo $Page->RecCount ?>_report_firstname1"<?php echo $Page->firstname1->ViewAttributes() ?>><?php echo $Page->firstname1->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->lastname1->Visible) { ?>
		<td data-field="lastname1"<?php echo $Page->lastname1->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->RecCount ?>_<?php echo $Page->RecCount ?>_report_lastname1"<?php echo $Page->lastname1->ViewAttributes() ?>><?php echo $Page->lastname1->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->password3->Visible) { ?>
		<td data-field="password3"<?php echo $Page->password3->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->RecCount ?>_<?php echo $Page->RecCount ?>_report_password3"<?php echo $Page->password3->ViewAttributes() ?>><?php echo $Page->password3->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->datetime1->Visible) { ?>
		<td data-field="datetime1"<?php echo $Page->datetime1->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->RecCount ?>_<?php echo $Page->RecCount ?>_report_datetime1"<?php echo $Page->datetime1->ViewAttributes() ?>><?php echo $Page->datetime1->ListViewValue() ?></span></td>
<?php } ?>
	</tr>
<?php

		// Accumulate page summary
		$Page->AccumulateSummary();

		// Get next record
		$Page->GetRow(2);
	$Page->GrpCount++;
} // End while
?>
<?php if ($Page->TotalGrps > 0) { ?>
</tbody>
<tfoot>
	</tfoot>
<?php } elseif (!$Page->ShowHeader && FALSE) { // No header displayed ?>
<?php if ($Page->Export <> "pdf") { ?>
<?php if ($Page->Export == "word" || $Page->Export == "excel") { ?>
<div class="ewGrid"<?php echo $Page->ReportTableStyle ?>>
<?php } else { ?>
<div class="panel panel-default ewGrid"<?php echo $Page->ReportTableStyle ?>>
<?php } ?>
<?php } ?>
<!-- Report grid (begin) -->
<?php if ($Page->Export <> "pdf") { ?>
<div class="<?php if (ewr_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<?php } ?>
<table class="<?php echo $Page->ReportTableClass ?>">
<?php } ?>
<?php if ($Page->TotalGrps > 0 || FALSE) { // Show footer ?>
</table>
<?php if ($Page->Export <> "pdf") { ?>
</div>
<?php } ?>
<?php if ($Page->Export == "" && !($Page->DrillDown && $Page->TotalGrps > 0)) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php include "reportrptpager.php" ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($Page->Export <> "pdf") { ?>
</div>
<?php } ?>
<?php } ?>
<?php if ($Page->Export <> "pdf") { ?>
</div>
<?php } ?>
<!-- Summary Report Ends -->
<?php if ($Page->Export == "") { ?>
	</div>
	<!-- center container - report (end) -->
	<!-- right container (begin) -->
	<div id="ewRight" class="ewRight">
<?php } ?>
	<!-- Right slot -->
<?php if ($Page->Export == "") { ?>
	</div>
	<!-- right container (end) -->
<div class="clearfix"></div>
<!-- bottom container (begin) -->
<div id="ewBottom" class="ewBottom">
<?php } ?>
	<!-- Bottom slot -->
<?php if ($Page->Export == "") { ?>
	</div>
<!-- Bottom Container (End) -->
</div>
<!-- Table Container (End) -->
<?php } ?>
<?php $Page->ShowPageFooter(); ?>
<?php if (EWR_DEBUG_ENABLED) echo ewr_DebugMsg(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($Page->Export == "" && !$Page->DrillDown) { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "phprptinc/footer.php" ?>
<?php
$Page->Page_Terminate();
if (isset($OldPage)) $Page = $OldPage;
?>
