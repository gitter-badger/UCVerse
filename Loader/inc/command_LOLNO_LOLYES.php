<?php
	if(substr($exp['2'], 0, 4) == "!lol") {
		if($get_nickname == "Zexorz" || $get_nickname == "LeTotalKiller" || $get_nickname == "Zexorz2") {
			fputs($socket,"PRIVMSG ".$channelname." :Indeed {$get_nickname}\r\n"); 
		} else {
			fputs($socket,"PRIVMSG ".$channelname." :No {$get_nickname}... just no.\r\n");
		}
		
		//fputs($socket,"KICK #UC {$get_nickname} :Indeed like this!\r\n");
	}

	/*if($get_nickname == 'GanGsTeR' && ) {
		fputs($socket,"KICK ".$channelname." {$get_nickname} :just no.\r\n");
	}*/
?>