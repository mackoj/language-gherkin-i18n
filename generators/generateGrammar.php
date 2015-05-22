<?php

error_reporting(-1);

require_once('generateGlobalConfig.php');
require_once('generateSharedFunctions.php');


/// main
////////
function generateLanguageTable($jsoni18nAssocArray)
{

	global $langTableFileMarkdownColumns, $langTableFileMarkdown, $defaultLangKey;

	$markdownTableLang  = "|Language Name(English)|Language Name(Native)|langID|\n";
	$markdownTableLang .= "|----------------------|---------------------|------|\n";
	$markdownTableContent = array();

	$counter = 0;

	foreach ($jsoni18nAssocArray as $jsonKey => $jsonValue)
	{
		if (strcmp($jsonKey, $defaultLangKey) != 0)
		{
			$counter++;
			$markdownTableContent[] = "|".$jsonValue[$langTableFileMarkdownColumns[0]]."|".$jsonValue[$langTableFileMarkdownColumns[1]]."|".$jsonKey."|";
		}
	}
	sort($markdownTableContent);

	$markdownTableLang .= implode("\n", $markdownTableContent);
	file_put_contents($langTableFileMarkdown, $markdownTableLang);

	return ([$counter, $markdownTableLang]);
}

function generateGrammar($jsoni18nAssocArray)
{

	global $defaultLangKey, $finalGrammarGeneratedExtension, $finalGrammarGeneratedFilename, $firstLineMatchLine, $grammarTemplate, $langKey, $smallLangKey, $smallLangWithADot, $grammarTemplateKeys, $search1, $search2, $delimiter, $grammarsDirName;

	$base_template = file_get_contents($grammarTemplate);
	$futureTemplate = array();

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

		$tmp_template = str_replace($smallLangKey, (strcmp($jsonKey, $defaultLangKey) === 0 ? "" : "-".$jsonKey), $tmp_template);
		$tmp_template = str_replace($smallLangWithADot, (strcmp($jsonKey, $defaultLangKey) === 0 ? "" : ".".$jsonKey), $tmp_template);

		foreach ($grammarTemplateKeys as $tKey => $tValue)
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

	$gherkinPathInfo = pathinfo($grammarTemplate);
	foreach ($futureTemplate as $keyLang => $langTemplateContent)
	{
		$dirname = $gherkinPathInfo['dirname'];
		$tmpFilename = "";
		if (strcmp($keyLang, $defaultLangKey) !== 0)
		{
			$tmpFilename = $dirname . "/../" . $grammarsDirName . $finalGrammarGeneratedFilename . "_" . $keyLang . "." . $finalGrammarGeneratedExtension;
		}
		else
		{
			$tmpFilename = $dirname . "/../" . $grammarsDirName . $finalGrammarGeneratedFilename . "." . $finalGrammarGeneratedExtension;
		}
		file_put_contents($tmpFilename, $langTemplateContent);
	}

}

?>
