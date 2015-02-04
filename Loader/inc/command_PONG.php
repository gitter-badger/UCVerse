<?php	
  if($exp['2'] == "!pong\r\n") {
		$ping[$get_nickname]['start'] = microtime(true);
		fputs($socket, "PRIVMSG ".$get_nickname." :PING ".$ping[$get_nickname]['start']."\r\n");

	}

	if($exp2['1'] == "NOTICE" && $exp2['2'] == $botname && $ping[$get_nickname]['start'] != NULL) {
		$ping[$get_nickname]['end'] = microtime(true);

		$calculate = $ping[$get_nickname]['end']-$ping[$get_nickname]['start'];
		$calculate = round($calculate, 3);
		$calculate = end(explode(".", $calculate));
		/*$calculate = $calculate/10;
		$calculate = round($calculate);*/

		fputs($socket, "PRIVMSG #UC :".$get_nickname."'s Estimated ping: ".$calculate."ms \r\n");	
		unset($ping);
	}
	
?>
