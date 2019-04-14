<!doctype html>
<?php
$path='python getPast.py';
//$output = json_decode(str_replace("'",'"',$output),true);
?>

<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="../MainPage/jslib/jquery-1.11.1.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<script type='text/javascript'>
   var lc = ['Central/western','Eastern','Kwun Tong','Sham Shui Po',
                'Kwai Chung','Tsuen Wan','Tseung Kwan O','Yuen Long',
                'Tuen Mun','Tung Chung','Tai Po','Sha Tin',
                'Tap Mun','Causeway Bay','Central','Mong Kok'];  
$("document").ready(function(){
		$.each(lc ,function(key,value){
		$("#location").append(
			"<option vaule='"+value+"'>"+value+"</option>");
		});
	getTable();
 
    // Automatically add a first row of data
});
function chTable(){
	document.cookie = "lct ="+$("#location").val();
var t = $('#ta').DataTable();
	t.clear().draw();
alert(<?=json_encode($loca)?>);
getTable();
}	
function getTable(){


	var t = $('#ta').DataTable();
    var counter = 1;
	<?php
	$output;
	if (!isset($_COOKIE["lct"]))
		$output= shell_exec("$path 'Central/western' 2>&1");
	else{
		$loca = $_COOKIE['lct'];
		$output= shell_exec("/Users/fei/anaconda3/bin/python getPast.py $loca 2>&1"); 
		 unset($_COOKIE['lct']);
	}
	$output = json_decode(str_replace("'",'"',$output),true);
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
	<?php		
	} ?>

	
}
	
</script>
<body>
<center>
	<div id="test">
	<select name="" id="location" onChange ="chTable()">
		
	</select>
	
	<div >
		<table id="ta" class="display" style="width:100%">
			<thead>
			    <tr>
					<th>No.</th>
                <th>Date Time</th>
                <th>NO2</th>
                <th>O3</th>
                <th>SO2</th>
                <th>CO</th>
                <th>PM10</th>
                <th>PM25</th>
            </tr>
        </thead>
			<tbody>
        </tbody>
        <tfoot>
            <tr>
         
            </tr>
        </tfoot>
		</table>
	</div>
	<p>
		Some Information: <a href="https://www.epd.gov.hk/epd/tc_chi/environmentinhk/air/data/air_data.html" target="_blank">Data & Statistics</a>
	</p>
	<p>		Some Information: <a href="http://www.hko.gov.hk/cis/climat_c.htm" target="_blank">Climatological Information Services</a></p>
</div>
</center>
</body>
	<style>

@media only screen and (max-width:  1000px) {


    #test{
margin-top: 20%;
    }

}
	</style>
</html>