<?php

$isDefaultLangEnable = TRUE;
$smallLangKey = "__SMALLLANG__";
$smallLangWithADot = "__SMALLLANG_DOT__";
$defaultLangKey = "__DEFAULT_LANG__";
$defaultLang = "en";

$increaseIndentPatternKey = "__INCREASEINDENTPATTERNKEY__";
$increaseIndentPattern =  "'__SCENARIO__: .*'";

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

$gherkinGeneratedFilename = "language-gherkin";
$gherkinGeneratedExtension = "cson";

/// function
////////////

function addQuote($word)
{
    return("      '".$word."'");
}

function addQuote2($word)
{
    return("      '".$word.":'");
}

function cleanLine($futureRegex)
{
	global $search1, $search2, $delimiter;

	$futureRegex = str_replace($search1, "", $futureRegex);
	$futureRegex = str_replace($search2, "", $futureRegex);
	$futureRegex = str_replace("'", "\'", $futureRegex); //inhibithion
	$explodedArray = explode($delimiter, $futureRegex);
	return $explodedArray;
}

function str_replace_first($search, $replace, $subject)
{
    $pos = strpos($subject, $search);
    if ($pos !== false) {
        $subject = substr_replace($subject, $replace, $pos, strlen($search));
    }
    return $subject;
}

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
if ($useLocalI18n === FALSE)
{
	file_put_contents($i18nLocaleFilePath, $fileContent);
}
$jsoni18nAssocArray = json_decode($fileContent, TRUE);
if ($isDefaultLangEnable)
{
	$jsoni18nAssocArray[$defaultLangKey] = $jsoni18nAssocArray[$defaultLang];
}

$base_template = file_get_contents($gherkinTemplate);
$futureTemplate = array();

foreach ($jsoni18nAssocArray as $jsonKey => $jsonValue)
{
	$tmp_template = $base_template;
	$tmp_firstLineMatchLine = "";
	$tmp_template = str_replace($smallLangWithADot, (strcmp($jsonKey, $defaultLangKey) === 0 ? "" : ".".$jsonKey), $tmp_template);

	foreach ($templateKeys as $tKey => $tValue)
	{
		$explodedArray = cleanLine($jsonValue[$tValue["name"]]);
		$funcName = (strlen($tValue["separator"]) > 0 ? "addQuote2" : "addQuote");
		$explodedArray = array_map($funcName, $explodedArray);
		$tmp_str = implode(PHP_EOL, $explodedArray);
		$tmp_template = str_replace($tKey, $tmp_str, $tmp_template);
	}

	$scenarios = cleanLine($jsonValue["scenario"]);
	$multipleIncreaseIndentPatternKey = str_repeat("      ".$increaseIndentPatternKey.( count($scenarios) > 1 ? PHP_EOL : ""), count($scenarios));
	$tmp_template = str_replace($increaseIndentPatternKey, $multipleIncreaseIndentPatternKey, $tmp_template);
	$tmp_template = str_replace($increaseIndentPatternKey, $increaseIndentPattern, $tmp_template);

	foreach ($scenarios as $unScenario)
	{
		$tmp_template = str_replace_first("__SCENARIO__", $unScenario, $tmp_template);
	}

	$futureTemplate[$jsonKey] = $tmp_template;
}

$gherkinPathInfo = pathinfo($gherkinTemplate);
foreach ($futureTemplate as $keyLang => $langTemplateContent)
{
	$dirname = $gherkinPathInfo['dirname'];
	$tmpFilename = "";
	if (strcmp($keyLang, $defaultLangKey) !== 0)
	{
		$tmpFilename = $dirname . "/scoped-properties/" . $gherkinGeneratedFilename . "_" . $keyLang . "." . $gherkinGeneratedExtension;
	}
	else
	{
		$tmpFilename = $dirname . "/scoped-properties/" . $gherkinGeneratedFilename . "." . $gherkinGeneratedExtension;
	}
	file_put_contents($tmpFilename, $langTemplateContent);
}

?>
