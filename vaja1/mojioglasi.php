<?php
include_once('glava.php');
if(!isset($_SESSION["USER_ID"])){
	header("Location: index.php");
	die();
} 

function get_oglasi($zapadli=false){
	global $conn;
	if($zapadli){
		$query = "SELECT * FROM ads WHERE datum_zapadlosti <= CURRENT_DATE ORDER BY datum_zapadlosti DESC;";
	}else $query = "SELECT * FROM ads WHERE datum_zapadlosti > CURRENT_DATE ORDER BY datum_zapadlosti DESC;";
	$res = $conn->query($query);
	$oglasi = array();
	while($oglas = $res->fetch_object()){
		array_push($oglasi, $oglas);
	}
	return $oglasi;
}


$oglasi = get_oglasi();
if(isset($_POST["filter"])){
	if(isset($_POST["zapadli"]) && $_POST["zapadli"] == "zapadli"){
		$oglasi = get_oglasi(true);
	}
}

?>

<form action = "mojioglasi.php" method = "POST">
<label>Pokaži zapadle oglase</label><input type="checkbox" name="zapadli" value="zapadli" <?php if(isset($_POST["zapadli"]) && $_POST["zapadli"] == "zapadli") echo "checked"?>/><br/>
<input type = "submit" name = "filter" value="Filtriraj"/>
</form>

<?php



foreach($oglasi as $oglas){
	$img_data = base64_encode($oglas->image);
	if ($oglas->user_id != $_SESSION["USER_ID"]) continue;
	//if(!isset($_GET["zapadli"])){
		//if ($oglas->datum_zapadlosti <= date("Y-m-d")) continue;
	//}
	?>
	<div class="oglas">
		<h4><?php echo $oglas->title;?></h4>
		<p><?php echo $oglas->description;?></p>
		<img src="data:image/jpg;base64, <?php echo $img_data;?>" width="400"/>
		<p>Kategorija: <?php echo $oglas->kategorija; ?></p>
		<p>Datum objave: <?php echo $oglas->datum; ?></p>
		<p>Datum zapadlosti: <?php echo $oglas->datum_zapadlosti; ?></p>
		<a href="uredi.php?id=<?php echo $oglas->id;?>"><button>Uredi</button></a>
		
	</div>
	<hr/>
	<?php
	
}








include_once('noga.php');
?>