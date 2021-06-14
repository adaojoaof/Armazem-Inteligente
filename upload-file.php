<?php
function connectDatabse(){
    include("database-config.php");
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_FILES['imagem'])){
            echo "Nome: ".$_FILES['imagem']['name'];
            echo "<br>Tamanho: ".$_FILES['imagem']['size'];
            echo "<br>Tipo: ".$_FILES['imagem']['type']."<br>";
            $imageFileType = strtolower(pathinfo($_FILES["imagem"]["name"],PATHINFO_EXTENSION));
            if ($_FILES["imagem"]["size"] > 1000000) {
                echo "Imagem demasiado grande!";
            }else if($imageFileType!="jpeg"&&$imageFileType!="jpg"&&$imageFileType!="png"){
                echo "Formato não autorizado!";
            }else if (move_uploaded_file($_FILES["imagem"]["tmp_name"], "images/".$_FILES['imagem']['name'])) {
                echo "Upload Ok!";
                $conn=connectDatabse();
					$nome = mysqli_real_escape_string($conn,$_FILES['imagem']['name']);
					$sql = "INSERT INTO images VALUES ('$nome', SYSDATE());";
					if($conn->query($sql) == true){
						echo "SUCCESS DB";
					}else{
						echo "ERROR DB - ".$conn->error;
					}
					$conn->close();
              } else {
                echo "Sorry, there was an error uploading your file.";
              }
        }else{
            echo "ERRO - Imagem não encontrada  ";
        }
    }else{
        echo "ERRO - Metodo  Post não detetado";
    }
?>