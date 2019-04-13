<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="jslib/jquery-1.11.1.js"></script>
    <style>
        body{
            background-image: url("photo/bgc.jpg");
        }


        .accordion {
            background-color: #eee;
            color: #444;
            cursor: pointer;
            padding: 18px;
            width: 100%;
            height: 70px;
            border: none;
            text-align: left;
            outline: none;
            font-size: 15px;
        }

        .active, .accordion:hover {
            background-color: #ccc;
            color: #18ff54;
        }

        .panel {

            background-color: white;
            overflow: hidden;
            width: 100%;
        }

        #right{
           position: absolute;
            left: 10%;
            width: 20%;
            height: 100px;
            display: inline-block;
        }
        #left{
            position: absolute;
            border: 1px solid red;
            right: 10%;
            width: 60%;
            height: 700px;
            display: inline-block;
        }


        .accordion{

            font-size: 25px;
        }
        .accordion b{
            color: #18ff54;
            right: 0px;
            margin-right: 0px;
            font-size: 30px;
        }

        .panel p:hover{
            color: red;
            background-color: #ccc;
        }
        .panel p{
            width: 99%;
            margin: 0px;
            padding-top: 3%;
            height: 40px;
            font-size: 20px;

        }
        h2{
           color: red;
            font-size: 70px;
            width: 80%;
            margin-bottom: 0px;
            margin-top: 0px;
            padding-top: 10px;
            padding-bottom: 10px;

        }
        h2 img{

            width: 100px;
            height: 100px;
        }
    </style>

    <script>

        $(function(){
            $(".panel").hide();
            // $("#left").load("./MainPage/mapDisplay.php");
            $("#firstMenu").click(function () {
                $("#firstMenuBar").toggle();
            });
            $("#secondMenu").click(function () {
                $("#secondMenuBar").toggle();
            });
            $("#thirdMenu").click(function () {
                $("#thirdMenuBar").toggle();
            });
            $("#FouthMenu").click(function () {
                $("#FourthMenuBar").toggle();
            });
            $("#fiveMenu").click(function () {
                $("#fifthMenuBar").toggle();
            });
            $("#SixMenu").click(function () {
                $("#SixMenuBar").toggle();
            });
            $("#APImenu").click(function () {
                $("#APIMenuBar").toggle();
            });


        });

    </script>
</head>
<body>

<center>
    <h2><i>Air Quality Forcast</i> </h2>

<div id="right">
    <button class="accordion" id="firstMenu" >Main Page<b>&#43;</b></button>
    <div class="panel" id="firstMenuBar">
        <p>Multiple Linear Regression</p>
        <p>Random Forest</p>
        <p>Time Series(ARIMA)</p>
        <p>ANN</p>
        <p>mathematic</p>
    </div>
    <button class="accordion" id="APImenu">Get Data<b>&#43;</b></button>
    <div class="panel" id="APIMenuBar">
      <p>  <a href="./callAPI/ARIMA.html" target="con"> Copy Link</a></p>

    </div>
    <button class="accordion" id="secondMenu">Chart<b>&#43;</b></button>
    <div class="panel" id="secondMenuBar">
        <p><a href="./chart/chart.php" target="con">Last Compare</a></p>
        <p>Predict Data</p>
    </div>

    <button class="accordion" id="thirdMenu">Test Plan<b>&#43;</b> </button>
    <div class="panel" id="thirdMenuBar">
        <p><a href="./TestPlan/MLP.html" target="con"> Multiple Linear Regression</a> </p>
        <p><a href="./TestPlan/rf.html" target="con">Random Forest</a></bu></p>
        <p><a href="./TestPlan/ARIMAMain.html" target="con">Time Series(ARIMA)</a></p>
        <p></p>
<!--        <p>ANN</p>-->
    </div>

    <button class="accordion" id="FouthMenu">Explaination<b>&#43;</b></button>
    <div class="panel" id="FourthMenuBar">
        <p>Multiple Linear Regression</p>
        <p>Random Forest</p>
        <p><a href="./Explaination/ARIMA.html" target="con">Time Series(ARIMA)</a></p>

        <p>ANN</p>
        <p><a href="./Explaination/math.html" target="con"> mathematic</a> </p>

    </div>
    <button class="accordion" id="fiveMenu">Past Data<b>&#43;</b></button>
    <div class="panel" id="fifthMenuBar">
        <p>Weather Data</p>
        <p>air pollution</p>
    </div>
    <button class="accordion" id="SixMenu">Get AQHI<b>&#43;</b></button>
    <div class="panel" id="SixMenuBar">
        <p>By GPS</p>
        <p>By Location</p>
    </div>

</div>
<div id="left">

    <iframe name="con" src="./MainPage/mapDisplay.php" frameborder="0" width="100%" height="100%">

    </iframe>

</div>
</center>


</body>
</html>