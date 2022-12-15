<?php
if (isset($_POST["submit"]) && !empty($_POST["submit"])) {
    $usuario = isset($_POST['username']) ? $_POST['username'] : 'usuario';
    $palabra = $_POST['plgam'];
    $jugador = array('usuario' => $usuario, 'palabra' => $palabra);
    $json_string = json_encode($jugador, JSON_UNESCAPED_UNICODE);
    $file = 'games.json';
    file_put_contents($file, $json_string);
}
// ---------------- Letras ------------------\\
$archivoJson = 'games2.json';
if (file_exists($archivoJson)) {
    $datos2 = file_get_contents("games2.json");
    $letras = json_decode($datos2, true,);
    $let = $_POST['key'];
    if ($let == "Ñ") {
        $let = "7";
    }
    if (!in_array($let, $letras)) {
        array_push($letras, $let);
    }
    $json_data = json_encode($letras);
    $file2 = 'games2.json';
    file_put_contents($file2, $json_data);
} else {
    $let = null;
    $letras = array($let);
    $json_data = json_encode($letras);
    $file2 = 'games2.json';
    file_put_contents($file2, $json_data);
}


//------------ Ver Plabra-----------
$datos = file_get_contents("games.json");
$json_jugador = json_decode($datos, true);
$palabraJuego = $json_jugador['palabra'];
?>



<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Ahorcado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<style>
    #letraInp {
        max-width: 30px;
        font-family: inherit;
        border: 0;
        border-bottom: 2px solid grey;
        outline: 0;
        font-size: 1.3rem;
        color: white;
        padding: 7px 0;
        background: transparent;
        border-radius: 0px;
    }
</style>

<body background="https://img.freepik.com/foto-gratis/muro-hormigon-gris_53876-88973.jpg" style="background-repeat: no-repeat; background-attachment: fixed; background-size: cover; margin: 50px;">
    <header>

        <div class="container text-center mt-2">
            <a title="Nuevo juego" href="./index.php"><img src="https://cdn-icons-png.flaticon.com/512/16/16498.png" alt="Los Tejos" style="width: 60px; height: 60px;margin-right: 150px ;"></a>
            <img src="https://raw.githubusercontent.com/JimyCalvo/RecursoosPHP/main/ezgif.com-gif-maker.gif" alt="El Ahorcado" srcset="" width="60%">
        </div>
        <hr>
    </header>
    <main class="container">
        <!-- ========== Start Vista Ahorcado ========== -->
        <?php
        $numLetras = mb_strlen($palabraJuego);
        $a = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
        $b = array('A', 'E', 'I', 'O', 'U', '7');
        $gamePalabra = strtoupper(str_replace($a, $b, $palabraJuego));
        $palabraG = str_split($gamePalabra);
        $intentos = count(array_diff($letras, $palabraG));

        $aux = array();
        $texto = ucwords($palabraJuego);

        ?>
        <section class=" container">
            <div class='container text-center p-2 ms-5 me-5 bg-dark text-light'>
                <?php
                $verit = 12 - $intentos;
                echo "<h5>Número de Intentos: $verit</h5>";
                ?>
            </div>
            <div class="container text-center">
                <div class="img">
                    <?php
                    $num = $intentos;
                    $result = array_intersect($palabraG, $letras);
                    if (count($result) == $numLetras) {
                        echo "<img src='./img/ahorcado/Diapositiva13.JPG' height='35%'>";
                    } else {
                        $formato = "./img/ahorcado/Diapositiva";
                        $exten = ".JPG";
                        $url = $formato . $num . $exten;
                        echo "<img src='$url ' height='35%'>";
                    }

                    ?>

                </div>
        </section>

        </div>

        <!-- ========== End Vista Ahorcado ========== -->




        <!-- ========== Start Vista Letra ========== -->
        <section class="container me-5 ms-5 mt-0 mb-2">
            <div class="container p-1 bg-dark">
                <div class="input-group justify-content-center m-3">
                    <?php
                    if ($intentos != 12) {
                        if (count($letras) == 1) {
                            for ($i = 0; $i < $numLetras; $i++) {
                                echo "<input class='form-control m-1 text-center' type='text' maxlength='1' name='valor$i' id='letraInp' disabled>";
                            }
                        } else {
                            /////----------------------------------------------------
                            if (count($aux) == $numLetras) {
                                echo "<br><div class='text-center text-light p-5'><h1>GANASTES , la palabra es: $texto</h1></div><br>";
                                $intentos = 13;
                            } else {
                                foreach ($palabraG as $j => $strG) {


                                    if (in_array($strG, $letras)) {
                                        if ($strG == "7") {
                                            $strG = "Ñ";
                                        }
                                        echo "<input class='form-control m-1 text-center' type='text' maxlength='1' name='valor$j' value='$strG' id='letraInp' disabled>";
                                        array_push($aux, $strG);
                                    } else {
                                        echo "<input class='form-control m-1 text-center' type='text' maxlength='1' name='valor$j' id='letraInp' disabled>";
                                    }
                                }
                                if (count($aux) == $numLetras) {
                                    echo "<br><div class='text-center text-light p-5'><h1>GANASTES , la palabra es: $texto</h1></div><br>";
                                }
                            }
                        }
                    } else {
                        echo "<div class='text-center text-light p-5'><h1>Perdio , la palabra es: $texto</h1></div><br>";
                    }
                    ?>
                </div>
            </div>
        </section>
        <!-- ========== End Vista Letra ========== -->
        <!-- ========== Start Teclado ========== -->
        <section class="container mt-1">
            <div class="row">
                <form method="POST" action="game.php">
                    <div class="row justify-content-center">
                        <?php
                        $alfabeto = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'Ñ', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
                        // // ---------------- Letras ------------------\\
                        if ($intentos == 12) {
                            echo "<div class='container text-center'><a class='btn btn-dark' href='index.php' role='button'><h2>Jugar de Nuevo</h2></a></div>";
                        } else {
                            if ((count($aux) == $numLetras)) {
                                echo "<div class='container text-center'><a class='btn btn-dark' href='index.php' role='button'><h2>Jugar de Nuevo</h2></a></div>";
                            } else {
                                if (count($letras) == 1) {
                                    foreach ($alfabeto as $key => $values) {
                                        echo "<div class='col-2 col-sm-1 m-1'><input type='submit' style='width: 40px !important;' class='btn btn-outline-dark' value='$values' name='key'></div>";
                                    }
                                } else {
                                    for ($i = 0; $i < count($alfabeto); $i++) {
                                        if (in_array($alfabeto[$i], $letras)) {
                                            echo "<div class='col-2 col-sm-1 m-1'><input type='submit' style='width: 40px !important;' class='btn btn-outline-dark' value='$alfabeto[$i]' name='key' disabled></div>";
                                        } else {
                                            echo "<div class='col-2 col-sm-1 m-1'><input type='submit' style='width: 40px !important;' class='btn btn-outline-dark' value='$alfabeto[$i]' name='key'></div>";
                                        }
                                    }
                                }
                            }
                        }



                        ?>
                    </div>
                </form>
            </div>
        </section>

        <!-- ========== End Teclado ========== -->


    </main>
    <footer class="container text-center bg-dark text-light p-3">
        <p> Elaborado por <a href="https://github.com/JimyCalvo/AWEB_Labortarorio5">@JimyCalvo</a> y <a href="https://github.com/Martyn147">@Martyn147</a></p>
    </footer>
</body>

</html>