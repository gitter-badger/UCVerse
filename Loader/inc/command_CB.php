<?php
	if($exp2['3'] == ":!cb") {
		$expplde = explode(":!cb ", $sock_data);
		$sendtocb = $expplde['1'];
		$reply = @file_get_contents("http://ultimateclan.net/clever/input.php?text=".$sendtocb);
		fputs($socket,"PRIVMSG ".$channelname." :{$get_nickname}, {$reply}\r\n"); 
	}
?>