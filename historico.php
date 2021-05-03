<?php
    $pageTitle="Histórico";
    $activePage="historico";

    //array com os sensores no armazém -> sensores.txt
	$sensores=file_get_contents("api/files/sensores.txt");
    $sensores=explode("\n",$sensores);
    foreach ($sensores as $key => $value) {
        $sensor=explode(":",$value);
        $newSensores[$sensor[0]]=$sensor[1];
    }
    $sensores=$newSensores;
?>
<?php include "header.php"; ?>
<div class="row">
    <div class="col-md-3 col-sm-5 col-12">
        <h5>Selecione o Sensor:</h5>
        <div class="list-group">
            <?php foreach ($sensores as $key => $value) { ?>
                <a href="historico.php?sensor=<?=$key?>" class="<?php if(isset($_GET['sensor'])){ if($_GET['sensor']==$key){echo "active";} } ?> list-group-item list-group-item-action"><?=$value?></a>
            <?php } ?>
        </div>
    </div>
    
    <div class="col-md-9 col-sm-7 col-12">
        <?php if(isset($_GET['sensor'])){
                if(isset($sensores[$_GET['sensor']])){ ?>
                    <div class="card-stats card">
                        <div class="card-header">
                            <h4 class="card-title"><?=$sensores[$_GET['sensor']]?></h4> 
                            <p class="card-category">Histórico do Sensor</p>
                        </div>
                        <div class="card-body">
                            <?php
                                $historico = file_get_contents("api/files/armazem/".$_GET['sensor']."/log.txt");
                                $historico=explode("\n",$historico);
                                array_pop($historico); //remove o 'enter' no array
                                if(count($historico)>0){
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
                                                $log=explode("-",$value);
                                                $data=$log[0];
                                                $valor=$log[1];
                                                ?>
                                                <tr>
                                                    <td><?=explode(" ",$data)[0]?></td>
                                                    <td><?=explode(" ",$data)[1]?></td>
                                                    <td><?= $valor ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php
                                }else{
                            ?>
                                <p class="text-center mt-4 mb-4">Sem dados para apresentar!</p>
                            <?php
                                }
                            ?>
                        </div>
                        <div class="card-footer">
                            <hr>
                            <div class="stats"><i class="fas fa-redo mr-1"></i>
                                <?php
                                    $date = file_get_contents("api/files/armazem/".$_GET['sensor']."/hora.txt");
                                    echo $date;
                                ?>
                            </div>
                        </div>
                    </div>

        <?php
            }
        }
        ?>
    </div>
</div>

<?php include "footer.php"; ?>