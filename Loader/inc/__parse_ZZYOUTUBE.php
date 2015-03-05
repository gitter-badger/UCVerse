				<?php 

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

						    fputs($socket,"PRIVMSG ".$channelname." :4[► YOUTUBE API] ".$ytarr['title']." by ".$ytarr['author']." (".$dur.")\r\n");
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

							fputs($socket,"PRIVMSG ".$channelname." :4[► YOUTUBE API] ".$ytarr['title']." by ".$ytarr['author']." (".$dur.")\r\n");
						}
					} else {
						fputs($socket,"PRIVMSG ".$channelname." :4 -- UNKNOWN DATA (".$to['host'].")\r\n");
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

							fputs($socket,"PRIVMSG ".$channelname." :4[► YOUTUBE API] ".$ytarr['title']." by ".$ytarr['author']." (".$dur.")\r\n");
						}
					}
				}
			?>
