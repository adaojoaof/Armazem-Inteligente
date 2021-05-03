<?php
$pageTitle = "Dashboard";
$activePage = "dashboard";

//array com os sensores no armazém -> sensores.txt
$sensores = file_get_contents("api/files/sensores.txt");
$sensores = explode("\n", $sensores);


$valor_temperatura = file_get_contents("api/files/armazem/temperatura/valor.txt");
$hora_temperatura = file_get_contents("api/files/armazem/temperatura/hora.txt");
$valor_humedad = file_get_contents("api/files/armazem/humidade/valor.txt");
$hora_humedad = file_get_contents("api/files/armazem/humidade/hora.txt");
$valor_luminosidade = file_get_contents("api/files/armazem/luminosidade/valor.txt");
$hora_luminosidade = file_get_contents("api/files/armazem/luminosidade/hora.txt");


$valor_porta_principal = file_get_contents("api/files/armazem/porta_principal/valor.txt");
$hora_porta_principal = file_get_contents("api/files/armazem/porta_principal/hora.txt");
$valor_porta_carga = file_get_contents("api/files/armazem/porta_carga/valor.txt");
$hora_porta_carga = file_get_contents("api/files/armazem/porta_carga/hora.txt");
$valor_porta_descarga = file_get_contents("api/files/armazem/porta_descargas/valor.txt");
$hora_porta_descarga = file_get_contents("api/files/armazem/porta_descargas/hora.txt");
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
            <div class="row">
               <div class="col-4">
                  <div class="icon-big text-center icon-warning">
                     <?php if ($valor_porta_principal == 1) { ?>
                        <i class="text-success fas fa-lock-open"></i>
                     <?php } else { ?>
                        <i class="text-danger fas fa-lock"></i>
                     <?php } ?>
                  </div>
               </div>
               <div class="col-8">
                  <div class="numbers">
                     <p class="card-category">Portão Principal</p>
                     <h4 class="card-title"> <?= $valor_porta_principal == 1 ? "Aberto" : "Fechado" ?> </h4>
                     <p class="dashboard-cards-hora"><?= $hora_porta_principal ?></p>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-4">
                  <div class="icon-big text-center icon-warning">
                     <?php if ($valor_porta_carga == 1) { ?>
                        <i class="text-success fas fa-lock-open"></i>
                     <?php } else { ?>
                        <i class="text-danger fas fa-lock"></i>
                     <?php } ?>
                  </div>
               </div>
               <div class="col-8">
                  <div class="numbers">
                     <p class="card-category">Portão Cargas</p>
                     <h4 class="card-title"> <?= $valor_porta_carga == 1 ? "Aberto" : "Fechado" ?> </h4>
                     <p class="dashboard-cards-hora"><?= $hora_porta_carga ?></p>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-4">
                  <div class="icon-big text-center icon-warning">
                     <?php if ($valor_porta_descarga == 1) { ?>
                        <i class="text-success fas fa-lock-open"></i>
                     <?php } else { ?>
                        <i class="text-danger fas fa-lock"></i>
                     <?php } ?>
                  </div>
               </div>
               <div class="col-8">
                  <div class="numbers">
                     <p class="card-category">Portão Descargas</p>
                     <h4 class="card-title"> <?= $valor_porta_descarga == 1 ? "Aberto" : "Fechado" ?> </h4>
                     <p class="dashboard-cards-hora"><?= $hora_porta_descarga ?></p>
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
            <div class="row">
               <div class="col-4">
                  <div class="icon-big text-center icon-warning"><i class="fas fa-thermometer-half text-primary"></i></div>
               </div>
               <div class="col-8">
                  <div class="numbers">
                     <p class="card-category">Temperatura</p>
                     <h4 class="card-title"><?php echo $valor_temperatura ?>Cº</h4>
                     <p class="dashboard-cards-hora"><?= $hora_temperatura ?></p>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-4">
                  <div class="icon-big text-center icon-warning"><i class="fas fa-tint text-primary"></i></div>
               </div>
               <div class="col-8">
                  <div class="numbers">
                     <p class="card-category">Humidade</p>
                     <h4 class="card-title"><?php echo $valor_humedad ?>%</h4>
                     <p class="dashboard-cards-hora"><?= $hora_humedad ?></p>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-4">
                  <div class="icon-big text-center icon-warning"><i class="fas fa-sun text-primary"></i></div>
               </div>
               <div class="col-8">
                  <div class="numbers">
                     <p class="card-category">Luminosidade</p>
                     <h4 class="card-title"><?php echo $valor_luminosidade ?></h4>
                     <p class="dashboard-cards-hora"><?= $hora_luminosidade ?></p>
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
            <h4 class="card-title">Estado</h4>
            <p class="card-category">Dispositivos instalados</p>
         </div>
         <div class="card-body">
            <div class="row">
               <div class="col-4">
                  <div class="icon-big text-center icon-warning">
                     <?php if ($valor_internet == 1) { ?>
                        <i class="fas fa-check-circle text-success"></i>
                     <?php } else { ?>
                        <i class="fas fa-exclamation-triangle text-danger"></i>
                     <?php } ?>
                  </div>
               </div>
               <div class="col-8">
                  <div class="numbers">
                     <p class="card-category">Internet</p>
                     <h4 class="card-title"> <?= $valor_internet == 1 ? "ON" : "OFF" ?> </h4>
                     <p class="dashboard-cards-hora"><?= $hora_internet ?></p>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-4">
                  <div class="icon-big text-center icon-warning">
                     <?php if ($valor_error == 0) { ?>
                        <i class="fas fa-check-circle text-success"></i>
                     <?php } else { ?>
                        <i class="fas fa-exclamation-triangle text-danger"></i>
                     <?php } ?>
                  </div>
               </div>
               <div class="col-8">
                  <div class="numbers">
                     <p class="card-category">Erros</p>
                     <h4 class="card-title"><?php echo $valor_error ?></h4>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-12">
      <div class="card-stats card">
         <div class="card-header">
            <h4 class="card-title">Prateleiras</h4>
            <p class="card-category">Estado de Cada Prateleira do Armazém</p>
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <table class="table table-hover table-striped">
                  <thead>
                     <tr>
                        <th>Código Prateleira</th>
                        <th>Localização</th>
                        <th>Produto</th>
                        <th>Stock</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php foreach ($prateleiras as $key => $value) { ?>
                        <tr>
                           <td><?= $key ?></td>
                           <td><?= file_get_contents("api/files/prateleiras/$key/localizacao.txt") ?></td>
                           <td><?= $value ?></td>
                           <td>
                              <?php if (file_get_contents("api/files/prateleiras/$key/valor.txt") == 1) { ?>
                                 <span class="badge badge-pill badge-success">OK</span>
                              <?php } else { ?>
                                 <span class="badge badge-pill badge-danger">Sem stock</span>
                              <?php } ?>
                              <span class="pratelerias-hora">[<?= file_get_contents("api/files/prateleiras/$key/hora.txt") ?>]</span>
                           </td>
                        </tr>
                     <?php } ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

<?php include "footer.php"; ?>