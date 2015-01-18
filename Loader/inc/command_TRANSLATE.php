<?php
	if($exp2['3'] == ":!translate") {
		$expplde = explode(":!translate ", $sock_data);
		$sendtocb = trim(preg_replace('/\s\s+/', '', $expplde['1']));
		$explode_words = explode(" ", $sendtocb);

		if(strlen($explode_words['0']) == "2") {
			$sendtocb = substr($sendtocb, 3);

			$sendtocb = urlencode($sendtocb);
			$reply = @file_get_contents("https://translate.google.com/translate_a/single?client=t&sl=".$explode_words['0']."&tl=en&hl=pl&dt=bd&dt=ex&dt=ld&dt=md&dt=qc&dt=rw&dt=rm&dt=ss&dt=t&dt=at&ie=UTF-8&oe=UTF-8&otf=2&rom=0&ssel=3&tsel=6&tk=516524|805520&q=".$sendtocb);
		} elseif(strlen($explode_words['0']) == "5") {
			$sendtocb = substr($sendtocb, 6);

			$explode_targets = explode("|", $explode_words['0']);

			$sendtocb = urlencode($sendtocb);
			$reply = @file_get_contents("https://translate.google.com/translate_a/single?client=t&sl=".$explode_targets['0']."&tl=".$explode_targets['1']."&hl=pl&dt=bd&dt=ex&dt=ld&dt=md&dt=qc&dt=rw&dt=rm&dt=ss&dt=t&dt=at&ie=UTF-8&oe=UTF-8&otf=2&rom=0&ssel=3&tsel=6&tk=516524|805520&q=".$sendtocb);
		} else {
			$sendtocb = urlencode($sendtocb);
			$reply = @file_get_contents("https://translate.google.com/translate_a/single?client=t&sl=auto&tl=en&hl=pl&dt=bd&dt=ex&dt=ld&dt=md&dt=qc&dt=rw&dt=rm&dt=ss&dt=t&dt=at&ie=UTF-8&oe=UTF-8&otf=2&rom=0&ssel=3&tsel=6&tk=516524|805520&q=".$sendtocb);
		}

		/*preg_match("/(.*?)]]/", $reply, $matches);
		$antydecode =  json_encode($json);
		$json = str_replace("[[[", "[", $matches['1'])."]";
		$json = json_decode($json);

		$reply = $json;

		$reply = trim(preg_replace('/\s\s+/', '', ucfirst($json['0'])));*/
		
		$reply = substr($reply, 0, 255);
		$reply = str_replace("[[[", "[", explode("\"]", $reply)['0']."\"]");
		$reply = json_decode($reply);
		$reply = $reply['0'];
		
		if($reply != NULL) {
			fputs($socket,"PRIVMSG ".$channelname." :4[{$get_nickname} / Translation Beta]: {$reply}\r\n"); 
			//fputs($socket,"PRIVMSG ".$channelname." :4[DEBUG]: {$antydecode}\r\n"); 
		} else {
			fputs($socket,"NOTICE ".$get_nickname." :Sorry. I were unable to fetch it.\r\n"); 
		}
	}
?>
