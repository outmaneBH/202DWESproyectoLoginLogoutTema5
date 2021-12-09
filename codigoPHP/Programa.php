<?php
/* llamar al fichero de recuperar sessiones */
require 'session.php';

/* destroy la session y devolver al usuario al login */
if (isset($_REQUEST['logout'])) {
    session_unset();
    session_destroy();
    header("Location:Login.php");
    exit;
}
/* llevarle a al detalle */
if (isset($_REQUEST['detalle'])) {
    header("Location:Detalle.php");
    exit;
}

/* alamcenamos alugunos vocabularios en arrays para usarlos en cookies */
if ($_COOKIE["IdiomaReg"] != 'es') {
    $aIngles = [1 => 'Hello', 2 => 'Welcome', 3 => 'LogOut'];
} else {
    $aEspañol = [1 => 'Hola', 2 => 'Bienvenido', 3 => 'Cerrar sesión'];
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
                background-image: url(../webroot/media/building-g458550d32_1920.jpg);
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
                width: 29%;
                position: relative;
                bottom: 0;

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
        <?php
        /* Usamos el fichero de configuracion ala base de datos */
        require_once '../config/confDBPDO.php';

        try {
            /* Establecemos la connection con pdo en global */
            $miDB = new PDO(HOST, USER, PASSWORD);

            /* configurar las excepcion */
            $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            /* Hgamos la comprobacion en la base de datos si existe este usuario con consulta preparada */
            $sql = "SELECT * FROM T01_Usuario WHERE T01_CodUsuario='" . $_SESSION['usuario202DWESAppLoginLogout'] . "'";
            $resultadoConsulta = $miDB->prepare($sql);
            $resultadoConsulta->execute();
            $registro = $resultadoConsulta->fetchObject();
            ?>
            <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
                <div class="container-fluid">

                    <div class="collapse navbar-collapse" id="mynavbar">
                        <ul class="navbar-nav me-auto">

                            <li class="nav-item">
                                <p style="font-size: 20px;" class="nav-link" ><?php echo ($aEspañol[1] ? $aEspañol[1] : $aIngles[1]); ?> , <?php echo $_SESSION['usuario202DWESAppLoginLogout']; ?> </p>
                            </li>

                        </ul>

                        <p style="color: white;position: relative;right: 32%;font-size: 30px;">Estas en Indice de Programa</p>
                        </li>
                        <form class="d-flex">
                            <input type="submit" class="btn btn-primary" name="detalle" value="Detalle" type="button"/>
                            <input type="submit" class="btn btn-info" name="logout" value="<?php echo ($aEspañol[3] ? $aEspañol[3] : $aIngles[3]) ?>" type="button"/>
                            <div class="w3-dropdown-hover w3-right">
                                <img src="../webroot/media/icons8-usuario-masculino-en-círculo-48.png" alt="Avatar" style="width:38px;height: 38px;margin-top:10px;" class="w3-circle">
                                <div class="w3-dropdown-content w3-bar-block " style="right:0;margin-top: 20%;">
                                    <a href="editarPerfil.php" class="w3-bar-item w3-button w3-black w3-hover-blue">Editar Perfil</a>
                                    <a href="delete.php" class="w3-bar-item w3-button w3-black w3-hover-red ">Delete Account</a>

                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </nav>


            <div class="container-fluid mt-3">
                <div class="alert">
                    <!--<span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> -->
                    <p><?php echo ($registro->T01_NumConexiones > 1) ? ($aEspañol[2] ? $aEspañol[2] : $aIngles[2]) . ' ' . $registro->T01_DescUsuario . ' es la ' . $registro->T01_NumConexiones . ' vez que se connecta y su ultima connexion anterior fue "' . date("d/m/Y H:i:s", $_SESSION['T01_FechaHoraUltimaConexionAnterior']) . '"' : ($aEspañol[2] ? $aEspañol[2] : $aIngles[2]) . ' ' . $registro->T01_DescUsuario . ' esta es la primera vez que se connecta.'; ?></p>
                </div>
            </div>
            <div style="height:100px;">

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
            <?php
        } catch (PDOException $exception) {
            /* Si hay algun error el try muestra el error del codigo */
            echo '<span> Codigo del Error :' . $exception->getCode() . '</span> <br>';

            /* Muestramos su mensage de error */
            echo '<span> Error :' . $exception->getMessage() . '</span> <br>';
        } finally {
            /* Ceramos la connection */
            unset($miDB);
        }
        ?>
    </body>
</html>


