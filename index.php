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
                padding-left:37%;
                height:200px ;
            }
           
        </style>
    </head>
    <body background="fondo1.jpg"  >
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
        <img src="logo.jpg" id="imgLogo"></img>
        <button name="tiempo" onclick="tiempoRestante()">Tiempo</button>
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
            
            var respuesta = '<?php echo $correcta?>';
             puntos=0;
             tiempo=30;
            
            function refresca(){
                location.reload();
            }
            
            function chequeaRespuesta(_respuesta){
                if(respuesta ===_respuesta){
                   $('#Next').html('<button class="btn btn-success" onclick="refresca()">Next</buton>"');//cambia el boton de color al seleccionar la preguna correcta
                   $('#btn1').html('Correcto');
                    /*$('#Next').append('<button class="btn btn-success" onclick="refresca()">Next</buton>"');*/
                    
                }
                else{
                   $('#Next').html  ('<button class="btn btn-danger" onclick="refresca()">Next</buton>"');//cambia el boton de color al seleccionar la preguna erronea
                   $('#btn2').html('Incorrecto');
                   $('#btn3').html('Incorrecto');
                   $('#btn4').html('Incorrecto');
                }
                 
            }
            
          
            function goBack() {
                window.history.back();
            }
             
            function sumarPuntos(){
               puntos++;
               document.getElementById("puntos").innerHTML = "puntuacion:<b>"+ puntos + "</b>";
               randNum = Math.round(Math.random()*500);
               randNum2 = Math.round(Math.random()*500);
              
           }
            
            function tiempoRestante(){
                tiempo--;
                document.getElementById(tiempo).innerHTML = "Tiempo:"+tiempo;
                
            }
            setInterval(restarTiempo,1000);
            
        </script>
    </body>
</html>
