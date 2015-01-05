<?php
	if($exp2['3'] == ":!eval") {

		$var2send = explode(':!eval', $sock_data);
		$xx = trim(preg_replace('/\s\s+/', '', $var2send['1']));

		$xx = str_replace(' ', '%20', $xx);

		$x = file_get_contents('http://ultimateclan.net/clever/php.php?code='.$xx);

		if($x == ' ') {
			fputs($socket,"PRIVMSG ".$channelname." :{$get_nickname}, nothing to eval\r\n");
		} else {
			fputs($socket,"PRIVMSG ".$channelname." :{$get_nickname}:".$x."\r\n");
		}
	}	
?>