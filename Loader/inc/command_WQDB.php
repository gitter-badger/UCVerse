<?php
	if($exp2['3'] == ":!wqdb") {
	  	//$id = (int)
	  	$id = preg_replace("/[^0-9]/", "", $exp2['4']);

	  	if($id == NULL) {
	  		$id = '0';
	  	}

		$url = file_get_contents("http://wqdb.org/?fullquote&".$id);

		if($url == NULL) {
			$url = file_get_contents("http://metonator-proxy.appspot.com/wqdb.org/?fullquote&".$id);
		}

		if($url == NULL) {
			fputs($socket,"PRIVMSG ".$channelname." :http://185.25.149.169:666/search.jpg\r\n");
			sleep(3);
			fputs($socket,"PRIVMSG ".$channelname." :FOUND ONE!!1111111oneoneone!!!1\r\n");
			$id = rand(1, 830);
			$url = file_get_contents("http://wqdb.org/?fullquote&".$id);

			if($url == NULL) {
				$url = file_get_contents("http://metonator-proxy.appspot.com/wqdb.org/?fullquote&".$id);
			}
		}

		if($url == NULL) {
			fputs($socket,"PRIVMSG ".$channelname." :http://185.25.149.169:666/search.jpg\r\n");
		} else {

			$options = array(
				'http'=>array(
					'method' => "GET",
					'header' => "User-Agent: UCVerse 1.3a (Zexorz bot on #UC @ Gamesurge)\r\n"
				)
			);

			$context = stream_context_create($options);

			$parse_html_document = @file_get_contents('http://wqdb.org/?'.$id, false, $context);
			if($url == NULL) {
				$parse_html_document = @file_get_contents('http://metonator-proxy.appspot.com/wqdb.org/?'.$id, false, $context);
			}
			preg_match("/ - Rating (.*) - /", $parse_html_document, $wqdb_likes);
			preg_match("/Submitted by:(.*) on (.*)/", $parse_html_document, $match2);

			if($match2 != NULL) {
				$author = " | Author: ".$match2['1'];
			} else {
				$author = "";
			}

			$quo = '1';

			fputs($socket,"PRIVMSG ".$channelname." :Entry ID: ".$id." | Fucks given: ".$wqdb_likes['1'].$author."\r\n");
			$quotes = explode(PHP_EOL, str_replace('<br />', '', htmlspecialchars_uni($url)));    
	    	foreach($quotes as $qt) {
	    		if(count($quotes) >= '10') {
	    			if($quo <= '10') {
		      			fputs($socket,"PRIVMSG ".$channelname." :".$qt."\r\n");
		      			sleep('1');
		      		} elseif($quo == '11') {
		      			fputs($socket,"PRIVMSG ".$channelname." :7More at: 12http://wqdb.org/?".$id."\r\n");
		      		}
		      		$quo++;
		      	} else {
		      		fputs($socket,"PRIVMSG ".$channelname." :".$qt."\r\n");
		      		sleep('1');
		      	}
	    	}
		}
	}
?>