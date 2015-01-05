<?php
	
	if($exp2['1'] == "JOIN" && ($exp2['2'] == "#UC" OR $exp2['2'] == "#UC\r\n")) {
		if($get_nickname != $botname) {
			if($get_nickname != "UltimateClan") {
				$address = end(explode("@", $exp2['0']));
				$starting_ip = explode(".", $address);

				if($starting_ip['2'] == 'gamesurge') {
					if($starting_ip['0'] == 'DarkOneRRp') {
						$nick_correct = 'DeeOne';
					} elseif($starting_ip['0'] == 'LeTotalKiller') {
						$nick_correct = "Mr. Baguette";
						//fputs($socket, "PRIVMSG ".$channelname." :[9DELAY BETA] Don't forget this: Check for replays regularly in your email inbox (be cautious about the attached files) and in the Game Awards Center.\r\n");
					} elseif($starting_ip['0'] == 'Zexorz') {
						$nick_correct = "DADDY";
					} else {
						$nick_correct = $starting_ip['0'];
					}
				} elseif($address == '82-170-180-42.ip.telfort.nl' || $starting_ip['0'].'.'.$starting_ip['1'] == '145.15' || $address == 'ip4da1b8c0.direct-adsl.nl') {
					$nick_correct = "Spaatki";
				} else {
					$nick_correct = $get_nickname;
				}
				$welcomemsg = array();
				$messageid = rand(0, 10);
				$welcomemsg[] = "Hiho {$nick_correct} :D";
				$welcomemsg[] = "Ohey {$nick_correct}, how are you?";
				$welcomemsg[] = "Howdy {$nick_correct} :)";
				$welcomemsg[] = "Welcome {$nick_correct} :)";
				$welcomemsg[] = "AEE {$nick_correct} :D";
				$welcomemsg[] = "Ae 420 blz it {$nick_correct}!";
				$welcomemsg[] = "High {$nick_correct}";
				$welcomemsg[] = "Y U NO greet {$nick_correct}";
				$welcomemsg[] = "Low {$nick_correct}";
				$welcomemsg[] = "Noob {$nick_correct}";
				$welcomemsg[] = "ACTION kicks {$nick_correct}";

				fputs($socket,"PRIVMSG ".$channelname." :".$welcomemsg[$messageid]."\r\n");
			}
		}
	}
?>