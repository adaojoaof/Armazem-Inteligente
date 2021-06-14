
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
        $( document ).ready(function() {
            <?php if($_SESSION['rules']=="admin"){ ?>
                $(".porta-icon .pointer").on("click", function(){
                    card=$(this).parent().parent();
                    newState=card.data('state')==1?0:1;
                    datetime=dataHora();
                    $.post("api/api.php", {'nome':card.attr("id"), 'valor':newState, 'hora':datetime})
                    .done(function(data){
                        card.data('state', newState);
                        if(data=="SUCCESS"){
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

            setInterval(function(){ 
                $.get("api/api.php?allSensors", function(data){
                    data=JSON.parse(data);
                    $.each(data,function(key,sensor){
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
                        $("#"+sensor.sensor_id).find(".dashboard-cards-hora").html(sensor.datetime);
                    });
                });
                $.get("api/api.php?historicoTemperatura", function(data){
                    newData = {
                        labels: ["","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","",],
                        series: [JSON.parse(data)]
                    };
                    chartTemperatura.update(newData)
                })
            }, 2000);

            // Our labels and three data series
            var data = {
            labels: ["","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","",],
            series: [<?= file_get_contents("http://localhost:8888/projetoTI/api/api.php?historicoTemperatura");?>]
            };

            // We are setting a few options for our chart and override the defaults
            var options = {
            height: '800px',
            // X-Axis specific configuration
            axisX: {
                // We can disable the grid for this axis
                showGrid: false,
                // and also don't show the label
                showLabel: true
            },
            // Y-Axis specific configuration
            axisY: {  
                // Lets offset the chart a bit from the labels
                offset: 100,
                // The label interpolation function enables you to modify the values
                // used for the labels on each axis. Here we are converting the
                // values into million pound.
                labelInterpolationFnc: function(value) {
                return value + ' Cº';
                }
            }
            };

            // All you need to do is pass your configuration as third parameter to the chart function
            chartTemperatura=new Chartist.Line('.ct-chart', data, options);


            $("#newPhoto").on("click", function(){
                $.post("api/api.php", {'nome':"movimento_rececao", 'valor':1, 'hora':dataHora()})
                    .done(function(data){
                        if(data=="SUCCESS"){
                            setTimeout(() => { 
                                $.post("api/api.php", {'nome':"movimento_rececao", 'valor':0, 'hora':dataHora()})
                                .done(function(data){
                                    console.log(data)
                                    location.reload();
                                });
                            }, 4000);
                        }
                    });
            });
        });

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