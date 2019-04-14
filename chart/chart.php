<!doctype html>
<?php
//echo shell_exec('/Users/fei/anaconda3/bin/python --V 2>&1');
//echo shell_exec('echo $PATH 2>&1');
$output= shell_exec('python ./python/my_last16Compare.py 2>&1');
$output = json_decode(str_replace("'",'"',$output),true);

?>

<html>

<style>
	
@media only screen and (max-width:  700px) {


    #test{

       margin-top: 20%;
    }

}

	</style>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript" src="../MainPage/jslib/jquery-1.11.1.js"></script>	
 <script type='text/javascript'>

	   google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawCurveTypes);

function drawCurveTypes() {

	<?php
		foreach($output as $key => $v){
			?>
			var count=1;
			var id= <?=json_encode($key, JSON_HEX_TAG)?>;
			$("body").append("<div id='"+id+"'></div>");
			var data= new google.visualization.DataTable();
			data.addColumn('number', 'Times');
    		data.addColumn('number', 'Actual');
    		data.addColumn('number', 'Predict');
			<?php
			foreach($v as $b){
				?>
				var acl =parseInt(<?=json_encode($v[0], JSON_HEX_TAG)?>);
				var pre =parseInt(<?=json_encode($v[1], JSON_HEX_TAG)?>);
				data.addRows([[count,acl,pre]]);
				count= count +1;
				var options = {
					chart: {
					  title: 'Random Forest-Last 10 Times Compare',
					  subtitle: id
					},
					width: 600,
					height: 300
			  };
				
				<?php
			} ?>
			var chart = new google.charts.Line(document.getElementById(id));
			chart.draw(data, google.charts.Line.convertOptions(options));
			<?php
			
		}
	
	?>
      
    }
	</script>
</head>
<body>
	<div id="test">
	<div class="se-pre-con"></div>
  <div id="chart_div1"></div>
	<div id="t"></div>
	</div>
</body>
</html>