<?php

if($to['host'] == 'soundcloud.com') {

	$link = $to['scheme']."://".$to['host'].$to['path'];

	$reply = @file_get_contents("http://ultimateclan.net/clever/SC/parse_SOUNDCLOUD.php?lnk=".$link);
	fputs($socket,"PRIVMSG ".$channelname." :{$reply}\r\n"); 
}
?>
