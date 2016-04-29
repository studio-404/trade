<?php
session_start();
header('X-Frame-Options: DENY');
header("Content-type: text/html; charset=utf-8");
/*
http://tradewithgeorgia.com/_newsletter/index.php?page=sentMails
*/
// Deny requesting GLOBALS
if (ini_get('register_globals'))
{
    (isset($_REQUEST['GLOBALS']) OR isset($_FILES['GLOBALS'])) AND exit(1);
    $global_variables = array_keys($GLOBALS);
    $global_variables = array_diff($global_variables, array(
                '_COOKIE', '_ENV', '_GET',
                '_FILES', '_POST', '_REQUEST',
                '_SERVER', '_SESSION', 'GLOBALS'
            ));
    foreach ($global_variables as $name)
        unset($GLOBALS[$name]);
}
@include("config.php");
date_default_timezone_set(DATA_TIMEZONE);
function __autoload($class_name) 
{
    $filename = str_replace('_', DIRECTORY_SEPARATOR, strtolower($class_name)).'.php';

	$file = $filename;
	if (!file_exists($file))
    {
        echo "Class: <b>".$class_name."</b> can't load.."; exit();
    }
    @include $file;
}

$bootstrap = new src_lancher_bootstrap();
$bootstrap->lanch();
?>