<?php include_once('glava.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Izpis Aktivnosti</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
          integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
          crossorigin=""/>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin=""></script>
    <style>
        html, body {
            height: 100%;
        }
        #mapid {
            height: 90%;
            width: 100%;
        }
    </style>
</head>
<body>
<?php include_once('navbar.php');?>
<table id="izpis" border="1">
</table>

<div id="mapid"></div>


<script>

    $(document).ready(function() {
        izpisiVse();
    });

    function izpisiVse(){

        $.get("api.php/baza/aktivnost",function(data){
            console.log(data);

            var $markerji = [[]]; //0-lat, 1-lon, 2-timestamp, 3-user, 4-cas trajanja, 5-ocena
            $markerji.pop();


            let $podatki = "<tr><th>Datum</th><th>Ocena aktivnosti</th><th>Koraki</th><th>Porabljene kalorije</th><th>Povprečni srčni utrip</th><th>Povprečna hitrost</th><th>Razdalja (m)</th><th>Čas (hour:min:sec)</th><th>Username</th><th>Ime</th></tr>";

            $.each(data, function(key,value) {
                $podatki += "<tr><td>" + value.datum + "</td><td>" + value.ocena_aktivnosti + "</td><td>" + value.koraki + "</td><td>" + value.porabljene_kalorije + "</td><td>" + value.povp_srcni_utrip + "</td><td>" + value.povp_hitrost + "</td><td>" + value.razdalja + "</td><td>" + value.cas + "</td><td>" + value.username + "</td><td>" + value.ime + "</td></tr>";
                $markerji.push([value.lat, value.lon, value.datum, value.username, value.cas, value.ocena_aktivnosti]);
            });
            $("#izpis").html($podatki);

            var stLokacij = 0;
            var latPovp = 0;
            var lonPovp = 0;
            for(var j = 0; j<$markerji.length; j++){
                if($markerji[j][0]!=null && $markerji[j][1]!=null){
                    stLokacij++;
                    latPovp += parseFloat($markerji[j][0]);
                    lonPovp += parseFloat($markerji[j][1]);
                }
            }
            latPovp/=stLokacij;
            lonPovp/=stLokacij;

            var myMap;
            if(isNaN(latPovp) || isNaN(lonPovp))
                mymap = L.map('mapid').setView([0, 0], 3);
            else mymap = L.map('mapid').setView([latPovp, lonPovp], 14);

            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoidGltMTIzNDQyMyIsImEiOiJja3BlNWp4ajAxdWR5Mm9wN2kxd2R1cWl3In0.Vrte3hWb1QoF-bVEZcWhNQ', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'your.mapbox.access.token'
            }).addTo(mymap);


            for(var i = 0; i<$markerji.length; i++){
                if($markerji[i][0]!=null && $markerji[i][1]!=null){
                    var lokacijaMarkerja = new L.LatLng($markerji[i][0], $markerji[i][1]);
                    var marker = new L.Marker(lokacijaMarkerja);
                    mymap.addLayer(marker);
                    var markerText = `<b>Aktivnost</b><br><br>
                                      <b>User:</b> ${$markerji[i][3]}<br>
                                      <b>Datum:</b> ${$markerji[i][2].substring(8,10)}.${$markerji[i][2].substring(5,7)}.${$markerji[i][2].substring(0,4)}<br>
                                      <b>Čas:</b> ${$markerji[i][2].substring(11,16)}<br>
                                      <b>Trajanje:</b> ${$markerji[i][4].substring(0,2)}H ${$markerji[i][4].substring(3,5)}M ${$markerji[i][4].substring(6,8)}S<br>
                                      <b>Ocena:</b> ${$markerji[i][5]}`;
                    marker.bindPopup(markerText);
                }
            }


        });

    }

</script>
</body>
</html>