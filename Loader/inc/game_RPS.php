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

	if($exp2['1'] == "NOTICE" && $exp2['2'] == $botname && $exp2['3'] == ":rps" && $rps_started == "1" && $rps_players[$get_nickname] == "1") {
		if($picked_rps[$get_nickname] == NULL) {
			$rps_check = trim(preg_replace('/\s\s+/', '', $exp2['4']));
			if(in_array($rps_check, array("rock", "paper", "scissors"))) {
				$picked_rps[$get_nickname] = $rps_check;

				if($played != "1") {
					foreach ($rps_players as $key => $value) {
						if($picked_rps[$key] == NULL) {
							$rps_nextplayer = $key;
						}
					}

					fputs($socket,"PRIVMSG #UC :".$get_nickname." have made his turn. waiting for ".$rps_nextplayer."\r\n");
					$played = "1";

					$rps_picker1 = $rps_check;
					$rps_picker1_name = $get_nickname;
				} else {
					if($rps_picker1 == $picked_rps[$get_nickname]) {
						$rps_draw = implode(" and ", array_keys($rps_players));

						fputs($socket,"PRIVMSG #UC :DRAW HAPPENED! Both ".$rps_draw." have picked ".$rps_picker1.".\r\n");
					} else {

						if($rps_picker1 == "rock" && $picked_rps[$get_nickname] == "scissors") {
							$winner = $rps_picker1_name;
							$rps_battle = "02".$rps_picker1." vs. ".$picked_rps[$get_nickname];
						} elseif($rps_picker1 == "rock" && $picked_rps[$get_nickname] == "paper") {
							$winner = $get_nickname;
							$rps_battle = "02".$picked_rps[$get_nickname]." vs. ".$rps_picker1;
						} elseif($rps_picker1 == "paper" && $picked_rps[$get_nickname] == "rock") {
							$winner = $rps_picker1_name;
							$rps_battle = "02".$rps_picker1." vs. ".$picked_rps[$get_nickname];
						} elseif($rps_picker1 == "paper" && $picked_rps[$get_nickname] == "scissors") {
							$winner = $get_nickname;
							$rps_battle = "02".$picked_rps[$get_nickname]." vs. ".$rps_picker1;
						} elseif($rps_picker1 == "scissors" && $picked_rps[$get_nickname] == "paper") {
							$winner = $rps_picker1_name;
							$rps_battle = "02".$rps_picker1." vs. ".$picked_rps[$get_nickname];
						} elseif($rps_picker1 == "scissors" && $picked_rps[$get_nickname] == "rock") {
							$winner = $get_nickname;
							$rps_battle = "02".$picked_rps[$get_nickname]." vs. ".$rps_picker1;
						}

						fputs($socket,"PRIVMSG #UC :EVERYONE Have made their turns. And the winner is: ".$winner." (".$rps_battle.")\r\n");
					}

					unset($picked_rps);
					$played = "0";
					unset($rps_players);
					$rps_played = "0";
					$rps_started = "0";
					unset($rps_real_players);
				}
			} else {
				fputs($socket,"NOTICE ".$get_nickname." :Invalid trigger. Use rock, paper or scissors.\r\n");
			}
		} else {
			fputs($socket,"NOTICE ".$get_nickname." :You've already picked ".$picked_rps[$get_nickname]."\r\n");
		}
	}
?>
