<p>Dodaj nov oglas</p>
<!-- pogled za dodajanje novega oglasa.-->
<!-- Gre za enostavno formo, ki podatke pošilja na kotroler oglasi, z akcijo shrani-->
<form action="?controller=oglasi&action=shrani" method="post">
<div class="form-group">
 <label for="naslov">Naslov:</label>
<input type="text" class="form-control" name="naslov" placeholder="Naslov" />
<label for="vsebina">Vsebina:</label>
<textarea name="vsebina" class="form-control" placeholder="Dodaj vsebino..."></textarea>
<input class="btn btn-primary" type="submit" name="Dodaj" value="Dodaj"/>
<!-- po pritisku submit gumba, se bo klicala akcija shrani, torej moremo v telesu metode shrani, v našem kontrolerju, ustrezno prebrati podatke ($_POST)-->
</div>
</form>