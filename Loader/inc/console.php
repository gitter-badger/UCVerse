<?php
if(!in_array($nickuser, array("Global", "CTCP", "PING", "NOTICE", "AuthServ", "NuclearFallout.WA.US.GameSurge.net"))) {
if($mode == "JOIN") {
echo "[JOIN] ".$nickuser.": ".$ircmsg."\r\n";
} elseif($mode == "QUIT") {
if($mode != NULL) {
echo "[QUIT] ".$nickuser.": ".$ircmsg."\r\n";
}
} else {
if($mode != NULL) {
echo "[".$mode."] ".$nickuser.": ".$ircmsg."";
}
}
}
if($mode == "JOIN") {
$file = @file_get_contents("http://irc.ultimateclan.net/post_irc.php?u=".$nickuser."&msg=Joined&mode=".$mode);
echo $file;
} else {
if($nickuser != NULL AND $ircmsg != NULL) {
if(in_array($nickuser, array("Global", "CTCP", "PING", "AuthServ", "NuclearFallout.WA.US.GameSurge.net", $botname))) {

} else {
if($exp2['2'] != $botname) {
$msg = trim(preg_replace('/\s\s+/', ' ', $ircmsg));
$msg = urlencode($msg);
$file = @file_get_contents("http://irc.ultimateclan.net/post_irc.php?u=".$nickuser."&msg=".$msg."&mode=".$mode);
echo $file;
}
}
}
}
?>