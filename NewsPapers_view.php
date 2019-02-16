<?php
// This script and data application were generated by AppGini 5.70
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/NewsPapers.php");
	include("$currDir/NewsPapers_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('NewsPapers');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "NewsPapers";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`NewsPapers`.`id`" => "id",
		"`NewsPapers`.`Language`" => "Language",
		"`NewsPapers`.`Name`" => "Name",
		"if(`NewsPapers`.`Date_Of_Receipt`,date_format(`NewsPapers`.`Date_Of_Receipt`,'%m/%d/%Y'),'')" => "Date_Of_Receipt",
		"if(`NewsPapers`.`Date_Published`,date_format(`NewsPapers`.`Date_Published`,'%m/%d/%Y'),'')" => "Date_Published",
		"`NewsPapers`.`Pages`" => "Pages",
		"`NewsPapers`.`Price`" => "Price",
		"`NewsPapers`.`Type`" => "Type",
		"`NewsPapers`.`Publisher`" => "Publisher"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`NewsPapers`.`id`',
		2 => 2,
		3 => 3,
		4 => '`NewsPapers`.`Date_Of_Receipt`',
		5 => '`NewsPapers`.`Date_Published`',
		6 => '`NewsPapers`.`Pages`',
		7 => '`NewsPapers`.`Price`',
		8 => 8,
		9 => 9
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`NewsPapers`.`id`" => "id",
		"`NewsPapers`.`Language`" => "Language",
		"`NewsPapers`.`Name`" => "Name",
		"if(`NewsPapers`.`Date_Of_Receipt`,date_format(`NewsPapers`.`Date_Of_Receipt`,'%m/%d/%Y'),'')" => "Date_Of_Receipt",
		"if(`NewsPapers`.`Date_Published`,date_format(`NewsPapers`.`Date_Published`,'%m/%d/%Y'),'')" => "Date_Published",
		"`NewsPapers`.`Pages`" => "Pages",
		"`NewsPapers`.`Price`" => "Price",
		"`NewsPapers`.`Type`" => "Type",
		"`NewsPapers`.`Publisher`" => "Publisher"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`NewsPapers`.`id`" => "ID",
		"`NewsPapers`.`Language`" => "Language",
		"`NewsPapers`.`Name`" => "Name",
		"`NewsPapers`.`Date_Of_Receipt`" => "Date Of Receipt",
		"`NewsPapers`.`Date_Published`" => "Date Published",
		"`NewsPapers`.`Pages`" => "Pages",
		"`NewsPapers`.`Price`" => "Price",
		"`NewsPapers`.`Type`" => "Type",
		"`NewsPapers`.`Publisher`" => "Publisher"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`NewsPapers`.`id`" => "id",
		"`NewsPapers`.`Language`" => "Language",
		"`NewsPapers`.`Name`" => "Name",
		"if(`NewsPapers`.`Date_Of_Receipt`,date_format(`NewsPapers`.`Date_Of_Receipt`,'%m/%d/%Y'),'')" => "Date_Of_Receipt",
		"if(`NewsPapers`.`Date_Published`,date_format(`NewsPapers`.`Date_Published`,'%m/%d/%Y'),'')" => "Date_Published",
		"`NewsPapers`.`Pages`" => "Pages",
		"`NewsPapers`.`Price`" => "Price",
		"`NewsPapers`.`Type`" => "Type",
		"`NewsPapers`.`Publisher`" => "Publisher"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array();

	$x->QueryFrom = "`NewsPapers` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm[2]==0 ? 1 : 0);
	$x->AllowDelete = $perm[4];
	$x->AllowMassDelete = true;
	$x->AllowInsert = $perm[1];
	$x->AllowUpdate = $perm[3];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 0;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = 1;
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 10;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation["quick search"];
	$x->ScriptFileName = "NewsPapers_view.php";
	$x->RedirectAfterInsert = "NewsPapers_view.php?SelectedID=#ID#";
	$x->TableTitle = "NewsPapers";
	$x->TableIcon = "resources/table_icons/curriculum_vitae.png";
	$x->PrimaryKey = "`NewsPapers`.`id`";

	$x->ColWidth   = array(  150, 150, 150, 150, 150, 80, 150, 150);
	$x->ColCaption = array("Language", "Name", "Date Of Receipt", "Date Published", "Pages", "Price", "Type", "Publisher");
	$x->ColFieldName = array('Language', 'Name', 'Date_Of_Receipt', 'Date_Published', 'Pages', 'Price', 'Type', 'Publisher');
	$x->ColNumber  = array(2, 3, 4, 5, 6, 7, 8, 9);

	// template paths below are based on the app main directory
	$x->Template = 'templates/NewsPapers_templateTV.html';
	$x->SelectedTemplate = 'templates/NewsPapers_templateTVS.html';
	$x->TemplateDV = 'templates/NewsPapers_templateDV.html';
	$x->TemplateDVP = 'templates/NewsPapers_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->ShowRecordSlots = 0;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `NewsPapers`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='NewsPapers' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `NewsPapers`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='NewsPapers' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`NewsPapers`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: NewsPapers_init
	$render=TRUE;
	if(function_exists('NewsPapers_init')){
		$args=array();
		$render=NewsPapers_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: NewsPapers_header
	$headerCode='';
	if(function_exists('NewsPapers_header')){
		$args=array();
		$headerCode=NewsPapers_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: NewsPapers_footer
	$footerCode='';
	if(function_exists('NewsPapers_footer')){
		$args=array();
		$footerCode=NewsPapers_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>