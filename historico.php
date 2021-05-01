<?php
    $pageTitle="Histórico";
    $activePage="historico";

    //array com os sensores no armazém -> sensores.txt
	$sensores=file_get_contents("api/files/sensores.txt");
	$sensores=explode("\n",$sensores);
?>
<?php include "header.php"; ?>
<div class="row">
    <div class="col-3">
        <h5>Selecione o Sensor:</h5>
        <div class="list-group">
            <?php foreach ($sensores as $key => $value) { ?>
                <a href="historico.php?sensor=<?=$value?>" class="<?php if(isset($_GET['sensor'])){ if($_GET['sensor']==$value){echo "active";} } ?> list-group-item list-group-item-action"><?=$value?></a>
            <?php } ?>
        </div>
    </div>

    <div class="col-9">
        <?php if(isset($_GET['sensor'])){
                if(is_numeric(array_search($_GET['sensor'], $sensores))){ ?>
                    <div class="card-stats card">
                        <div class="card-header">
                            <h4 class="card-title"><?=$_GET['sensor']?></h4> 
                            <p class="card-category">Histórico do Sensor <?=$_GET['sensor']?><??></p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>Data</th>
                                        <th>Hora</th>
                                        <th>Valor Registado</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $historico = file_get_contents("api/files/armazem/".$_GET['sensor']."/log.txt");
                                        $historico=explode("\n",$historico);
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
                        </div>
                        <div class="card-footer">
                            <hr>
                            <div class="stats"><i class="fas fa-redo mr-1"></i> 2021/04/28 15:00:00</div>
                        </div>
                    </div>

        <?php
            }
        }
        ?>
    </div>
</div>

<?php include "footer.php"; ?>