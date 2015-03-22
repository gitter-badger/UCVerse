<?php	
	if($exp['2'] == "!pong\r\n") {
		$ping['start'] = microtime(true);
		fputs($socket, "PRIVMSG ".$get_nickname." :VERSION\r\n");

	}

	if($exp2['1'] == "NOTICE" && $exp2['2'] == $botname && $ping['start'] != NULL) {
		$ping['end'] = microtime(true);

		$calculate = $ping['end']-$ping['start'];
		$calculate = round($calculate, 3);
		$calculate = explode(".", $calculate);
		/*$calculate = $calculate/10;
		$calculate = round($calculate);*/
		
		if((int)$calculate2['0'] != 0) {
			if(strlen($calculate2['1']) == "2") {
				$calculate2['1'] = $calculate2['1']."0";
			} elseif(strlen($calculate2['1']) == "1") {
				$calculate2['1'] = $calculate2['1']."00";
			}
			
			$calculate = $calculate2['0'].".".$calculate2['1'];
		} else {
			if(strlen($calculate2['1']) == "2") {
				$calculate2['1'] = $calculate2['1']."0";
			} elseif(strlen($calculate2['1']) == "1") {
				$calculate2['1'] = $calculate2['1']."00";
			}

			$calculate = $calculate2['1'];
		}
		fputs($socket, "PRIVMSG ".$channelname." :".$get_nickname."'s Estimated ping: ".$calculate."ms \r\n");	
		unset($ping);
	}
?>
