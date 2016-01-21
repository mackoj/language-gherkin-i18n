<?php

require_once('generateGlobalConfig.php');

require_once('generateGrammar.php');
require_once('generateReadme.php');
require_once('generateSettings.php');
require_once('generateLangTable.php');

// Download i18n.json
if ($useLocalI18n)
{
	$i18nFilePath = $i18nLocaleFilePath;
}
else
{
	unlink($i18nLocaleFilePath);
	$i18nFilePath = $i18nRemoteFilePath;
}

convertNewGherkinLanguagesToOldi18n($i18nFilePath);

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

// Generate LangTable artefact
list($nb_lang, $markdownTableLang) = generateLanguageTable($jsoni18nAssocArray);

// Generate Grammars
force_rmdir($grammarsDir);
mkdir($grammarsDir);
generateGrammar($jsoni18nAssocArray);

// Generate Settings
force_rmdir($settingsDir);
mkdir($settingsDir);
generateSettings($jsoni18nAssocArray);

// Update Readme
unlink($readmeFinalPath);
updateREADME($nb_lang, $markdownTableLang);

?>
