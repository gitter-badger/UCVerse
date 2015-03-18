<?php

$specialtags = array(
	'BOLD'				=> chr(2),
	'MASK'				=> chr(22),
	'ITALIC'			=> chr(29),
	'UNDERLINE'			=> chr(31),
	'COLOR_WHITE' 		=> chr(3)."00",
	'COLOR_BLACK'	 	=> chr(3)."01",
	'COLOR_BLUE' 		=> chr(3)."02",
	'COLOR_GREEN' 		=> chr(3)."03",
	'COLOR_RED' 		=> chr(3)."04",
	'COLOR_BROWN'	 	=> chr(3)."05",
	'COLOR_PURPLE' 		=> chr(3)."06",
	'COLOR_ORANGE' 		=> chr(3)."07",
	'COLOR_YELLOW' 		=> chr(3)."08",
	'COLOR_LIGHTGREEN' 	=> chr(3)."09",
	'COLOR_CYAN' 		=> chr(3)."10",
	'COLOR_LIGHTCYAN' 	=> chr(3)."11",
	'COLOR_LIGHTBLUE' 	=> chr(3)."12",
	'COLOR_PINK' 		=> chr(3)."13",
	'COLOR_GREY' 		=> chr(3)."14",
	'COLOR_LIGHTGREY' 	=> chr(3)."15",
	'COLOR_EXIT' 		=> chr(3) //TODO: Autoclose colors?
);

foreach($specialtags as $key => $value) {
	define($key, $value);
}

class UCVerse {
  function say() {
    
  }
  
  function notice() {
  
  }
  
  function kick() {
  
  }
  
  function ban() {
  
  }
  
  function log() {
  
  }
  
  function addcommand() {
  
  }
  
  /* ETC ETC... just a snippet */
}

?>
