<?php include_once('glava.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Prijava</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<?php include_once('navbar.php');?>
<p id="izp"></p>
<h1>Prijava</h1>
<table>
    <tr><td><label>Username: </label></td><td><input type="text" id="username"/></td></tr>
    <tr><td><label>Password: </label></td><td><input type="text" id="password"/></td></tr>
    <tr><td><button onclick="prijava();">Prijavi</button></td></tr>
</table>
<script>

    function prijava(){



        podatek={username:$("#username").val(), password:$("#password").val()}
        $.post("api.php/baza/user/prijava",podatek,function(data){

            if(data.info === "Neuspesna prijava") {
                $("#izp").text(data.info)
                $("#username").val("")
                $("#password").val("")
            } else $(location).attr('href', 'index.php')

        });

    }
</script>
</body>
</html>