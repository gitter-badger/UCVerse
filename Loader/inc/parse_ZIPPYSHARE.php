<?php

$zippy_explode = explode('.', $to['host']);
$zippyaddress = $zippy_explode['1'].'.'.$zippy_explode['2'];

if($zippyaddress == 'zippyshare.com') {

	$link = $to['scheme']."://".$to['host'].$to['path'];

	$str = file_get_contents($link);
	$str = strip_tags($str);

	preg_match('/(?P<foo>Name): (.*)/', $str, $matches);

	$title = $matches['2'];
	$title = trim(preg_replace('/\s\s+/', '', $title));

	fputs($socket,"PRIVMSG ".$channelname." :4[► ZIPPY API] {$title}\r\n");
}
 
?>