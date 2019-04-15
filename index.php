<!DOCTYPE html>
<html>
<title></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
<script ></script>
<style>
.w3-sidebar a {font-family: "Roboto", sans-serif}
body,h1,h2,h3,h4,h5,h6,.w3-wide {font-family: "Montserrat", sans-serif;}
@media only screen and (min-width:  700px) {


    #test{

       padding-left: 30%;
    }

}

@media only screen and (max-width:  500px) {


    #test{
margin-top: 20%;
    }

}



</style>
<body class="w3-content" style="max-width:1200px">

<nav class="w3-sidebar w3-bar-block w3-white w3-collapse w3-top" style="z-index:3;width: 250px;" id="mySidebar">
  <div class="w3-container w3-display-container ">
    <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
    <h3 class="w3-wide"><b>Air Quality Prediction</b></h3>
  </div>
  <div class="w3-padding-64 w3-large w3-text-grey" style="font-weight:bold">
	  <a onclick="myAccFunc()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align" id="myBtn">
      Main <i class="fa fa-caret-down"></i>
    </a>
    <div id="demoAcc" class="w3-bar-block w3-hide w3-padding-large w3-medium">

      <a href="./MainPage/mapDisplay.php" class="w3-bar-item w3-button" target="con">Random Forest</a>
      <a href="#" class="w3-bar-item w3-button" target="con">Time Series(ARIMA)</a>
      <a href="#" class="w3-bar-item w3-button"target="con">ANN</a>
      <a href="#" class="w3-bar-item w3-button"target="con">Mathematic</a>
    </div>
    <a href="./callAPI/ARIMA.html" class="w3-bar-item w3-button" target="con">Get Data</a>

    <a href="./chart/chart.php" target="con" class="w3-bar-item w3-button">Chart</a>
    <a href="#" class="w3-bar-item w3-button" onClick="show3()">Test Plan<i class="fa fa-caret-down"></i></a>
	  <div id="demoAcc3" class="w3-bar-block w3-hide w3-padding-large w3-medium">
      <a href="./TestPlan/MLP.html" class="w3-bar-item w3-button" target="con">Random Forest</a>
      <a href="./TestPlan/ARIMAMain.html" class="w3-bar-item w3-button" target="con">Time Series(ARIMA)</a>
      <a href="./TestPlan/MLP.html" class="w3-bar-item w3-button" target="con">Multiple Linear Regression</a>
    </div>

    <a href="#" class="w3-bar-item w3-button" onClick="show2()" >Explaination<i class="fa fa-caret-down"></i></a>
	<div id="demoAcc2" class="w3-bar-block w3-hide w3-padding-large w3-medium">
      <a href="./Explaination/rf.html" class="w3-bar-item w3-button" target="con">Random Forest</a>
      <a href="./Explaination/ARIMA.html" class="w3-bar-item w3-button" target="con">Time Series(ARIMA)</a>
      <a href="./Explaination/math.html" class="w3-bar-item w3-button" target="con">Mathematic</a>
    </div>
    <a href="./PastData/past72Data.php" target="con" class="w3-bar-item w3-button">Past Data</a>
    <a href="./getAQHI/byGPS.html" class="w3-bar-item w3-button" target="con">Get AQHI</a>


  </div>

</nav>
<div class="w3-display-container w3-container">
<!--<iframe src="./MainPage/mapDisplay.php" style="border: 1px solid black ;  width: 100%;height: 1000px;" name="con" frameborder="0"></iframe>-->
<iframe  class="w3-display-topleft w3-text-white" style=" border: 10px solid black; width: 80%;height: 1000px;" id="test"  name="con" src="./MainPage/mapDisplay.php" frameborder="0">
<!--	-->
<!--	</iframe>-->
<!--	-->w
</div>

<!-- Top menu on small screens -->
<header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
  <div class="w3-bar-item w3-padding-24 w3-wide">Air Quality Predict</div>
  <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-24 w3-right" onclick="w3_open()"><i class="fa fa-bars"></i></a>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:250px">

  <!-- Push down content on small screens -->
  <div class="w3-hide-large" style="margin-top:83px"></div>

  <!-- Top header -->
  <header class="w3-container w3-xlarge">



<!-- Newsletter Modal -->
<div id="newsletter" class="w3-modal">
  <div class="w3-modal-content w3-animate-zoom" style="padding:32px">
    <div class="w3-container w3-white w3-center">
      <i onclick="document.getElementById('newsletter').style.display='none'" class="fa fa-remove w3-right w3-button w3-transparent w3-xxlarge"></i>
      <h2 class="w3-wide">NEWSLETTER</h2>
      <p>Join our mailing list to receive updates on new arrivals and special offers.</p>
      <p><input class="w3-input w3-border" type="text" placeholder="Enter e-mail"></p>
      <button type="button" class="w3-button w3-padding-large w3-red w3-margin-bottom" onclick="document.getElementById('newsletter').style.display='none'">Subscribe</button>
    </div>
  </div>
</div>

<script>
// Accordion 
function myAccFunc() {
  var x = document.getElementById("demoAcc");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else {
    x.className = x.className.replace(" w3-show", "");
  }
}
function show2() {
  var x = document.getElementById("demoAcc2");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else {
    x.className = x.className.replace(" w3-show", "");
  }
}
function show3() {
  var x = document.getElementById("demoAcc3");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else {
    x.className = x.className.replace(" w3-show", "");
  }
}
// Click on the "Jeans" link on page load to open the accordion for demo purposes
document.getElementById("myBtn").click();


// Open and close sidebar
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("myOverlay").style.display = "none";
}
</script>

</body>
</html>
