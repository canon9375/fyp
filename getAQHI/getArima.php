<?php
include("../path.php");
$output = shell_exec("$path2 printArimaJson.py");
$output = str_replace("'",'"',$output);
echo json_encode($output);
?>