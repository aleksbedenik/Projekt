<?php
include_once('glava.php');



function get_ad($id){
	global $conn;
	$id = mysqli_real_escape_string($conn, $id);
	$user = $_SESSION["USER_ID"];
	$query = "SELECT * FROM ads WHERE id = '$id' AND user_id = '$user';"; //preveri ce dostopamo do svojega oglasa.
	$res = $conn->query($query);
	if(mysqli_num_rows($res)==0){
		header("Location: index.php");
		die();
	}
	
	$query = "SELECT ads.*, users.username FROM ads LEFT JOIN users ON users.id = ads.user_id WHERE ads.id = $id;";
	$res = $conn->query($query);
	if($obj = $res->fetch_object()){
		return $obj;
	}
	return null;
}

function update($title, $desc, $img, $kategorija, $zapadlost=false){
	global $conn;
	$title = mysqli_real_escape_string($conn, $title);
	$desc = mysqli_real_escape_string($conn, $desc);
	
	
	$img_file = file_get_contents($img["tmp_name"]);
	
	$img_file = mysqli_real_escape_string($conn, $img_file);
	$id = $_GET["id"];
	if(!$zapadlost)
		$query = "UPDATE ads SET title = '$title', description = '$desc', image = '$img_file', kategorija = '$kategorija' WHERE id = '$id';";
	else $query = "UPDATE ads SET title = '$title', description = '$desc', image = '$img_file', kategorija = '$kategorija', datum_zapadlosti = CURRENT_DATE + INTERVAL 30 DAY WHERE id = '$id';";
	
	if($conn->query($query)){
		return true;
	}
	else{
		return false;
	}
	
}

function delete(){
	global $conn;
	$id = $_GET["id"];
	$query = "DELETE FROM ads WHERE id = '$id';";
	if($conn->query($query)){
		return true;
	}
	else{
		return false;
	}
}
if(!isset($_GET["id"])){
	echo "Manjkajoči parametri.";
	die();
}
$id = $_GET["id"];
$oglas = get_ad($id);
if($oglas == null){
	echo "Oglas ne obstaja.";
	die();
}
//Base64 koda za sliko (hexadecimalni zapis byte-ov iz datoteke)
$img_data = base64_encode($oglas->image);
$error = "";
if(isset($_GET["izbrisi"])){
	delete();
	header("Location: mojioglasi.php");
	die();
}

if(isset($_POST["poslji_uredi"])){
	
	
	if($_POST["title"] == ""){
		$error = "Vnesi naslov oglasa";
	}
	else if($_POST["description"] == ""){
		$error = "Vnesi vsebino oglasa";
	}
	else if($_FILES['image']['size'] == 0){
		$error = "Izberi sliko oglasa";
	}
	else if(isset($_POST["zapadlost"])){
		if(update($_POST["title"], $_POST["description"], $_FILES["image"], $_POST["kategorija"], true )){
			header("Location: mojioglasi.php");
			die();
		}
	}
	else if(update($_POST["title"], $_POST["description"], $_FILES["image"], $_POST["kategorija"] )){
		header("Location: mojioglasi.php");
		die();
	}
	else{
		$error = "Prišlo je do našpake pri urejanju oglasa.";
	}
	
	
}

?>
	
	<h2>Uredi oglas</h2>
	<form action="uredi.php?id=<?php echo $id;?>" method="POST" enctype="multipart/form-data">
		<label>Naslov</label><input type="text" name="title" value="<?php echo $oglas->title;?>" /> <br/>
		<label>Kategorija</label><select name="kategorija">
			<option value="Nepremičnine">Nepremičnine</option>
			<option value="Tehnika">Tehnika</option>
			<option value="Materiali, oprema">Materiali, oprema</option>
			<option value="Avtomobili">Avtomobili</option>
			<option value="Storitve, delo">Storitve, delo</option>
		</select><br/>
		<label>Vsebina</label><textarea name="description" rows="10" cols="50"> <?php echo $oglas->description;?> </textarea> <br/>
		<label>Slika</label><img src="data:image/jpg;base64, <?php echo $img_data;?>" width="400"/><input type="file" name="image"/> <br/>
		<?php if ($oglas->datum_zapadlosti <= date("Y-m-d")){
			echo '<label>Podaljšaj zapadlost oglasa</label><input type="checkbox" name="zapadlost"/><br/>';
		}?>
		<input type="submit" name="poslji_uredi" value="Objavi" /> <br/>
		<label><?php echo $error; ?></label>
	</form>
	<a href="uredi.php?id=<?php echo $id;?>&izbrisi"><button>Izbriši</button></a><br/>
<?php
include_once('noga.php');
?>