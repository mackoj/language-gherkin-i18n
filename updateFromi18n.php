<?php

$langKey = "__LANG__";
$defaultFile = "__HACKED__";
$firstLineMatchLine = "'firstLineMatch' : '^(.*)\\s*__LANG__$'";
$templateKeys = [ 
	"__FEATURE__" => [ "name" => "feature", "separator" => "\\\\:|" ],
	"__BACKGROUND__" => [ "name" => "background", "separator" => "\\\\:|" ],
	"__SCENARIO__" => [ "name" => "scenario", "separator" => "\\\\:|" ],
	"__SCENARIO__OUTLINE__" => [ "name" => "scenario_outline", "separator" => "\\\\:|" ],
	"__EXAMPLES__" => [ "name" => "examples", "separator" => "\\\\:|" ],
	"__GIVEN__" => [ "name" => "given", "separator" => "|" ],
	"__WHEN__" => [ "name" => "when", "separator" => "|" ],
	"__THEN__" => [ "name" => "then", "separator" => "|" ],
	"__BUT__" => [ "name" => "but", "separator" => "|" ],
	"__AND__" => [ "name" => "and", "separator" => "|" ],
];
$gherkinTemplate = dirname(__FILE__) . "/gherkin_template.cson";

$i18nRemoteFilePath = "https://raw.githubusercontent.com/cucumber/gherkin/master/lib/gherkin/i18n.json";
// $cleaner = "^\*(.*)<?$";
$delimiter = "|";
$search1 = "*|";
$search2 = "<";

$gherkinGeneratedFilename = "gherkin";
$gherkinGeneratedExtension = "cson";

/// FUGLY ASS SCRIPT
////////////////////

$fileContent  = file_get_contents($i18nRemoteFilePath);
$jsoni18nAssocArray = json_decode($fileContent, TRUE);
$jsoni18nAssocArray[$defaultFile] = $jsoni18nAssocArray["en"];
$base_template = file_get_contents($gherkinTemplate);
$futureTemplate = array();

foreach ($jsoni18nAssocArray as $jsonKey => $jsonValue) 
{
	$tmp_template = $base_template;
	$tmp_firstLineMatchLine = "";
	if (strcmp($jsonKey, $defaultFile) !== 0) 
	{
		$tmp_firstLineMatchLine = str_replace($langKey, $jsonKey, $firstLineMatchLine);
		$tmp_template = str_replace($langKey, $tmp_firstLineMatchLine, $tmp_template);
	}
	else
	{
		$tmp_template = str_replace($langKey.PHP_EOL, $tmp_firstLineMatchLine, $tmp_template);
	}
		
	foreach ($templateKeys as $tKey => $tValue) 
	{
		$futureRegex = $jsonValue[$tValue["name"]];
		$futureRegex = str_replace($search1, "", $futureRegex);
		$futureRegex = str_replace($search2, "", $futureRegex);
		$futureRegex = str_replace("'", "\'", $futureRegex); //inhibithion
		$explodedArray = explode($delimiter, $futureRegex);
		$tmp_str = implode($tValue["separator"], $explodedArray);
		$tmp_template = str_replace($tKey, $tmp_str, $tmp_template);
	}
	$futureTemplate[$jsonKey] = $tmp_template;
}


$gherkinPathInfo = pathinfo($gherkinTemplate);
foreach ($futureTemplate as $keyLang => $langTemplateContent) 
{
	$dirname = $gherkinPathInfo['dirname'];
	$tmpFilename = "";
	if (strcmp($keyLang, $defaultFile) !== 0) 
	{
		$tmpFilename = $dirname . "/grammars/" . $gherkinGeneratedFilename . "_" . $keyLang . "." . $gherkinGeneratedExtension;
	}
	else
	{
		$tmpFilename = $dirname . "/grammars/" . $gherkinGeneratedFilename . "." . $gherkinGeneratedExtension;
	}
	file_put_contents($tmpFilename, $langTemplateContent);
}

?>
