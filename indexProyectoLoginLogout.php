<?php
/* Comprobar si existe cookies en el navigador sino meter por defecto de ingles  */
if (!isset($_COOKIE['IdiomaReg'])) {
    setcookie("IdiomaReg", 'en');
}

/* Comprobar si ha pulsado button de idomas español o ingles para iniciar cookie */
if (isset($_REQUEST['select'])) {
    setcookie("IdiomaReg", $_REQUEST['select']);
}

/* Comprobar si ha pulsado button login desde Index */
if (isset($_REQUEST["btnlogin"])) {
    echo '<script>location="codigoPHP/Login.php"</script>;';
    // header("Location:codigoPHP/Login.php");
    exit;
}

/* Si no tiene cuenta hay que regestrarse */
if (isset($_REQUEST["btnregister"])) {
    echo '<script>location="codigoPHP/registro.php"</script>;';
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Index LogIn LogOut</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <style>
            footer {
                position: fixed;
                left: 0;
                bottom: 0;
                width: 100%;
                background-color: red;
                color: white;
                text-align: center;
            }
            body {
                background-image: url(webroot/media/sky.jpg);
                background-repeat: no-repeat;
                background-size: cover;
            }
            h3{
                color: white;

                width: 450px;
                padding: 5px;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="mynavbar">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <h3>Proyecto Tema 5 LogIn LogOut</h3>
                        </li>
                    </ul>

                    <form class="d-flex">

                        <input name="btnlogin" type="submit" style="margin-right: 5px;" value="Login" class="btn btn-primary" />
                        <input name="btnregister" type="submit" style="margin-right: 5px;" value="Register" class="btn btn-success" />
                        <select name="select">
                            <option value="0" selected>Idioma </option>
                            <option value="es">Español</option>
                            <option value="en">Ingles</option>
                        </select>
                           
                    </form>
                </div>
            </div>
        </nav>
        <div class="container-fluid mt-3">
          <!--  <a href="scriptDB/CreaDB202DWESProyectoTema5-1&1.php" name="Create" style="margin: 5px;" class="btn btn-primary" >Create Tables 1 & 1</a><br>
            <a href="scriptDB/CargaInicialDB202DWESProyectoTema5-1&1.php" name="Insert" style="margin: 5px;" class="btn btn-success" >Insert Data en Tables 1 & 1</a><br>
            <a href="scriptDB/BorraDB202DWESProyectoTema5-1&1.php" name="Delete" style="margin: 5px;" class="btn btn-danger" >Delete Tables 1 & 1</a><br>-->
        </div>
        <footer style="position: fixed;bottom: 0;width: 100%" class="bg-dark text-center text-white">
            <!-- Grid container -->
            <div class="container p-3 pb-0">
                <!-- Section: Social media -->
                <section class="mb-3">
                    <!-- Github -->
                    <a class="btn btn-outline-light btn-floating m-1" href="https://github.com/outmaneBH/202DWESproyectoLoginLogout" target="_blank" role="button">
                        <img id="git" style="width: 30px;height:30px; " src="webroot/media/git.png" alt="github"/>  
                    </a>
                </section>
            </div>
            <!-- Grid container -->
            <!-- Copyright -->
            <a class="nav-link" style="float: left;" href="../202proyectoDWES/indexProyectoDWES.php"><i class="material-icons" style="font-size:48px;color:#FF5DA2">keyboard_backspace</i></a>
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                Copyrights © 2021 
                <a class="text-white" href="../index.html">OUTMANE BOUHOU</a>
                . All rights reserved.
                <p>Ultima actualizacion : 09/12/2021 version 2 ( v.2 LoginLogout )</p>
            </div>
            <!-- Copyright -->
        </footer>
    </body>
</html>


