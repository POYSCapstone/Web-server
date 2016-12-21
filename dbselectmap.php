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
        width : 50%;
        margin-left: 20px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 20;
        padding: 40;
      }
    </style>


<?php
$hostname = "127.0.0.1";
$username = "root";
$password = "kongbak0100";
$dbname = "hoon";

$connect = mysql_connect($hostname, $username, $password) or die("mysql server연결에  실패!");
$status = mysql_select_db($dbname, $connect);

if($status){
  echo '<br />';
  echo '<br />';
  echo '<br />';
  echo '<br />';
  echo '<br />';

  echo("mysql connect 성공!");
  echo '<br/>';

$result = mysql_query('SELECT * FROM test2');

while($row = mysql_fetch_row($result)) {

    echo 'cannum: '.$row[0];

    echo 'positition: '.$row[1];

    echo '   status: '.$row[2];
    echo '<br />';
     echo '<br />';
      echo '<br />';
       echo '<br />';
        echo '<br />';
         echo '<br />';




}

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
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(37.284324, 127.044314),
          zoom: 12
        });
        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          downloadUrl('https://storage.googleapis.com/mapsdevsite/json/mapmarkers2.xml', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var name = markerElem.getAttribute('name');
              var address = markerElem.getAttribute('address');
              var type = markerElem.getAttribute('type');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = address
              infowincontent.appendChild(text);
              var icon = customLabel[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label
              });
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
          });
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
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQmm56eyDcpG9LvCT1rOzHMZCaerEK_00&callback=initMap">
    </script>
  </body>
</html>
