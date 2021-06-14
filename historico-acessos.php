<?php
$pageTitle = "Histórico de Acessos ao Armazém";
$activePage = "historico-acessos";
$rules=['admin', 'driver'];

//função para conectar à base de dados
function connectDatabse(){
    include("database-config.php");
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

//recebe os logs de acessos
$conn=connectDatabse();
$sql = "SELECT datetime, name, result FROM log_acessos_armazem inner join users on users.username=log_acessos_armazem.username order by datetime desc limit 50";
$resultLogs = $conn->query($sql);
$conn->close();

//array com os logs e acessos
$logs=[];
while($row=$resultLogs->fetch_assoc()){
    $logs[]=$row;
}
?>

<?php include "header.php"; ?>

<div class="row">
    <div class="col-12">
        <div class="card-stats card">
            <div class="card-body">
                <?php
                //só mostra a tabela se existirem dados
                if (count($logs) > 0) {
                ?>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Hora</th>
                                    <th>Utilizador</th>
                                    <th>Autorização</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($logs as $key => $value) {
                                ?>
                                    <tr>
                                        <td><?= explode(" ",$value['datetime'])[0] ?></td>
                                        <td><?= explode(" ",$value['datetime'])[1] ?></td>
                                        <td><?= $value['name'] ?></td>
                                        <td><?= $value['result'] ?></td>
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