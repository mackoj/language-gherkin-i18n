<?php

error_reporting(-1);

require_once('generateGlobalConfig.php');
require_once('generateSharedFunctions.php');

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

?>
