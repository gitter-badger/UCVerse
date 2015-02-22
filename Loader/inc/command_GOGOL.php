<?php
	if($exp2['3'] == ":!gogol") {
		$expplde = end(explode(":!gogol ", $sock_data));
		$gogol = trim(preg_replace("/\s\s+/", "", $expplde));

		if($gogol == NULL) {
			fputs($socket,"PRIVMSG ".$channelname." :You're so unlucky ".$get_nickname." that i dont even know what you want.\r\n");
		} else {
			$url = "http://gogol.librelogiciel.com/cgi-bin/gogol.cgi";

			$postdata = http_build_query(
				array(
					'q' => $gogol,
					'_gogol' => '_gogol',
					'_charset_' => NULL,
					'btnI' => "I'm feeling unlucky with Gogol !"
				)
			);

			$opts = array('http' =>
				array(
					'method'  => 'POST',
					'header'  => 'Content-type: application/x-www-form-urlencoded',
					'content' => $postdata
				)
			);

			$context  = stream_context_create($opts);
			$stream = fopen($url, 'r', false, $context);

			$meta = stream_get_meta_data($stream);
			$headers = $meta['wrapper_data'];
			$location = $headers['3'];

			$location = str_replace("Location: ", "", $location);

			fputs($socket,"PRIVMSG ".$channelname." :".($location)."\r\n");
			unset($meta);
		}
	}
?>
