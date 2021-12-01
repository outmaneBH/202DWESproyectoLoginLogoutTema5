<?php
require 'session.php';

if (isset($_REQUEST['logout'])) {
    session_unset();
    session_destroy();
    header("Location:Login.php");
    exit;
}
if (isset($_REQUEST['detalle'])) {
    header("Location:Detalle.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>OB-Programa</title>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
        <style>
            body{
                background-image: url(../webroot/media/water-g93351de39_1920.jpg);
                background-repeat: no-repeat;
                background-size: cover;
            }
            input{
                margin: 10px;
            }
            .alert {
                padding: 20px;
                background-color: #864879;
                color: white;
                width: 25%;
                float: right;
            }

            .closebtn {
                margin-left: 15px;
                color: white;
                font-weight: bold;
                float: right;
                font-size: 22px;
                line-height: 20px;
                cursor: pointer;
                transition: 0.3s;
            }

            .closebtn:hover {
                color: black;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="container-fluid">

                <div class="collapse navbar-collapse" id="mynavbar">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <p style="font-size: 20px;" class="nav-link" >Hello , <?php echo $_SESSION['usuario202DWESAppLoginLogout']; ?> </p>
                        </li>

                    </ul>

                    <p style="color: white;position: relative;right: 32%;font-size: 30px;">Estas en Indice de Programa</p>
                    </li>
                    <form class="d-flex">
                        <input type="submit" class="btn btn-primary" name="detalle" value="Detalle" type="button"/>
                        <input type="submit" class="btn btn-info" name="logout" value="LogOut" type="button"/>
                    </form>
                </div>
            </div>
        </nav>
        <div class="container-fluid mt-3">
             <div class="alert">
               <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                Bienvenido <strong><?php echo $_SESSION['usuario202DWESAppLoginLogout']; ?> !</strong> esta es la  
               
                <?php echo ($_SESSION['T01_NumConexiones'] != null ? $_SESSION['T01_NumConexiones']." y su ultima Conexion Anterior fue <strong> ".$_SESSION['T01_FechaHoraUltimaConexionAnterior']."</strong>" : "Primera vez que se Conecta"); ?>
               
               <!-- y su ultima Conexion Anterior fue <strong><?php echo $_SESSION['T01_FechaHoraUltimaConexionAnterior']; ?></strong>-->
            </div>
        </div>
        <div style="height:200px;">
          
        </div>

        <footer style="position: fixed;bottom: 0;width: 100%" class="bg-dark text-center text-white">
            <!-- Grid container -->
            <div class="container p-3 pb-0">
                <!-- Section: Social media -->
                <section class="mb-3">
                    <!-- Github -->
                    <a class="btn btn-outline-light btn-floating m-1" href="https://github.com/outmaneBH/202DWESproyectoLoginLogout" target="_blank" role="button">
                        <img id="git" style="width: 30px;height:30px; " src="../webroot/media/git.png" alt="github"/>  
                    </a>
                </section>

            </div>
            <!-- Grid container -->

            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                Copyrights © 2021 
                <a class="text-white" href="../index.html">OUTMANE BOUHOU</a>
                . All rights reserved.
            </div>
            <!-- Copyright -->
        </footer>

    </body>
</html>


