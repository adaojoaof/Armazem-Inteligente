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
                <h4 class="card-title">Prateleiras</h4> 
                <p class="card-category">Estado de Cada Prateleira do Armazém</p>
            </div>
         <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <th>Prateleira</th>
                        <th>Localização</th>
                        <th>Produto</th>
                        <th>Stock</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Setor A</td>
                            <td>Salsichas</td>
                            <td><span class="badge badge-pill badge-success">OK</span></td>
                        </tr>
                        <tr>
                           <td>2</td>
                            <td>Setor B</td>
                            <td>Papel Higiénico</td>
                            <td><span class="badge badge-pill badge-success">OK</span></td>
                        </tr>
                        <tr>
                           <td>3</td>
                            <td>Setor A</td>
                            <td>Palitos</td>
                            <td><span class="badge badge-pill badge-danger">Sem Stock</span></td>
                        </tr>
                        <tr>
                           <td>4</td>
                            <td>Setor A</td>
                            <td>Massas</td>
                            <td><span class="badge badge-pill badge-success">OK</span></td>
                        </tr>
                        <tr>
                           <td>5</td>
                            <td>Setor C</td>
                            <td>Arroz</td>
                            <td><span class="badge badge-pill badge-warning">Sem dados</span></td>
                        </tr>
                        <tr>
                           <td>6</td>
                            <td>Setor A</td>
                            <td>Batatas Fritas</td>
                            <td><span class="badge badge-pill badge-success">OK</span></td>
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