<?php


class uporabnik_controller
{
    public function index(){
        if(isset($_SESSION["USER_ID"]) && $admin = Uporabnik::isAdmin($_SESSION["USER_ID"]) == true){
            $uporabniki = Uporabnik::vsi();
            require_once('views/uporabnik/index.php');
        }else return call("strani","napaka");
    }

    public function prikaziUporabnika(){
        if(!isset($_SESSION["USER_ID"]))return call("strani","napaka");
        $uporabnik = Uporabnik::najdi($_SESSION["USER_ID"]);
        require_once('views/uporabnik/prikaziUporabnika.php');
    }

    public function prijava(){

        if (!isset($_SESSION["USER_ID"])) require_once('views/uporabnik/prijava.php');
        else return call("strani","napaka");
    }

    public function prijavi(){
        if (!isset($_SESSION["USER_ID"])) {
            if (isset($_POST["prijava"])) {
                $prijava = Uporabnik::validate_login($_POST["username"], $_POST["password"]);
                if ($prijava >= 0) {
                    $_SESSION["USER_ID"] = $prijava;
                    $URL = "index.php";
                    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
                } else return call("strani","napaka");
            }
        }else return call("strani","napaka");
    }

    public function odjava(){
        if (isset($_SESSION["USER_ID"])) {
            session_unset();
            session_destroy();
            $URL = "index.php";
            echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
        } else return call("strani","napaka");
    }

    public function registracija(){
        if(!isset($_SESSION["USER_ID"])){
           require_once('views/uporabnik/registracija.php');
        } else return call("strani","napaka");
    }

    public function registriraj(){
        if(isset($_POST["registriraj"])){
            if($_POST["password"] != $_POST["repeat_password"]){
                return call("strani","napaka");
            }
            else if(Uporabnik::username_exists($_POST["username"])){
                return call("strani","napaka");
            }
            else if($_POST["username"] == ""){
                return call("strani","napaka");
            }
            else if($_POST["password"] == ""){
                return call("strani","napaka");
            }
            else if($_POST["email"] == ""){
                return call("strani","napaka");
            }
            else if($_POST["ime"] == ""){
                return call("strani","napaka");
            }
            else if($_POST["priimek"] == ""){
                return call("strani","napaka");
            }

            else if(Uporabnik::register_user($_POST["username"], $_POST["password"], $_POST["email"], $_POST["ime"], $_POST["priimek"], $_POST["naslov"], $_POST["posta"], $_POST["telefon"], $_POST["spol"], $_POST["starost"])){
                return call("uporabnik", "prijava");
            }

            else return call("strani","napaka");

        }
    }

    public function uredi(){
        if (!isset($_GET['id'])){
            return call('strani', 'napaka');
        }
        $uporabnik = Uporabnik::najdi($_GET['id']);
        require_once('views/uporabnik/registracija.php');
    }

    public function urediShrani(){
        if(isset($_POST["uredi"])){
            if(!isset($_GET['id'])){
                return call("strani","napaka");
            }
            else if(Uporabnik::username_exists($_POST["username"])){
                return call("strani","napaka");
            }
            else if($_POST["username"] == ""){
                return call("strani","napaka");
            }
            else if($_POST["email"] == ""){
                return call("strani","napaka");
            }
            else if($_POST["ime"] == ""){
                return call("strani","napaka");
            }
            else if($_POST["priimek"] == ""){
                return call("strani","napaka");
            }
            else if(Uporabnik::update_user($_GET['id'], $_POST["username"], $_POST["email"], $_POST["ime"], $_POST["priimek"], $_POST["naslov"], $_POST["posta"], $_POST["telefon"], $_POST["spol"], $_POST["starost"])){
                return call("uporabnik", "index");
            }

            else return call("strani","napaka");

        }
    }
}