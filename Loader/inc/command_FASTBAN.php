<?php
	if($exp2['3'] == ":!fb") {
		$nickname = trim(preg_replace('/\s\s+/', ' ', $exp2['4']));
		$formatted = str_replace("!fb ", "", $exp['2']);
		$formatted = str_replace($nickname." ", "", $formatted);
		if($formatted == NULL) {
			if($exp2['4'] == $botname."\r\n" || $exp2['4'] == $botname) {
				fputs($socket,"PRIVMSG ".$channelname." :HAH, Gaaaaaaaaaaaaaaay! \r\n");	
			} else {
				fputs($socket,"PRIVMSG ChanServ :ADDTIMEDBAN ".$channelname." ".$nickname." 15s FastBan by UCVerse\r\n"); 
				$msg = trim(preg_replace("/\s\s+/", " ", "FastBan by UCVerse"));
				$msg = urlencode($msg);
				$file = @file_get_contents("http://irc.ultimateclan.net/post_irc.php?u=UCVerse&msg=".$msg."&mode=BAN");
				echo $file;
			}
		} else {
			if($exp2['4'] == $botname."\r\n" || $exp2['4'] == $botname) {
				fputs($socket,"PRIVMSG ".$channelname." :HAH, Gaaaaaaaaaaaaaaay! \r\n");	
			} else {
				fputs($socket,"PRIVMSG ChanServ :ADDTIMEDBAN ".$channelname." ".$nickname." 15s ".$formatted."\r\n"); 
				$msg = trim(preg_replace("/\s\s+/", " ", $formatted));
				$msg = urlencode($msg);
				$file = @file_get_contents("http://irc.ultimateclan.net/post_irc.php?u=UCVerse&msg=".$msg."&mode=BAN");
				echo $file;
			}
		}
	}
?>