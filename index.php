<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Proyecto Preguntados</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <style>
            
             #pasar{
                padding-top:30px ;
            }
           
            #imgLogo{
                padding-top: 50px;
                padding-left:450px;
                height:200px ;
            }
           
        </style>
    </head>
    <body background="imagenes/fondo1.jpg"  >
        <?php
            include('./funciones.php');
            $mysqli = conectaBBDD();
        
            $consulta = $mysqli -> query("SELECT * FROM preguntas ;");
            $num_filas = $consulta -> num_rows;
            $listaPreguntas = array();
            
            for ($i = 0; $i<$num_filas; $i++){
                $resultado = $consulta ->fetch_array();
                $listaPreguntas[$i][0]= $resultado['numero'];
                $listaPreguntas[$i][1]= $resultado['tema'];
                $listaPreguntas[$i][2]= $resultado['enunciado'];
                $listaPreguntas[$i][3]= $resultado['r1'];
                $listaPreguntas[$i][4]= $resultado['r2'];
                $listaPreguntas[$i][5]= $resultado['r3'];
                $listaPreguntas[$i][6]= $resultado['r4'];
                $listaPreguntas[$i][7]= $resultado['correcta'];
            }
           
            $preguntaElegida = rand(0,$num_filas-1);
            $r1 = rand(3,6);
            $r2 = rand(3,6); while ($r2 == $r1){$r2 = rand(3,6);}
            $r3 = rand(3,6); while ($r3 == $r1 || $r3 == $r2){$r3 = rand(3,6);}
            $r4 = rand(3,6); while ($r4 == $r1 || $r4 == $r2 || $r4 == $r3){$r4 = rand(3,6);}
        
            $correcta = $listaPreguntas[$preguntaElegida ][7];
//            $numeros = range(3, 6);
//            shuffle($numeros);
//            foreach ($numeros as $numero) {
//                echo "$numero ";
//            }
            ?>
        <!----------------------------------------------------------------------------------------------------------------->
        <?php
            if(isset($_COOKIE['contado'])){
                setcookie('contado',$_COOKIE['contador']+1, time()+365*24*60*60);
                echo "Numero de visitas:".$_COOKIE['contador'];
            }else{
                setcookie('contador',1, time()+365*24*60*60);
                echo 'Bienvenido por primera vez a nuestra pagina';
            }
            
            
?>
        <img src="imagenes/logo.jpg" id="imgLogo"></img>
        
         <div id="vidas">
            <img id="vida1" src="images/vida.png" width="30">
            <img id="vida2" src="images/vida.png" width='30'>
            <img id="vida3" src="images/vida.png" width='30'>
        </div>
        
        </br>
        <div class="container" id="preguntas">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    
                    <button   class="btn btn-block btn-warning disabled">
                        <?php echo $listaPreguntas[$preguntaElegida][2];?>
                    </button>
                    <br><br>
                    <button id="btn1" class="btn btn-block btn-primary " onclick="chequeaRespuesta('1');">
                        <?php echo $listaPreguntas[$preguntaElegida][$r1];?>
                    </button> 
                    <br><br>
                    <button id="btn2" class="btn btn-block btn-primary " onclick="chequeaRespuesta('2');">
                        <?php echo $listaPreguntas[$preguntaElegida][$r2];?>
                    </button> 
                    <br><br>
                    <button id="btn3" class="btn btn-block btn-primary " onclick="chequeaRespuesta('3');">
                        <?php echo $listaPreguntas[$preguntaElegida][$r3];?>
                    </button> 
                    <br><br>                                                            
                    <button id="btn4" class="btn btn-block btn-primary  " onclick="chequeaRespuesta('4');">
                        <?php echo $listaPreguntas[$preguntaElegida][$r4];?>
                    </button> 
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
        
        
      
            <div align="center" id="pasar">
                <div id="Next"></div>
                <a href="entrada.php">
                    <button type="button" class="btn btn-primary " onclick="goBack()">Back</button>
                </a>
            </div>       
        </a>       
        <script src="js/jquery-1.12.0.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script>
            /*
             var puntuacion = 0;
            
            function chequea(opcion){
                var correcta = '<?php echo $resultado;?>';
                if(opcion == correcta){
                    puntuacion = puntuacion + 100;
                    document.getElementById("puntos").innerHTML = "<b>PUNTUACION: "+puntuacion+"</b>";
                    $('#'+opcion).removeClass('btn btn-info').addClass('btn btn-success');
                    document.title = "RESPUESTA CORRECTA!";
                    document.getElementById("alert").innerHTML = "¡RESPUESTA CORRECTA!";
                    $('#alert').removeClass('alert alert-warning').addClass('alert alert-success');
                    setTimeout(
                        function(){
                            location.reload();
                        },1000
                    );                    
                } else {
                    $('#'+opcion).removeClass('btn btn-info').addClass('btn btn-danger');  
                    document.title = "RESPUESTA ERRÓNEA!";
                    document.getElementById("alert").innerHTML = "¡RESPUESTA ERRÓNEA!";
                    $('#alert').removeClass('alert alert-warning').addClass('alert alert-danger');
                    restaVidas();
                }
            }           
            function restaVidas(){
                var vidas = 3;
                var imagen1 = $('#vida1').css('display');
                var imagen2 = $('#vida2').css('display');
                if(imagen1 == 'none' & imagen2 == 'none'){
                    $('#vida3').css({'display':'none'});
                    vidas = vidas-1;
                }
                else if(imagen1 == 'none'){
                    $('#vida2').css({'display':'none'});
                    vidas = vidas-1;
                }
                else if(imagen1 !== 'none'){
                    $('#vida1').css({'display':'none'});
                    vidas = vidas-1;
                }
                if(vidas == 0){
                }
            } 
            */
               
                window.getCookie = function( name) {
                var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
                if (match) return match[2];
            };
            
            
            var respuesta = '<?php echo $correcta?>';
             puntos=0;
             
            
            function refresca(){
                location.reload();
            }
            
            function chequeaRespuesta(_respuesta){
                if(respuesta ===_respuesta){
                   $('#Next').html('<button class="btn btn-success" onclick="refresca()">Next</buton>"');//cambia el boton de color al seleccionar la preguna correcta
                   $('#btn1').addClass('Correcto');
                   puntuacion=puntuacion + 10 ;
                    /*$('#Next').append('<button class="btn btn-success" onclick="refresca()">Next</buton>"');*/
                    
                }
                else{
                   $('#Next').html  ('<button class="btn btn-danger" onclick="refresca()">Next</buton>"');//cambia el boton de color al seleccionar la preguna erronea
                   $('#btn2').html('Incorrecto');
                   $('#btn3').html('Incorrecto');
                   $('#btn4').html('Incorrecto');
                   
                   setCookie();
                   document.getElementById('boton1').textContent = puntuacion;
                }
                 
            }
            
          
            function goBack() {
                window.history.back();
            }
             
            
           
              function setCookie(){
                document.cookie = 'puntuacionC=' + puntuacion + '; expires=Fri, 19 Jun 2020 20:47:11 UTC; path=/';
            }
               
          
            
        </script>
   
        
    </body>
</html>
