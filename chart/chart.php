<!doctype html>
<?php
//echo shell_exec('/Users/fei/anaconda3/bin/python --V 2>&1');
//echo shell_exec('echo $PATH 2>&1');
//$output= shell_exec('/Users/fei/anaconda3/bin/python ./python/my_last16Compare.py 2>&1');
//$resultData = json_decode($output, true);
//print_r($output);
?>

<html>


<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript" src="../MainPage/jslib/jquery-1.11.1.js"></script>	
 <script type='text/javascript'>

	   google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawCurveTypes);

function drawCurveTypes() {
	var data = new google.visualization.DataTable();
	data.addColumn('number', 'Times');
    data.addColumn('number', 'Actual');
    data.addColumn('number', 'Predict');
	<?php
		
	
	?>


	
data.addRows([
        [1,  3, 3],
        [2,  4, 3],
        [3,  4,    5],
  		[4,  3, 4],
        [5,  4, 4],
        [6,  5,    4],
		[7,  4, 4],
        [8,  4, 3],
        [9,  4,    4],
		[10,  3,    4],
   [11,  3, 3],
        [12,  4, 3],
        [13,  4,    5],
  		[14,  3, 4],
        [15,  4, 4],
        [16,  5,    4],
		[17,  4, 4],
        [18,  4, 3],
        [19,  4,    4],
		[20,  3,    4],
	  [21,  3, 3],
        [22,  4, 3],
        [23,  4,    5],
  		[24,  3, 4],
        [25,  4, 4],
        [26,  5,    4],
		[27,  4, 4],
        [28,  4, 3],
        [29,  4,    4],
		[30,  3,    4],
      ]);

      var options = {
        chart: {
          title: 'Random Forest-Last 30 Times Compare',
          subtitle: 'Mong KoK'
        },
        width: 600,
        height: 300
      };


        var chart = new google.charts.Line(document.getElementById('chart_div'));


        chart.draw(data, google.charts.Line.convertOptions(options));
    }
	</script>
</head>
<body>
	<div class="se-pre-con"></div>
  <div id="chart_div"></div>
	<div id="t"></div>
</body>
</html>