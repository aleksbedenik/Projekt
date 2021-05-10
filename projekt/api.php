<?php
include "user.php";
include "aktivnost.php";
//http metoda
$method = $_SERVER['REQUEST_METHOD'];



//povezava na bazo
$db=mysqli_connect("localhost","root","","projekt");
$db->set_charset("UTF8");

if(isset($_SERVER['PATH_INFO']))
    $request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
else
    $request="";

/*
Naš api:

api/baza/user
    GET-> izpis usera
    POST-> dodaj usera

api/baza/aktivnost
    GET-> izpis aktivnost
    POST-> dodaj aktivnsot

*/

if(isset($request[0])&&($request[0]=='baza')){

    switch($method){
        case 'GET':
            if(isset($request[1]) && $request[1]=='user'){
                $podatek=User::vrniVse($db);

            }
            if(isset($request[1]) && $request[1]=='aktivnost'){
                $podatek=Aktivnost::vrniVse($db);

            }

            break;

        case 'POST':
            if(isset($request[1]) && $request[1]=='user'){
                parse_str(file_get_contents('php://input'),$input);
                if(isset($input)){
                    $podatek=new User($input["ime"], $input["priimek"], $input["email"], $input["telefon"], $input["teza"], $input["visina"], $input["FK_idNaslov"], $input["FK_idSpol"]);
                    $podatek->dodaj($db);
                }
                else{
                    $podatek=array("info"=>"Narobno podani podatki");
                }
            }
            if(isset($request[1]) && $request[1]=='aktivnost'){
                parse_str(file_get_contents('php://input'),$input);
                if(isset($input)){
                    $podatek=new Aktivnost($input["datum"], $input["ocena_aktivnosti"], $input["koraki"], $input["porabljene_kalorije"], $input["povp_srcni_utrip"], $input["povp_hitrost"], $input["razdalja"], $input["cas"], $input["FK_idUser"]);
                    $podatek->dodaj($db);
                }
                else{
                    $podatek=array("info"=>"Narobno podani podatki");
                }
            }


            break;
    }




    //nastavimo glave odgovora tako, da brskalniku sporočimo, da mu vračamo json
    header('Content-Type: application/json');

    //izpišemo oglas, ki smo ga prej ustrezno nastavili
    echo json_encode($podatek);
}
?>