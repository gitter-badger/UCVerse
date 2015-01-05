<?php
	if($exp2['3'] == ":!time\r\n") {
		$time = date('l jS \of F Y H:i:s', time()+(5*60*60));
		fputs($socket,"PRIVMSG ".$channelname." :{$get_nickname}, it's ".$time."!\r\n");
	}
?>