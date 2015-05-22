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
