<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
<script>
function getTable(){
	alert('ok');
	
    var counter = 1;
	<?php
//	$output = json_decode(str_replace("'",'"',$output),true);
	if(!is_null($output)){
	foreach($output as $k1 => $v1){
	?>
			t.row.add( [
				counter ,
				<?=json_encode($k1)?>,
				<?=json_encode($v1[0])?>,
				<?=json_encode($v1[1])?>,
				<?=json_encode($v1[2])?>,
				<?=json_encode($v1[3])?>,
				<?=json_encode($v1[4])?>,
				<?=json_encode($v1[5])?>,
				<?=json_encode($v1[6])?>,
        	]).draw( false );
 			counter++;
<?php } 
	} ?>
}
	</script>
</body>
</html>