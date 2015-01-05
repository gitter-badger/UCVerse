<?php
	if($exp['2'] == "!bot quit\r\n") {
		if($get_nickname == "Zexorz2") {
			fputs($socket,"PART ".$channelname." :Cya\r\n"); 
			fclose($socket);
		} else {
			fputs($socket,"PRIVMSG ".$channelname." :HAH, Gaaaaaaaaaaaaaaay! \r\n");	
		}
	}

	if($exp['2'] == "!bot info\r\n") {
		$osname = php_uname('s');
		$type = php_uname('m');
		$hn = php_uname('n');
		$sl = sys_getloadavg();
		fputs($socket,"PRIVMSG ".$channelname." :System: ".$osname." | Type: ".$type." | Hostname: ".$hn." | Serverload: ".$sl['0']."% \r\n");	
	}

	if($exp['2'] == "!bot nick\r\n") {
		fputs($socket,"PRIVMSG ".$channelname." :UCVerse Codename nick is: ".$botname."\r\n");	
	}
?>