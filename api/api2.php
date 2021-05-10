<?php
include "oglas.php";


//http metoda
$method = $_SERVER['REQUEST_METHOD'];

//v htacces smo preslikai ../api/* v ../api2.php/*
//V kolikor vam za strani ../api/* javlja, da stran ne obstaja, vam rewrite ne deluje pravilno. Lahko uporabite ../api2.php/*
//razpoznati je potrebno *
//reqest je polje besed, ki so se pojavljala v * in so bila ločena z / 
//tako dobimo iz /prva/druga/tretja => $request=array("prva","druga","tretja") 
if(isset($_SERVER['PATH_INFO']))
	$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
else
	$request="";


/*
Naš api:
api/oglas/:id/
	PUT -> posodobi
	GET -> vrni oglas
	DELETE -> zbriši oglas

api/oglas
    POST -> dodaj nov oglas
	GET-> vrni vse oglase

api/oglas/JSONP/:callback
	GET -> vrne jsonp rezultat s callback imenom metode

api/proxy
	GET-> proxy na google place search

*/
//povezava na bazo
	$db=mysqli_connect("localhost","root","","vaja2");
	$db->set_charset("UTF8");

//razpoznamo /oglas
	if(isset($request[0])&&($request[0]=='oglas')){

		switch ($method) {
			case 'GET':
		//vrni oglas
			if(isset($request[1])&&$request[1]!=='JSONP'){
				$oglasid=$request[1];
				$oglas=Oglas::vrniEnega($db,$oglasid);
			}
			else{
		//vrni vse oglase
		//uporabimo statično funkcijo ::vrniVse
				$oglas=Oglas::vrniVse($db);

			}
			break;
			case 'PUT':
		//če je podan id, posodobimo oglas
			if(isset($request[1])){
				$oglasid=$request[1];
				$oglas=Oglas::vrniEnega($db,$oglasid);
			//tukaj so bili oz morajo biti podatki poslani kot json niz
				$input = json_decode(file_get_contents('php://input'),true);
				if(isset($input)){
					$oglas->naslov=$input['naslov'];
					$oglas->vsebina=$input['vsebina'];
					$oglas->posodobi($db);
				}
				else
				{
					$oglas=array("info"=>"Ni podane vsebine oglasa");
				}
			}
			else
				$oglas=array("info"=>"Ni podanega identifikatorja oglas");
			break;
			case 'POST':
		//tukaj so podatki poslani preko url encoded formata
		//najdemo jih v $POST[]
		//če imamo drugo metodo, lahko naredimo
			parse_str(file_get_contents('php://input'),$input);
			if(isset($input)){
				$oglas=new Oglas($input["naslov"],$input["vsebina"]);
				$oglas->dodaj($db);
			}
			else
			{
				$oglas=array("info"=>"Ni podane vsebine oglasa");
			}

			break;
			case 'DELETE':
		//ta metoda apija ni implementirana
		//enako kot pri ostalih, bi bilo potrebon prebrati id
		//nato pa na razredu oglas napisati in nato poklicati funkcijo za brisanje
			$oglas=array("info"=>"oglas je bil uspešno zbrisan");
			break;
		}

	//del apija, ki se odziva na JSONP zahtevo
	//JSONP/:callback
		if(isset($request[1])&&isset($request[2])&&$request[1]=='JSONP')
		{
			$callback=$request[2];
			$oglas=json_encode($oglas);
			echo "$callback($oglas);";
		}
		else 
		{
	//ta del kode, bi se načeloma lahko ponavljal v vsaki veji switch stavka
	//a ker je enak v vsaki veji smo ga dali na konec, vsaka veja pa nastavi
	//vrednost spremenljivke $oglas

	//nastavimo glave odgovora tako, da brskalniku sporočimo, da mu vračamo json
			header('Content-Type: application/json');
	//omgočimo zahtevo iz različnih domen
			header("Access-Control-Allow-Origin: *");
	//izpišemo oglas, ki smo ga prej ustrezno nastavili
			echo json_encode($oglas);
		}
	}

//del apija, ki se odziva na proxy zahtevo
//api/proxy/
	if(isset($request[0])&&($request[0]=='proxy')){
	//api/isci/JSONP/callback;

		$arrContextOptions=array("ssl"=>array("verify_peer"=>false,"verify_peer_name"=>false,));
		echo(file_get_contents("https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=46.5475311,15.6357408&radius=500&type=restaurant&keyword=fast&key=AIzaSyCVEC1ERr1a9XG8Etp3e26EHuYc3ZxfFOc",false, stream_context_create($arrContextOptions)));


	}




	?>