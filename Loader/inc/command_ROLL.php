<?php
	if($exp['2'] == "!roll\r\n") {
		$roll = rand(1, 6);
		fputs($socket,"PRIVMSG ".$channelname." :{$get_nickname} just rolled  ".$roll."!\r\n"); 
		$msg = trim(preg_replace("/\s\s+/", " ", "{$get_nickname} just rolled  ".$roll."!"));
		$msg = urlencode($msg);
		$file = @file_get_contents("http://irc.ultimateclan.net/post_irc.php?u=UCVerse&msg=".$msg."&mode=PRIVMSG");
		echo $file;
	}

	if($exp['2'] == "!roll2\r\n") {
		$roll = rand(1, 6);
		$roll2 = rand(1, 6);
		$total = $roll+$roll2;
		fputs($socket,"PRIVMSG ".$channelname." :{$get_nickname}, you rolled ".$roll." and ".$roll2." (".$total." in total)!\r\n"); 

		$msg = trim(preg_replace("/\s\s+/", " ", "{$get_nickname}, you rolled ".$roll." and ".$roll2." (".$total." in total)!)"));
		$msg = urlencode($msg);
		$file = @file_get_contents("http://irc.ultimateclan.net/post_irc.php?u=UCVerse&msg=".$msg."&mode=PRIVMSG");
		echo $file;
	}
?>