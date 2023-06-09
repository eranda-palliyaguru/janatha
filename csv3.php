<?php

class csv extends mysqli
{
	private $state_csv = false;
	public function __construct()
	{
		parent::__construct("localhost","colorb69_1","rathunona1.","colorb69_sumith_motors");
		if ($this->connect_error) {

			echo "Fail to connection_timeout".$this->connect_error;

		}
	}
public function inport($file)
{
	$file = fopen($file, 'r');

	while( ($row = fgetcsv($file,1000,",")) !==false) {

		$r=$row [0];
		$r1=$row [1];
		$r2=$row [2];
		$r3=$row [3];
		
		
		
		
		
		
		

     include('connect.php');


	  
	  	//$value = "'". implode("','", $row)."'";
	  	$q = "INSERT INTO csv3(code,price,name,qty) 
		VALUES('$r','$r1','$r2','$r3')";
	  	if ($this->query($q)) {
	  		$this->state_csv = true;
	  	}else{
	  		$this->state_csv = false;
	  		echo $this->error;
	  	}

	  } 

}
}
?>