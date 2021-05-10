<?php
include_once('glava.php');

// Funkcija prebere oglase iz baze in vrne polje objektov
function get_oglasi($kategorija="privzeto", $iskanje = "privzeto"){
	global $conn;
	$iskanje = mysqli_real_escape_string($conn, $iskanje);
	
	$query = "SELECT * FROM ads ORDER BY datum_zapadlosti DESC;";
	
	if($kategorija!="privzeto" && $iskanje=="privzeto"){
		$query = "SELECT * FROM ads WHERE kategorija='$kategorija' ORDER BY datum_zapadlosti DESC;";
	}
	else if($kategorija!="privzeto" && $iskanje!="privzeto"){
		$query = "SELECT * FROM ads WHERE title LIKE '%$iskanje%' OR description LIKE '%$iskanje%' AND kategorija='$kategorija' ORDER BY datum_zapadlosti DESC;";
	}
	else if($kategorija=="privzeto" && $iskanje!="privzeto"){
		$query = "SELECT * FROM ads WHERE title LIKE '%$iskanje%' OR description LIKE '%$iskanje%' ORDER BY datum_zapadlosti DESC;";
	}
	
	$res = $conn->query($query);
	$oglasi = array();
	while($oglas = $res->fetch_object()){
		array_push($oglasi, $oglas);
	}
	return $oglasi;
}


$oglasi = get_oglasi();
$kategorija = "privzeto";
$iskanje = "privzeto";
if(isset($_POST["filter"])){
	if (isset($_POST["kategorija"]) && $_POST["kategorija"] == "Vse"){
		$kategorija = "privzeto";
	}
	else if(isset($_POST["kategorija"]) && $_POST["kategorija"] == "Nepremičnine"){
		$kategorija = "Nepremičnine";
	}
	else if (isset($_POST["kategorija"]) && $_POST["kategorija"] == "Tehnika"){
		$kategorija = "Tehnika";
	}
	else if (isset($_POST["kategorija"]) && $_POST["kategorija"] == "Materiali, oprema"){
		$kategorija = "Materiali, oprema";
	}
	else if (isset($_POST["kategorija"]) && $_POST["kategorija"] == "Avtomobili"){
		$kategorija = "Avtomobili";
	}
	else if (isset($_POST["kategorija"]) && $_POST["kategorija"] == "Storitve, delo"){
		$kategorija = "Storitve, delo";
	}
	if(isset($_POST["iskanje"]) && $_POST["iskanje"]!=""){
		$iskanje = $_POST["iskanje"];
	}
	$oglasi = get_oglasi($kategorija, $iskanje);
}

?>

<form action = "index.php" method = "POST">
<label>Iskaje: </label><input type = "text" name = "iskanje"/></br>
<label>Sortitaj po kategoriji: </label>
<select name="kategorija">
	<option value="Vse" <?php if(isset($_POST["kategorija"]) && $_POST["kategorija"] == "Vse") echo 'selected="selected"'?>>Vse</option>
	<option value="Nepremičnine" <?php if(isset($_POST["kategorija"]) && $_POST["kategorija"] == "Nepremičnine") echo 'selected="selected"'?>>Nepremičnine</option>
	<option value="Tehnika" <?php if(isset($_POST["kategorija"]) && $_POST["kategorija"] == "Tehnika") echo 'selected="selected"'?>>Tehnika</option>
	<option value="Materiali, oprema" <?php if(isset($_POST["kategorija"]) && $_POST["kategorija"] == "Materiali, oprema") echo 'selected="selected"'?>>Materiali, oprema</option>
	<option value="Avtomobili" <?php if(isset($_POST["kategorija"]) && $_POST["kategorija"] == "Avtomobili") echo 'selected="selected"'?>>Avtomobili</option>
	<option value="Storitve, delo" <?php if(isset($_POST["kategorija"]) && $_POST["kategorija"] == "Storitve, delo") echo 'selected="selected"'?>>Storitve, delo</option>
</select><br/>
<input type = "submit" name = "filter" value="Filtriraj"/>
</form>

<?php

foreach($oglasi as $oglas){
	$img_data = base64_encode($oglas->image);
	if ($oglas->datum_zapadlosti <= date("Y-m-d")) continue;
	?>
	<div class="oglas">
		<h4><?php echo $oglas->title;?></h4>
		<img src="data:image/jpg;base64, <?php echo $img_data;?>" width="400"/>
		<p>Kategorija: <?php echo $oglas->kategorija;?></p>
		<a href="oglas.php?id=<?php echo $oglas->id;?>"><button>Preberi več</button></a>
	</div>
	<hr/>
	<?php
	//if ("2021-03-29" > date("Y-m-d"))echo "ja";
}


include_once('noga.php');
?>