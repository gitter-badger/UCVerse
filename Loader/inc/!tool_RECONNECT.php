<?php

//Nothing, will help as logging system.
$array1 = print_r($exp, true);
$array2 = print_r($exp2, true);

$loggingfile = fopen('log.ucv', 'a');
fwrite($loggingfile, "Array_1: ".json_encode($array1).PHP_EOL."Array_2: ".json_encode($array2).PHP_EOL."---------------------------------".PHP_EOL);
fclose($loggingfile);

?>