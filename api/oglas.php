<?php
class Oglas{
	//public lastnosti
	public $id;
	public $naslov;
	public $vsebina;


	//konstruktor s priveztim paramterom id, tako da ga ni potrebno podati npr. new Oglas("naslov","vsebina") ali new Oglas("naslov","vsebina",5);
	function __construct($naslov, $vsebina,$id=0)
	{
		$this->naslov = $naslov;
		$this->vsebina = $vsebina;
		$this->id = $id;

	}
	

	public function dodaj($db){
		$naslov=$this->naslov;
		$vsebina=$this->vsebina;
		$qs="insert into oglas (Naslov,Vsebina) values('$naslov','$vsebina');";
		$result=mysqli_query($db,$qs);

		if(mysqli_error($db))
		{
			var_dump(mysqli_error($db));
			exit();
		}
		$this->id=mysqli_insert_id($db);
	}
	public function posodobi($db){
		$id=$this->id;
		$naslov=$this->naslov;
		$vsebina=$this->vsebina;
		$qs="Update oglas set Naslov='$naslov',Vsebina='$vsebina' where ID=$id;";
		$result=mysqli_query($db,$qs);

		if(mysqli_error($db))
		{
			var_dump(mysqli_error($db));
			exit();
		}
		
	}
	//statična funkcija, ki jo lahko kličemo brez primerka razreda
	public static function vrniVse($db) {
		$qs="Select * from oglas";
		$result=mysqli_query($db,$qs);

		if(mysqli_error($db))
		{
			var_dump(mysqli_error($db));
			exit();
		}
		$oglasi=array();
		//zgradimo polje oglasov in ga vrnemo
		while($row = mysqli_fetch_assoc($result)) {
			$oglas=new Oglas($row["Naslov"],$row["Vsebina"],$row["ID"]);
			$oglasi[]=$oglas;
		}
	
		return $oglasi;
	}
	//statična funkcija, ki jo lahko kličemo brez primerka razreda
	public static function vrniEnega($db,$id) {
		$qs="Select * from oglas where id=$id";
		$result=mysqli_query($db,$qs);

		if(mysqli_error($db))
		{
			var_dump(mysqli_error($db));
			exit();
		}
		
		//ustvarimo nov objekt oglas
		$row = mysqli_fetch_assoc($result);
		$oglas=new Oglas($row["Naslov"],$row["Vsebina"],$row["ID"]);
		
	
		return $oglas;
	}

}





?>