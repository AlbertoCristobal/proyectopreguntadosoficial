<html>
    <head>
        <meta charset="UTF-8">
        <title>Entrada</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <style>
           
           
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
       <div class="container" id="preguntas">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    
                    
                    <br><br>
                    <form action="index.php "method ="POST">
                        <button  id="btn1" class="btn btn-block btn-primary " onclick="chequeaRespuesta('1')" value="ciencia">
                           Ciencia:
                        </button> 
                    </form>
                    <br><br>
                    <form action="index.php "method ="POST">
                        <button id="btn2" class="btn btn-block btn-primary " onclick="chequeaRespuesta('2');">
                            Economia:
                        </button> 
                    </form>
                    <br><br>
                    <form action="index.php "method ="POST">
                        <button id="btn3" class="btn btn-block btn-primary " onclick="chequeaRespuesta('3');">
                            Ingles:
                        </button>
                    </form>
                    <br><br>   
                    <form action="index.php "method ="POST">
                    <button id="btn4" class="btn btn-block btn-primary  " onclick="chequeaRespuesta('4');">
                        Deportes:
                    </button> 
                    </form>
                    
                    <a href="Login.html">
                        <button type="button" class="btn btn-danger " >Cerrar sesion</button>
                     </a>
                    
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
            
        </script>
    </body>
</html>


