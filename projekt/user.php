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

    //statična funkcija, ki jo lahko kličemo brez primerka razreda
    public static function vrniVse($db) {
        $qs="SELECT ime, priimek, email, telefon, teza, visina, spol, ulica, hisna_st, ime_poste, stevilka_poste FROM user JOIN spol ON (user.FK_idSpol = spol.idSpol) JOIN naslov ON (user.FK_idNaslov = naslov.idNaslov) JOIN posta ON (naslov.FK_idPosta = posta.idPosta);";
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

}

?>