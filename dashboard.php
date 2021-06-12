<?php
$pageTitle = "Dashboard";
$activePage = "dashboard";

//array com os sensores no armazém -> sensores.txt
$sensores = file_get_contents("api/files/sensores.txt");
$sensores = explode("\n", $sensores);


$temperatura = json_decode(file_get_contents("http://localhost:8888/projetoTI/api/api.php?sensor=temperatura"));
$humidade = json_decode(file_get_contents("http://localhost:8888/projetoTI/api/api.php?sensor=humidade"));
$vento = json_decode(file_get_contents("http://localhost:8888/projetoTI/api/api.php?sensor=detetor_vento"));
$janelaNorte = json_decode(file_get_contents("http://localhost:8888/projetoTI/api/api.php?sensor=janela_sul"));
$janelaSul = json_decode(file_get_contents("http://localhost:8888/projetoTI/api/api.php?sensor=janela_sul"));


$portao_principal = json_decode(file_get_contents("http://localhost:8888/projetoTI/api/api.php?sensor=portao_principal"));
$porta_descargas = json_decode(file_get_contents("http://localhost:8888/projetoTI/api/api.php?sensor=porta_descargas"));
$porta_cargas = json_decode(file_get_contents("http://localhost:8888/projetoTI/api/api.php?sensor=porta_cargas"));
$valor_camara = file_get_contents("api/files/armazem/camara/valor.txt");
$hora_camara = file_get_contents("api/files/armazem/camara/hora.txt");
$valor_sensores = sizeof($sensores);


$valor_internet = file_get_contents("api/files/armazem/internet/valor.txt");
$hora_internet = file_get_contents("api/files/armazem/internet/hora.txt");
$valor_error = file_get_contents("api/files/armazem/error/valor.txt");

//array com as prateleiras no armazém -> prateleiras.txt
$prateleiras = file_get_contents("api/files/prateleiras.txt");
$prateleiras = explode("\n", $prateleiras);
array_pop($prateleiras);
foreach ($prateleiras as $key => $value) {
   $prateleira = explode(":", $value);
   $newPrateleiras[$prateleira[0]] = $prateleira[1];
}
$prateleiras = $newPrateleiras;
?>

<?php include "header.php"; ?>

