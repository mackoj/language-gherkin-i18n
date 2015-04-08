<?php

$templateKeys = [
	"__FEATURE__" => [ "name" => "feature", "separator" => ":" ],
	"__BACKGROUND__" => [ "name" => "background", "separator" => ":" ],
	"__SCENARIO__" => [ "name" => "scenario", "separator" => ":" ],
	"__SCENARIOOUTLINE__" => [ "name" => "scenario_outline", "separator" => ":" ],
	"__EXAMPLES__" => [ "name" => "examples", "separator" => ":" ],
	"__GIVEN__" => [ "name" => "given", "separator" => "" ],
	"__WHEN__" => [ "name" => "when", "separator" => "" ],
	"__THEN__" => [ "name" => "then", "separator" => "" ],
	"__BUT__" => [ "name" => "but", "separator" => "" ],
	"__AND__" => [ "name" => "and", "separator" => "" ],
];
$gherkinTemplate = dirname(__FILE__) . "/gherkin_settings_template.cson";

$useLocalI18n = TRUE;
$i18nLocaleFilePath = dirname(__FILE__) . "/i18n.json";
$i18nRemoteFilePath =  "https://raw.githubusercontent.com/cucumber/gherkin/master/lib/gherkin/i18n.json";

$delimiter = "|";
$search1 = "*|";
$search2 = "<";

$gherkinGeneratedBasename = dirname(__FILE__) ."/settings/language-gherkin.cson";

/// FUGLY ASS SCRIPT
////////////////////

if ($useLocalI18n)
{
	$i18nFilePath = $i18nLocaleFilePath;
}
else
{
	$i18nFilePath = $i18nRemoteFilePath;
}

$fileContent  = file_get_contents($i18nFilePath);
$jsoni18nAssocArray = json_decode($fileContent, TRUE);

$base_template = file_get_contents($gherkinTemplate);
$futureTemplate = array();

foreach ($jsoni18nAssocArray as $jsonKey => $jsonValue)
{
	$tmp_template = $base_template;
	$tmp_firstLineMatchLine = "";
	
	foreach ($templateKeys as $tKey => $tValue)
	{
		$futureRegex = $jsonValue[$tValue["name"]];
		$futureRegex = str_replace($search1, "", $futureRegex);
		$futureRegex = str_replace($search2, "", $futureRegex);
		$futureRegex = str_replace("'", "\'", $futureRegex); //inhibithion
		$explodedArray = explode($delimiter, $futureRegex);
		$tmp_str = implode($tValue["separator"].PHP_EOL, array_map("addQuote", $explodedArray));
		$tmp_template = str_replace($tKey, $tmp_str, $tmp_template);
	}
	$futureTemplate[] = $tmp_template;
}

file_put_contents($gherkinGeneratedBasename, $futureTemplate);

function addQuote($word)
{
    return("'".$word."'");
}


?>
