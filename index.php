<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Ahorcado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<style>
    
  
    #gameback {
        background-image: url("https://media.idownloadblog.com/wp-content/uploads/2013/06/Limbo-PC-Screenshot-002.jpg");
       
        background-repeat: no-repeat;
        width: 90vw;
        padding: 5px;
        height: 258px;
        overflow: hidden;
    }

    #jugar {
        width: 160px;
        height: 60px;
        font-size: 30px;
        color: white;

    }


  .btn-outline-secondary{
        width: 160px;
        height: 60px;
        font-size: 30px;
        
  }
</style>

<body background="https://img3.goodfon.com/wallpaper/nbig/8/49/noch-derevo-devochka-mishka.jpg" style="background-repeat: no-repeat; background-attachment: fixed; background-size: cover; margin: 100px;">
  

    <header>
        <div class="container text-center mt-2">
            <img src="https://raw.githubusercontent.com/JimyCalvo/RecursoosPHP/main/ezgif.com-gif-maker.gif" alt="El Ahorcado" srcset="" width="80%">
        </div>
    </header>
    <main class="container-fluid text-center p-5">
        <div class="container" id="gameback">
            <form class="container m-5 p-5" method="POST" action="game.php">
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-7 ">
                            <input type="text" class="form-control" name="username" aria-describedby="helpId" placeholder="Jugador">
                            <small id="helpId" class="form-text text-light">Nombre de Jugador</small>
                        </div>
                        <div class="col-md-5">
                            <?php
                            include 'listaPalabras.php';
                            echo "<input type='hidden'name='plgam' value='$palabra'>";
                            echo "<input type='submit' name='submit' class='btn btn-outline-secondary' value='JUGAR'>";
                            ?>
                        </div>
                    </div>
                    <?php
                    $archivoJson = 'games2.json';
                    if (file_exists($archivoJson)) {
                        unlink($archivoJson);
                    }
                    ?>
            </form>
        </div>
    </main>
    <hr>
    <footer class="container text-center bg-dark text-light p-3">
        <p> Elaborado por <a href="https://github.com/JimyCalvo/AWEB_Labortarorio5">@JimyCalvo</a> y <a href="https://github.com/Martyn147">@Martyn147</a></p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>