<?php
	if(strtolower($exp2['3']) == ":!seen") {
	  	$id = trim(preg_replace("/\s\s+/", "", $exp2['4']));

	  	if($id == 'NULL') {
		  	$wiads = "And for who should i search?";
	  	} else {
	  		if($id == $get_nickname) {
	  			$wiads = "Orly {$get_nickname}?";
	  		} else {
			  	$conn = mysql_connect('185.25.149.169', 'root', '');
			  	mysql_select_db('ultimateclan_net', $conn);

			  	$query = mysql_query("SELECT * FROM `mybb_irc` WHERE `nickname` = '".mysql_real_escape_string($id)."' ORDER BY `id` DESC LIMIT 0, 1");
			  	$numrw = mysql_num_rows($query);

			  	if($numrw == '0') {
			  		$wiads = "Sorry {$get_nickname}, i haven't seen {$id} around yet :(";
			  	} else {
			  		$rowy = mysql_fetch_array($query);

			  		if($id == 'UCVerse') {
				  			$wiads = "{$get_nickname}, {$id} fucked up your mother 2 seconds ago...";
			  		} else {
				  		if($rowy['MODE'] == 'NICK') {
				  			$wiads = "{$get_nickname}, {$id} changed his nick to {$rowy['message']} ".time_ago('@'.($rowy['time']))." ago!";
				  		} elseif($rowy['MODE'] == 'QUIT') {
					  		$wiads = "{$get_nickname}, {$id} quit ".time_ago('@'.($rowy['time']))." ago!";
					  	} elseif($rowy['MODE'] == 'PART') {
					  		$wiads = "{$get_nickname}, {$id} parted ".time_ago('@'.($rowy['time']))." ago!";
					  	} elseif($rowy['MODE'] == 'JOIN') {
					  		$wiads = "{$get_nickname}, {$id} joined ".time_ago('@'.($rowy['time']))." ago!";
					  	} elseif($rowy['MODE'] == 'PRIVMSG') {
					  		$wiads = "{$get_nickname}, {$id} typed something ".time_ago('@'.($rowy['time']))." ago!";
					  	} elseif($rowy['MODE'] == 'NOTICE') {
					  		$wiads = "{$get_nickname}, {$id} noticed something ".time_ago('@'.($rowy['time']))." ago!";
					  	} else {
					  		$wiads = json_encode($rowy);
					  	}
					}
			  	}
			}
		}

	  	fputs($socket,"PRIVMSG ".$channelname." :".$wiads."\r\n");
	  	unset($id);
	  	mysql_close($conn);
	}
?>