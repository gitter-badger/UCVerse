<?php	
	if($exp['2'] == "!pong\r\n") {
		$ping['start'] = microtime(true);
		fputs($socket, "PRIVMSG ".$get_nickname." :VERSION\r\n");
		$pongie = $get_nickname;
	}

	if($exp2['1'] == "NOTICE" && $exp2['2'] == $botname && $ping[$get_nickname]['start'] != NULL && $pongie == $get_nickname) {
		$ping['end'] = microtime(true);

		$calculate = $ping['end']-$ping[$get_nickname]['start'];
		$calculate = number_format($calculate, 3);
		$calculate2 = explode(".", $calculate);

		$pingo[$get_nickname]['latest'] = $calculate;
		fputs($socket, "PRIVMSG #UC :".$get_nickname."'s Estimated ping: ".$pingo[$get_nickname]['latest']."s\r\n");

		if($pingo[$get_nickname]['lowest'] == NULL) {
			$pingo[$get_nickname]['lowest'] = $pingo[$get_nickname]['latest'];
		} elseif($pingo[$get_nickname]['lowest'] > $pingo[$get_nickname]['latest']) {
			$pingo[$get_nickname]['lowest'] = $pingo[$get_nickname]['latest'];	
		}

		$pingo[$get_nickname]['countcalls']++;
		unset($pongie);
	}
?>
