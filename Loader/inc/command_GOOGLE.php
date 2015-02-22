<?php
	if($exp2['3'] == ":!google") {
		$expplde = end(explode(":!google ", $sock_data));
		$expplde = trim(preg_replace("/\s\s+/", "", $expplde));
		$google = urlencode($expplde);

		$google = 'http://www.google.com/search?q='.$google.'&btnI=q';

		$google = get_headers($google);

		foreach($google as $loc) {
			$explode = explode(": ", $loc);
			if($explode[0] == "Location") {
				$urls[] = $explode[1];
			}
		}

		$count = count($urls)-1;

		$exacturl = $urls[$count];
		$parseurl = parse_url($exacturl);

		if($parseurl['host'] == "www.google.pl" && $parseurl['path'] == "/search") {

			print_r(get_headers($exacturl));

			$thislink = "Not feeling lucky: ";
			$thislink .= $exacturl;
		} else {
			$thislink = $exacturl;
		}

		fputs($socket,"PRIVMSG ".$channelname." :".($thislink)."\r\n");

		unset($urls);
	}
?>
