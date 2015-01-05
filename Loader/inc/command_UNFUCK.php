<?php
	if($exp2['3'] == ":!unfuck") {
		if($exp2['4'] != NULL) {
			$who = trim(preg_replace('/\s\s+/', '', $exp2['4']));
			fputs($socket,"PRIVMSG ".$channelname." :{$who} has been unfucked!\r\n"); 
		}
	}
?>