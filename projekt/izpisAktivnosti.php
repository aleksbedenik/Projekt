<?php include_once('glava.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Izpis Aktivnosti</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<?php include_once('navbar.php');?>
<table id="izpis" border="1">



</table>


<script>

    $(document).ready(function() {
        izpisiVse();
    });

    function izpisiVse(){

        $.get("api.php/baza/aktivnost",function(data){
            console.log(data);



            let $podatki = "<tr><th>Datum</th><th>Ocena aktivnosti</th><th>Koraki</th><th>Porabljene kalorije</th><th>Povprečni srčni utrip</th><th>Povprečna hitrost</th><th>Razdalja (m)</th><th>Čas (hour:min:sec)</th><th>Username</th><th>Ime</th></tr>";

            $.each(data, function(key,value) {
                $podatki += "<tr><td>" + value.datum + "</td><td>" + value.ocena_aktivnosti + "</td><td>" + value.koraki + "</td><td>" + value.porabljene_kalorije + "</td><td>" + value.povp_srcni_utrip + "</td><td>" + value.povp_hitrost + "</td><td>" + value.razdalja + "</td><td>" + value.cas + "</td><td>" + value.username + "</td><td>" + value.ime + "</td></tr>";
            });

            $("#izpis").html($podatki);


        });

    }

</script>
</body>
</html>