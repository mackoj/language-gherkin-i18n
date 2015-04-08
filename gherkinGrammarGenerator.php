<?php

$langKey = "__LANG__";

$isDefaultLangEnable = FALSE;
$smallLangKey = "__SMALL_LANG__";
$defaultLangKey = "__DEFAULT_LANG__";
$defaultLang = "en";

$firstLineMatchLine = "'firstLineMatch' : '^(.*)\\s*__LANG__$'";
$templateKeys = [ 
	"__FEATURE__" => [ "name" => "feature"],
	"__BACKGROUND__" => [ "name" => "background"],
	"__SCENARIO__" => [ "name" => "scenario"],
	"__SCENARIO__OUTLINE__" => [ "name" => "scenario_outline"],
	"__EXAMPLES__" => [ "name" => "examples"],
	"__GIVEN__" => [ "name" => "given"],
	"__WHEN__" => [ "name" => "when"],
	"__THEN__" => [ "name" => "then"],
	"__BUT__" => [ "name" => "but"],
	"__AND__" => [ "name" => "and"],
];

$gherkinTemplate = dirname(__FILE__) . "/gherkin_settings_template.cson";

$useLocalI18n = TRUE;
$i18nLocaleFilePath = dirname(__FILE__) . "/i18n.json";
$i18nRemoteFilePath =  "https://raw.githubusercontent.com/cucumber/gherkin/master/lib/gherkin/i18n.json";

$delimiter = "|";
$search1 = "*|";
$search2 = "<";

$gherkinGeneratedBasename = "/settings/language-gherkin.cson";

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
$futureTemplate = "";

foreach ($jsoni18nAssocArray as $jsonKey => $jsonValue) 
{
	$tmp_template = $base_template;
	$tmp_firstLineMatchLine = "";
			
	if (strcmp($jsonKey, $defaultLangKey) !== 0) 
	{
		$tmp_firstLineMatchLine = str_replace($langKey, $jsonKey, $firstLineMatchLine);
		$tmp_template = str_replace($langKey, $tmp_firstLineMatchLine, $tmp_template);
	}
	else
	{
		$tmp_template = str_replace($langKey.PHP_EOL, $tmp_firstLineMatchLine, $tmp_template);
	}

	$tmp_template = str_replace($smallLangKey, (strcmp($jsonKey, $defaultLangKey) === 0 ? $defaultLang : $jsonKey), $tmp_template);
		
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
	$markdownTableLang .= "|".$jsonValue[$langTableFileMarkdownColumns[0]]."|".$jsonValue[$langTableFileMarkdownColumns[1]]."|\n";
}


$gherkinPathInfo = pathinfo($gherkinTemplate);
foreach ($futureTemplate as $keyLang => $langTemplateContent) 
{
	$dirname = $gherkinPathInfo['dirname'];
	$tmpFilename = $dirname . $gherkinGeneratedBasename;
	file_put_contents($tmpFilename, $langTemplateContent);
}

?>
