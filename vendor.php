<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$cas=$_POST['cas'];
$runpython="/home/mzhu7/chemroutes/sigma.py ".$cas;
echo $runpython;
$command=escapeshellcmd($runpython);
$output=shell_exec($command);
echo $output;
$outputs= explode("\n",$output);


for ($i=0;$i<count($outputs)-1;$i++){
	echo $outputs[$i];
}


?>
