<?php

error_reporting(-1);

require_once('generateGlobalConfig.php');
require_once('generateSharedFunctions.php');

function updateREADME($nb_lang, $markdownTableLang)
{
  global $readmeNumberOfLangKey, $readmeLangList, $readmeTemplate, $readmeFinalPath;

  $base_template = file_get_contents($readmeTemplate);

  $base_template = str_replace($readmeNumberOfLangKey, $nb_lang, $base_template);
  $base_template = str_replace($readmeLangList, $markdownTableLang, $base_template);
  file_put_contents($readmeFinalPath, $base_template);
}

?>
