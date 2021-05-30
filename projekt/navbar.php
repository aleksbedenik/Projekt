<nav>
    <?php if(isset($_SESSION["USER_ID"])) echo '
        <a href="index.php">Index</a> |
        <a href="izpisUporabnikov.php">Moj Profil</a> |
        <a href="izpisAktivnosti.php">Izpis Aktivnosti</a> |
        <a href="izpisPovprecja.php">Izpis Povprečja</a> |
        <a href="vstaviAktivnost.php">Vstavi Aktivnost</a> |
        <a href="odjava.php">Odjava</a>
    ';else echo '
        <a href="index.php">Index</a> |
        <a href="registracija.php">Registracija</a> |
        <a href="prijava.php">Prijava</a>
    ';?>

</nav>