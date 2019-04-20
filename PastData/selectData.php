<?php
//header("Content-type: application/json;charset=UTF-8");
//header("Cache-Control:no-cache");
include_once("../path.php");
$output="";
if(isset($_POST['loc'])){
	$locat =$_POST['loc'];
	$output= shell_exec("$path $locat 2>&1");
	$output = str_replace("'",'"',$output);
	echo json_encode($output);
}else{
	$output= shell_exec("$path 'Central/western' 2>&1");
	$output = str_replace("'",'"',$output);
	echo json_encode($output);
//	echo gettype($output);
//	echo json_encode("a");
}
?>
