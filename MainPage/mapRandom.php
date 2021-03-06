<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Simple Marker Icons</title>
	  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	  <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
	  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	  <link rel="stylesheet" href="../bootstrap/css/bootstrap-responsive.min.css">
	  <link rel="stylesheet" href="../bootstrap/css/bootstrap-responsive.css">
	   <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
	  <script src="../bootstrap/js/bootstrap.js"></script>
	  <script src="../bootstrap/js/bootstrap.min.js"></script>
	   <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
	<script type="text/javascript" src="./jslib/jquery-1.11.1.js"></script>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map0,#map1,#map2,#map3 {
        height: 425px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
	.btn-group button {
	  background-color: #C6EFE3; /* Green background */
	  border: 1px solid #EEF4DA; /* Green border */
	  color: #615A5A; /* White text */
	  padding: 10px 24px; /* Some padding */
	  cursor: pointer; /* Pointer/hand icon */
	  float:none;
	  text-align:center;
	  font-size: 18px;
	}

	/* Clear floats (clearfix hack) */
	.btn-group:after {
	  content: "";
	  clear: both;
	  display: table;
	}

	.btn-group button:not(:last-child) {
	  border-right: none; /* Prevent double borders */
	}

	/* Add a background color on hover */
	.btn-group button:hover {
	  background-color: #8CCDC5;
		border-color: aqua;
	}
	.btn{
			font-size: 28px;
		margin: 10px;
	}

@media only screen and (max-width: 1000px) {
  .btn {
    display: block;
  }
}
@media only screen and (max-width: 513px) {
	#level{
		display: block;
	}
}
</style>
  </head>

  <body>
	 <?php include("../loadingPage.html"); ?>
	 <div id="myMain">
		 <h1>Random Forest and Ann Prediction</h1>
  <br><br><br><br>
<!--	 button set start-->
	  <center>
		  <div class="row">
		 <div class="container">
		  <button class="btn btn-group" id="b0" onClick="b0Show()">Now</button>
  		<button class="btn btn-group" id="b1" onClick="b1Show()">T+1</button>
  		<button class="btn btn-group" id="b2" onClick="b2Show()">T+2</button>
  		<button class="btn btn-group" id="b3" onClick="b3Show()">T+3</button>
		  </div>
		 </div>
	</center>
<!--	end of button set  -->
	  <br><br><br>

	  <canvas id="myCanvas" width="20" height="17" style="display:none">
</canvas>
	  
<!--	 start of map -->
	<div id="map0"></div>
    <div id="map1"></div>
    <div id="map2"></div>
    <div id="map3"></div>
	<div id="random"></div>
<!--	  end of map-->
<!--
	<table align="right">
		<tr>
			<td><canvas width="30" height="30"  id="src" > </canvas>:General Station</td>
			<td> <canvas width="30" height="30" id="rect"></canvas>:ANN prediction</td>
		</tr>
	</table>
-->
<div>
<div class="container" id="staInfo">
	<div class="row" align="right">
		 <div class="col-md-4 col-xs-offset-10"><canvas width="30" height="30"  id="src" > </canvas>:General Station</div>
		 <div class="col-md-4 col-xs-offset-10"><canvas width="25" height="25"  id="rect" > </canvas>:ANN Prediction</div>
	 </div>
		
</div>
<div class="container" style="display: inline-flex" id="level">
	<div class="row" align="left" style="display: inline-flex">
		 <div class=""><canvas width="100" height="100"  id="low" > </canvas></div>
		 <div class=""><canvas width="100" height="100"  id="moderate" > </canvas></div>
		<div class=""><canvas width="100" height="100"  id="high" > </canvas></div>
		 <div class=""><canvas width="100" height="100"  id="vhigh" > </canvas></div>
		 <div class=""><canvas width="100" height="100"  id="serious" > </canvas></div>
	 </div>
