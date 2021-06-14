<?php
$pageTitle = "Histórico de Imagens capturadas na Receção";
$activePage = "historico-imagens";
$rules=['admin'];

//função para conectar à base de dados
function connectDatabse(){
    include("database-config.php");
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

//recebe as imagens de acessos na receção
$conn=connectDatabse();
$sql = "SELECT * FROM `images` order by datetime desc limit 10";
$resultImages = $conn->query($sql);
$conn->close();

//array com as imagens de acessos na receção
$images=[];
while($row=$resultImages->fetch_assoc()){
    $images[]=$row;
}
?>

<?php include "header.php"; ?>

<div class="row">
    <div class="col-12">
        <div class="card-stats card">
            <div class="card-body">
                <?php
                //só mostra a tabela se existirem dados
                if (count($images) > 0) {
                ?>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Imagem</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($images as $key => $value) {
                                ?>
                                    <tr>
                                        <td><?= $value['datetime'] ?></td>
                                        <!-- mostra a imagem -->
                                        <td><img class="img-fluid" style="height: 100px;" src="images/<?= $value['name'] ?>" alt=""></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } else { ?>
                    <p class="text-center mt-4 mb-4">Sem dados para apresentar!</p>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>