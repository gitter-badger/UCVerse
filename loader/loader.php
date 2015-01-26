<?php

if(PHP_SAPI !== 'cli' || isset($_SERVER['HTTP_USER_AGENT'])) {
	$html = "<div style='padding: 10px;background: rgb(240, 240, 240);border: 1px solid rgb(224, 224, 224);border-radius: 3px;box-shadow: inset 0 -1px 0px white;font-weight: bold;text-align: center;'>";
	$html .= "This bot can be executed ONLY in CLI Mode. Please read more <a href='https://github.com/Zexorz/UCVerse#installing'>here</a>";
	$html .= "</div>";

	die($html);
}

ob_start();
ini_set('max_execution_time', 0);
$starttime = time();

function object_to_array($obj) {
	$_arr = is_object($obj) ? get_object_vars($obj) : $obj;

	foreach ($_arr as $key => $val) {
		$val = (is_array($val) || is_object($val)) ? object_to_array($val) : $val;
		$arr[$key] = $val;
	}
	
	return $arr;
}

echo "Dir name: ".dirname(__FILE__)."/";

$settings = object_to_array(json_decode(file_get_contents("./settings.conf")));
if($settings['loader']['Server'] == NULL || $settings['loader']['Nickname'] == NULL || $settings['loader']['Channel']['Main'] == NULL ) {
	die("IRCBot is not configured!");
}

if($settings['loader']['Port'] == NULL) {
	$settings['loader']['Port'] == "6667";
}

include "./functions.php";

$socket = fsockopen($settings['loader']['Server'], $settings['loader']['Port'], $errno, $errstr, $settings['loader']['Timeout']) or die($errstr);
fputs($socket,"CAP LS \r\n");
fputs($socket,"NICK ".$settings['loader']['Nickname']." \r\n");
fputs($socket,"USER ".$settings['loader']['Nickname']." 0 * :".$settings['loader']['Information']." \r\n");
