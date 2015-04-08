<?php

/// conf variables
//////////////////

$langKey = "__LANG__";

$isDefaultLangEnable = TRUE;
$smallLangKey = "__SMALLLANG__";
$smallLangWithADot = "__SMALLLANG_DOT__";
$defaultLangKey = "__DEFAULT_LANG__";
$defaultLang = "en";

$firstLineMatchLine = "'firstLineMatch' : '^(.*)\\s*__LANG__$'";
$templateKeys = [
	"__FEATURE__" => [ "name" => "feature", "separator" => "\\\\:|" ],
	"__BACKGROUND__" => [ "name" => "background", "separator" => "\\\\:|" ],
	"__SCENARIO__" => [ "name" => "scenario", "separator" => "\\\\:|" ],
	"__SCENARIOOUTLINE__" => [ "name" => "scenario_outline", "separator" => "\\\\:|" ],
	"__EXAMPLES__" => [ "name" => "examples", "separator" => "\\\\:|" ],
	"__GIVEN__" => [ "name" => "given", "separator" => "|" ],
	"__WHEN__" => [ "name" => "when", "separator" => "|" ],
	"__THEN__" => [ "name" => "then", "separator" => "|" ],
	"__BUT__" => [ "name" => "but", "separator" => "|" ],
	"__AND__" => [ "name" => "and", "separator" => "|" ],
];
$gherkinTemplate = dirname(__FILE__) . "/gherkin_grammar_template.cson";

$useLocalI18n = TRUE;
$i18nLocaleFilePath = dirname(__FILE__) . "/i18n.json";
$i18nRemoteFilePath =  "https://raw.githubusercontent.com/cucumber/gherkin/master/lib/gherkin/i18n.json";

$delimiter = "|";
$search1 = "*|";
$search2 = "<";

$gherkinGeneratedFilename = "gherkin";
$gherkinGeneratedExtension = "cson";

$langTableFileMarkdown = dirname(__FILE__) . "/langTable.md";
$langTableFileMarkdownColumns = [ "name", "native" ];

/// main
////////

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
if ($isDefaultLangEnable)
{
	$jsoni18nAssocArray[$defaultLangKey] = $jsoni18nAssocArray[$defaultLang];
}

$base_template = file_get_contents($gherkinTemplate);
$futureTemplate = array();

$markdownTableLang = "|".$langTableFileMarkdownColumns[0]."|".$langTableFileMarkdownColumns[1]."|Lang ID|\n";
$markdownTableLang .= "|".str_repeat("-", strlen($langTableFileMarkdownColumns[0]))."|".str_repeat("-", strlen($langTableFileMarkdownColumns[1]))."|-------|\n";

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
	$tmp_template = str_replace($smallLangWithADot, (strcmp($jsonKey, $defaultLangKey) === 0 ? "" : ".".$jsonKey), $tmp_template);

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
	$markdownTableLang .= "|".$jsonValue[$langTableFileMarkdownColumns[0]]."|".$jsonValue[$langTableFileMarkdownColumns[1]]."|".$jsonKey."|\n";
}


$gherkinPathInfo = pathinfo($gherkinTemplate);
foreach ($futureTemplate as $keyLang => $langTemplateContent)
{
	$dirname = $gherkinPathInfo['dirname'];
	$tmpFilename = "";
	if (strcmp($keyLang, $defaultLangKey) !== 0)
	{
		$tmpFilename = $dirname . "/grammars/" . $gherkinGeneratedFilename . "_" . $keyLang . "." . $gherkinGeneratedExtension;
	}
	else
	{
		$tmpFilename = $dirname . "/grammars/" . $gherkinGeneratedFilename . "." . $gherkinGeneratedExtension;
	}
	file_put_contents($tmpFilename, $langTemplateContent);
}

file_put_contents($langTableFileMarkdown, $markdownTableLang);


?>
