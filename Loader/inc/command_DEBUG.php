<?php
	if($exp2['3'] == ":!fbdebug") {
		$expwed = print_r($exp2, true);
		$expwed = str_replace(PHP_EOL, "", $expwed);
		fputs($socket,"PRIVMSG ".$channelname." :".$expwed." \r\n");
	}
?>