<?php
include "user.php";
include "aktivnost.php";
include_once('glava.php');
//http metoda
$method = $_SERVER['REQUEST_METHOD'];



//povezava na bazo
$db=mysqli_connect("localhost","root","","projekt");
$db->set_charset("UTF8");



if(isset($_SERVER['PATH_INFO'])){
    $request = explode('/', trim($_SERVER['PATH_INFO'],'/'));

} else{
    $request="";
}





/*
Naš api:

api/baza/user
    GET-> izpis usera
    POST-> registracija

api/baza/user/prijava
    POST-> prijava

api/baza/aktivnost
    GET-> izpis aktivnost
    POST-> dodaj aktivnsot



api/baza/user/android
    GET-> izpis
    POST-> registracija

api/baza/user/android/prijava
    POST-> prijava

api/baza/aktivnost/android
	GET-> izpis aktivnost
	POST-> dodaj aktivnost


*/

if(isset($request[0])&&($request[0]=='baza')){

    switch($method){
        case 'GET':
            if(isset($request[1]) && $request[1]=='user'){
                if(isset($_SESSION["USER_ID"])){
                    $podatek=User::izpisUporabnika($db, $_SESSION["USER_ID"]);
                }

                if(isset($request[2]) && $request[2]=='android'){ //izpis userjev na android
                    if(isset($_GET["id"])){
                        $podatek=User::izpisUporabnika($db, htmlspecialchars($_GET["id"]));
                    } //primer za izpis userjev za uporabnika z id=25: "http://172.105.244.126/api.php/baza/user/android?id=25"

                }


            }
            if(isset($request[1]) && $request[1]=='aktivnost'){
                if(isset($_SESSION["USER_ID"])){
                    $podatek=Aktivnost::vrniVseAktivnosti($db, $_SESSION["USER_ID"]);
                }

                if(isset($request[2]) && $request[2]=='android'){ //izpis aktivnosti na android
                    if(isset($_GET["id"])){
                        $podatek=Aktivnost::vrniVseAktivnosti($db, htmlspecialchars($_GET["id"]));
                    } //primer za izpis aktivnosti za uporabnika z id=25: "http://172.105.244.126/api.php/baza/aktivnost/android?id=25"

                }

            }
            if(isset($request[1]) && $request[1]=='povprecje'){
                if(isset($_SESSION["USER_ID"])){
                    $podatek=Aktivnost::vrniPovprecje($db, $_SESSION["USER_ID"]);

                }

            }

            break;

        case 'POST':
            if(isset($request[1]) && $request[1]=='user'){
                //login
                if(isset($request[2]) && $request[2] == 'prijava'){ //prijava web
                    parse_str(file_get_contents('php://input'), $input);

                    $podatek = User::validate_login($db, $input["username"], $input["password"]);
                    if($podatek != -1){ //uspešna prijava
                        $_SESSION["USER_ID"] = $podatek;
                        $podatek = array("idUser" => "$podatek");
                    }else $podatek = array("info" => "Neuspesna prijava");

                }

                if(isset($request[2]) && $request[2] == 'android'){
                    $input = json_decode(file_get_contents('php://input'), true);
                    if(isset($request[3]) && $request[3] == 'prijava'){ //android prijava
                        if (isset($input)) {
                            $podatek = User::validate_login($db, $input["username"], $input["password"]);
                            if($podatek != -1){ //uspešna prijava
                                $podatek = array("idUser" => "$podatek");
                            }else $podatek = array("info" => "Neuspesna prijava");
                        } else $podatek = array("info" => "Neuspesna prijava");

                    }else{ //android registracija
                        if (isset($input)) {
                            if (User::register($db, $input["username"], $input["password"]) == true )
                                $podatek=array("info" => "Uspesna registracija");
                            else $podatek = array("info" => "Neuspesna registracija");

                        }else $podatek = array("info" => "Neuspesna registracija");

                    }

                }

                else {

                    //register web
                    //$input = json_decode(file_get_contents('php://input'), true);
                    parse_str(file_get_contents('php://input'), $input);
                    if (isset($input)) {
                        //$podatek = new User($input["ime"], $input["priimek"], $input["email"], $input["telefon"], $input["teza"], $input["visina"], $input["FK_idNaslov"], $input["FK_idSpol"]);

                        if (User::register($db, $input["username"], $input["password"]) == true )
                            $podatek=array("info" => "Uspesna registracija");
                        else $podatek = array("info" => "Neuspesna registracija");

                        //$podatek->dodaj($db);
                    } else {
                        $podatek = array("info" => "Neuspesna registracija");
                    }
                }
            }
            if(isset($request[1]) && $request[1]=='aktivnost'){

                if(isset($request[2]) && $request[2]=='android'){ //vstavi aktivnost android
                    $input = json_decode(file_get_contents('php://input'), true);
                    if(isset($input)){
                        $podatek=new Aktivnost($input["datum"], $input["ocena_aktivnosti"], $input["koraki"], $input["porabljene_kalorije"], $input["povp_srcni_utrip"], $input["povp_hitrost"], $input["razdalja"], $input["cas"],  $input["id"], $input["lat"], $input["lon"]);
                        $rezultat = $podatek->dodaj($db);
                        if($rezultat == true){
                            $podatek=array("info"=>"Uspesno vstavljena aktivnost");
                        }
                    }else $podatek=array("info"=>"Narobno podani podatki");




                }else{
                    //vstavi aktivnost web
                    parse_str(file_get_contents('php://input'),$input);
                    if(isset($input)){
                        if(isset($_SESSION["USER_ID"])){
                            $podatek=new Aktivnost($input["datum"], $input["ocena_aktivnosti"], $input["koraki"], $input["porabljene_kalorije"], $input["povp_srcni_utrip"], $input["povp_hitrost"], $input["razdalja"], $input["cas"],  $_SESSION["USER_ID"], $input["lat"], $input["lon"]);
                            $rezultat = $podatek->dodaj($db);
                            if($rezultat == true){
                                $podatek=array("info"=>"Uspesno vstavljena aktivnost");
                            }
                        }
                    }
                    else{
                        $podatek=array("info"=>"Narobno podani podatki");
                    }

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