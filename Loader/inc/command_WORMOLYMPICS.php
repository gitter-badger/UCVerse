<?php
	if($exp2['3'] == ":!wo") {
		if($exp2['4'] == "next\r\n") {
			$filename = "http://wormolympics.com/api/tournaments/next";
			$file = simplexml_load_file($filename);
			if($file->tournament->scheme != NULL) {
				$message = "Next tournament is ".$file->tournament->scheme." hosted by ".$file->tournament->hoster." on ".$file->tournament->channel." ".$file->next." (".$file->tournament->url.")";
			} else {
				$message = "WormOlympics is over ;)";
			}
			fputs($socket,"PRIVMSG ".$channelname." :".$message."\r\n"); 
		} elseif($exp2['4'] == "today\r\n") {
			$filename = "http://wormolympics.com/api/tournaments/today";
			$file = simplexml_load_file($filename);

			fputs($socket,"PRIVMSG ".$channelname." :Today tournament for Wormolympics:\r\n");

			$number = '1';
			foreach($file->tournament as $tour) {
				fputs($socket,"PRIVMSG ".$channelname." :".$number.". ".$tour->scheme." hosted by ".$tour->hoster." on ".$tour->channel." at ".$tour->time." (".$tour->url.")\r\n");
				$number++;
			}
		} else {
			fputs($socket,"PRIVMSG ".$channelname." :Unknown command from !wo, next and today are only supported!\r\n"); 
		}
	}
?>