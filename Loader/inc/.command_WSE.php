<?php

$wse_array = array();

$wse_array['time'] = time();
$wse_array['online'] = '0';

if(time() >= $wse_array['time']) {
	$file = @file_get_contents("http://wse.worms2d.info/2014.php");
	if($file && $wse_array['online'] == '0') {
		$wse_array['online'] = '1';
		fputs($socket,"PRIVMSG #UC :WSE2014 IS ONLINE!!! [http://wse.worms2d.info/2014.php]\r\n");
	}
	$wse_array['time'] = time()+500;
}

?>