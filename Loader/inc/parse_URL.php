<?php

$domain = end(explode('.', $to['host']));
if(isset($to['host']) && ($to['scheme'] == "http" || $to['scheme'] == "https")/* && (strlen($domain) >= 2 AND strlen($domain) <= 5)*/) {
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
				$time3 = $time3;
			}
			
			$dur = $time2['0'].":".$time3;

			fputs($socket,"PRIVMSG ".$channelname." :4[► URL Parse] ".$ytarr['title']." by ".$ytarr['author']." (".$dur.")\r\n");
		}
	} else {
		$link = $to['scheme']."://".$to['host'].$to['path'];

		$file_parse = @file_get_contents($link);
		if($file_parse) {
			preg_match("/\<title\>(.*)\<\/title\>/", $file_parse, $title);
			if($title[1] != NULL) {
				$title = html_entity_decode($title[1]);
				//$title = (strlen($title) > 50) ?  substr_replace($title,"...",50) :  $title;
				fputs($socket,"PRIVMSG ".$channelname." :4[URL Parse] ".$title."\r\n");
			}
		}
	}
}
 
?>
