<?php
	if($exp['2'] == "!ae\r\n") {
		$rand = rand('1', '10');
		$rand_lett = substr('eeeeeeeeeeeeeeeeeeeeee', '0', $rand);
		fputs($socket,"PRIVMSG ".$channelname." :a".$rand_lett." ".$get_nickname."\r\n"); 
	}
?>