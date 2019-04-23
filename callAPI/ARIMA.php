<!DOCTYPE html>
<html lang="en">
<head>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="../MainPage/jslib/jquery-1.11.1.js"></script>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        /* Style the list */
        ul.breadcrumb {
            margin-top: 0px;
            padding: 10px 16px;
            list-style: none;
            background-color: #eee;

        }

        /* Display list items side by side */
        ul.breadcrumb li {
            display: inline;
            font-size: 20px;
        }

        /* Add a slash symbol (/) before/behind each list item */
        ul.breadcrumb li+li:before {
            padding: 8px;
            color: black;
            content: "/\00a0";
        }

        /* Add a color to all links inside the list */
        ul.breadcrumb li a {
            color: #0275d8;
            text-decoration: none;
        }

        /* Add a color on mouse-over */
        ul.breadcrumb li a:hover {
            color: #01447e;
            text-decoration: underline;
        }

 input{
    width: 400px;
    height: 150px;
     font-size: 20px;
}
        button {

            border: none;

            padding: 16px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;

            transition-duration: 0.4s;
            cursor: pointer;
        }
        button {
            background-color: white;
            color: black;
            border: 2px solid #555555;
        }
        button:hover {
            background-color: #555555;
            color: white;
        }
    </style>
    <script>
$("document").ready(function(){
	$(document).ajaxStart(function(){
    	$("#wait").css("display", "block");
		$("#myMain").css("display", "none");
  	});
  	$(document).ajaxComplete(function(){
		$("#wait").css("display", "none");
		$("#myMain").css("display", "block");
  	});
	
		});
        function myFunction() {
            var copyText = document.getElementById("myInput");
            copyText.select();
            document.execCommand("copy");
            alert("Copied " );
        }
        function change(a) {
            document.getElementById("myInput").value=a;
        }
function callRandomAjax(){
	callAjax('getDataRan.php');	
}
function callmlrAjax(){
	callAjax('getData.php');	
}
function calltimeAjax(){
	callAjax('getArimaData.php');	
}
function callAjax(p2){
	$.ajax({
       type: 'POST',
       url: '../MainPage/'+p2,
		data: {}, 
		contentType: "application/x-www-form-urlencoded;charset=utf-8",
       dataType: 'json',
		success: function(data,status, XMLHttpRequest)
       {
		   var box = $("#myInput");
		   if(JSON.parse(data)){
			   result = JSON.parse(data);
				box.text(data);
		   }else{
			   box.text(data);
		   }

	   },
          error:function(err){
			 console.log(err);
          }
				
	   });	
}
    </script>
</head>
<body>
		<?php include("../loadingPage.html"); ?>
<div id="myMain">
<center>
  <h1>Choose the method</h1>
<!--change the json path here-->

    <ul class="breadcrumb" >
        <li><span onclick="callmlrAjax()">Multiple Linear Regression </span></li>
        <li > <span onclick="callRandomAjax()">Random Forest & ANN</span></li>
        <li><span onclick="calltimeAjax()"> Time Series(ARIMA)</span></li>
    </ul>
    <textarea rows="20" cols="100" id="myInput">

	select Model
</textarea>
    <br>
    <button onclick="myFunction()">Copy text</button>
</center>
</div>
</body>
</html>