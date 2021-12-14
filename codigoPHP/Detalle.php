<?php
/* Recuperar sessiones */
require 'session.php';

/* Si ha pulsado button volver */
if (isset($_REQUEST['volver'])) {
    header("Location:Programa.php");
    exit;
}

/* usar el fichero de lenguajes */
require '../core/lenguajes.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>OB - Detalle</title>
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
            #supGlob{
                margin-left: 15%;
                width: 100%;
            }
            table ,tr,td{
                border: 2px solid black;
                border-collapse: collapse;

            }

        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="container-fluid ">
                <div class="collapse navbar-collapse " id="mynavbar">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <p style="font-size: 20px;" class="nav-link" > <?php echo $aLeng[1] . ' , ' . $_SESSION['usuario202DWESAppLoginLogout']; ?></p>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <input type="submit" class="btn btn-primary" name="volver" value="Volver" type="button"/>
                    </form>
                </div>
            </div>
        </nav> 
        <div id="supGlob">
            <?php
            echo '<h3>Mostrar el contenido de las variables superglobales:</h3>  ';
            // El contenido de $_SESSION
            echo '<h3>Mostrar el contenido de $_SESSION :</h3>  ';
            echo '<table><tr><th>Clave</th><th>Valor</th></th>';
            foreach ($_SESSION as $Clave => $Valor) {
                echo '<tr>';
                echo "<td>$Clave</td>";
                echo "<td>$Valor</td>";
                echo '</tr>';
            }
            echo '</table>';

            // El contenido de $_COOKIE
            echo '<h3>Mostrar el contenido de $_COOKIE :</h3>  ';
            echo '<table><tr><th>Clave</th><th>Valor</th></th>';
            foreach ($_COOKIE as $Clave => $Valor) {
                echo '<tr>';
                echo "<td>$Clave</td>";
                echo "<td>$Valor</td>";
                echo '</tr>';
            }
            echo '</table>';



            echo '<h3>Mostrar el contenido de $_SERVER :</h3>  ';
            echo '<table><tr><th>Clave</th><th>Valor</th></th>';
            /* usando foreach() */
            foreach ($_SERVER as $Clave => $Valor) {
                echo '<tr>';
                echo "<td>$Clave</td>";
                echo "<td>$Valor</td>";
                echo '</tr>';
            }
            echo '</table>';
            ?>

        </div>
        <?php phpinfo(); ?>
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
                <a class="w3-black w3-text-white" href="../index.html">OUTMANE BOUHOU</a>
                . All rights reserved.
            </div>
            <!-- Copyright -->
        </footer>
    </body>
</html>


