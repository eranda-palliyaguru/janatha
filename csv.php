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
		$r4=$row [4];
		$r5=$row [5];
		$r6=$row [6];
		$r7=$row [7];
		$r8=$row [8];
		$r9=$row [9];
		$r10=$row [10];
		$r11=$row [11];
		$r12=$row [12];
		$r13=$row [13];
		$r14=$row [14];
		
		
		

     include('connect.php');


	  
	  	//$value = "'". implode("','", $row)."'";
	  	$q = "INSERT INTO csv(ref,bik_no,date,mileg,date2,next_srv,total,fw,ws,pws,wr,is_company,labour,cmp_labor,cmp_price) 
		VALUES('$r','$r1','$r2','$r3','$r4','$r5','$r6','$r7','$r8','$r9','$r10','$r11','$r12','$r13','$r14')";
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