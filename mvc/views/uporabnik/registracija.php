<p>Registracija</p>
<form action="<?php if(isset($uporabnik)){echo '?controller=uporabnik&action=urediShrani&id='; echo $uporabnik->id;}else echo'?controller=uporabnik&action=registriraj';?>" method="post">
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" name="username" placeholder="Username" value="<?php if(isset($uporabnik))echo $uporabnik->username; ?>"/>
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="password" placeholder="Password" <?php if(isset($uporabnik))echo "disabled"; ?>/>
        <label for="password">Repeat password:</label>
        <input type="password" class="form-control" name="repeat_password" placeholder="Repeat password" <?php if(isset($uporabnik))echo "disabled"; ?>/>
        <label for="email">Email:</label>
        <input type="text" class="form-control" name="email" placeholder="Email" value="<?php if(isset($uporabnik))echo $uporabnik->email; ?>"/>
        <label for="ime">Ime:</label>
        <input type="text" class="form-control" name="ime" placeholder="Ime" value="<?php if(isset($uporabnik))echo $uporabnik->ime; ?>"/>
        <label for="priimek">Priimek:</label>
        <input type="text" class="form-control" name="priimek" placeholder="Priimek" value="<?php if(isset($uporabnik))echo $uporabnik->priimek; ?>"/>
        <label for="naslov">Naslov:</label>
        <input type="text" class="form-control" name="naslov" placeholder="Naslov" value="<?php if(isset($uporabnik))echo $uporabnik->naslov; ?>"/>
        <label for="posta">Pošta:</label>
        <input type="number" class="form-control" name="posta" placeholder="Posta" value="<?php if(isset($uporabnik))echo $uporabnik->posta; ?>"/>
        <label for="telefon">Telefon:</label>
        <input type="number" class="form-control" name="telefon" placeholder="Telefon" value="<?php if(isset($uporabnik))echo $uporabnik->telefon; ?>"/>
        <label for="spol">Spol:</label>
        <div class="form-check">
            <input type="radio" class="form-check-input" name="spol" <?php if(isset($uporabnik) && $uporabnik->spol == "Moški")echo 'checked="checked"'; ?> value="Moški"/>
            <label class="form-check-label" for="moski" value="Moški">Moški</label>
        </div>
        <div class="form-check">
            <input type="radio" class="form-check-input" name="spol" <?php if(isset($uporabnik) && $uporabnik->spol == "Ženska")echo 'checked="checked"'; ?> value="Ženska"/>
            <label class="form-check-label" for="zenska">Ženska</label>
        </div>
        <label for="starost">Starost:</label>
        <input type="number" class="form-control" name="starost" placeholder="Starost" value="<?php if(isset($uporabnik))echo $uporabnik->starost; ?>"/>

        <?php if(isset($uporabnik))echo '<input class="btn btn-primary" type="submit" name="uredi" value="Uredi"/>';
            else echo'<input class="btn btn-primary" type="submit" name="registriraj" value="Registriraj"/>';
        ?>


    </div>
    
</form>
