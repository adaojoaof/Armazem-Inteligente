<?php
$pageTitle = "Histórico";
$activePage = "historico";

function connectDatabse(){
    include("database-config.php");
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

$conn=connectDatabse();
$sql = "SELECT * FROM sensores order by id";
$resultSensores = $conn->query($sql);
$conn->close();

//array com os sensores no armazém -> sensores.txt
$sensores=[];
while($row=$resultSensores->fetch_assoc()){
    $sensores[$row['id']]=$row;
}
?>

<?php include "header.php"; ?>

<div class="row">
    <div class="col-md-3 col-sm-5 col-12 mb-4">
        <h5>Selecione o Sensor:</h5>
        <div class="list-group">
            <?php foreach ($sensores as $key => $value) { ?>
                <a href="historico.php?sensor=<?= $key ?>" class="<?= isset($_GET['sensor'])&&$_GET['sensor']==$key?"active":"" ?> list-group-item list-group-item-action"><?= $value['name'] ?></a>
            <?php } ?>
        </div>
    </div>

    <div class="col-md-9 col-sm-7 col-12 mb-4">
        <?php if (isset($_GET['sensor'])) {
            if (isset($sensores[$_GET['sensor']])) { ?>
                <div class="card-stats card">
                    <div class="card-header">
                        <h4 class="card-title"><?= $sensores[$_GET['sensor']]['name'] ?></h4>
                        <p class="card-category">Histórico do Sensor</p>
                    </div>
                    <div class="card-body">
                        <?php
                        $conn=connectDatabse();
                        $sensor = mysqli_real_escape_string($conn,$_GET['sensor']);
                        $sql = "SELECT * FROM historico_sensores where sensor_id='$sensor' order by datetime desc limit 100";
                        $resultHistorico = $conn->query($sql);
                        $conn->close();
                        $historico=[];
                        while($row=$resultHistorico->fetch_assoc()){
                            $historico[$row['id']]=$row;
                        }
                        if (count($historico) > 0) {
                        ?>
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Hora</th>
                                            <th>Valor Registado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($historico as $key => $value) {
                                        ?>
                                            <tr>
                                                <td><?= explode(" ",$value['datetime'])[0] ?></td>
                                                <td><?= explode(" ",$value['datetime'])[1] ?></td>
                                                <td>
                                                    <?php
                                                        if($value['sensor_id']=="portao_principal"||$value['sensor_id']=="porta_cargas"||$value['sensor_id']=="porta_descargas"){
                                                            if($value['value']==1){?>
                                                                <i class="text-success fas fa-lock-open"></i>
                                                            <?php }else{ ?>
                                                                <i class="text-danger fas fa-lock"></i>
                                                            <?php }
                                                        }else if($value['sensor_id']=="humidade"){
                                                            echo $value['value']."%";
                                                        }else if($value['sensor_id']=="temperatura"){
                                                            echo $value['value']." Cº";
                                                        }
                                                        else if($value['sensor_id']=="detetor_vento"){
                                                            if($value['value']==1){
                                                                echo "Detetado";
                                                            }else{
                                                                echo "Não detetado";
                                                            }
                                                        }
                                                    ?>
                                                
                                                </td>
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
        <?php
            }
        }
        ?>
    </div>
</div>

<?php include "footer.php"; ?>