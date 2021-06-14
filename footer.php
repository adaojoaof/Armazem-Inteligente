
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav>
                        <p class="copyright text-center">
                            ©2021 TI, Jhelan e João
                        </p>
                    </nav>
                </div>
            </footer>
        </div>
    </div>


    <!--   Core JS Files   -->
    <script src="assets/js/core/jquery.3.2.1.min.js" ></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="assets/js/plugins/bootstrap-switch.js"></script>
    <!--  Chartist Plugin  -->
    <script src="assets/js/plugins/chartist.min.js"></script>
    <!--  Notifications Plugin    -->
    <!-- <script src="assets/js/plugins/bootstrap-notify.js"></script> -->
    <!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
    <script src="assets/js/light-bootstrap-dashboard.js?v=2.0.0 "></script>

    <script>
        var chartTemperatura;
        //Utilização do jquery
        $( document ).ready(function() {
            //se tiver permissões, é escrito o código para o click da abertura/fecho dos portões
            <?php if($_SESSION['rules']=="admin"||$_SESSION['rules']=="driver"){ ?>
                //definição do evento onClick
                $(".porta-icon .pointer").on("click", function(){
                    //vai buscar o elemnto HTML para a DOM
                    card=$(this).parent().parent();
                    //pega no valor antigo e coloca o "oposto"
                    newState=card.data('state')==1?0:1;
                    datetime=dataHora();
                    //post para enviar o novo estado do portão para a API
                    $.post("api/api.php", {'nome':card.attr("id"), 'valor':newState, 'hora':datetime})
                    .done(function(data){
                        //atualiza o data-state atribute para o novo estado
                        card.data('state', newState);
                        if(data=="SUCCESS"){
                            //se tiver sucesso altera os icons/texto e data
                            if(newState==1){
                                card.find(".card-title").html("Aberto");
                                card.find("div.icon-big").html('<i class="text-success fas fa-lock-open"></i>');
                            }else{
                                card.find(".card-title").html("Fechado");
                                card.find("div.icon-big").html('<i class="text-danger fas fa-lock"></i>');
                            }
                            card.find(".dashboard-cards-hora").html(datetime);
                        }
                    });
                });
            <?php } ?>
            
            //códigoc para, de 2 em 2 segundos, atualizar os valores de cada sensor na dashboard
            setInterval(function(){
                //vai buscar à api um json com os valores de cada sensor
                $.get("api/api.php?allSensors", function(data){
                    //faz o decode do json
                    data=JSON.parse(data);
                    //percorre cada sensor no html para editar, 1 a 1, o seu valor
                    $.each(data,function(key,sensor){
                        //condições para cada tipo de sensor, com base na informação a ser apresentada
                        if(sensor.sensor_id=="portao_principal"||sensor.sensor_id=="porta_cargas"||sensor.sensor_id=="porta_descargas"){
                            if(sensor.value==1){
                                $("#"+sensor.sensor_id).find(".card-title").html("Aberto");
                                $("#"+sensor.sensor_id).find("div.icon-big").html('<i class="text-success fas fa-lock-open"></i>');
                            }else{
                                $("#"+sensor.sensor_id).find(".card-title").html("Fechado");
                                $("#"+sensor.sensor_id).find("div.icon-big").html('<i class="text-danger fas fa-lock"></i>');
                            }
                        }
                        else if(sensor.sensor_id=="humidade"||sensor.sensor_id=="temperatura"){
                            $("#"+sensor.sensor_id).find(".card-title .value-in").html(sensor.value);
                            oldValue=$("#"+sensor.sensor_id).data("value");
                            if(oldValue>sensor.value){
                                $("#"+sensor.sensor_id).find(".arrow-state").html('<i class="fas fa-arrow-down"></i>');
                            }else if(oldValue<sensor.value){
                                $("#"+sensor.sensor_id).find(".arrow-state").html('<i class="fas fa-arrow-up"></i>');
                            }
                            $("#"+sensor.sensor_id).data("value", sensor.value);
                        }else if(sensor.sensor_id=="detetor_vento"){
                            if(sensor.value==1){
                                $("#"+sensor.sensor_id).find(".card-title").html("Detetado");
                            }else{
                                $("#"+sensor.sensor_id).find(".card-title").html('Não detetado');
                            }
                        }else if(sensor.sensor_id=="janela_sul"||sensor.sensor_id=="janela_norte"){
                            if(sensor.value==1){
                                $("#"+sensor.sensor_id).find(".card-title").html("Aberta");
                            }else{
                                $("#"+sensor.sensor_id).find(".card-title").html('Fechada');
                            }
                        }
                        //atualiza a data
                        $("#"+sensor.sensor_id).find(".dashboard-cards-hora").html(sensor.datetime);
                    });
                });
                //Aqui é atualizado também o gráfico, através da API, quando recebe os dados, faz update ao gráfico, com os novos dados
                $.get("api/api.php?historicoTemperatura", function(data){
                    newData = {
                        labels: ["","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","",],
                        series: [JSON.parse(data)]
                    };
                    chartTemperatura.update(newData)
                })
            }, 2000);

            //inicialização do gráfico
            var data = {
                labels: ["","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","",],
                series: [<?= file_get_contents("http://localhost:8888/projetoTI/api/api.php?historicoTemperatura");?>]
            };
            // Opções do gráfico
            var options = {
                height: '800px',
                axisX: {
                    showGrid: false,
                    showLabel: false
                },
                axisY: {  
                    offset: 100,
                    labelInterpolationFnc: function(value) {
                        return value + ' Cº';
                    }
                }
            };
            //inicializar o gráfico
            chartTemperatura=new Chartist.Line('.ct-chart', data, options);

            //ação do botão para tirar nova foto na receção
            $("#newPhoto").on("click", function(){
                //simula uma alteração do estado movimento_rececao para 1, para o python tirar a foto
                $.post("api/api.php", {'nome':"movimento_rececao", 'valor':1, 'hora':dataHora()})
                    .done(function(data){
                        if(data=="SUCCESS"){
                            //quando tuver success, espera 4 segundos e faz post para voltar a colocar a 0, o estado do kovimento
                            setTimeout(() => { 
                                $.post("api/api.php", {'nome':"movimento_rececao", 'valor':0, 'hora':dataHora()})
                                .done(function(data){
                                    console.log(data)
                                    //quando concluido, atualiza a página para visualizar a nova foto
                                    location.reload();
                                });
                            }, 4000);
                        }
                    });
            });
        });

        //função standard para formatar a data e hora, em js
        function dataHora(){
            var dateISO=new Date().toISOString();
            var data0 = dateISO.split('T')[0];
            var data1 = dateISO.split('T')[1];
            var time = data1.split('.')[0];
            var datahora = data0 + " " + time;
            return datahora;
        }
    </script>

</body>
</html>