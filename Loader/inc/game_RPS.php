<?php
	if($exp['2'] == "!rps\r\n") {
		if($rps_started == "1") {
			if($rps_players[$get_nickname] == "1") {
				fputs($socket,"PRIVMSG ".$channelname." :".$get_nickname." is already in game.\r\n");
			} else {
				foreach ($rps_players as $key => $value) {
					$rps_real_players[] = $key;
				}
				$texttosend = implode(" and ", $rps_real_players);
				fputs($socket,"PRIVMSG ".$channelname." :Sorry ".$get_nickname.". There's a game between ".$texttosend."\r\n");
				unset($rps_real_players);
			}
		} else {
			if($rps_players[$get_nickname] == "1") {
				fputs($socket,"PRIVMSG ".$channelname." :".$get_nickname." is already in game.\r\n");				
			} elseif(count($rps_players) == "0") {
				fputs($socket,"PRIVMSG ".$channelname." :".$get_nickname." has been added to queue for Rock-Paper-Scissors game. Waiting for 1 more.\r\n");
				$rps_players[$get_nickname] = "1";
			} elseif(count($rps_players) == "1") {
				fputs($socket,"PRIVMSG ".$channelname." :".$get_nickname." has been added to queue for Rock-Paper-Scissors game. Game can start. Please send me with /notice ".$botname." rps [rock / paper / scissors].\r\n");
				$rps_players[$get_nickname] = "1";
				$rps_started = "1";
			} elseif(count($rps_players) >= "2") {
				foreach ($rps_players as $key => $value) {
					$rps_real_players[] = $key;
				}
				$texttosend = implode(" and ", $rps_real_players);
				fputs($socket,"PRIVMSG ".$channelname." :Sorry ".$get_nickname.". There will be a game between ".$texttosend."\r\n");
				unset($rps_real_players);
			}
		}
	}

	if($exp['2'] == "!rpstop\r\n") {
		unset($rps_players);
		$rps_started = "0";
	}
?>