</div>

		
</div>
</div>
<script>
$(document).ready(function(){
	//gener setting 
	$("#map1").hide();
	$("#map2").hide();
	$("#map3").hide();
	//loading page
	$(document).ajaxStart(function(){
    	$("#wait").css("display", "block");
		$("#myMain").css("display", "none");
  	});
  	$(document).ajaxComplete(function(){
		$("#wait").css("display", "none");
		$("#myMain").css("display", "block");
  	});
	//drawing
	var c = document.getElementById("src");
	var ctx = c.getContext("2d");
	ctx.beginPath();
	ctx.arc(c.width/2,c.height/2,c.height/2,0,2*Math.PI);	
	ctx.closePath();
	ctx.stroke();
	ctx.restore();
	var c2 = document.getElementById("rect");
	var ctx2 = c2.getContext("2d");
	ctx2.strokeRect(0,0,c2.width,c2.height);
	ctx2.restore();
	drawBorad();
});
function drawBorad(){
	var risk = ["Low(1-3)","Moderate(4-6)","High(7)","Very High(8-10)","Serious(10)"];
	var riskId = ["low","moderate","high","vhigh","serious"];
	var bgc =["#75CE4F","#DFD142","#FF0000","#791212","#111111"];
	for(var i =0;i< risk.length;i++){
		i= parseInt(i);
		var c = document.getElementById(riskId[i]);
		var ctx = c.getContext("2d");
		ctx.fillStyle=bgc[i];
		ctx.fillRect(0,0,c.width,c.height);
		ctx.fillStyle = "#EFEFF4";
		ctx.font = "12px Arial";
		ctx.textAlign = "center";
		ctx.fillText(risk[i], c.width/2, c.height/2);	
		ctx.restore();
	}
}
var path="./";
var modelPath="randomData.json";
      // This example adds a marker to indicate the position of Bondi Beach in Sydney,
      // Australia.

function b0Show(){ 
	$("div[id*='map']").hide();
	$("#map0").show();
}
function b1Show(){ 
	$("div[id*='map']").hide();
	$("#map1").show();
}
function b2Show(){ 
	$("div[id*='map']").hide();
	$("#map2").show();
}
function b3Show(){ 
	$("div[id*='map']").hide();
	$("#map3").show();
}
	
function initMap() {
//	mapMarker();
	callAjax();
}
//function mapMarker(){
//	count = -1;
//	buC = 0;
//	$.getJSON(path+modelPath, function(result){
//		$.each(result, function(i, field){
//			count =1+count;
//			buC ++;
//			id = "map"+count;
//			bid = "#b"+buC;
//			$(bid).text(i);
//			 var map = new google.maps.Map(document.getElementById(id), {
//				 	zoom: 10.2,
//          			center: {lat: 22.29552, lng: 114.15769}
//        		});
//			 $.each(field, function(i2, field2){
//				var img = genImg(field2[2]);
//				var beachMarker = new google.maps.Marker({
//				  position: {lat: field2[0], lng: field2[1]},
//				  map: map,
//				  icon: img
//				});
//			});
//		});
//  });
//}
function genImg(v,lo){
	var c = document.getElementById("myCanvas");
	var ctx = c.getContext("2d");
	var v = parseInt(v);
	var lo = parseInt(lo);
	var bgc =["#75CE4F","#DFD142","#FF0000","#791212","#111111"];
	var bgcS=0;
 	if(v>3 && v<7){bgcS=1;}
	else if(v<=3){bgcS=0; }
	else if(v>=8 && v<=10){bgcS=3;}
	else if(v==7) {bgcS=2;}
	else {bgcS=4;}
	ctx.fillStyle =bgc[bgcS];
	if(lo==1){
		ctx.beginPath();
		ctx.arc(c.width/2,c.height/2,c.height/2,0,2*Math.PI);	
		ctx.closePath();
		ctx.stroke();
		ctx.fill();
	}else{
		ctx.fillRect(0,0,30,30);
	}
	ctx.fillStyle = "#EFEFF4";
	ctx.font = "12px Arial";
	ctx.textAlign = "center";
	ctx.fillText(v, c.width/2, c.height/2);	
	var img    = c.toDataURL("image/png");
	ctx.clearRect(0,0,c.width,c.height);
	
	return img;
}

function callAjax(){
	$.ajax({
       type: 'POST',
       url: 'getDataRan.php',
		data: {}, 
		contentType: "application/x-www-form-urlencoded;charset=utf-8",
       dataType: 'json',
		success: function(data,status, XMLHttpRequest)
       {
//		   console.log(data);
		   if(JSON.parse(data)){
			   result = JSON.parse(data);
			   console.log(data);
				count = 0;
				buC = 0;
				$.each(result,function(i,field){   
					id = "map"+count;
					bid = "#b"+buC;
					if(buC!=0){
						$(bid).text(i);
					}
					 var map = new google.maps.Map(document.getElementById(id), {
							zoom: 10.2,
							center: {lat: 22.29552, lng: 114.15769}
					});
					
					 $.each(field, function(i2, field2){	
						var img = genImg(field2[2],field2[3]);
						var beachMarker = new google.maps.Marker({
						  position: {lat: field2[0], lng: field2[1]},
						  map: map,
						  icon: img
						});
					 });
					count =1+count;
					buC ++;
				});
		   }else{
			   
		   }

	   },
          error:function(err){
			 console.log(err);
          }
				
	   });	
}

 </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSoruTeCmzsvdNkzwXWw2dgwopdg8tu0c&callback=initMap">
    </script>
	 <div id="mycanvas" style="height: 20px;width: 30px"></div>

  </body>
</html>