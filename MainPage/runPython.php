<?php
	include("../path.php");
	$output = shell_exec("$path2 printForestJson.py");
	$output = str_replace("'",'"',$output);
?>