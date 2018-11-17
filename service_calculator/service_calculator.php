<?php
	class Calculator
	{
		public $num1, $num2, $num3;
		
		public function __construct($num1,$num2,$num3)
		{
			$this->num1 = $num1;
			$this->num2 = $num2;
			$this->num3 = $num3;
		}
		public function sum()
		{
			return $this->num1 + $this->num2 + $this->num3;
		}
		public function avg()
		{
			return ($this->num1 + $this->num2 + $this->num3) / 3;
		}
		public function mult()
		{
			return $this->num1 * $this->num2 * $this->num3;
		}
	}

	if(isset($_GET['num1'])) // receive data via GET
		$num1 = (int)$_GET["num1"]; // convert String to Integer else if(isset($_POST['num1'])) // receive data via POST
	else if(isset($_POST['num1'])) 
		$num1 = (int)$_POST["num1"]; 
	else $num1 = 0;

	if(isset($_GET['num2'])) 
		$num2 = (int)$_GET["num2"];
	else if(isset($_POST['num2'])) 
		$num2 = (int)$_POST["num2"]; 
	else $num2 = 0;

	if(isset($_GET['num3'])) 
		$num3 = (int)$_GET["num3"];
	else if(isset($_POST['num3'])) 
		$num3 = (int)$_POST["num3"]; 
	else $num3 = 0;

	if(isset($_GET['func'])) 
		$func = $_GET["func"];
	else if(isset($_POST['func'])) 
		$func = $_POST["func"]; 

	$method = $_SERVER['REQUEST_METHOD'];
	if ($method == "PUT"){
	  	parse_str(file_get_contents("php://input"), $_PUT);
	  	$func = $_PUT['func'];
	  	$clacObj = new Calculator($_PUT['num1'],$_PUT['num2'],$_PUT['num3']);
	  	if ($func == 'sum')
			$res = $clacObj->sum();
		else if ($func == 'avg')
			$res = $clacObj->avg();
		else if ($func == 'mult')
			$res = $clacObj->mult();
		else{
			echo "Error in func variable!";
			$res = 0;
		}
		$a = array ('retVal' => $res);
		header('Content-Type: application/json'); // set header for json response echo json_encode($a); // echo the converted JSON Object from the Array
		echo json_encode($a);
	}
	
	else{
		$clacObj = new Calculator($num1,$num2,$num3);
		if ($func == 'sum')
			$res = $clacObj->sum();
		else if ($func == 'avg')
			$res = $clacObj->avg();
		else if ($func == 'mult')
			$res = $clacObj->mult();
		else{
			echo "Error in func variable!";
			$res = 0;
		}
		$a = array ('retVal' => $res);
		header('Content-Type: application/json'); // set header for json response echo json_encode($a); // echo the converted JSON Object from the Array
		echo json_encode($a);
	}
?>