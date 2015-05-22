<?php

error_reporting(-1);

require_once('generateGlobalConfig.php');
require_once('generateSharedFunctions.php');


function generateSettings($jsoni18nAssocArray)
{
	global $settingsTemplate, $smallLangWithADot, $defaultLangKey, $finalSettingsGeneratedExtension, $finalSettingsGeneratedFilename, $increaseIndentPattern, $increaseIndentPatternKey, $settingsTemplate, $settingsTemplateKeys, $settingsDirName;

	$base_template = file_get_contents($settingsTemplate);
	$futureTemplate = array();

	foreach ($jsoni18nAssocArray as $jsonKey => $jsonValue)
	{
		$tmp_template = $base_template;
		$tmp_firstLineMatchLine = "";
		$tmp_template = str_replace($smallLangWithADot, (strcmp($jsonKey, $defaultLangKey) === 0 ? "" : ".".$jsonKey), $tmp_template);

		foreach ($settingsTemplateKeys as $tKey => $tValue)
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

	$gherkinPathInfo = pathinfo($settingsTemplate);
	foreach ($futureTemplate as $keyLang => $langTemplateContent)
	{
		$dirname = $gherkinPathInfo['dirname'];
		$tmpFilename = "";
		if (strcmp($keyLang, $defaultLangKey) !== 0)
		{
			$tmpFilename = $dirname . "/../" . $settingsDirName . $finalSettingsGeneratedFilename . "_" . $keyLang . "." . $finalSettingsGeneratedExtension;
		}
		else
		{
			$tmpFilename = $dirname . "/../" . $settingsDirName . $finalSettingsGeneratedFilename . "." . $finalSettingsGeneratedExtension;
		}
		file_put_contents($tmpFilename, $langTemplateContent);
	}
}

?>
