<?php include_once('glava.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registracija</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

<?php include_once('navbar.php');?>

<p id="izp"></p>
<h1>Registracija</h1>
<table>
    <tr><td>Username:</td><td><input type="text" id="username"></td></tr>
    <tr><td>Password:</td><td><input type="text" id="password"></td></tr>

</table>

<button onclick="dodaj();">Registriraj</button>

<script>
    function dodaj(){
        podatek={username:$("#username").val(), password:$("#password").val()}

        $.post("api.php/baza/user",podatek,function(data){
            if(data.info === "Neuspesna registracija"){
                $("#izp").text(data.info)
                $("#username").val("")
                $("#password").val("")
            } else $(location).attr('href', 'prijava.php')

            //$(location).attr('href', 'izpisUporabnikov.html')
        });
    }
</script>
</body>
</html>