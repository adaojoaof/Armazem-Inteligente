<?php
	//array com os sensores no armazém -> sensores.txt
	$sensores=file_get_contents("files/sensores.txt");
	$sensores=explode("\n",$sensores);

	header('Content-Type: text/html; charset=utf-8');
	//echo $_SERVER['REQUEST_METHOD'];
	
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		if(isset($_POST["nome"]) && isset($_POST["valor"]) && isset($_POST["hora"])){
			if(array_search($_POST['nome'], $sensores)!=false){
				file_put_contents("files/armazem/". $_POST["nome"] ."/valor.txt", $_POST["valor"]);
				file_put_contents("files/armazem/". $_POST["nome"] ."/hora.txt", $_POST["hora"]);
				file_put_contents("files/armazem/". $_POST["nome"] ."/log.txt", $_POST["hora"]."-".$_POST["valor"].PHP_EOL, FILE_APPEND);
			}else{
				echo "Error: Sensor não encontrado";
			}
				
		}else{ 
			echo "Error: parametros invalidos";
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