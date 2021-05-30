<?php include_once('glava.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Izpis Uporabnikov</title>
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

        $.get("api.php/baza/user",function(data){
            console.log(data);

            let $podatki = "<tr><th>Username</th><th>Ime</th><th>Priimek</th><th>Email</th><th>Telefon</th><th>Teža</th><th>Višina</th><th>Spol</th><th>Ulica</th><th>Hišna številka</th><th>Pošta</th><th>Poštna številka</th></tr>";

            $.each(data, function(key,value) {
                $podatki += "<tr><td>" + value.username + "</td><td>" + value.ime + "</td><td>" + value.priimek + "</td><td>" + value.email + "</td><td>" + value.telefon + "</td><td>" + value.teza + "</td><td>" + value.visina + "</td><td>" + value.spol + "</td><td>" + value.ulica + "</td><td>" + value.hisna_st + "</td><td>" + value.ime_poste + "</td><td>" + value.stevilka_poste + "</td></tr>";
            });

            $("#izpis").html($podatki);

        });

    }

</script>
</body>
</html>