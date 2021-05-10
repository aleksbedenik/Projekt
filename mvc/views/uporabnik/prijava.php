<p>Prijava</p>
<!-- pogled za dodajanje novega oglasa.-->
<!-- Gre za enostavno formo, ki podatke pošilja na kotroler oglasi, z akcijo shrani-->
<form action="?controller=uporabnik&action=prijavi" method="post">
    <div class="form-group">
        <label for="naslov">Username:</label>
        <input type="text" class="form-control" name="username" placeholder="Username" />
        <label for="naslov">Geslo:</label>
        <input type="password" class="form-control" name="password" placeholder="Geslo" />
        <input class="btn btn-primary" type="submit" name="prijava" value="Prijava"/>
        <!-- po pritisku submit gumba, se bo klicala akcija shrani, torej moremo v telesu metode shrani, v našem kontrolerju, ustrezno prebrati podatke ($_POST)-->
    </div>
</form>
