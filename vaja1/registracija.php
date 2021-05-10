<?php
include_once('glava.php');

// Funkcija preveri, ali v bazi obstaja uporabnik z določenim imenom in vrne true, če obstaja.
function username_exists($username){
	global $conn;
	$username = mysqli_real_escape_string($conn, $username);
	$query = "SELECT * FROM users WHERE username='$username'";
	$res = $conn->query($query);
	return mysqli_num_rows($res) > 0;
}

// Funkcija ustvari uporabnika v tabeli users. Poskrbi tudi za ustrezno šifriranje uporabniškega gesla.
function register_user($username, $password, $email, $ime, $priimek, $naslov, $posta, $telefon, $spol, $starost){
	global $conn;
	$username = mysqli_real_escape_string($conn, $username);
	$pass = sha1($password);
	$email = mysqli_real_escape_string($conn, $email);
	$ime = mysqli_real_escape_string($conn, $ime);
	$priimek = mysqli_real_escape_string($conn, $priimek);
	$naslov = mysqli_real_escape_string($conn, $naslov);
	
	
	$query = "INSERT INTO users (username, password, email, ime, priimek, naslov, posta, telefon, spol, starost) 
				VALUES ('$username', '$pass', '$email', '$ime', '$priimek', '$naslov', '$posta', '$telefon', '$spol', '$starost');";
	if($conn->query($query)){
		return true;
	}
	else{
		echo mysqli_error($conn);
		return false;
	}
}

$error = "";
if(isset($_POST["poslji"])){
	/*
		VALIDACIJA: preveriti moramo, ali je uporabnik pravilno vnesel podatke (unikatno uporabniško ime, dolžina gesla,...)
		Validacijo vnesenih podatkov VEDNO izvajamo na strežniški strani. Validacija, ki se izvede na strani odjemalca (recimo Javascript), 
		služi za bolj prijazne uporabniške vmesnike, saj uporabnika sproti obvešča o napakah. Validacija na strani odjemalca ne zagotavlja
		nobene varnosti, saj jo lahko uporabnik enostavno zaobide (developer tools,...).
	*/
	
	//Preveri če se gesli ujemata
	if($_POST["password"] != $_POST["repeat_password"]){
		$error = "Gesli se ne ujemata.";
	}
	//Preveri ali uporabniško ime obstaja
	else if(username_exists($_POST["username"])){
		$error = "Uporabniško ime je že zasedeno.";
	}
	else if($_POST["username"] == ""){
		$error = "Vnesi username.";
	}
	else if($_POST["password"] == ""){
		$error = "Vnesi geslo.";
	}
	else if($_POST["email"] == ""){
		$error = "Vnesi email.";
	}
	else if($_POST["ime"] == ""){
		$error = "Vnesi ime.";
	}
	else if($_POST["priimek"] == ""){
		$error = "Vnesi priimek.";
	}
	//Podatki so pravilno izpolnjeni, registriraj uporabnika
	else if(register_user($_POST["username"], $_POST["password"], $_POST["email"], $_POST["ime"], $_POST["priimek"], $_POST["naslov"], $_POST["posta"], $_POST["telefon"], $_POST["spol"], $_POST["starost"])){
		header("Location: prijava.php");
		die();
	}
	//Prišlo je do napake pri registraciji
	else{
		$error = "Prišlo je do napake med registracijo uporabnika.";
	}
}

?>
	<h2>Registracija</h2>
	<form action="registracija.php" method="POST">
		<label>Uporabniško ime</label><input type="text" name="username" /> <br/>
		<label>Geslo</label><input type="password" name="password" /> <br/>
		<label>Ponovi geslo</label><input type="password" name="repeat_password" /> <br/>
		<label>Email</label><input type="text" name="email" /> <br/>
		<label>Ime</label><input type="text" name="ime" /> <br/>
		<label>Priimek</label><input type="text" name="priimek" /> <br/>
		<label>Naslov</label><input type="text" name="naslov" /> <br/>
		<label>Pošta</label><input type="number" name="posta" /> <br/>
		<label>Telefon</label><input type="number" name="telefon" /> <br/>
		<label>Spol</label><br/>
			<label>Moški</label><input type="radio" name="spol" value="Moški" /><br/>
			<label>Ženska</label><input type="radio" name="spol" value="Ženska"/> <br/>
		<label>Starost</label><input type="number" name="starost" /> <br/>
		<input type="submit" name="poslji" value="Pošlji" /> <br/>
		<label><?php echo $error; ?></label>
	</form>
<?php
include_once('noga.php');
?>