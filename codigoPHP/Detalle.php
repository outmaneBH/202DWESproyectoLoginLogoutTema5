<?php
require 'session.php';
if (isset($_REQUEST['logout'])) {
    session_unset();
    session_destroy();
    header("Location:Login.php");
    exit;
}
if (isset($_REQUEST['volver'])) {
    setcookie($_COOKIE['Cookieuser'], "", time() - 3600);
    header("Location:Programa.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>OB-Detalle</title>
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
                margin-left: 50px;
            }
            table ,tr,td{
                border: 2px solid black;
                border-collapse: collapse;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="container-fluid">

                <div class="collapse navbar-collapse" id="mynavbar">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <p style="font-size: 20px;" class="nav-link" >Hello , <?php echo $_SESSION['USER']; ?></p>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <input type="submit" class="btn btn-primary" name="volver" value="Volver" type="button"/>

                        <input type="submit" class="btn btn-info" name="logout" value="LogOut" type="button"/>
                    </form>
                </div>
            </div>
        </nav> 
        <div id="supGlob">
            <?php
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
            
            /* usando foreach() */
            echo '<h3>Mostrar el contenido de las variables superglobales:</h3>  ';

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


            phpinfo();
            ?>
        </div>

    </body>
</html>


