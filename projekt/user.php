<?php


class User{
    public $idUser;
    public $ime;
    public $priimek;
    public $email;
    public $telefon;
    public $teza;
    public $visina;
    public $FK_idNaslov;
    public $FK_idSpol;
    public $FK_idSlika;
    public $username;

    function __construct($ime, $priimek, $email, $telefon, $teza, $visina, $FK_idNaslov, $FK_idSpol, $FK_idSlika=NULL, $idUser=0)
    {
        $this->idUser = $idUser;
        $this->ime = $ime;
        $this->priimek = $priimek;
        $this->email = $email;
        $this->telefon = $telefon;
        $this->teza = $teza;
        $this->visina = $visina;
        $this->FK_idNaslov = $FK_idNaslov;
        $this->FK_idSpol = $FK_idSpol;
        $this->FK_idSlika = $FK_idSlika;
    }

    public static function validate_login($db, $username, $password){

        if($username == null or $password == null) return -1;
        $username = mysqli_real_escape_string($db, $username);
        //$pass = sha1($password);
        $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
        $res = $db->query($query);
        if($user_obj = $res->fetch_object()){
            return $user_obj->idUser; //ob uspesni prijavi vrne id usera
        }
        return -1;
    }

    public static function isAdmin($db, $id){

        $query = "SELECT * FROM user WHERE idUser='$id' AND admin=true;";
        $res = $db->query($query);
        if(mysqli_num_rows($res)==0)return false;
        return true;

    }


    public static function izpisUporabnika($db, $id) {
        if(User::isAdmin($db, $id) == true){
            $qs="SELECT username, password, ime, priimek, email, telefon, teza, visina, spol, ulica, hisna_st, ime_poste, stevilka_poste FROM user JOIN spol ON (user.FK_idSpol = spol.idSpol) JOIN naslov ON (user.FK_idNaslov = naslov.idNaslov) JOIN posta ON (naslov.FK_idPosta = posta.idPosta);";
        }else $qs="SELECT username, password, ime, priimek, email, telefon, teza, visina, spol, ulica, hisna_st, ime_poste, stevilka_poste FROM user JOIN spol ON (user.FK_idSpol = spol.idSpol) JOIN naslov ON (user.FK_idNaslov = naslov.idNaslov) JOIN posta ON (naslov.FK_idPosta = posta.idPosta) WHERE idUser = '$id';";

        $result=mysqli_query($db,$qs);

        if(mysqli_error($db))
        {
            var_dump(mysqli_error($db));
            exit();
        }
        $podatki=array();
        //zgradimo polje oglasov in ga vrnemo
        //while($row = mysqli_fetch_assoc($result)) {
        //    $podatek=new User($row["idUser"],$row["ime"],$row["priimek"],$row["email"],$row["telefon"],$row["teza"],$row["visina"],$row["FK_idNaslov"],$row["FK_idSpol"],$row["FK_idSlika"]);
        //    $podatki[]=$podatek;
       // }

        while($podatek = $result->fetch_object()){
            array_push($podatki, $podatek);
        }
        return $podatki;
    }

    public function dodaj($db){
        $ime=$this->ime;
        $priimek=$this->priimek;
        $email=$this->email;
        $telefon=$this->telefon;
        $teza=$this->teza;
        $visina=$this->visina;
        $FK_idNaslov=$this->FK_idNaslov;
        $FK_idSpol=$this->FK_idSpol;


        $qs="INSERT INTO user (ime, priimek, email, telefon, teza, visina, FK_idNaslov, FK_idSpol) VALUES('$ime', '$priimek', '$email', '$telefon', '$teza', '$visina', '$FK_idNaslov', '$FK_idSpol');";
        $result=mysqli_query($db,$qs);

        if(mysqli_error($db))
        {
            var_dump(mysqli_error($db));
            exit();
        }
        $this->idUser=mysqli_insert_id($db);
    }

    public static function username_exists($db, $username){

        $qs = "SELECT * FROM user WHERE username='$username'";
        $result=mysqli_query($db,$qs);

        return mysqli_num_rows($result) > 0;
    }

    public static function register($db, $username, $password){
        $username = mysqli_real_escape_string($db, $username);

        if($username == "") return false;
        if($password == "") return false;
        //$pass = sha1($password);
        if(User::username_exists($db, $username)){
            return false;
        }


        $qs="INSERT INTO user (username, password) VALUES('$username', '$password');";
        $result=mysqli_query($db,$qs);

        if(mysqli_error($db))
        {
            var_dump(mysqli_error($db));
            return false;
        }

        return true;
    }



}

?>