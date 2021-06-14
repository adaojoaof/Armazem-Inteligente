<?php
//função para conectar à base de dados
function connectDatabse(){
    include("database-config.php");
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
    //valida se está com um post e se a "imagem" está definida
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_FILES['imagem'])){
            //mostra os dados da imagem
            echo "Nome: ".$_FILES['imagem']['name'];
            echo "<br>Tamanho: ".$_FILES['imagem']['size'];
            echo "<br>Tipo: ".$_FILES['imagem']['type']."<br>";

            //guarda o tipo de ficheiro
            $imageFileType = strtolower(pathinfo($_FILES["imagem"]["name"],PATHINFO_EXTENSION));

            //se for maior de 1000kB, dá erro
            if ($_FILES["imagem"]["size"] > 1000000) {
                echo "Imagem demasiado grande!";
            //se for diferente de jpeg, jpg ou png, dá erro
            }else if($imageFileType!="jpeg"&&$imageFileType!="jpg"&&$imageFileType!="png"){
                echo "Formato não autorizado!";
            //caso contrário, dá upload!
            }else if (move_uploaded_file($_FILES["imagem"]["tmp_name"], "images/".$_FILES['imagem']['name'])) {
                echo "Upload Ok!";
                //ao dar upload, faz uma query à base de dados para inserir um novo registo [para ser utilizado para o historico de imagens]
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