<!-- Content -->
<div class="row">
   <div class="col-xl-3 col-sm-6">
      <div class="card-stats card">
         <div class="card-header">
            <h4 class="card-title">Portões</h4>
            <p class="card-category">Estado dos Portões</p>
         </div>
         <div class="card-body">
            <div class="row porta-icon" id="portao_principal" data-state="<?= $portao_principal->value?>">
               <div class="col-4">
                  <div class="icon-big text-center icon-warning pointer">
                     <?php if ($portao_principal->value == 1) { ?>
                        <i class="text-success fas fa-lock-open"></i>
                     <?php } else { ?>
                        <i class="text-danger fas fa-lock"></i>
                     <?php } ?>
                  </div>
               </div>
               <div class="col-8">
                  <div class="numbers">
                     <p class="card-category">Portão Principal</p>
                     <h4 class="card-title"> <?= $portao_principal->value == 1 ? "Aberto" : "Fechado" ?> </h4>
                     <p class="dashboard-cards-hora"><?= $portao_principal->datetime ?></p>
                  </div>
               </div>
            </div>
            <div class="row porta-icon" id="porta_cargas" data-state="<?= $porta_cargas->value?>">
               <div class="col-4">
                  <div class="icon-big text-center icon-warning pointer">
                     <?php if ($porta_cargas->value == 1) { ?>
                        <i class="text-success fas fa-lock-open"></i>
                     <?php } else { ?>
                        <i class="text-danger fas fa-lock"></i>
                     <?php } ?>
                  </div>
               </div>
               <div class="col-8">
                  <div class="numbers">
                     <p class="card-category">Portão Cargas</p>
                     <h4 class="card-title"> <?= $porta_cargas->value == 1 ? "Aberto" : "Fechado" ?> </h4>
                     <p class="dashboard-cards-hora"><?= $porta_cargas->datetime ?></p>
                  </div>
               </div>
            </div>
            <div class="row porta-icon" id="porta_descargas" data-state="<?= $porta_descargas->value?>">
               <div class="col-4">
                  <div class="icon-big text-center icon-warning pointer">
                     <?php if ($porta_descargas->value == 1) { ?>
                        <i class="text-success fas fa-lock-open"></i>
                     <?php } else { ?>
                        <i class="text-danger fas fa-lock"></i>
                     <?php } ?>
                  </div>
               </div>
               <div class="col-8">
                  <div class="numbers">
                     <p class="card-category">Portão Descargas</p>
                     <h4 class="card-title"> <?= $porta_descargas->value == 1 ? "Aberto" : "Fechado" ?> </h4>
                     <p class="dashboard-cards-hora"><?= $porta_descargas->datetime ?></p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-xl-3 col-sm-6">
      <div class="card-stats card">
         <div class="card-header">
            <h4 class="card-title">Armazém</h4>
            <p class="card-category">Dados do Interior do Armazém</p>
         </div>
         <div class="card-body">
            <div class="row" id="temperatura" data-value="<?= $temperatura->value ?>">
               <div class="col-4">
                  <div class="icon-big text-center icon-warning"><i class="fas fa-thermometer-half text-primary"></i></div>
               </div>
               <div class="col-8">
                  <div class="numbers">
                     <p class="card-category">Temperatura</p>
                     <h4 class="card-title"><span class="value-in"><?php echo $temperatura->value ?></span> Cº <span class="arrow-state"></span></h4>
                     <p class="dashboard-cards-hora"><?= $temperatura->datetime ?></p>
                  </div>
               </div>
            </div>
            <div class="row" id="humidade"  data-value="<?= $humidade->value ?>">
               <div class="col-4">
                  <div class="icon-big text-center icon-warning"><i class="fas fa-tint text-primary"></i></div>
               </div>
               <div class="col-8">
                  <div class="numbers">
                     <p class="card-category">Humidade</p>
                     <h4 class="card-title"><span class="value-in"><?php echo $humidade->value ?></span>% <span class="arrow-state"></span></h4>
                     <p class="dashboard-cards-hora"><?= $humidade->datetime ?></p>
                  </div>
               </div>
            </div>
            <div class="row" id="detetor_vento">
               <div class="col-4">
                  <div class="icon-big text-center icon-warning"><i class="fas fa-wind text-primary"></i></div>
               </div>
               <div class="col-8">
                  <div class="numbers">
                     <p class="card-category">Vento</p>
                     <h4 class="card-title"><?php echo $vento->value == 1 ? "Detetado" : "Não detetado" ?></h4>
                     <p class="dashboard-cards-hora"><?= $vento->datetime ?></p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-xl-3 col-sm-6">
      <div class="card-stats card">
         <div class="card-header">
            <h4 class="card-title">Equipamentos</h4>
            <p class="card-category">Dispositivos instalados</p>
         </div>
         <div class="card-body">
            <div class="row">
               <div class="col-4">
                  <div class="icon-big text-center icon-warning"><i class="fas fa-camera text-info"></i></div>
               </div>
               <div class="col-8">
                  <div class="numbers">
                     <p class="card-category">Câmera</p>
                     <h4 class="card-title"><?= $valor_camara == 1 ? "ON" : "OFF" ?></h4>
                     <p class="dashboard-cards-hora"><?= $hora_camara ?></p>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-4">
                  <div class="icon-big text-center icon-warning"><i class="fas fa-microchip text-info"></i></div>
               </div>
               <div class="col-8">
                  <div class="numbers">
                     <p class="card-category">Sensores</p>
                     <h4 class="card-title"><?php echo $valor_sensores ?></h4>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-xl-3 col-sm-6">
      <div class="card-stats card">
         <div class="card-header">
            <h4 class="card-title">Janelas</h4>
            <p class="card-category">Janelas do Armazém</p>
         </div>
         <div class="card-body">
         <div class="row" id="janela_sul">
               <div class="col-4">
                  <div class="icon-big text-center icon-warning"><i class="far fa-window-maximize"></i></div>
               </div>
               <div class="col-8">
                  <div class="numbers">
                     <p class="card-category">Janela Norte</p>
                     <h4 class="card-title"><?php echo $janelaNorte->value == 1 ? "Aberta" : "Fechada" ?></h4>
                     <p class="dashboard-cards-hora"><?= $janelaNorte->datetime ?></p>
                  </div>
               </div>
            </div>
            <div class="row" id="janela_norte">
               <div class="col-4">
                  <div class="icon-big text-center icon-warning"><i class="far fa-window-maximize"></i></div>
               </div>
               <div class="col-8">
                  <div class="numbers">
                     <p class="card-category">Janela Sul</p>
                     <h4 class="card-title"><?php echo $janelaSul->value == 1 ? "Aberta" : "Fechada" ?></h4>
                     <p class="dashboard-cards-hora"><?= $janelaSul->datetime ?></p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-12">
      <div class="card-stats card">
         <div class="card-header">
            <h4 class="card-title">Histórico das Temperaturas</h4>
            <p class="card-category"></p>
         </div>
         <div class="card-body">
            <div class="ct-chart ct-perfect-fourth">
               
            </div>
         </div>
      </div>
   </div>
</div>

<?php include "footer.php"; ?>