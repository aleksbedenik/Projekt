<?php


class Uporabnik
{
    public $id;
    public $username;
    public $email;
    public $ime;
    public $priimek;
    public $naslov;
    public $posta;
    public $telefon;
    public $spol;
    public $starost;
    public $admin;

    public function __construct($id, $username, $email, $ime, $priimek, $naslov, $posta, $telefon, $spol, $starost, $admin) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->ime = $ime;
        $this->priimek = $priimek;
        $this->naslov = $naslov;
        $this->posta = $posta;
        $this->telefon = $telefon;
        $this->spol = $spol;
        $this->starost = $starost;
        $this->admin = $admin;
    }

    public static function validate_login($username, $password){
        $db = Db::getInstance();
        $username = mysqli_real_escape_string($db, $username);
        $pass = sha1($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$pass'";
        $res = $db->query($query);
        if($user_obj = $res->fetch_object()){
            return $user_obj->id;
        }
        return -1;
    }

    public static function vsi() {
        $list = [];
        $db = Db::getInstance();
        $db->set_charset("UTF8");
        $result = mysqli_query($db,'SELECT * FROM users');

        while($row = mysqli_fetch_assoc($result)){
            $list[] = new Uporabnik($row['id'], $row['username'], $row['email'], $row['ime'], $row['priimek'], $row['naslov'], $row['posta'], $row['telefon'], $row['spol'], $row['starost'], $row['admin']);
        }

        return $list;
    }

    public static function isAdmin($id){
        $db = Db::getInstance();
        $query = "SELECT * FROM users WHERE id='$id' AND admin=true;";
        $res = $db->query($query);
        if(mysqli_num_rows($res)==0)return false;
        return true;
    }

    public static function najdi($id){
        $id = intval($id);
        $db = Db::getInstance();
        $db->set_charset("UTF8");
        $result = mysqli_query($db,"SELECT * FROM users where ID='$id'");
        $row = mysqli_fetch_assoc($result);
        return new Uporabnik($row['id'], $row['username'], $row['email'], $row['ime'], $row['priimek'], $row['naslov'], $row['posta'], $row['telefon'], $row['spol'], $row['starost'], $row['admin']);
    }

    public static function username_exists($username){
        $db = Db::getInstance();
        $username = mysqli_real_escape_string($db, $username);
        $query = "SELECT * FROM users WHERE username='$username'";
        $res = $db->query($query);
        return mysqli_num_rows($res) > 0;
    }

    public static function register_user($username, $password, $email, $ime, $priimek, $naslov, $posta, $telefon, $spol, $starost){
        $db = Db::getInstance();
        $username = mysqli_real_escape_string($db, $username);
        $pass = sha1($password);
        $email = mysqli_real_escape_string($db, $email);
        $ime = mysqli_real_escape_string($db, $ime);
        $priimek = mysqli_real_escape_string($db, $priimek);
        $naslov = mysqli_real_escape_string($db, $naslov);


        $query = "INSERT INTO users (username, password, email, ime, priimek, naslov, posta, telefon, spol, starost) 
				VALUES ('$username', '$pass', '$email', '$ime', '$priimek', '$naslov', '$posta', '$telefon', '$spol', '$starost');";
        if($db->query($query)){
            return true;
        }
        else{
            echo mysqli_error($db);
            return false;
        }
    }

    public static function update_user($id, $username, $email, $ime, $priimek, $naslov, $posta, $telefon, $spol, $starost){
        $db = Db::getInstance();
        $db->set_charset("UTF8");
        $username = mysqli_real_escape_string($db, $username);
        $email = mysqli_real_escape_string($db, $email);
        $ime = mysqli_real_escape_string($db, $ime);
        $priimek = mysqli_real_escape_string($db, $priimek);
        $naslov = mysqli_real_escape_string($db, $naslov);

        $query = "UPDATE users SET username='$username', email='$email', ime='$ime', priimek='$priimek', naslov='$naslov', posta='$posta', telefon='$telefon', spol='$spol', starost='$starost' WHERE id='$id';";
        if($db->query($query)){
            return true;
        }
        else{
            return false;
        }

    }
}