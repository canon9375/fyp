<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Simple Marker Icons</title>
	<script type="text/javascript" src="./jslib/jquery-1.11.1.js"></script>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 425px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
  <br><br><br><br><br><br><br>
	  <div w3-include-html="../index2.php"></div>
	  <canvas id="myCanvas" width="20" height="17" style="display:none">
</canvas>
    <div id="map"></div>
	<div id="random"></div>
<script>
var path="./";
var modelPath="randomData.json";
      // This example adds a marker to indicate the position of Bondi Beach in Sydney,
      // Australia.
function initMap() {
     var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10.2,
          center: {lat: 22.29552, lng: 114.15769}
        });
	mapMarker(map);

}
function mapMarker(map){
	$.getJSON(path+modelPath, function(result){
		$.each(result, function(i, field){
			 $.each(field, function(i2, field2){
				var img = genImg(field2[2]);
				var beachMarker = new google.maps.Marker({
				  position: {lat: field2[0], lng: field2[1]},
				  map: map,
				  icon: img
				});
			});
		});
  });
}


function genImg(v){
	var c = document.getElementById("myCanvas");
	var ctx = c.getContext("2d");
	ctx.fillStyle = "#FF0000";
	ctx.fillRect(0,0,30,30);
	ctx.fillStyle = "#EFEFF4";
	ctx.font = "12px Arial";
	ctx.textAlign = "center";
	ctx.fillText(v, c.width/2, c.height/2);	
	var img    = c.toDataURL("image/png");
	return img;
}
 </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSoruTeCmzsvdNkzwXWw2dgwopdg8tu0c&callback=initMap">
    </script>
	 <div id="mycanvas" style="height: 20px;width: 30px"></div>
  </body>
</html>