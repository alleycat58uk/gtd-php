<?php
if (!isset($areUpdating)) require_once 'headerDB.inc.php';

if ($_SESSION['version']!==_GTD_VERSION && !isset($areUpdating) ) {
    $testver=query('getgtdphpversion');
    if ($testver && _GTD_VERSION === array_pop(array_pop($testver)) ) {
        $_SESSION['version']=_GTD_VERSION;
    } else {
        $msg= ($testver)
                ? "<p class='warning'>Your version of the database needs upgrading before we can continue.</p>"
                : "<p class='warning'>No gtd-php installation found: please check the database prefix in config.inc.php, and then install.</p>";
        $_SESSION['message']=array($msg); // remove warning about version not being found
        nextScreen('install.php');
        die;
    }
}

if (!headers_sent()) header("Content-Type: text/html; charset={$_SESSION['config']['charset']}");

if (empty($title)) $title= ($_SESSION['config']['title_suffix']) ? $pagename : '';

$extrajavascript = '';

if ($_SESSION['debug']['debug'] || defined('_DEBUG'))
	$extrajavascript .= "\n<script type='text/javascript'>
    /* <![CDATA[ */
    $(document).ready(function(){
        GTD.debugInit(\"{$_SESSION['debug']['key']}\");
    });
    /* ]]> */
    </script>";

$themejs="themes/{$_SESSION['theme']}/theme.js";
if (is_readable($themejs))
    $extrajavascript .= "\n<script type='text/javascript' src='$themejs'></script>";

/*-----------------------------------------------------------
    build HTML header
*/
if (empty($_SESSION['theme'])) $_SESSION['theme']='default';
$headertext=<<<HTML1
<!doctype html>
<html lang="en">

<head>
    <meta charset="{$_SESSION['config']['charset']}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <title>{$_SESSION['config']['title']} $title</title>
    <link rel="stylesheet" href="themes/{$_SESSION['theme']}/style.css" type="text/css">
    <link rel="stylesheet" href="themes/{$_SESSION['theme']}/style_screen.css" type="text/css" media="screen">
    <link rel="shortcut icon" href="./favicon.ico">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="calendar.js"></script>
    <script type="text/javascript" src="lang/calendar-en.js"></script>
    <script type="text/javascript" src="gtdfuncs.js"></script>

{$extrajavascript}
HTML1;
//-----------------------------------------------------------
if (gtd_handleEvent(_GTD_ON_HEADER,$pagename)) echo $headertext;
/*
Documentation for included files:


theme main stylesheet
<link rel="stylesheet" href="themes/{$_SESSION['theme']}/style.css" type="text/css"/>

theme screen stylesheet
<link rel="stylesheet" href="themes/{$_SESSION['theme']}/style_screen.css" type="text/css" media="screen">

main calendar program
<script type="text/javascript" src="calendar.js"></script>

language for the calendar
<script type="text/javascript" src="lang/calendar-en.js"></script>

sort tables, and other utilities
<script type="text/javascript" src="gtdfuncs.js"></script>

*/
?>
