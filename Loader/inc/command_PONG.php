<?php	
	if($exp['2'] == "!pong\r\n") {
		$ping['start'] = microtime(true);
		fputs($socket, "PRIVMSG ".$get_nickname." :PING ".$ping['start']."\r\n");

	}

	if($exp2['1'] == "NOTICE" && $exp2['2'] == $botname && $ping['start'] != NULL) {
		$ping['end'] = microtime(true);

		$calculate = $ping['end']-$ping['start'];
		$calculate = round($calculate, 3);
		$calculate = end(explode(".", $calculate));
		/*$calculate = $calculate/10;
		$calculate = round($calculate);*/

		fputs($socket, "PRIVMSG #UC :Ping! ".$get_nickname."'s Estimated ping: ".$calculate."ms \r\n");	
		unset($ping);
	}
?>
