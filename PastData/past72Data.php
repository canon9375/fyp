<!doctype html>
<?php
include_once("../path.php");
//include_once("../index.php");
//include_once("selectData.php");
//$output= shell_exec("$path 'Central/western' 2>&1");

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
	var t;
$("document").ready(function(){
	$(document).ajaxStart(function(){
    	$("#wait").css("display", "block");
		$("#test").css("display", "none");
  	});
  	$(document).ajaxComplete(function(){
		$("#wait").css("display", "none");
		$("#test").css("display", "block");
  	});
		t =  $('#ta').DataTable();
		$.each(lc ,function(key,value){
		$("#location").append(
			"<option vaule='"+value+"'>"+value+"</option>");
		});
		$("#loBtn").click(function(){
			t.clear().draw();
			selLoc = $("[id=location]").val();
			callAjax({loc:selLoc});
		});
   
callAjax({});
});
function callAjax(sdData){
	$.ajax({
       type: 'POST',
       url: 'selectData.php',
		data: sdData, 
		contentType: "application/x-www-form-urlencoded;charset=utf-8",
       dataType: 'json',
		success: function(data,status, XMLHttpRequest)
       {
				data = JSON.parse(data);
				var counter =1;
				$.each(data,function(k,v){   
					t.row.add( [
						counter ,
						k,v[0],v[1],v[2],v[3],
						v[4],v[5],v[6],v[7]
					]).draw( false );
 					counter++;	
				});	
			
	   },
          error:function(err){
			 console.log(err);
          }
				
	   });	
}


</script>
<body>
<?php include("../loadingPage.html"); ?>

<center>
	<div id="test">
	<select name="location" id="location">
		
	</select>
	<button id="loBtn">OK</button>
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
					<th>AQHI</th>
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