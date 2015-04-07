<?php

$langKey = "__LANG__";
$templateKeys = [ 
	"__FEATURE__" => [ "name" => "feature", "separator" => "\\:|" ],
	"__BACKGROUND__" => "background",
	"__SCENARIO__" => "scenario",
	"__SCENARIO__OUTLINE__" => "scenario_outline",
	"__EXAMPLES__" => "examples",
	"__GIVEN__" => "given",
	"__WHEN__" => "when",
	"__THEN__" => "then",
	"__BUT__" => "but",
	"__AND__" => "and",
];
$gherkinTemplate = dirname(__FILE__) . "/grammars/gherkin_template.cson";

$i18nRemoteFilePath = "https://github.com/cucumber/gherkin/blob/master/lib/gherkin/i18n.json";
// $cleaner = "^\*(.*)<?$";
$delimiter = "|";
$search1 = "*|";
$search2 = "<";

$gherkinGeneratedFilename = "gherkin_";
$gherkinGeneratedExtension = "cson";

/// FUGLY ASS SCRIPT
////////////////////

$fileContent  = file_get_contents($i18nRemoteFilePath);
$jsoni18nAssocArray = json_decode($fileContent, TRUE);
$base_template = file_get_contents($gherkinTemplate);
$futureTemplate = array();
$gherkinPathInfo = pathinfo($gherkinTemplate);

foreach ($jsoni18nAssocArray as $jsonKey => $jsonValue) 
{
	$tmp_template = $base_template;
	$tmp_template = $futureTemplate[$jsonKey];
	$tmp_template = str_replace($langKey, $jsonKey, $tmp_template);
	foreach ($templateKeys as $tKey => $tValue) 
	{
		$futureRegex = $jsonValue[$tValue];
		$futureRegex = str_replace($futureRegex, $search1);
		$futureRegex = str_replace($futureRegex, $search2);
		$explodedArray = explode($delimiter, $futureRegex);
		foreach ($explodedArray as $explodedValue) 
		{
			$tmp_template = str_replace($tKey, $explodedValue, $tmp_template);
		}
	}
	$futureTemplate[$jsonKey] = $tmp_template;
}

foreach ($futureTemplate as $keyLang => $langTemplateContent) 
{
	$dirname = $gherkinPathInfo['dirname'];
	$tmpFilename = $dirname . "/" . $gherkinGeneratedFilename . $keyLang . "." . $gherkinGeneratedExtension;
	file_put_contents($tmpFilename, $langTemplateContent);
}

?>
