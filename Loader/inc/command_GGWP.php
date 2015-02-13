<?php
	if($exp2['3'] == ":!ggwp" && $exp2['4'] != NULL) {
		$tokick = trim(preg_replace('/\s\s+/', '', $exp2['4']));

		if(!in_array($get_nickname, array("LeTotalKiller", "Zexorz"))) {
			fputs($socket,"KICK ".$channelname." ".$get_nickname." :[SelfKick] Oh yea good game well played bro :P\r\n"); 
		} elseif($tokick == "Triad") {
			fputs($socket,"KICK ".$channelname." ".$get_nickname." :NOU XD\r\n"); 
		} else {
			fputs($socket,"KICK ".$channelname." ".$tokick." :Oh yea good game well played bro :P\r\n"); 
		}
	}
?>
