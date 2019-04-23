<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../MainPage/jslib/jquery-1.11.1.js"></script>
    <script>
        $(document).ready(function(){


            //loading page
            $(document).ajaxStart(function(){
                $("#wait").css("display", "block");
                $("#myMain").css("display", "none");
            });
            $(document).ajaxComplete(function(){
                $("#wait").css("display", "none");
                $("#myMain").css("display", "block");
            });
        });

        function cal(x1,y1,x2,y2) {
            var s= (y2-y1)/(x2-x1);
            return s;
        }

        function y_intercept(x1,y1,slope) {
            // # y = mx + b
            // # b = y - mx
            // # b = P1[1] - slope * P1[0]
            var  y=y1-slope*x1;
            return y;
        }

        function slope(x1,y1,x2,y2) {
            var s=(y2-y1)/(x2-x1);
            return s;

        }


        function nearestPoint(x1,y1,x2,y2) {
            var  slope1= (y2-y1)/(x2-x1);
            var  slope =Math.pow(-1,1) / slope1;
            return slope;
        }

        function line_intersect(m1,b1,m2,b2) {
            if (m1==m2){
                return none;
            }
            x=(b2-b1)/(m1-m2);
            y=m1*x+b1;
            var r=[x,y];
            return r;
        }

        function distance(x1,y1,x2,y2) {
            var x= Math.sqrt(Math.pow(x2-x1,2)+Math.pow(y2-y1,2));
            // console.log(x);
            return x;
        }

        function ratio(d1,d2) {
            var d = d1/(d1+d2);
            return d;
        }

        function aqhiOfPoint(aqhi1,aqhi2,distanceRatio) {


            var aqhi=(aqhi2 * distanceRatio) + (aqhi1*(1-distanceRatio));
            // alert(aqhi);
            return aqhi;
        }
        //
        // function getcurrentAQHI(location) {
        //     // location = place
        //     //get current AQHI
        //     var result=[];
        //     var locaList = [['causewaybay', 22.2801379, 114.1829043],
        //         ['central', 22.2818189, 114.1559413],
        //         ['central/western', 22.317831, 114.194941],
        //         ['eastern', 22.2477915, 114.1496074],
        //         ['kwaichung', 22.3283503, 114.0142057],
        //         ['kwuntong', 22.3133199, 114.2226423],
        //         ['mongkok', 22.3226159, 114.1660853],
        //         ['shamshuipo', 22.3302309, 114.1569233]
        //         , ['shatin', 22.3762849, 114.1823453],
        //         ['taipo', 22.4509649, 114.1623843]
        //         , ['tapmun', 22.4713209, 114.3585323]
        //         , ['tseungkwano', 22.3261644, 114.1147959]
        //         , ['tsuenwan', 22.3260131, 114.114796],
        //         ['tuenmun', 22.4181877, 113.9821814]
        //         , ['tungchung', 22.2888939, 113.9414723],
        //         ['yuenlong', 22.4451599, 114.0204623]];
        //     var aa=callAjax();
        //     $.each(aa,function(k,f){
        //         $.each(f,function(k2,f2){
        //             if(f[k2]==location){
        //                 result.push(f2[3]);
        //             }
        //
        //         });
        //
        //     });
        //     console.log(result);
        //     // console.log(aa["2019-04-23 01:30"][0]);
        //
        //     return result;
        // }


        function getcurrentAQHI(location) {


                    var ran;
                    var x=[];
                    var c = [2,3,3,3,3,3,2,3,3,4,3,3,3,3,3];
                    for (var count=0;count<=2;count++){

                        ran=parseInt(Math.random()*(c.length-1));
                        x.push(c[ran]);

                    }
                    // alert(x);
                    return x;

                }




        function findOutAQHI(x1,y1) {
            var locaList = [['causewaybay', 22.2801379, 114.1829043],
                ['central', 22.2818189, 114.1559413],
                ['central/western', 22.317831, 114.194941],
                ['eastern', 22.2477915, 114.1496074],
                ['kwaichung', 22.3283503, 114.0142057],
                ['kwuntong', 22.3133199, 114.2226423],
                ['mongkok', 22.3226159, 114.1660853],
                ['shamshuipo', 22.3302309, 114.1569233]
                , ['shatin', 22.3762849, 114.1823453],
                ['taipo', 22.4509649, 114.1623843]
                , ['tapmun', 22.4713209, 114.3585323]
                , ['tseungkwano', 22.3261644, 114.1147959]
                , ['tsuenwan', 22.3260131, 114.114796],
                ['tuenmun', 22.4181877, 113.9821814]
                , ['tungchung', 22.2888939, 113.9414723],
                ['yuenlong', 22.4451599, 114.0204623]];
            var d = 100;
            var aqhi = [];
            for (var x = 0; x < locaList.length; x++) {
                for (var y = 0; y < locaList.length; y++) {
                    if (x == y)
                        continue;
                    else {

                        var slope_A = slope((locaList[x][1]), (locaList[x][2]), (locaList[y][1]), (locaList[y][2]));
                        var slope_B = nearestPoint((locaList[x][1]), (locaList[x][2]), (locaList[y][1]), (locaList[y][2]));
                        var y_int_A = y_intercept((locaList[x][1]), (locaList[x][2]), slope_A);
                        var y_int_B = y_intercept(x1, y1, slope_B);
                        var p2 = line_intersect(slope_A, y_int_A, slope_B, y_int_B);

                        var distance1 = distance((locaList[x][1]), (locaList[x][2]), p2[0], p2[1]);
                        var distance2 = distance((locaList[y][1]), (locaList[y][2]), p2[0], p2[1]);

                        if (d > (distance1 + distance2)) {
                            var distance1Ratio = ratio(distance1, distance2);
                            var locationOne = getcurrentAQHI(locaList[x][0]);
                            var locationTwo = getcurrentAQHI(locaList[y][0]);
                            // alert(locationTwo);
                            for (var count = 0; count < 3; count++) {
                                yy = aqhiOfPoint(locationOne[count], locationTwo[count], distance1Ratio);


                                aqhi[count]=parseInt(yy);

                            }

                        }

                    }

                }
            }
            return aqhi;
        }



    </script>

    <!--for log and lan-->
    <script>
        var x = document.getElementById("demo");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            var info="";
            var x = document.getElementById("demo");
            x.innerHTML = "Latitude: " + position.coords.latitude +
                "<br>Longitude: " + position.coords.longitude;
            var ge= findOutAQHI(position.coords.latitude,position.coords.longitude);

            console.log(typeof ge.toString());
            var res = ge.toString().split(",");

            var color=["orange","orange","orange"];
            for (var i=0; i<3;i++){

                if (res[i]<4){
                    color[i]="green";
                }
                else if (res[i] == 7){
                    color[i]="red";
                }
                else  if (res[i]>=8 && res[i] <= 10){
                    color[i]="brown";
                }
                else if(res[i]>=11){
                    color[i]="black";
                }


            }
            // alert(res[0]);
            info += "<p style=\"color: "+color[0]+";\">"+ "One Hour Later :" + res[0]+"</p>";
            info +="<p style=\"color: "+color[1]+";\">"+ "Two Hour Later :" + res[1]+"</p>";
            info +="<p style=\"color: "+color[2]+";\">"+ "Three Hour Later :" + res[2]+"</p>";

            x.innerHTML = info;


        }


    </script>
    <script>
        var geocoder;
        var map;
        var x;

        function codeAddress() {
            var result;
            var info="";
            var res;
            geocoder = new google.maps.Geocoder();
            console.log(geocoder);
            var x = document.getElementById("de");
            var address = document.getElementById('address').value;
            geocoder.geocode( { 'address': address}, function(results, status) {
                if (status == 'OK') {

                    result = results[0].geometry.location.toString();

                    res = result.split(",");

                    var lan=res[0].substring(1,res[0].length);
                    var lon=res[1].substring(1,res[0].length);

                    //return  AQHI
                    var ge= findOutAQHI(lan,lon);
                    var res = ge.toString().split(",");
                    var color=["orange","orange","orange"];
                    for (var i=0; i<3;i++){

                        if (res[i]<4){
                            color[i]="green";
                        }
                        else if (res[i]==7){
                            color[i]="red";
                        }
                        else  if (res[i]>=8 && res[i] <= 10){
                            color[i]="brown";
                        }
                        else if(res[i]>=11){
                            color[i]="black";
                        }



                    }
                    // alert(res[0]);
                    info += "<p style=\"color: "+color[0]+";\">"+ "One Hour Later :" + res[0]+"</p>";
                    info +="<p style=\"color: "+color[1]+";\">"+ "Two Hour Later :" + res[1]+"</p>";
                    info +="<p style=\"color: "+color[2]+";\">"+ "Three Hour Later :" + res[2]+"</p>";

                    x.innerHTML = info;
                    // alert(aqhi);
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            });


        }


    </script>

    <!--for log and lan-->
    <script>
        var x = document.getElementById("demo");
        //
        // function getLocation() {
        //     if (navigator.geolocation) {
        //         navigator.geolocation.getCurrentPosition(showPosition);
        //     } else {
        //         x.innerHTML = "Geolocation is not supported by this browser.";
        //     }
        // }
        //
        // function showPosition(position) {
        //     var x = document.getElementById("demo");
        //     x.innerHTML = "Latitude: " + position.coords.latitude +
        //         "<br>Longitude: " + position.coords.longitude;
        //     var ge= findOutAQHI(position.coords.latitude,position.coords.longitude);
        //     var res = ge.split(",");
        //
        //
        //     //return  AQHI
        //     var res = result.split(",");
        //
        //     // var lan=res[0].substring(1,res[0].length);
        //     // var lon=res[1].substring(1,res[0].length);
        //     //
        //     //
        //     alert(res);
        //     x.innerHTML = ge[0];
        //     alert(ge);
        //
        // }


    </script>
    <style>
        body{
            width: 60%;
            alignment: center;
            padding-left: 20%;
        }


        div{

        }

        .button {
            background-color: rgba(172, 250, 255, 0.95); /* Green */
            border: none;

            padding: 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
        .button5 {border-radius: 50%;}


    </style>
    <style>
        .accordion {
            background-color: #eee;
            color: #444;
            cursor: pointer;
            padding: 18px;
            width: 100%;
            border: none;
            text-align: left;
            outline: none;
            font-size: 15px;
            transition: 0.4s;
        }

        .active, .accordion:hover {
            background-color: #ccc;
        }

        .panel {
            padding: 0 18px;
            display: none;
            background-color: white;
            overflow: hidden;
            padding-top: 8%;
            padding-bottom: 8%;
        }
    </style>
</head>
<body style="width: 60%; margin-top: 10%; ">
<?php include_once ("../loadingPage.html"); ?>
<div id="myMain">
<center>




<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSoruTeCmzsvdNkzwXWw2dgwopdg8tu0c&callback=initMap">
</script>
<h1 style="color: gray"> please select method</h1>


    <button class="accordion">Use Address  to get AQHI</button>
    <div class="panel">
        <input type="text" id="address" style="height: 40px;width: 70%; font-size: 20px;" placeholder="enter address..">
        <button class="button button5" onclick="codeAddress()">Get AQHI</button>
        <p id="de"></p>
    </div>

    <button class="accordion">Use GPS to get AQHI</button>
    <div class="panel">
        <button class="button button5" onclick="getLocation()">Get AQHI</button>
        <p id="demo"></p>
    </div>



    <script>
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.display === "block") {
                    panel.style.display = "none";
                } else {
                    panel.style.display = "block";
                }
            });
        }
    </script>

</center>
</div>
</body>
</html>