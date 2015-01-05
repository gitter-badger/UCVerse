<?php
	if($exp['2'] == "!bot uptime\r\n") {
		fputs($socket,"PRIVMSG ".$channelname." :UPTIME: ".time_ago("@".$starttime)."!\r\n");
		$msg = trim(preg_replace("/\s\s+/", " ", "UPTIME: ".time_ago("@".$starttime)."!"));
		$msg = urlencode($msg);
		$file = @file_get_contents("http://irc.ultimateclan.net/post_irc.php?u=UCVerse&msg=".$msg."&mode=PRIVMSG");
		echo $file;

		fputs($socket,"PRIVMSG ".$channelname." :Running since: ".date("Y-m-d H:i:s", $starttime)."\r\n");
		$msg = trim(preg_replace("/\s\s+/", " ", "Running since: ".date("Y-m-d H:i:s", $starttime).""));
		$msg = urlencode($msg);
		$file = @file_get_contents("http://irc.ultimateclan.net/post_irc.php?u=UCVerse&msg=".$msg."&mode=PRIVMSG");
		echo $file;
	}
?>