<?php

if($to['host'] == 'www.redtube.com') {
	fputs($socket,"PRIVMSG ".$channelname." :FAP FAP FAP FAP FAP FAP...\r\n");
	fputs($socket,"PRIVMSG ChanServ :ADDTIMEDBAN ".$channelname." ".$get_nickname." 1m ... FAP FAP FAP No porn allowed ".$get_nickname."\r\n");
}
 
?>