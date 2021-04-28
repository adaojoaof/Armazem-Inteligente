<?php
    $pageTitle="Dashboard";
    $activePage="dashboard";
?>
<?php include "header.php"; ?>

<!-- Content -->
<div class="row">
   <div class="col-lg-3 col-sm-6">
      <div class="card-stats card">
            <div class="card-header">
                <h4 class="card-title">Portões</h4>
                <p class="card-category">Estado dos Portões</p>
            </div>
            <div class="card-body">
                <div class="numbers">
                    <p class="card-category">Portão Principal</p>
                    <h4 class="card-title"> <i class="text-success fas fa-lock-open"></i> Aberto</h4>
                </div>
                <div class="numbers">
                    <p class="card-category">Cargas</p>
                    <h4 class="card-title"> <i class="text-danger fas fa-lock"></i> Fechado</h4>
                </div>
                <div class="numbers">
                    <p class="card-category">Descargas</p>
                    <h4 class="card-title"> <i class="text-danger fas fa-lock"></i> Fechado</h4>
                </div>
            </div>
            <div class="card-footer">
                <hr>
                <div class="stats"><i class="fas fa-redo mr-1"></i> 2021/04/28 15:00:00</div>
            </div>
      </div>
   </div>
   <div class="col-lg-3 col-sm-6">
      <div class="card-stats card">
        <div class="card-header">
                <h4 class="card-title">Armazém</h4> 
                <p class="card-category">Dados do Interior do Armazém</p>
            </div>
         <div class="card-body">
            <div class="row">
               <div class="col-5">
                  <div class="icon-big text-center icon-warning"><i class="fas fa-thermometer-half text-primary"></i></div>
               </div>
               <div class="col-7">
                  <div class="numbers">
                     <p class="card-category">Temperatura</p>
                     <h4 class="card-title">18 Cº</h4>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-5">
                  <div class="icon-big text-center icon-warning"><i class="fas fa-tint text-primary"></i></div>
               </div>
               <div class="col-7">
                  <div class="numbers">
                     <p class="card-category">Humidade</p>
                     <h4 class="card-title">80%</h4>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-5">
                  <div class="icon-big text-center icon-warning"><i class="fas fa-sun text-primary"></i></div>
               </div>
               <div class="col-7">
                  <div class="numbers">
                     <p class="card-category">Luminosidade</p>
                     <h4 class="card-title">200</h4>
                  </div>
               </div>
            </div>
         </div>
         <div class="card-footer">
                <hr>
                <div class="stats"><i class="fas fa-redo mr-1"></i> 2021/04/28 15:00:00</div>
            </div>
      </div>
   </div>
   <div class="col-lg-3 col-sm-6">
      <div class="card-stats card">
      <div class="card-header">
                <h4 class="card-title">Equipamentos</h4> 
                <p class="card-category">Dispositivos instalados</p>
            </div>
         <div class="card-body">
            <div class="row">
               <div class="col-5">
                  <div class="icon-big text-center icon-warning"><i class="fas fa-camera text-info"></i></div>
               </div>
               <div class="col-7">
                  <div class="numbers">
                     <p class="card-category">Câmera</p>
                     <h4 class="card-title">ON</h4>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-5">
                  <div class="icon-big text-center icon-warning"><i class="fas fa-microchip text-info"></i></div>
               </div>
               <div class="col-7">
                  <div class="numbers">
                     <p class="card-category">Sensores</p>
                     <h4 class="card-title">12</h4>
                  </div>
               </div>
            </div>
         </div>
         <div class="card-footer">
         <hr>
                <div class="stats"><i class="fas fa-redo mr-1"></i> 2021/04/28 15:00:00</div>
         </div>
      </div>
   </div>
   <div class="col-lg-3 col-sm-6">
      <div class="card-stats card">
      <div class="card-header">
                <h4 class="card-title">Estado</h4> 
                <p class="card-category">Dispositivos instalados</p>
            </div>
         <div class="card-body">
         <div class="row">
               <div class="col-5">
                  <div class="icon-big text-center icon-warning"><i class="fas fa-check-circle text-success"></i></div>
               </div>
               <div class="col-7">
                  <div class="numbers">
                     <p class="card-category">Internet</p>
                     <h4 class="card-title">OK</h4>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-5">
                  <div class="icon-big text-center icon-warning"><i class="fas fa-exclamation-triangle text-danger"></i></div>
               </div>
               <div class="col-7">
                  <div class="numbers">
                     <p class="card-category">Erros</p>
                     <h4 class="card-title">2</h4>
                  </div>
               </div>
            </div>
         </div>
         <div class="card-footer">
         <hr>
                <div class="stats"><i class="fas fa-redo mr-1"></i> 2021/04/28 15:00:00</div>
         </div>
      </div>
   </div>
   <div class="col-12">
      <div class="card-stats card">
      <div class="card-header">
                <h4 class="card-title">Tabela de Sensores</h4> 
                <p class="card-category">Estado em Tempo Real de cada sensor</p>
            </div>
         <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Salary</th>
                        <th>Country</th>
                        <th>City</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Dakota Rice</td>
                            <td>$36,738</td>
                            <td>Niger</td>
                            <td>Oud-Turnhout</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Minerva Hooper</td>
                            <td>$23,789</td>
                            <td>Curaçao</td>
                            <td>Sinaai-Waas</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Sage Rodriguez</td>
                            <td>$56,142</td>
                            <td>Netherlands</td>
                            <td>Baileux</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Philip Chaney</td>
                            <td>$38,735</td>
                            <td>Korea, South</td>
                            <td>Overland Park</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Doris Greene</td>
                            <td>$63,542</td>
                            <td>Malawi</td>
                            <td>Feldkirchen in Kärnten</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Mason Porter</td>
                            <td>$78,615</td>
                            <td>Chile</td>
                            <td>Gloucester</td>
                        </tr>
                    </tbody>
                </table>
            </div>
         </div>
         <div class="card-footer">
         <hr>
                <div class="stats"><i class="fas fa-redo mr-1"></i> 2021/04/28 15:00:00</div>
         </div>
      </div>
   </div>
</div>


<?php include "footer.php"; ?>