<?php
ob_start();
ini_set('max_execution_time', 0);
$starttime = time();

function time_ago($datetime, $full = true) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . '' : '';
}

function htmlspecialchars_uni($message) {
	//$message = preg_replace("#&(?!\#[0-9]+;)#si", "&amp;", $message); // Fix & but allow unicode
	$message = str_replace("&lt;", "<", $message);
	$message = str_replace("&gt;", ">", $message);
	$message = str_replace("&quot;", "\"", $message);
	return $message;
}

error_reporting('E_NONE');

$socket = fsockopen("64.31.0.226", "6667");
fputs($socket,"CAP LS \r\n");
fputs($socket,"NICK UCVerse \r\n");
fputs($socket,"USER UC 0 * :... \r\n");

$conn = mysql_connect("185.25.149.169", "root", "mixando95") or die("1");
mysql_select_db("uc_wa_tk", $conn) or die("2");

$x = 1;

while(1) {
	$sock_data = fgets($socket,1024);
	$exp = explode(":", $sock_data);
	$exp2 = explode(" ", $sock_data);
	$message = $exp['1'];
	$who = $exp['0'];
	$ver = $exp2['3'];

	$pong = array();

	//GET NICKS//
	$split_ident = explode("!", $exp2['0']);
	$get_nickname = str_replace(":", "", $split_ident['0']);

	if ($who == 'PING ') { 
		fputs($socket,"PONG $message \r\n"); 
	}
		
	if ($ver == ':VERSION') { 
		fputs($socket,"PONG $message \r\n"); 
	}

	if($x == "21") {
		fputs($socket,"JOIN #UC \r\n"); 
	}

	$rand = rand('1', '6');

	if($exp['2'] == "!bot quit\r\n") {
		if($get_nickname == "Zexorz2") {
			fputs($socket,"PART #UC :Cya\r\n"); 
			fclose($socket);
		} else {
			fputs($socket,"PRIVMSG #UC :HAH, Gaaaaaaaaaaaaaaay! \r\n");	
		}
	}

	if($exp['2'] == "!bot login\r\n") {
		fputs($socket,"PRIVMSG AuthServ@Services.Gamesurge.net :login UCVerse metonator\r\n"); 
	}

	if($exp['2'] == "!ae\r\n") {
		$rand = rand('1', '10');
		$rand_lett = substr('eeeeeeeeeeeeeeeeeeeeee', '0', $rand);
		fputs($socket,"PRIVMSG #UC :a".$rand_lett." ".$get_nickname."\r\n"); 
	}

	if($exp2['3'] == ":!fb") {
		$nickname = trim(preg_replace('/\s\s+/', ' ', $exp2['4']));
		$formatted = str_replace("!fb ", "", $exp['2']);
		$formatted = str_replace($nickname." ", "", $formatted);
		if($formatted == NULL) {
			fputs($socket,"PRIVMSG ChanServ :ADDTIMEDBAN #UC ".$nickname." 15s FastBan by UCVerse\r\n"); 
			$msg = trim(preg_replace("/\s\s+/", " ", "FastBan by UCVerse"));
			$msg = urlencode($msg);
			$file = @file_get_contents("http://irc.ultimateclan.net/post_irc.php?u=UCVerse&msg=".$msg."&mode=BAN");
			echo $file;
		} else {
			fputs($socket,"PRIVMSG ChanServ :ADDTIMEDBAN #UC ".$nickname." 15s ".$formatted."\r\n"); 
			$msg = trim(preg_replace("/\s\s+/", " ", $formatted));
			$msg = urlencode($msg);
			$file = @file_get_contents("http://irc.ultimateclan.net/post_irc.php?u=UCVerse&msg=".$msg."&mode=BAN");
			echo $file;
		}
	}

	if($exp2['3'] == ":!cb") {
		$expplde = explode(":!cb ", $sock_data);
		$sendtocb = $expplde['1'];
		$reply = @file_get_contents("http://ultimateclan.net/clever/input.php?text=".$sendtocb);
		fputs($socket,"PRIVMSG #UC :{$get_nickname}, {$reply}\r\n"); 
	}

	if($exp['2'] == "!roll\r\n") {
		$roll = rand(1, 6);
		fputs($socket,"PRIVMSG #UC :{$get_nickname} just rolled  ".$roll."!\r\n"); 
		$msg = trim(preg_replace("/\s\s+/", " ", "{$get_nickname} just rolled  ".$roll."!"));
		$msg = urlencode($msg);
		$file = @file_get_contents("http://irc.ultimateclan.net/post_irc.php?u=UCVerse&msg=".$msg."&mode=PRIVMSG");
		echo $file;
	}

	if($exp['2'] == "!roll2\r\n") {
		$roll = rand(1, 6);
		$roll2 = rand(1, 6);
		$total = $roll+$roll2;
		fputs($socket,"PRIVMSG #UC :{$get_nickname}, you rolled ".$roll." and ".$roll2." (".$total." in total)!\r\n"); 

		$msg = trim(preg_replace("/\s\s+/", " ", "{$get_nickname}, you rolled ".$roll." and ".$roll2." (".$total." in total)!)"));
		$msg = urlencode($msg);
		$file = @file_get_contents("http://irc.ultimateclan.net/post_irc.php?u=UCVerse&msg=".$msg."&mode=PRIVMSG");
		echo $file;
	}

	/* WO IS HERE */
	if($exp2['3'] == ":!wo") {
		if($exp2['4'] == "next\r\n") {
			$filename = "http://wormolympics.com/api/tournaments/next";
			$file = simplexml_load_file($filename);
			$message = "Next tournament is ".$file->tournament->scheme." hosted by ".$file->tournament->hoster." on ".$file->tournament->channel." ".$file->next." (".$file->tournament->url.")";
			fputs($socket,"PRIVMSG #UC :".$message."\r\n"); 
		} elseif($exp2['4'] == "today\r\n") {
			$filename = "http://wormolympics.com/api/tournaments/today";
			$file = simplexml_load_file($filename);

			fputs($socket,"PRIVMSG #UC :Today tournament for Wormolympics:\r\n");

			$number = '1';
			foreach($file->tournament as $tour) {
				fputs($socket,"PRIVMSG #UC :".$number.". ".$tour->scheme." hosted by ".$tour->hoster." on ".$tour->channel." at ".$tour->time." (".$tour->url.")\r\n");
				$number++;
			}
		} else {
			fputs($socket,"PRIVMSG #UC :Unknown command from !wo, next and today are only supported!\r\n"); 
		}
	}

	/* WQDB */
	

	if($exp2['3'] == ":!wqdb") {
	  	$id = (int)$exp2['4'];
		$url = file_get_contents("http://wqdb.org/?fullquote&".$id);

		if($url == NULL) {
			fputs($socket,"PRIVMSG #UC :This entry doesnt exists!!\r\n");
		} else {
			$quotes = explode(PHP_EOL, str_replace('<br />', '', htmlspecialchars_uni($url)));    
	    	foreach($quotes as $qt) {
	      		fputs($socket,"PRIVMSG #UC :".$qt."\r\n");
	    	}
		}
	}

	if($exp['2'] == "!bot uptime\r\n") {
		fputs($socket,"PRIVMSG #UC :UPTIME: ".time_ago("@".$starttime)."!\r\n");
		$msg = trim(preg_replace("/\s\s+/", " ", "UPTIME: ".time_ago("@".$starttime)."!"));
		$msg = urlencode($msg);
		$file = @file_get_contents("http://irc.ultimateclan.net/post_irc.php?u=UCVerse&msg=".$msg."&mode=PRIVMSG");
		echo $file;

		fputs($socket,"PRIVMSG #UC :Running since: ".date("Y-m-d H:i:s", $starttime)."\r\n");
		$msg = trim(preg_replace("/\s\s+/", " ", "Running since: ".date("Y-m-d H:i:s", $starttime).""));
		$msg = urlencode($msg);
		$file = @file_get_contents("http://irc.ultimateclan.net/post_irc.php?u=UCVerse&msg=".$msg."&mode=PRIVMSG");
		echo $file;
	}

	/* if($exp2['3'] == ":!face") {
		$nickname = trim(preg_replace('/\s\s+/', ' ', $exp2['4']));
		fputs($socket,"PRIVMSG #UC :{$nickname}, you just suck!\r\n");
		sleep(3);
		fputs($socket,"PRIVMSG #UC :I don't know why your face looks like this\r\n");
		sleep(3);
		fputs($socket,"PRIVMSG #UC :But... well... idk either what you do here....\r\n");
		sleep(3);
		fputs($socket,"PRIVMSG #UC :Please call a doctor {$nickname} cause your face looks shitty to be honest.\r\n");
		sleep(3);
		fputs($socket,"PRIVMSG #UC :And back when you will be in better face condition\r\n");
	} */

	if($exp2['1'] == "PART") {
		if($get_nickname == "UCVerse") {
			fputs($socket,"JOIN #UC \r\n");
		}
	}

	if($exp2['1'] == "KICK") {
		if($get_nickname == "UCVerse") {
			fputs($socket,"JOIN #UC \r\n");
		}
	}

	if($exp2['1'] == "JOIN") {
		if($get_nickname != "UCVerse") {
			if($get_nickname != "UltimateClan") {
				fputs($socket,"PRIVMSG #UC :Welcome {$get_nickname} :) \r\n");
			}
		}
	}

	$nickuser = $get_nickname;
	$ircmsg2 = end(explode("UCVerse :", $sock_data));

	if($exp2['1'] == "PRIVMSG") {
		if($exp2['2'] == "UCVerse") {
			if($get_nickname != "CTCP") {
				if($exp['2'] == "join\r\n") {
					fputs($socket,"JOIN #UC \r\n");
				} elseif($exp2['3'] == ":RAWCMD") {
					$formatted = str_replace("RAWCMD ", "", $ircmsg2);
					fputs($socket, $formatted."\r\n");
				} elseif($exp2['3'] == ":VERSION\r\n" || $exp2['3'] == ":VERSION\r\n") {
					fputs($socket,"NOTICE {$get_nickname} :VERSION UCVerse 1.1beta\r\n");
				} elseif($exp2['3'] == ":PING" || $exp2['3'] == ":PING") {
					$pingreply = ((int)$exp2['4'])-420;
					fputs($socket,"NOTICE {$get_nickname} :PING {$pingreply}\r\n");
				} else {
					fputs($socket,"PRIVMSG #UC :{$get_nickname} @ PRIVMSG: {$exp['2']}\r\n");
					$msg = trim(preg_replace("/\s\s+/", " ", "{$get_nickname} @ PRIVMSG: {$exp['2']}"));
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

	$mode = $exp2['1'];

	if($mode == "PRIVMSG") {
			$ircmsg = end(explode("#UC :", $sock_data));

			$str = $ircmsg;

			$asd = explode(" ", $str);
			foreach($asd as $asdasd) {
				$to = parse_url($asdasd);

				if(in_array($to['scheme'], array('http', 'https'))) {
					if(in_array($to['host'], array('youtube.com', 'www.youtube.com', 'm.youtube.com')) && $to['path'] == "/watch") {
					    $get_id = str_replace("v=", "", $to['query']);
					    $get_id = explode(" ", $get_id);
					    $get_id2 = explode("&", $get_id['0']);
					    $id_yt = str_replace("__", "", $get_id2['0']);
					    $id_yt = trim(preg_replace('/\s\s+/', ' ', $id_yt));
					    $content = file_get_contents("http://youtube.com/get_video_info?video_id=".$id_yt);
					    parse_str($content, $ytarr);
					    if($ytarr['title'] != NULL) {

					    	$totaltime = $ytarr['length_seconds'];
							$time = $totaltime/60;
							$time2 = explode(".", $time);
							$time3 = $totaltime-(60*$time2['0']);
							if(strlen($time3) == '1') {
								$time3 = "0".$time3;
							} else {
								$time3 = $time3; //LOL OBVIOUS
							}
							$dur = $time2['0'].":".$time3;

						    fputs($socket,"PRIVMSG #UC :4 ----- YOUTUBE API -----\r\n");
						    fputs($socket,"PRIVMSG #UC :4 Title: ".$ytarr['title']."\r\n");
						    fputs($socket,"PRIVMSG #UC :4 Author: ".$ytarr['author']."\r\n");
						    fputs($socket,"PRIVMSG #UC :4 Duration: ".$dur."\r\n");
						    fputs($socket,"PRIVMSG #UC :4 -----------------------\r\n");
						}
					} elseif($to['host'] = "youtu.be") {
						$id_yt = str_replace("__", "", $to['path']);
						$id_yt = str_replace("/", "", $id_yt);

						$content = file_get_contents("http://youtube.com/get_video_info?video_id=".$id_yt);
					    parse_str($content, $ytarr);
					    if($ytarr['title'] != NULL) {

					    	$totaltime = $ytarr['length_seconds'];
							$time = $totaltime/60;
							$time2 = explode(".", $time);
							$time3 = $totaltime-(60*$time2['0']);
							if(strlen($time3) == '1') {
								$time3 = "0".$time3;
							} else {
								$time3 = $time3; //LOL OBVIOUS
							}
							$dur = $time2['0'].":".$time3;

						    fputs($socket,"PRIVMSG #UC :4 ----- YOUTUBE API -----\r\n");
						    fputs($socket,"PRIVMSG #UC :4 Title: ".$ytarr['title']."\r\n");
						    fputs($socket,"PRIVMSG #UC :4 Author: ".$ytarr['author']."\r\n");
						    fputs($socket,"PRIVMSG #UC :4 Duration: ".$dur."\r\n");
						    fputs($socket,"PRIVMSG #UC :4 -----------------------\r\n");
						}
					} else {
						fputs($socket,"PRIVMSG #UC :4 -- UNKNOWN DATA (".$to['host'].")\r\n");
					}
				} elseif(substr($asdasd, 0, 4) == "www.") {
					if(substr($asdasd, 4, 7) == "youtube") {
						$to = parse_url("http://".$asdasd);
						$id_yt = str_replace("__", "", $to['path']);
						$id_yt = str_replace("/", "", $id_yt);

						$content = file_get_contents("http://youtube.com/get_video_info?video_id=".$id_yt);
						parse_str($content, $ytarr);
						if($ytarr['title'] != NULL) {

						  	$totaltime = $ytarr['length_seconds'];
							$time = $totaltime/60;
							$time2 = explode(".", $time);
							$time3 = $totaltime-(60*$time2['0']);
							if(strlen($time3) == '1') {
								$time3 = "0".$time3;
							} else {
								$time3 = $time3; //LOL OBVIOUS
							}
							$dur = $time2['0'].":".$time3;

						    fputs($socket,"PRIVMSG #UC :4 ----- YOUTUBE API -----\r\n");
						    fputs($socket,"PRIVMSG #UC :4 Title: ".$ytarr['title']."\r\n");
						    fputs($socket,"PRIVMSG #UC :4 Author: ".$ytarr['author']."\r\n");
						    fputs($socket,"PRIVMSG #UC :4 Duration: ".$dur."\r\n");
						    fputs($socket,"PRIVMSG #UC :4 -----------------------\r\n");
						}
					}
				}
			}
	} else {
		$ircmsg = $exp['2'];
	}

	if(!in_array($nickuser, array("Global", "CTCP", "PING", "NOTICE", "AuthServ", "Limestone.TX.US.GameSurge.net"))) {
		if($mode == "JOIN") {
			echo "[JOIN] ".$nickuser.": ".$ircmsg."\r\n";
		} elseif($mode == "QUIT") {
			if($mode != NULL) {
				echo "[QUIT] ".$nickuser.": ".$ircmsg."\r\n";
			}
		} else {
			if($mode != NULL) {
				echo "[".$mode."] ".$nickuser.": ".$ircmsg."";
			}
		}
	}

	if($mode == "JOIN") {
		$file = @file_get_contents("http://irc.ultimateclan.net/post_irc.php?u=".$nickuser."&msg=Joined&mode=".$mode);
		echo $file;
	} else {	
		if($nickuser != NULL AND $ircmsg != NULL) {
			if(in_array($nickuser, array("Global", "CTCP", "PING", "AuthServ", "Limestone.TX.US.GameSurge.net", "UCVerse"))) {

			} else {
				if($exp2['2'] != "UCVerse") {
					$msg = trim(preg_replace('/\s\s+/', ' ', $ircmsg));
					$msg = urlencode($msg);
					$file = @file_get_contents("http://irc.ultimateclan.net/post_irc.php?u=".$nickuser."&msg=".$msg."&mode=".$mode);
					echo $file;
				}
			}
		}	
	}

	ob_flush();
	flush();
	$x++;
}

ob_end_flush();
?>
