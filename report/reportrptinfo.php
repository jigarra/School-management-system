<?php

// Global variable for table object
$report = NULL;

//
// Table class for report
//
class crreport extends crTableBase {
	var $ShowGroupHeaderAsRow = FALSE;
	var $ShowCompactSummaryFooter = TRUE;
	var $ID;
	var $fname;
	var $lname;
	var $_email;
	var $address;
	var $password;
	var $bdate;
	var $mobileno;
	var $Updatetime;
	var $ID1;
	var $name;
	var $email1;
	var $password1;
	var $date;
	var $ID2;
	var $firstname;
	var $lastname;
	var $password2;
	var $datetime;
	var $ID3;
	var $firstname1;
	var $lastname1;
	var $password3;
	var $datetime1;

	//
	// Table class constructor
	//
	function __construct() {
		global $ReportLanguage, $gsLanguage;
		$this->TableVar = 'report';
		$this->TableName = 'report';
		$this->TableType = 'VIEW';
		$this->DBID = 'DB';
		$this->ExportAll = FALSE;
		$this->ExportPageBreakCount = 0;

		// ID
		$this->ID = new crField('report', 'report', 'x_ID', 'ID', '`ID`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->ID->Sortable = TRUE; // Allow sort
		$this->ID->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['ID'] = &$this->ID;
		$this->ID->DateFilter = "";
		$this->ID->SqlSelect = "";
		$this->ID->SqlOrderBy = "";

		// fname
		$this->fname = new crField('report', 'report', 'x_fname', 'fname', '`fname`', 200, EWR_DATATYPE_STRING, -1);
		$this->fname->Sortable = TRUE; // Allow sort
		$this->fields['fname'] = &$this->fname;
		$this->fname->DateFilter = "";
		$this->fname->SqlSelect = "";
		$this->fname->SqlOrderBy = "";

		// lname
		$this->lname = new crField('report', 'report', 'x_lname', 'lname', '`lname`', 200, EWR_DATATYPE_STRING, -1);
		$this->lname->Sortable = TRUE; // Allow sort
		$this->fields['lname'] = &$this->lname;
		$this->lname->DateFilter = "";
		$this->lname->SqlSelect = "";
		$this->lname->SqlOrderBy = "";

		// email
		$this->_email = new crField('report', 'report', 'x__email', 'email', '`email`', 200, EWR_DATATYPE_STRING, -1);
		$this->_email->Sortable = TRUE; // Allow sort
		$this->fields['email'] = &$this->_email;
		$this->_email->DateFilter = "";
		$this->_email->SqlSelect = "";
		$this->_email->SqlOrderBy = "";

		// address
		$this->address = new crField('report', 'report', 'x_address', 'address', '`address`', 201, EWR_DATATYPE_MEMO, -1);
		$this->address->Sortable = TRUE; // Allow sort
		$this->fields['address'] = &$this->address;
		$this->address->DateFilter = "";
		$this->address->SqlSelect = "";
		$this->address->SqlOrderBy = "";

		// password
		$this->password = new crField('report', 'report', 'x_password', 'password', '`password`', 200, EWR_DATATYPE_STRING, -1);
		$this->password->Sortable = TRUE; // Allow sort
		$this->fields['password'] = &$this->password;
		$this->password->DateFilter = "";
		$this->password->SqlSelect = "";
		$this->password->SqlOrderBy = "";

		// bdate
		$this->bdate = new crField('report', 'report', 'x_bdate', 'bdate', '`bdate`', 133, EWR_DATATYPE_DATE, 0);
		$this->bdate->Sortable = TRUE; // Allow sort
		$this->bdate->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EWR_DATE_FORMAT"], $ReportLanguage->Phrase("IncorrectDate"));
		$this->fields['bdate'] = &$this->bdate;
		$this->bdate->DateFilter = "";
		$this->bdate->SqlSelect = "";
		$this->bdate->SqlOrderBy = "";

		// mobileno
		$this->mobileno = new crField('report', 'report', 'x_mobileno', 'mobileno', '`mobileno`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->mobileno->Sortable = TRUE; // Allow sort
		$this->mobileno->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['mobileno'] = &$this->mobileno;
		$this->mobileno->DateFilter = "";
		$this->mobileno->SqlSelect = "";
		$this->mobileno->SqlOrderBy = "";

		// Updatetime
		$this->Updatetime = new crField('report', 'report', 'x_Updatetime', 'Updatetime', '`Updatetime`', 133, EWR_DATATYPE_DATE, 0);
		$this->Updatetime->Sortable = TRUE; // Allow sort
		$this->Updatetime->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EWR_DATE_FORMAT"], $ReportLanguage->Phrase("IncorrectDate"));
		$this->fields['Updatetime'] = &$this->Updatetime;
		$this->Updatetime->DateFilter = "";
		$this->Updatetime->SqlSelect = "";
		$this->Updatetime->SqlOrderBy = "";

		// ID1
		$this->ID1 = new crField('report', 'report', 'x_ID1', 'ID1', '`ID1`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->ID1->Sortable = TRUE; // Allow sort
		$this->ID1->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['ID1'] = &$this->ID1;
		$this->ID1->DateFilter = "";
		$this->ID1->SqlSelect = "";
		$this->ID1->SqlOrderBy = "";

		// name
		$this->name = new crField('report', 'report', 'x_name', 'name', '`name`', 200, EWR_DATATYPE_STRING, -1);
		$this->name->Sortable = TRUE; // Allow sort
		$this->fields['name'] = &$this->name;
		$this->name->DateFilter = "";
		$this->name->SqlSelect = "";
		$this->name->SqlOrderBy = "";

		// email1
		$this->email1 = new crField('report', 'report', 'x_email1', 'email1', '`email1`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->email1->Sortable = TRUE; // Allow sort
		$this->email1->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['email1'] = &$this->email1;
		$this->email1->DateFilter = "";
		$this->email1->SqlSelect = "";
		$this->email1->SqlOrderBy = "";

		// password1
		$this->password1 = new crField('report', 'report', 'x_password1', 'password1', '`password1`', 200, EWR_DATATYPE_STRING, -1);
		$this->password1->Sortable = TRUE; // Allow sort
		$this->fields['password1'] = &$this->password1;
		$this->password1->DateFilter = "";
		$this->password1->SqlSelect = "";
		$this->password1->SqlOrderBy = "";

		// date
		$this->date = new crField('report', 'report', 'x_date', 'date', '`date`', 133, EWR_DATATYPE_DATE, 0);
		$this->date->Sortable = TRUE; // Allow sort
		$this->date->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EWR_DATE_FORMAT"], $ReportLanguage->Phrase("IncorrectDate"));
		$this->fields['date'] = &$this->date;
		$this->date->DateFilter = "";
		$this->date->SqlSelect = "";
		$this->date->SqlOrderBy = "";

		// ID2
		$this->ID2 = new crField('report', 'report', 'x_ID2', 'ID2', '`ID2`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->ID2->Sortable = TRUE; // Allow sort
		$this->ID2->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['ID2'] = &$this->ID2;
		$this->ID2->DateFilter = "";
		$this->ID2->SqlSelect = "";
		$this->ID2->SqlOrderBy = "";

		// firstname
		$this->firstname = new crField('report', 'report', 'x_firstname', 'firstname', '`firstname`', 200, EWR_DATATYPE_STRING, -1);
		$this->firstname->Sortable = TRUE; // Allow sort
		$this->fields['firstname'] = &$this->firstname;
		$this->firstname->DateFilter = "";
		$this->firstname->SqlSelect = "";
		$this->firstname->SqlOrderBy = "";

		// lastname
		$this->lastname = new crField('report', 'report', 'x_lastname', 'lastname', '`lastname`', 200, EWR_DATATYPE_STRING, -1);
		$this->lastname->Sortable = TRUE; // Allow sort
		$this->fields['lastname'] = &$this->lastname;
		$this->lastname->DateFilter = "";
		$this->lastname->SqlSelect = "";
		$this->lastname->SqlOrderBy = "";

		// password2
		$this->password2 = new crField('report', 'report', 'x_password2', 'password2', '`password2`', 200, EWR_DATATYPE_STRING, -1);
		$this->password2->Sortable = TRUE; // Allow sort
		$this->fields['password2'] = &$this->password2;
		$this->password2->DateFilter = "";
		$this->password2->SqlSelect = "";
		$this->password2->SqlOrderBy = "";

		// datetime
		$this->datetime = new crField('report', 'report', 'x_datetime', 'datetime', '`datetime`', 133, EWR_DATATYPE_DATE, 0);
		$this->datetime->Sortable = TRUE; // Allow sort
		$this->datetime->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EWR_DATE_FORMAT"], $ReportLanguage->Phrase("IncorrectDate"));
		$this->fields['datetime'] = &$this->datetime;
		$this->datetime->DateFilter = "";
		$this->datetime->SqlSelect = "";
		$this->datetime->SqlOrderBy = "";

		// ID3
		$this->ID3 = new crField('report', 'report', 'x_ID3', 'ID3', '`ID3`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->ID3->Sortable = TRUE; // Allow sort
		$this->ID3->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['ID3'] = &$this->ID3;
		$this->ID3->DateFilter = "";
		$this->ID3->SqlSelect = "";
		$this->ID3->SqlOrderBy = "";

		// firstname1
		$this->firstname1 = new crField('report', 'report', 'x_firstname1', 'firstname1', '`firstname1`', 200, EWR_DATATYPE_STRING, -1);
		$this->firstname1->Sortable = TRUE; // Allow sort
		$this->fields['firstname1'] = &$this->firstname1;
		$this->firstname1->DateFilter = "";
		$this->firstname1->SqlSelect = "";
		$this->firstname1->SqlOrderBy = "";

		// lastname1
		$this->lastname1 = new crField('report', 'report', 'x_lastname1', 'lastname1', '`lastname1`', 200, EWR_DATATYPE_STRING, -1);
		$this->lastname1->Sortable = TRUE; // Allow sort
		$this->fields['lastname1'] = &$this->lastname1;
		$this->lastname1->DateFilter = "";
		$this->lastname1->SqlSelect = "";
		$this->lastname1->SqlOrderBy = "";

		// password3
		$this->password3 = new crField('report', 'report', 'x_password3', 'password3', '`password3`', 200, EWR_DATATYPE_STRING, -1);
		$this->password3->Sortable = TRUE; // Allow sort
		$this->fields['password3'] = &$this->password3;
		$this->password3->DateFilter = "";
		$this->password3->SqlSelect = "";
		$this->password3->SqlOrderBy = "";

		// datetime1
		$this->datetime1 = new crField('report', 'report', 'x_datetime1', 'datetime1', '`datetime1`', 133, EWR_DATATYPE_DATE, 0);
		$this->datetime1->Sortable = TRUE; // Allow sort
		$this->datetime1->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EWR_DATE_FORMAT"], $ReportLanguage->Phrase("IncorrectDate"));
		$this->fields['datetime1'] = &$this->datetime1;
		$this->datetime1->DateFilter = "";
		$this->datetime1->SqlSelect = "";
		$this->datetime1->SqlOrderBy = "";
	}

	// Set Field Visibility
	function SetFieldVisibility($fldparm) {
		global $Security;
		return $this->$fldparm->Visible; // Returns original value
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			if ($ofld->GroupingFieldId == 0)
				$this->setDetailOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			if ($ofld->GroupingFieldId == 0) $ofld->setSort("");
		}
	}

	// Get Sort SQL
	function SortSql() {
		$sDtlSortSql = $this->getDetailOrderBy(); // Get ORDER BY for detail fields from session
		$argrps = array();
		foreach ($this->fields as $fld) {
			if ($fld->getSort() <> "") {
				$fldsql = $fld->FldExpression;
				if ($fld->GroupingFieldId > 0) {
					if ($fld->FldGroupSql <> "")
						$argrps[$fld->GroupingFieldId] = str_replace("%s", $fldsql, $fld->FldGroupSql) . " " . $fld->getSort();
					else
						$argrps[$fld->GroupingFieldId] = $fldsql . " " . $fld->getSort();
				}
			}
		}
		$sSortSql = "";
		foreach ($argrps as $grp) {
			if ($sSortSql <> "") $sSortSql .= ", ";
			$sSortSql .= $grp;
		}
		if ($sDtlSortSql <> "") {
			if ($sSortSql <> "") $sSortSql .= ", ";
			$sSortSql .= $sDtlSortSql;
		}
		return $sSortSql;
	}

	// Table level SQL
	// From

	var $_SqlFrom = "";

	function getSqlFrom() {
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`report`";
	}

	function SqlFrom() { // For backward compatibility
		return $this->getSqlFrom();
	}

	function setSqlFrom($v) {
		$this->_SqlFrom = $v;
	}

	// Select
	var $_SqlSelect = "";

	function getSqlSelect() {
		return ($this->_SqlSelect <> "") ? $this->_SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}

	function SqlSelect() { // For backward compatibility
		return $this->getSqlSelect();
	}

	function setSqlSelect($v) {
		$this->_SqlSelect = $v;
	}

	// Where
	var $_SqlWhere = "";

	function getSqlWhere() {
		$sWhere = ($this->_SqlWhere <> "") ? $this->_SqlWhere : "";
		return $sWhere;
	}

	function SqlWhere() { // For backward compatibility
		return $this->getSqlWhere();
	}

	function setSqlWhere($v) {
		$this->_SqlWhere = $v;
	}

	// Group By
	var $_SqlGroupBy = "";

	function getSqlGroupBy() {
		return ($this->_SqlGroupBy <> "") ? $this->_SqlGroupBy : "";
	}

	function SqlGroupBy() { // For backward compatibility
		return $this->getSqlGroupBy();
	}

	function setSqlGroupBy($v) {
		$this->_SqlGroupBy = $v;
	}

	// Having
	var $_SqlHaving = "";

	function getSqlHaving() {
		return ($this->_SqlHaving <> "") ? $this->_SqlHaving : "";
	}

	function SqlHaving() { // For backward compatibility
		return $this->getSqlHaving();
	}

	function setSqlHaving($v) {
		$this->_SqlHaving = $v;
	}

	// Order By
	var $_SqlOrderBy = "";

	function getSqlOrderBy() {
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "";
	}

	function SqlOrderBy() { // For backward compatibility
		return $this->getSqlOrderBy();
	}

	function setSqlOrderBy($v) {
		$this->_SqlOrderBy = $v;
	}

	// Select Aggregate
	var $_SqlSelectAgg = "";

	function getSqlSelectAgg() {
		return ($this->_SqlSelectAgg <> "") ? $this->_SqlSelectAgg : "SELECT * FROM " . $this->getSqlFrom();
	}

	function SqlSelectAgg() { // For backward compatibility
		return $this->getSqlSelectAgg();
	}

	function setSqlSelectAgg($v) {
		$this->_SqlSelectAgg = $v;
	}

	// Aggregate Prefix
	var $_SqlAggPfx = "";

	function getSqlAggPfx() {
		return ($this->_SqlAggPfx <> "") ? $this->_SqlAggPfx : "";
	}

	function SqlAggPfx() { // For backward compatibility
		return $this->getSqlAggPfx();
	}

	function setSqlAggPfx($v) {
		$this->_SqlAggPfx = $v;
	}

	// Aggregate Suffix
	var $_SqlAggSfx = "";

	function getSqlAggSfx() {
		return ($this->_SqlAggSfx <> "") ? $this->_SqlAggSfx : "";
	}

	function SqlAggSfx() { // For backward compatibility
		return $this->getSqlAggSfx();
	}

	function setSqlAggSfx($v) {
		$this->_SqlAggSfx = $v;
	}

	// Select Count
	var $_SqlSelectCount = "";

	function getSqlSelectCount() {
		return ($this->_SqlSelectCount <> "") ? $this->_SqlSelectCount : "SELECT COUNT(*) FROM " . $this->getSqlFrom();
	}

	function SqlSelectCount() { // For backward compatibility
		return $this->getSqlSelectCount();
	}

	function setSqlSelectCount($v) {
		$this->_SqlSelectCount = $v;
	}

	// Sort URL
	function SortUrl(&$fld) {
		return "";
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld) {
		global $gsLanguage;
		switch ($fld->FldVar) {
		}
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld) {
		global $gsLanguage;
		switch ($fld->FldVar) {
		}
	}

	// Table level events
	// Page Selecting event
	function Page_Selecting(&$filter) {

		// Enter your code here
	}

	// Page Breaking event
	function Page_Breaking(&$break, &$content) {

		// Example:
		//$break = FALSE; // Skip page break, or
		//$content = "<div style=\"page-break-after:always;\">&nbsp;</div>"; // Modify page break content

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Cell Rendered event
	function Cell_Rendered(&$Field, $CurrentValue, &$ViewValue, &$ViewAttrs, &$CellAttrs, &$HrefValue, &$LinkAttrs) {

		//$ViewValue = "xxx";
		//$ViewAttrs["style"] = "xxx";

	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}

	// Load Filters event
	function Page_FilterLoad() {

		// Enter your code here
		// Example: Register/Unregister Custom Extended Filter
		//ewr_RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A', 'GetStartsWithAFilter'); // With function, or
		//ewr_RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A'); // No function, use Page_Filtering event
		//ewr_UnregisterFilter($this-><Field>, 'StartsWithA');

	}

	// Page Filter Validated event
	function Page_FilterValidated() {

		// Example:
		//$this->MyField1->SearchValue = "your search criteria"; // Search value

	}

	// Page Filtering event
	function Page_Filtering(&$fld, &$filter, $typ, $opr = "", $val = "", $cond = "", $opr2 = "", $val2 = "") {

		// Note: ALWAYS CHECK THE FILTER TYPE ($typ)! Example:
		//if ($typ == "dropdown" && $fld->FldName == "MyField") // Dropdown filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "extended" && $fld->FldName == "MyField") // Extended filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "popup" && $fld->FldName == "MyField") // Popup filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "custom" && $opr == "..." && $fld->FldName == "MyField") // Custom filter, $opr is the custom filter ID
		//	$filter = "..."; // Modify the filter

	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		// Enter your code here
	}
}
?>
