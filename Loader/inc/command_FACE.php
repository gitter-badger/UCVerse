<?php
	/*if($exp2['3'] == ":!face") {
		$nickname = trim(preg_replace('/\s\s+/', ' ', $exp2['4']));
		fputs($socket,"PRIVMSG ".$channelname." :{$nickname}, your face is [[INSERT CUSTOM FACE WORDS HERE]]\r\n");
	}*/

	if($exp2['3'] == ":!hug" || $exp2['3'] == ":!hug\r\n") {
		fputs($socket,"KICK ".$channelname." ".$get_nickname." :Hugg'd :>\r\n");
	}
?>