<?php
	//array com os sensores no armazém -> sensores.txt
	$sensores=file_get_contents("files/sensores.txt");
    $sensores=explode("\n",$sensores);
    foreach ($sensores as $key => $value) {
        $sensor=explode(":",$value);
        $newSensores[$sensor[0]]=$sensor[1];
    }
    $sensores=$newSensores;

	header('Content-Type: text/html; charset=utf-8');
	//echo $_SERVER['REQUEST_METHOD'];
	
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		if(isset($_POST["nome"]) && isset($_POST["valor"]) && isset($_POST["hora"])){
			if(isset($sensores[$_POST["nome"]])){
				if($_POST["nome"]!="" && $_POST["valor"]!="" && $_POST["hora"]!="" && is_numeric($_POST["valor"])){
					file_put_contents("files/armazem/". $_POST["nome"] ."/valor.txt", $_POST["valor"]);
					file_put_contents("files/armazem/". $_POST["nome"] ."/hora.txt", $_POST["hora"]);
					file_put_contents("files/armazem/". $_POST["nome"] ."/log.txt", $_POST["hora"]."-".$_POST["valor"].PHP_EOL, FILE_APPEND);
				}else{
					echo "ERROR: Dados inválidos";
					http_response_code(400);
				}
			}else{
				echo "ERROR: Sensor não encontrado";
				http_response_code(404);
			}
				
		}else{ 
			echo "ERROR: Parâmetros invalidos";
			http_response_code(400);
		}
		exit();
		
	}elseif($_SERVER["REQUEST_METHOD"] == "GET"){
		if(isset($_GET['sensor'])){
			if(isset($sensores[$_GET['sensor']])){
				echo file_get_contents("files/armazem/".$_GET["sensor"]."/valor.txt");
			}else{
				echo "ERROR: Sensor não encontrado";
				http_response_code(404);
			}
		}else{
			echo "ERROR: Parâmetros invalidos";
			http_response_code(400);
		}
		exit();
	}else{
		echo "Metodo não permitido";
		http_response_code(403);
		exit();
	}
	
	
	
?>