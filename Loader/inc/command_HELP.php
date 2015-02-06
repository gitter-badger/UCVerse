<?php

	$method = "PRIVMSG";

	if($exp['2'] == "!help\r\n") {
		fputs($socket, $method." ".$channelname." :Help:  [required] (optional)\r\n");

		fputs($socket, $method." ".$channelname." :!ae  Returns: aeeee...\r\n");		
		fputs($socket, $method." ".$channelname." :!bot [uptime / info]  Shows UCVerse informations about uptime and resources in use\r\n");		
		fputs($socket, $method." ".$channelname." :!cb [anytext]  Speak with CleverBot\r\n");	
		fputs($socket, $method." ".$channelname." :!eval [php code]  Execute Sanboxed PHP Code\r\n");
		sleep(1);	
		fputs($socket, $method." ".$channelname." :!fb [nick]  Bans an user for 15 seconds\r\n");	
		fputs($socket, $method." ".$channelname." :!help  Returns this\r\n");	
		fputs($socket, $method." ".$channelname." :!lol(anytext)  Just \"Indeed nickname\" \r\n");	
		fputs($socket, $method." ".$channelname." :!pong  Returns your PING between You and UCVerse \r\n");
		sleep(1);		
		fputs($socket, $method." ".$channelname." :!roll / !roll2  Roll Dice\r\n");	
		fputs($socket, $method." ".$channelname." :!seen [nick]  Shows information about last used trigger by nick (PRIVMSG / QUIT / PART / JOIN)\r\n");	
		fputs($socket, $method." ".$channelname." :!time  Gives current time\r\n");	
		fputs($socket, $method." ".$channelname." :!translate ((lang1)|lang2) [anytext]  Translates a text using Google Translate. (By default: english)\r\n");
		sleep(1);		
		fputs($socket, $method." ".$channelname." :!unfuck [nick]  Unfucks an user\r\n");	
		fputs($socket, $method." ".$channelname." :!wo [today / next]  Shows information about next or today WormOlympics.com tournament\r\n");	
		fputs($socket, $method." ".$channelname." :!wqdb [integer]  Shows a quote from WQDB.org\r\n");	
		fputs($socket, $method." ".$channelname." ://END OF !help\r\n");	
	}
?>
