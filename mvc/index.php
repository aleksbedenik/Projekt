<?php
//vstopna točka v našo spletno stran.
//vse zahteve bodo šle neposredno preko te datoteke
//ponvadi v našem spletnem strežniku celo onemogočimo, da bi uporabnik zahteval ostale php datoteke neposredno
//to dovolimo le uporabniškem računu, pod katerim se na strežniku izvaja php

//dodamo statični razred, za povezovanje s podatkovno bazo
require_once('connection.php');


//razberemo namero uporabnika preko query string parametrov controller in action

if (isset($_GET['controller']) && isset($_GET['action'])) {
	$controller = $_GET['controller'];
	$action     = $_GET['action'];
} else {
  	//če uporabnik ni podal svoje zahteve v pravilni obliki, ga preusmerimo na privzeto akcijo
	$controller = 'strani';
	$action     = 'domov';
}

//vključimo layout, torej splošni izgled strani
//v njem, bomo pa vključili usmerjevalnik, ki bo iz spremenljivk $controller in $action poklical ustrezne funkcije
//opcijsko, bi lahko tukaj vključili kar usmerjevalnik (routes.php) neposredno, in bi v vsak pogled vključevali glavo in nogo
require_once('views/layout.php');
?>