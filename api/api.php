<?php
	//array com os sensores no armazém -> sensores.txt
	$sensores=file_get_contents("files/sensores.txt");
    $sensores=explode("\n",$sensores);
    foreach ($sensores as $key => $value) {
        $sensor=explode(":",$value);
        $newSensores[$sensor[0]]=$sensor[1];
    }
    $sensores=$newSensores;

	//array com as prateleiras no armazém -> prateleiras.txt
	$prateleiras=file_get_contents("files/prateleiras.txt");
    $prateleiras=explode("\n",$prateleiras);
    foreach ($prateleiras as $key => $value) {
        $prateleira=explode(":",$value);
        $newPrateleiras[$prateleira[0]]=$prateleira[1];
    }
    $prateleiras=$newPrateleiras;
	// var_dump($prateleiras);

	header('Content-Type: text/html; charset=utf-8');
	//echo $_SERVER['REQUEST_METHOD'];
	
	

	function connectDatabse(){
		include("../database-config.php");
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		return $conn;
	}

	function verifyIfSensorExists($nome){
		$conn=connectDatabse();
		$nome = mysqli_real_escape_string($conn,$nome);
		$sql = "SELECT id FROM sensores WHERE id = '$nome'";
		$resultCheckSensor = $conn->query($sql);
		$conn->close();
		if($resultCheckSensor->num_rows == 1){
			return true;
		}else{
			return false;
		}
	}

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		if(isset($_POST["nome"]) && isset($_POST["valor"]) && isset($_POST["hora"])){
			if($_POST["nome"]!="" && $_POST["valor"]!="" && $_POST["hora"]!="" && is_numeric($_POST["valor"])){
				if(verifyIfSensorExists($_POST["nome"])){
					$conn=connectDatabse();
					$nome = mysqli_real_escape_string($conn,$_POST["nome"]);
					$valor = mysqli_real_escape_string($conn,$_POST["valor"]);
					$hora = mysqli_real_escape_string($conn,$_POST["hora"]);
					$sql = "INSERT INTO historico_sensores VALUES (NULL, '$nome', $valor, '$hora');";
					if($conn->query($sql) == true){
						echo "SUCCESS";
					}else{
						echo "ERROR DB - ".$conn->error;
					}
					$conn->close();
				} else {
					echo "ERROR: Sensor não encontrado";
					http_response_code(404);
				}
			}else{
				echo "ERROR: Dados inválidos";
				http_response_code(400);
			}	
		}else{ 
			echo "ERROR: Parâmetros invalidos";
			http_response_code(400);
		}
		exit();
		
	}else if($_SERVER["REQUEST_METHOD"] == "GET"){
		if(isset($_GET['sensor'])){
			if(verifyIfSensorExists($_GET["sensor"])){
				$conn=connectDatabse();
				$sensor = mysqli_real_escape_string($conn,$_GET['sensor']);
				$sql = "SELECT * FROM historico_sensores WHERE sensor_id = '$sensor' ORDER BY datetime desc LIMIT 1";
				$result = $conn->query($sql);
				$conn->close();
				$data=$result->fetch_assoc();
				echo json_encode($data);
			}else{
				echo "ERROR: Sensor não encontrado";
				http_response_code(404);
			}
		}else if(isset($_GET['card_id_portaoPrincipal'])){
			$conn=connectDatabse();
			$card = mysqli_real_escape_string($conn,$_GET['card_id_portaoPrincipal']);
			$sql = "SELECT username, rule FROM users WHERE rfid_card_id = '$card'";
			$resultCardVerify = $conn->query($sql);
			$conn->close();
			if($resultCardVerify->num_rows == 1){
				$data=$resultCardVerify->fetch_assoc();
				if($data['rule']=="admin"||$data['rule']=="driver"){
					$authorized="authorized";
				}else{
					$authorized="unauthorized";
				}
				$conn=connectDatabse();
				$sql = "INSERT INTO log_acessos_armazem VALUES (NULL, '".$data['username']."', '$authorized', NOW());";
				if($conn->query($sql) == true){
					echo $authorized;
				}else{
					echo "ERROR DB - ".$conn->error;
				}
				$conn->close();
			}else{
				echo "ERROR: CardId não encontrado";
				http_response_code(404);
			}
		}else if(isset($_GET['currentAuthCardUser'])){
			$conn=connectDatabse();
			$sql = "SELECT users.name FROM log_acessos_armazem INNER JOIN users on log_acessos_armazem.username=users.username ORDER by datetime desc limit 1";
			$resultCurrentCardUsername = $conn->query($sql);
			$conn->close();
			if($resultCurrentCardUsername->num_rows == 1){
				$data=$resultCurrentCardUsername->fetch_assoc();
				echo $data['name'];
			}else{
				echo "ERROR: Sem dados!";
				http_response_code(404);
			}
		}else if(isset($_GET['allSensors'])){
			$conn=connectDatabse();
			$sql = "SELECT historico_sensores.sensor_id as sensor_id, value, historico_sensores.datetime as datetime from historico_sensores, ( select sensor_id, max(datetime) as datetime from historico_sensores group by sensor_id ) most_recent where most_recent.sensor_id=historico_sensores.sensor_id and most_recent.datetime=historico_sensores.datetime ORDER BY historico_sensores.id DESC";
			$resultAllSensors = $conn->query($sql);
			$conn->close();
			if($resultAllSensors->num_rows > 0){
				$data=[];
				while($row=$resultAllSensors->fetch_assoc()){
					$data[$row['sensor_id']]=$row;
				}
				print json_encode($data);
			}else{
				echo "ERROR: Sem dados!";
				http_response_code(404);
			}

			
		}else if(isset($_GET['historicoTemperatura'])){
			$conn=connectDatabse();
			$sql = "SELECT value FROM `historico_sensores` WHERE sensor_id='temperatura' order by datetime desc LIMIT 50";
			$resulthistory = $conn->query($sql);
			$conn->close();
			if($resulthistory->num_rows > 0){
				$data=[];
				while($row=$resulthistory->fetch_assoc()){
					$data[]=intval($row['value']);
				}
				print json_encode($data);
			}else{
				echo "ERROR: Sem dados!";
				http_response_code(404);
			}

			
		}else if(isset($_GET['imagemRececao'])){
			$conn=connectDatabse();
			$sql = "SELECT * FROM `images` order by datetime desc LIMIT 1";
			$resultImg = $conn->query($sql);
			$conn->close();
			if($resultImg->num_rows == 1){
				print json_encode($resultImg->fetch_assoc());
			}else{
				echo "ERROR: Sem dados!";
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