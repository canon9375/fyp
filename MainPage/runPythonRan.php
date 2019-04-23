<?php
	include("../path.php");
	$output = shell_exec("$path2 printForestJson2.py");
	$output = str_replace("'",'"',$output);
?>