<?php include_once('glava.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vstavi Aktivnost</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<?php include_once('navbar.php');?>

<p id="izp"></p>
<table>
    <tr><td>Ocena aktivnosti:</td><td><input type="number" id="ocena_aktivnosti"></td></tr>
    <tr><td>Koraki:</td><td><input type="number" id="koraki"></td></tr>
    <tr><td>Porabljene kalorije:</td><td><input type="number" id="porabljene_kalorije"></td></tr>
    <tr><td>Povprečni srčni utrip:</td><td><input type="number" id="povp_srcni_utrip"></td></tr>
    <tr><td>Povprečna hitrost:</td><td><input type="number" id="povp_hitrost"></td></tr>
    <tr><td>Razdalja (m):</td><td><input type="number" id="razdalja"></td></tr>
    <tr><td>Čas (hour:min:sec):</td><td><input type="text" id="cas"></td></tr>

</table>

<button onclick="dodaj();">Vstavi</button>

<script>


    function dodaj(){
        var d = new Date,
            dformat = [d.getFullYear(),d.getMonth()+1, d.getDate(),].join('-')+' '+
                [d.getHours(), d.getMinutes(), d.getSeconds()].join(':');

        podatek={datum:dformat, ocena_aktivnosti:$("#ocena_aktivnosti").val(), koraki:$("#koraki").val(), porabljene_kalorije:$("#porabljene_kalorije").val(), povp_srcni_utrip:$("#povp_srcni_utrip").val(), povp_hitrost:$("#povp_hitrost").val(), razdalja:$("#razdalja").val(), cas:$("#cas").val()}
        $.post("api.php/baza/aktivnost",podatek,function(data){
            //$("#ime").val("");
            //$("#cors").append(JSON.stringify(data));
            //$(location).attr('href', 'izpisAktivnosti.html')
            //$("#izp").text(JSON.stringify(data));

            if(data.info === "Narobno podani podatki"){
                $("#izp").text(data.info)
                $("#ocena_aktivnosti").val("")
                $("#koraki").val("")
                $("#porabljene_kalorije").val("")
                $("#povp_srcni_utrip").val("")
                $("#povp_hitrost").val("")
                $("#razdalja").val("")
                $("#cas").val("")
            } else $(location).attr('href', 'izpisAktivnosti.php')
        });
    }
</script>

</body>
</html>