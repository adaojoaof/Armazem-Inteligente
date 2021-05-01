<?php
    $pageTitle="Dashboard";
    $activePage="dashboard";
	
	//array com os sensores no armazém -> sensores.txt
	$sensores=file_get_contents("api/files/sensores.txt");
	$sensores=explode("\n",$sensores);
	
	
	$valor_temperatura = file_get_contents("api/files/armazem/temperatura/valor.txt");
	$valor_humedad = file_get_contents("api/files/armazem/humidade/valor.txt");
	$valor_luminosidade= file_get_contents("api/files/armazem/luminosidade/valor.txt");
	
	
	$valor_porta_principal = file_get_contents("api/files/armazem/porta_principal/valor.txt");
	$valor_porta_carga = file_get_contents("api/files/armazem/porta_carga/valor.txt");
	$valor_porta_descarga = file_get_contents("api/files/armazem/porta_descargas/valor.txt");
	
	$valor_camara = file_get_contents("api/files/armazem/camara/valor.txt");
	$valor_sensores = sizeof($sensores);
	
	
	$valor_internet = file_get_contents("api/files/armazem/internet/valor.txt");
	$valor_error = file_get_contents("api/files/armazem/error/valor.txt");
	
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
                    <h4 class="card-title">
					<?php if($valor_porta_principal == 1){ ?> 	
						<i class="text-success fas fa-lock-open"></i> Aberto</h4>
					<?php }else{ ?>
						<i class="text-danger fas fa-lock"></i> fechado</h4>
					<?php }?>
				</div>
                <div class="numbers">
                    <p class="card-category">Cargas</p>
                    <h4 class="card-title"> 
						<?php if($valor_porta_carga == 1){ ?> 	
						<i class="text-success fas fa-lock-open"></i> Aberto</h4>
					<?php }else{ ?>
						<i class="text-danger fas fa-lock"></i> fechado</h4>
					<?php }?>
					
                </div>
                <div class="numbers">
                    <p class="card-category">Descargas</p>
                    <h4 class="card-title"> 	
					<?php if($valor_porta_descarga == 1){ ?> 	
						<i class="text-success fas fa-lock-open"></i> Aberto</h4>
					<?php }else{ ?>
						<i class="text-danger fas fa-lock"></i> fechado</h4>
					<?php }?>
					
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
                     <h4 class="card-title"><?php echo $valor_temperatura?>Cº</h4>
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
                     <h4 class="card-title"><?php echo $valor_humedad?>%</h4>
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
                     <h4 class="card-title"><?php echo $valor_luminosidade?></h4>
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
                     <h4 class="card-title">
					 <?php if($valor_camara == 1){?>
					 ON</h4>
					 <?php } else{ ?>
					 OFF</h4>
					 <?php }?>
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
                     <h4 class="card-title"><?php echo $valor_sensores?></h4>
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
                  <div class="icon-big text-center icon-warning">
				  
				  
				  <?php if($valor_internet == 1){?>
				  <i class="fas fa-check-circle text-success"></i></div>
				  
				  <?php } else { ?>
				  <i class="fas fa-exclamation-triangle text-danger"></i></div>
				  <?php } ?>
				  
				  
				  
				  
               </div>
               <div class="col-7">
                  <div class="numbers">
                     <p class="card-category">Internet</p>
                     <h4 class="card-title">				 
					   <?php if($valor_internet == 1){?>
				
				  OK</h4>
				  <?php } else { ?>
				  
				  BAD</h4>
				  <?php } ?>
					 
					 </h4>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-5">
                  <div class="icon-big text-center icon-warning">
				  
				  
				  <?php if($valor_error == 0){?>
				  <i class="fas fa-check-circle text-success"></i></div>
				  
				  <?php } else { ?>
				  <i class="fas fa-exclamation-triangle text-danger"></i></div>
				  <?php } ?>
				  
				  
               </div>
               <div class="col-7">
                  <div class="numbers">
                     <p class="card-category">Erros</p>
                     <h4 class="card-title"><?php echo $valor_error?></h4>
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