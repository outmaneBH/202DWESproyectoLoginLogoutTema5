<?php
/*
 * author: OUTMANE BOUHOU
 * Fecha: 28/11/2021
 * description: 
 */
/* Iniciamos la session para alamacenar el codigo de usuario */
session_start();

/* Usamos el fichero de configuracion ala base de datos */
require_once '../config/confDBPDO.php';

/* Declaramos un variable error para meter el error de usuario */
$error = "";


/* Si el usuario a pulsado button login */
if (isset($_REQUEST['btnlogin'])) {
    /* Almacenar los datos de los inputs en variables */
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    
    if ($username != null || $password != null) {
        try {
            /* Establecemos la connection con pdo en global */
            $miDB = new PDO(HOST, USER, PASSWORD);

            /* configurar las excepcion */
            $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            /* Hgamos la comprobacion en la base de datos si existe este usuario con consulta preparada */
            $sql = "SELECT * FROM T01_Usuario WHERE T01_CodUsuario='$username' and T01_Password=sha2('" . $username . $password . "',256)";
            $resultadoConsulta = $miDB->prepare($sql);
            $resultadoConsulta->execute();
            $registro = $resultadoConsulta->fetchObject();
            /* Si existe este usuario alamacenamos en la session un variable user para recuperala enPrograma.php */
            if ($registro != null) {
                $_SESSION['USER'] = $registro->T01_CodUsuario;
                setcookie("Cookieuser", $registro->T01_CodUsuario, time() + (86400 * 30), "/");
                header('Location:Programa.php');
                exit;
            } else {
                $error = "¡ No existe este Usuario<br> o <br> Passsword incorrecto !";
            }
        } catch (PDOException $exception) {
            /* Si hay algun error el try muestra el error del codigo */
            echo '<span> Codigo del Error :' . $exception->getCode() . '</span> <br>';

            /* Muestramos su mensage de error */
            echo '<span> Error :' . $exception->getMessage() . '</span> <br>';
        } finally {
            /* Ceramos la connection */
            unset($miDB);
        }
    } else {
        $error = " ¡ You must write username or Password !";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>OB-Log In</title>
        <!--<link rel="stylesheet" type="text/css" href="../webroot/css/style.css">-->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>

        <link rel="icon" href="../webroot/media/fav.png" type="image/ico" sizes="16x16">
        <style>
            body{
                background-image: url(../webroot/media/water-g93351de39_1920.jpg);
                background-repeat: no-repeat;
                background-size: cover;
            }
            form{
                height:  400px;
                display: flex;
                justify-content: center;
                flex-flow: column wrap;
                align-content: center;
                gap:40px;

            }
            #bg{
                border-radius: 10px;
            }
            input{
                padding: 10px;
                background: none;
                text-align: center;
                color: white;

            }
            label:nth-of-type(1){
                color: white;
                text-align: center;
                font-size: 30px;
            }
            label:nth-of-type(2){
                color: red;
                text-align: center;
                font-size: 15px;
                margin-top: -30px;
            }
            input:nth-of-type(1),input:nth-of-type(2){
                border: 2px solid blue;
                border-radius: 25px;

            }
            input:nth-of-type(3){
                border: 2px solid green;
                align-self: center;
                border-radius: 25px;
                width: 100px;
            }
            ::placeholder{
                text-transform: uppercase;
                color: #978686;
            }
        </style>
    </head>
    <body>
        <div class="container mt-3">
            <div class="d-flex mb-3">
                <div class="p-2  flex-fill"></div>
                <div id="bg" class="p-2 flex-fill bg-dark">
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="Post">
                        <label>LOGIN</label>
                        <input type="text" name="username" id="username"  placeholder="username">
                        <input type="password" name="password" id="password" placeholder="password">
                        <input type="submit" name="btnlogin" class="w3-hover-green w3-hover-text-black" value="Entrar">
                        <label><?php echo $error; ?></label>
                    </form> 

                </div>
                <div class="p-2  flex-fill"></div>
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
                    <a class="btn btn-outline-light btn-floating m-1" href="#" target="_blank" role="button">
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


