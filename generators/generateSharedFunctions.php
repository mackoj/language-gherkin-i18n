<?php

error_reporting(-1);

require_once('generateGlobalConfig.php');

function addQuote($word)
{
    return("      '".$word."'");
}

function addQuote2($word)
{
    return("      '".$word.":'");
}

function convertNewGherkinLanguagesToOldi18n($i18nFilePath)
{
  $fileContent = file_get_contents($i18nFilePath);
  $jsoni18nAssocArray = json_decode($fileContent, TRUE);
  $newjson = array();
  foreach ($jsoni18nAssocArray as $country => $pieces)
  {
    foreach ($pieces as $keyword => $values)
    {
      if (is_array($values))
      {
        $newjson[$country][$keyword] = implode("|", $values);
      }
      else 
      {
        $newjson[$country][$keyword] = $values;
      }
    }
  }
  file_put_contents($i18nFilePath, json_encode($newjson, JSON_PRETTY_PRINT));
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

function force_rmdir($dir)
{
  exec("rm -rf {$dir}");
}

?>
