
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
    <!-- <script src="assets/js/plugins/chartist.min.js"></script> -->
    <!--  Notifications Plugin    -->
    <!-- <script src="assets/js/plugins/bootstrap-notify.js"></script> -->
    <!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
    <script src="assets/js/light-bootstrap-dashboard.js?v=2.0.0 "></script>

    <script>
        $( document ).ready(function() {
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
                            oldValue=$("#"+sensor.sensor_id).attr("data-value");
                            if(oldValue>sensor.value){
                                $("#"+sensor.sensor_id).find(".arrow-state").html('<i class="fas fa-arrow-down"></i>');
                            }else if(oldValue<sensor.value){
                                $("#"+sensor.sensor_id).find(".arrow-state").html('<i class="fas fa-arrow-up"></i>');
                            }
                            $("#"+sensor.sensor_id).attr("data-value", sensor.value);
                        }else if(sensor.sensor_id=="detetor_vento"){
                            if(sensor.value==1){
                                $("#"+sensor.sensor_id).find(".card-title").html("Detetado");
                            }else{
                                $("#"+sensor.sensor_id).find(".card-title").html('Não detetado');
                            }
                        }
                        console.log("#"+sensor.sensor_id);
                        $("#"+sensor.sensor_id).find(".dashboard-cards-hora").html(sensor.datetime);
                    });
                });
            }, 3000);
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