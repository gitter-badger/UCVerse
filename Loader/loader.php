<?php
error_reporting('E_ALL');

ob_start();
ini_set('max_execution_time', 0);
$starttime = time();

include("./inc/functions.php");

$socket = fsockopen("Portlane.SE.EU.GameSurge.net", "6667", $errno, $errstr, '2') or die($errstr);

$botname = "UCVerse";

fputs($socket,"CAP LS \r\n");
fputs($socket,"NICK ".$botname." \r\n");
fputs($socket,"USER UCVerse 0 * :http://ultimateclan.net/ \r\n");

$x = '1';

while(1) {
	$sock_data = fgets($socket,1024);
	$exp = explode(":", $sock_data);
	$exp2 = explode(" ", $sock_data);
	$message = $exp['1'];
	$who = $exp['0'];
	$ver = $exp2['3'];
	$channelname = trim(preg_replace('/\s\s+/', ' ', $exp2['2']));

	//NICK CHANGE DETECT//
	include("./inc/NICK_change.php");

	$pong = array();

	//GET NICKS//
	$split_ident = explode("!", $exp2['0']);
	$get_nickname = str_replace(":", "", $split_ident['0']);

	if ($who == 'PING ') { 
		fputs($socket,"PONG $message \r\n"); 
	}
		
	if ($ver == ':VERSION') { 
		fputs($socket,"PONG $message \r\n"); 
	}

	if($x == "21") {
		fputs($socket,"JOIN #UC \r\n"); 
		fputs($socket,"JOIN #AbC \r\n");
		fputs($socket,"PRIVMSG AuthServ@Services.Gamesurge.net :login xxx yyy\r\n"); 
	}

	$nickuser = $get_nickname;
	$ircmsg2 = end(explode($botname." :", $sock_data));

	foreach (glob("./inc/command_*.php") as $filename) {
		include $filename;
	}

	$mode = $exp2['1'];

	if($mode == "PRIVMSG") {
			$ircmsg = end(explode("".$channelname." :", $sock_data));

			$str = $ircmsg;

			$asd = explode(" ", $str);
			foreach($asd as $asdasd) {
				$to = parse_url(trim(preg_replace('/\s\s+/', ' ', $asdasd)));

				foreach (glob("./inc/parse_*.php") as $filename) {
				    include $filename;
				}
			}
	} else {
		$ircmsg = $exp['2'];
	}

include("./inc/console.php");
include("./inc/reconnect.php");

	ob_flush();
	flush();
	$x++;
}

ob_end_flush();
?>
