<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Using MySQL and PHP with Google Maps</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 70%;
        width : 70%;
        margin-left: 20px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 20;
        padding: 20;
      }
    </style>


<?php
$hostname = "127.0.0.1";
$username = "root";
$password = "kongbak0100";
$dbname = "hoon";
$st= "a";
$connect = mysql_connect($hostname, $username, $password) or die("mysql server연결에  실패!");
$status = mysql_select_db($dbname, $connect);

if($status){
  echo '<br />';


  // echo("mysql connect 성공!");
   echo("<아주대학교 쓰레기통 현황>");
  echo '<br/>';

$result = mysql_query('SELECT * FROM ajou');

while($row = mysql_fetch_row($result)) {

    echo 'TRASHCAN: '.$row[0];
    echo '  LATITUDE: '.$row[1];
    echo '  LONDTITUDE: '.$row[2];
    echo '  STATE: '.$row[3];
    
    
   echo '<br />';




}

$result2 = mysql_query("SELECT STATE FROM ajou WHERE TRASHCAN='paldal'");
while($row = mysql_fetch_row($result2)) {

   $st = $row[0];


    

}


 echo '<br />';
     echo '<br />';


}

else{
  echo("mysql connect 실패");
}

mysql_close($connect); ?>


  </head>

  <body>
    <div id="map"></div>





    <script>
      var customLabel = {
        restaurant: {
          label: 'R'
        },
        bar: {
          label: 'B'
        }
      };




        function initMap() {
  var arrPos = new Array();
  var myLatLng = {lat: 37.284324, lng: 127.044314};
  arrPos[0] = new google.maps.LatLng(37.284324,127.044314);//팔달관
  arrPos[0] = new google.maps.LatLng(37.284324,127.044314);//팔달관
  arrPos[1] = new google.maps.LatLng(37.281885, 127.044298);//중도 
  arrPos[2] = new google.maps.LatLng(37.284643, 127.045915);//기식
  arrPos[2] = new google.maps.LatLng(37.283878, 127.042749);//서관 




  //37.282947, 127.045292 성호관 
//37.282934, 127.047283 다산관 

//37.281885, 127.044298 중도 
//37.284643, 127.045915 기숙사 식당
//37.283878, 127.042749 서관 





  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 17,
    center: myLatLng
  });


var GreenIcon = new google.maps.MarkerImage(
   "http://labs.google.com/ridefinder/images/mm_20_green.png",
   new google.maps.Size(12, 20),
   new google.maps.Point(0, 0),
   new google.maps.Point(6, 20)
);


for(var idx =0; idx<count; idx++){
  var marker = new google.maps.Marker({
    icon : GreenIcon,

    position: myLatLng,
    map: map,
    title: 'cannum 1'
  });
}



}

        function initMap2() {

var count =5;
var arrPos =new Array();

arrPos[0] = new google.maps.LatLng(37.284324,127.044314);//팔달관
arrPos[1] = new google.maps.LatLng(37.282947, 127.045292);//성호관//NOFULL
arrPos[2] = new google.maps.LatLng(37.283878, 127.042749);//서관 //NOFULL
arrPos[3] = new google.maps.LatLng(37.284643, 127.045915);//기식 //FULL
arrPos[4] = new google.maps.LatLng(37.282934, 127.047283);//다산관//FULL
arrPos[5] = new google.maps.LatLng(37.281885, 127.044298);//중도 //FULL


var myLatLng = {lat: 37.284324, lng: 127.044314};


  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 17,
    center: myLatLng
  });


var GreenIcon = new google.maps.MarkerImage(
   "http://labs.google.com/ridefinder/images/mm_20_green.png",
   new google.maps.Size(12, 20),
   new google.maps.Point(0, 0),
   new google.maps.Point(6, 20)
);


for(var idx =1; idx<3; idx++){


  var marker = new google.maps.Marker({
    icon : GreenIcon,
    position: arrPos[idx],
    map: map,
    //title: 'cannum 1'
    visible : true
  });
}

for(var idx = 3; idx<6; idx++){


  var marker = new google.maps.Marker({
    
    position: arrPos[idx],
    map: map,
    //title: 'cannum 1'
    visible : true
  });
}

<?php if($st =='FULL'){ ?>


  var marker2 = new google.maps.Marker({
     
    position: arrPos[0],
    map: map,
    //title: 'cannum 1'
    visible : true
  });

<?php } ?>

<?php if($st == 'EMPTY'){ ?>


  var marker2 = new google.maps.Marker({
    icon : GreenIcon,
    position: arrPos[0],
    map: map,
    //title: 'cannum 1'
    visible : true
  });

<?php } ?>



}





      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}
    </script>
     <br/>
     <br/>
     <br/>

   <!--  <?php if($aa == 'nofull'){ ?>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQmm56eyDcpG9LvCT1rOzHMZCaerEK_00&callback=initMap">
    </script>
    <?php } ?> -->

  
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQmm56eyDcpG9LvCT1rOzHMZCaerEK_00&callback=initMap2">
    </script>
   


  </body>
</html>
