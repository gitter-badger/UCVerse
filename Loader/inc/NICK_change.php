<?php

$address = end(explode("@", $exp2['0']));
$starting_ip = explode(".", $address);

$get_exact_nick = $starting_ip['0'];
if($exp2['1'] == 'NICK' && $get_exact_nick == 'UCVerse') {
	$getitnickyminaj = str_replace(":", "", trim(preg_replace("/\s\s+/", "", $exp2['2'])));
	$botname = $getitnickyminaj;
	echo PHP_EOL.PHP_EOL."NICK CHANGED!!!".PHP_EOL.PHP_EOL;
}

?>