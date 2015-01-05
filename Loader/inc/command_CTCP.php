<?php
	if($exp2['1'] == "PRIVMSG") {
		if($exp2['2'] == $botname) {
			if($get_nickname != "CTCP") {
				if($exp['2'] == "join\r\n") {
					fputs($socket,"JOIN ".$channelname." \r\n");
				} elseif($exp2['3'] == ":COMMAND") {
					$formatted = str_replace("COMMAND ", "", $ircmsg2);
					$defuse = explode(" ", strtoupper($formatted));

					if($defuse['0'] == "QUIT" || $defuse['0'] == "QUIT\r\n") {
						if($get_nickname == "Zexorz2") {
							fputs($socket, $formatted."\r\n");
						} else {
							fputs($socket, "PRIVMSG #UC :{$get_nickname}, No QUIT ;).\r\n");
						}
					} elseif($defuse['0'] == "PART" || $defuse['0'] == "PART\r\n") {
						if($get_nickname == "Zexorz2") {
							fputs($socket, $formatted."\r\n");
						} else {
							fputs($socket, "PRIVMSG #UC :{$get_nickname}, No PART ;).\r\n");
						}
					} elseif($defuse['0'] == "KICK" || $defuse['0'] == "KICK\r\n") {
						if($get_nickname == "Zexorz2") {
							fputs($socket, $formatted."\r\n");
						} else {
							fputs($socket, "PRIVMSG #UC :{$get_nickname}, No KICK ;).\r\n");
						}
					} elseif(substr(strtoupper($exp['3']), 0, 5) == "!KICK") {
						if($get_nickname == "Zexorz2") {
							fputs($socket, $formatted."\r\n");
						} else {
							fputs($socket, "PRIVMSG #UC :{$get_nickname}, No !kick ;).\r\n");
						}
					} elseif(substr(strtoupper($exp['3']), 0, 4) == "!PWN") {
						if($get_nickname == "Zexorz2") {
							fputs($socket, $formatted."\r\n");
						} else {
							fputs($socket, "PRIVMSG #UC :{$get_nickname}, No !pwn ;).\r\n");
						}
					} elseif(substr(strtoupper($exp['3']), 0, 4) == "!OWN") {
						if($get_nickname == "Zexorz2") {
							fputs($socket, $formatted."\r\n");
						} else {
							fputs($socket, "PRIVMSG #UC :{$get_nickname}, No !own ;).\r\n");
						}
					} elseif(substr(strtoupper($exp['3']), 0, 3) == "!TB") {
						if($get_nickname == "Zexorz2") {
							fputs($socket, $formatted."\r\n");
						} else {
							fputs($socket, "PRIVMSG #UC :{$get_nickname}, No !tb ".$botname." ;).\r\n");
						}
					} elseif(substr(strtoupper($exp['3']), 0, 3) == "!KB") {
						if($get_nickname == "Zexorz2") {
							fputs($socket, $formatted."\r\n");
						} else {
							fputs($socket, "PRIVMSG #UC :{$get_nickname}, No !KB ".$botname." ;).\r\n");
						}
					} elseif(substr(strtoupper($exp['3']), 0, 2) == "!K") {
						if($get_nickname == "Zexorz2") {
							fputs($socket, $formatted."\r\n");
						} else {
							fputs($socket, "PRIVMSG #UC :{$get_nickname}, No !K ".$botname." ;).\r\n");
						}
					} elseif(substr(strtoupper($exp['3']), 0, 5) == "!CLVL" || substr(strtoupper($formatted), 0, 16) == "PRIVMSG CHANSERV" || substr(strtoupper($formatted), 0, 10) == "PRIVMSG CS" || substr(strtoupper($formatted), 0, 2) == "CS" || substr(strtoupper($formatted), 0, 8) == "CHANSERV") {
						if($get_nickname == "Zexorz2") {
							fputs($socket, $formatted."\r\n");
						} else {
							fputs($socket, "PRIVMSG #UC :{$get_nickname}, Phahahhahahaha @ ".$exp['3']." ;).\r\n");
						}
					} else {
						fputs($socket, $formatted."\r\n");
						fputs($socket, "NOTICE Zexorz2 :".$formatted."\r\n");
					}
					echo substr(strtoupper($exp['3']));
				} elseif($exp2['3'] == ":VERSION\r\n" || $exp2['3'] == ":VERSION\r\n") {
					fputs($socket,"NOTICE {$get_nickname} :VERSION UCVerse 1.3a\r\n");
				} elseif($exp2['3'] == ":PING" || $exp2['3'] == ":PING") {
					$pingreply = ((int)$exp2['4'])+826;
					fputs($socket,"NOTICE {$get_nickname} :PING {$pingreply}\r\n");
				} else {
					fputs($socket,"PRIVMSG #UC :{$get_nickname} @ PRIVMSG: {$ircmsg2}\r\n");
					$msg = trim(preg_replace("/\s\s+/", " ", "{$get_nickname} @ PRIVMSG: {$ircmsg2}"));
					$msg = urlencode($msg);
					$file = @file_get_contents("http://irc.ultimateclan.net/post_irc.php?u=UCVerse&msg=".$msg."&mode=PRIVMSG");
					echo $file;
				}
			} else {
				if($exp2['3'] == ':PING') {
					fputs($socket,"PRIVMSG $get_nickname :PONG 1064386503\r\n");
				}
			}
		}
	}
?>