<?php


class Aktivnost{
    public $idAktivnost;
    public $datum;
    public $ocena_aktivnosti;
    public $koraki;
    public $porabljene_kalorije;
    public $povp_srcni_utrip;
    public $povp_hitrost;
    public $razdalja;
    public $cas;
    public $FK_idUser;

    function __construct($datum, $ocena_aktivnosti, $koraki, $porabljene_kalorije, $povp_srcni_utrip, $povp_hitrost, $razdalja, $cas, $FK_idUser, $idAktivnost=0)
    {
        $this->idAktivnost = $idAktivnost;
        $this->datum = $datum;
        $this->ocena_aktivnosti = $ocena_aktivnosti;
        $this->koraki = $koraki;
        $this->porabljene_kalorije = $porabljene_kalorije;
        $this->povp_srcni_utrip = $povp_srcni_utrip;
        $this->povp_hitrost = $povp_hitrost;
        $this->razdalja = $razdalja;
        $this->cas = $cas;
        $this->FK_idUser = $FK_idUser;

    }

    //statična funkcija, ki jo lahko kličemo brez primerka razreda
    public static function vrniVse($db) {
        $qs="SELECT datum, ocena_aktivnosti, koraki, porabljene_kalorije, povp_srcni_utrip, povp_hitrost, razdalja, cas, ime FROM aktivnost JOIN user ON (user.idUser = aktivnost.FK_idUser);";
        $result=mysqli_query($db,$qs);

        if(mysqli_error($db))
        {
            var_dump(mysqli_error($db));
            exit();
        }
        $podatki=array();

        while($podatek = $result->fetch_object()){
            array_push($podatki, $podatek);
        }
        return $podatki;
    }


    public function dodaj($db){
        $datum=$this->datum;
        $ocena_aktivnosti=$this->ocena_aktivnosti;
        $koraki=$this->koraki;
        $porabljene_kalorije=$this->porabljene_kalorije;
        $povp_srcni_utrip=$this->povp_srcni_utrip;
        $povp_hitrost=$this->povp_hitrost;
        $razdalja=$this->razdalja;
        $cas=$this->cas;
        $FK_idUser=$this->FK_idUser;

        $qs="INSERT INTO aktivnost (datum, ocena_aktivnosti, koraki, porabljene_kalorije, povp_srcni_utrip, povp_hitrost, razdalja, cas, FK_idUser) VALUES('$datum', '$ocena_aktivnosti', '$koraki', '$porabljene_kalorije', '$povp_srcni_utrip', '$povp_hitrost', '$razdalja', '$cas', '$FK_idUser');";
        $result=mysqli_query($db,$qs);

        if(mysqli_error($db))
        {
            var_dump(mysqli_error($db));
            exit();
        }
        $this->idAktivnost=mysqli_insert_id($db);
    }

}

?>