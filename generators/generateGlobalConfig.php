<?php

// Global Configuration
$langKey = "__LANG__";
$isDefaultLangEnable = TRUE;
$defaultLangKey = "__DEFAULT_LANG__";
$defaultLang = "en";

$useLocalI18n = TRUE;
$i18nLocaleFilePath = dirname(__FILE__) . "/../tmp/gherkin-languages.json";
$i18nRemoteFilePath = "https://raw.githubusercontent.com/cucumber/cucumber/master/gherkin/gherkin-languages.json";

$delimiter = "|";
$search1 = "*|";
$search2 = "<";

$smallLangKey = "__SMALLLANG_TIRET_";
$smallLangWithADot = "__SMALLLANG_DOT__";

$templateFolder = "/template";

// Grammar
$firstLineMatchLine = "'firstLineMatch' : '\\#( +)?language\\:( +)?__LANG__'";

$grammarTemplateKeys = [
	"__FEATURE__" => [ "name" => "feature", "separator" => "\\\\:|" ],
	"__BACKGROUND__" => [ "name" => "background", "separator" => "\\\\:|" ],
	"__SCENARIO__" => [ "name" => "scenario", "separator" => "\\\\:|" ],
	"__SCENARIOOUTLINE__" => [ "name" => "scenarioOutline", "separator" => "\\\\:|" ],
	"__EXAMPLES__" => [ "name" => "examples", "separator" => "\\\\:|" ],
	"__GIVEN__" => [ "name" => "given", "separator" => "|" ],
	"__WHEN__" => [ "name" => "when", "separator" => "|" ],
	"__THEN__" => [ "name" => "then", "separator" => "|" ],
	"__BUT__" => [ "name" => "but", "separator" => "|" ],
	"__AND__" => [ "name" => "and", "separator" => "|" ],
];

$grammarTemplate = dirname(__FILE__) . $templateFolder . "/gherkin_grammar_template.cson";

$finalGrammarGeneratedFilename = "gherkin";
$finalGrammarGeneratedExtension = "cson";

$langTableFileMarkdown = dirname(__FILE__) . "/../tmp/langTable.md";
$langTableFileMarkdownColumns = [ "name", "native" ];

$grammarsDirName = "/../grammars/";
$grammarsDir = dirname(__FILE__) . $grammarsDirName;

// Settings
$increaseIndentPatternKey = "__INCREASEINDENTPATTERNKEY__";
$increaseIndentPattern =  "'__SCENARIO__: .*'";

$settingsTemplateKeys = [
	"__FEATURE__" => [ "name" => "feature", "separator" => ":" ],
	"__BACKGROUND__" => [ "name" => "background", "separator" => ":" ],
	"__SCENARIO__" => [ "name" => "scenario", "separator" => ":" ],
	"__SCENARIOOUTLINE__" => [ "name" => "scenarioOutline", "separator" => ":" ],
	"__EXAMPLES__" => [ "name" => "examples", "separator" => ":" ],
	"__GIVEN__" => [ "name" => "given", "separator" => "" ],
	"__WHEN__" => [ "name" => "when", "separator" => "" ],
	"__THEN__" => [ "name" => "then", "separator" => "" ],
	"__BUT__" => [ "name" => "but", "separator" => "" ],
	"__AND__" => [ "name" => "and", "separator" => "" ],
];

$settingsDirName = "/../settings/";
$settingsDir = dirname(__FILE__) . "/../settings/";

$settingsTemplate = dirname(__FILE__) . $templateFolder . "/gherkin_settings_template.cson";

$finalSettingsGeneratedFilename  = "language-gherkin";
$finalSettingsGeneratedExtension = "cson";

// README
$readmeNumberOfLangKey = "__NB_LANG__";
$readmeLangList =  "__LANG_LIST__";
$readmeTemplate = dirname(__FILE__) . $templateFolder . "/README_template.md";
$readmeFinalPath = dirname(__FILE__) . "/../README.md";
