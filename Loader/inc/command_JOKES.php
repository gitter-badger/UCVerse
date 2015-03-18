<?php
	if($exp['2'] == "!joke\r\n") {
		
		$file = file_get_contents("http://api.icndb.com/jokes/random");
		$joke = json_decode($file);

		if ($joke) {
			if (isset($joke->value->joke)) {
				fputs($socket,"PRIVMSG ".$channelname." :".html_entity_decode($joke->value->joke)."\r\n"); 
			} else {
				fputs($socket,"PRIVMSG ".$channelname." :I don't feel like laughing today. :(\r\n"); 
			}
		} else {
			fputs($socket,"PRIVMSG ".$channelname." :I don't feel like laughing today. :(\r\n"); 
		}
	}
?>
