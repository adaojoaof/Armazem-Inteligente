<?php

	header('Content-Type: text/html; charset=utf-8');
	//echo $_SERVER['REQUEST_METHOD'];
	
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		echo "recebido um POST";
		//print_r($_POST);
		//var_dump(file_put_contents("php://input"));
		
		if(isset($_POST["nome"]) && isset($_POST["valor"])){
			file_put_contents("files/armazem/". $_POST["nome"] ."/valor.txt", $_POST["valor"]);
				
			//exit();
		}else{ 
			echo "Error: parametros invalidos";
			//exit();
		}
		exit();
		
	}elseif($_SERVER["REQUEST_METHOD"] == "GET"){
		echo "recebido um GET";
		//print_r($_GET);
		exit();
		
	}else{
		echo "Metodo não permitido";
		exit();
	}
	
	
	
?>