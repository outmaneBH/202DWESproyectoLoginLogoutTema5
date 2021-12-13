<?php
/*
 * @author: OUTMANE BOUHOU
 * @updated: 05/12/2021
 * @see : Desarrollo de una aplicación (Proyecto LoginLogoff) con control de acceso e identificación del
  usuario basado en un formulario (Login.php) con un botón de “Entrar” y en el uso de una tabla
  “Usuario” de la base de datos (PDO). En el caso de que tecleemos un usuario y password
  correctos se abrirá otra página (Programa.php) donde tendremos un botón de “Salir” que nos
  devolverá al Login.php (Funionalidad Logoff que nos redirige automáticamente a la página de
  autenticación).
 */

require_once 'session.php';

/* si ha pulsado buton cancelar ,enviamos a Programa */
if (isset($_REQUEST['btncancelar'])) {
    echo '<script>location="Programa.php"</script>;';
}


/* La configuracion de base de datos */
require_once '../config/confDBPDO.php';

/* usar la libreria de validacion */
require_once '../core/LibreriaValidacion.php';

/* definir un variable constante obligatorio a 1 */
define("OBLIGATORIO", 1);

/* Varible de entrada correcta inicializada a true */
$entradaOK = true;

/* definir un array para alamcenar errores del nombre y la altura */
$aErrores = ['password' => null,
    'password1' => null,
    'password2' => null
];

/* Array de respuestas inicializado a null */
$aRespuestas = ['password' => null,
    'password1' => null,
    'password2' => null
];

$error = "";


/* comprobar si ha pulsado el button entrar */
if (isset($_REQUEST['btnupdate'])) {
    $entradaOK = false;
//Para cada campo del formulario: Validar entrada y actuar en consecuencia
//Validar entrada
//Comprobar si el campo password esta rellenado
    $aErrores["password"] = validacionFormularios::validarPassword($_REQUEST['password'], 8, 1, 2, OBLIGATORIO);

//Comprobar si el campo password esta rellenado
    $aErrores["password1"] = validacionFormularios::validarPassword($_REQUEST['password1'], 8, 1, 2, OBLIGATORIO);

//Comprobar si el campo password esta rellenado
    $aErrores["password2"] = validacionFormularios::validarPassword($_REQUEST['password2'], 8, 1, 2, OBLIGATORIO);

    try {
        /* usar el ficherod de configuracion */
        $miDB = new PDO(HOST, USER, PASSWORD);

        /* Preparamos las excepciones */
        $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /* Consulta preparada para buscar  */
        $sql = "SELECT T01_CodUsuario FROM T01_Usuario WHERE T01_CodUsuario='" . $_SESSION['usuario202DWESAppLoginLogout'] . "' and T01_Password=sha2('" . $_SESSION['usuario202DWESAppLoginLogout'] . $_REQUEST['password'] . "',256)";
        $resultadoConsulta = $miDB->prepare($sql);
        /* ejecutar la consulta */
        $resultadoConsulta->execute();

        if ($resultadoConsulta->rowCount() > 0) {
            if ($_REQUEST['password1'] == $_REQUEST['password2']) {
                $aRespuestas['password1'] = $_REQUEST['password1'];
                $entradaOK = true;
            }
        } else {
            $error = "Algo  mal";
        }
    } catch (PDOException $exception) {
        /* llamar al fichero de configuracion de Catch */
        require '../error/catchConfig.php';
    } finally {
        /* Cerramos the connection */
        unset($miDB);
    }

//recorrer el array de errores
    foreach ($aErrores as $nombreCampo => $value) {
//Comprobar si el campo ha sido rellenado
        if ($value != null) {
            $_REQUEST[$nombreCampo] = "";
// cuando encontremos un error
            $entradaOK = false;
        }
    }
} else {
//El formulario no se ha rellenado nunca
    $entradaOK = false;
}
if ($entradaOK) {
//Tratamiento del formulario - Tratamiento de datos OK
//Si los datos estan correctos


    try {
        /* usar el fichero  de configuracion para conectarnos con la base de datos */
        $miDB = new PDO(HOST, USER, PASSWORD);

        /* Preparamos las excepciones */
        $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /* Editar la tabla T01_Usuario para  el campo password del usuario  */
        $sql2 = "UPDATE T01_Usuario SET T01_Password=sha2('" . $_SESSION['usuario202DWESAppLoginLogout'] . $aRespuestas['password1'] . "',256) WHERE T01_CodUsuario='" . $_SESSION['usuario202DWESAppLoginLogout'] . "'";

        /* Preparamos  la consulta   */
        $consulta = $miDB->prepare($sql2);
        /* Ejecución de la consulta */
        $consulta->execute();

        if ($consulta->rowCount() > 0) {
            /* cuando todo esta bien devolverlo a editar de Perfil */
            header("Location:editarPerfil.php");
        } else {
            $error = "Algo mal";
        }
    } catch (PDOException $exception) {
        /* llamar al fichero de configuracion de Catch */
        require '../error/catchConfig.php';
    } finally {
        /* cerramos la connection */
        unset($miDB);
    }
} else {
//Mostrar el formulario hasta que lo rellenemos correctamente
//Mostrar formulario
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>OB - CambiarPassword</title>
            <!--<link rel="stylesheet" type="text/css" href="../webroot/css/style.css">-->
            <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>

            <link rel="icon" href="../webroot/media/fav.png" type="image/ico" sizes="16x16">
            <style>
                body{
                    background-image: url(../webroot/media/building-g458550d32_1920.jpg);
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
                span:nth-of-type(1){
                    color: white;
                    text-align: center;
                    font-size: 30px;
                }
                span:nth-of-type(2), span:nth-of-type(3){
                    color: red;
                    text-align: center;
                    font-size: 15px;
                    margin-top: -30px;
                    margin-bottom: -20px;
                }
                input:nth-of-type(1),input:nth-of-type(2),input:nth-of-type(3){
                    border: 2px solid blue;
                    border-radius: 25px;
                }
                section input:nth-of-type(1){
                    border: 2px solid green;
                    align-self: center;
                    border-radius: 25px;
                    width: 100px;
                }
                section input:nth-of-type(2){
                    border: 2px solid red;
                    align-self: center;
                    border-radius: 25px;
                    width: 100px;
                }
                section{
                    text-align: center;
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
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                            <span> Cambiar Password </span>
                            <input type="text" name="password"  value="<?php echo (isset($_REQUEST['password']) ? $_REQUEST['password'] : null); ?>"  placeholder="old password">
                            <input type="password" name="password1"  value="<?php echo (isset($_REQUEST['password1']) ? $_REQUEST['password1'] : null); ?>"  placeholder="new password">
                            <input type="password" name="password2"  value="<?php echo (isset($_REQUEST['password2']) ? $_REQUEST['password2'] : null); ?>"  placeholder="repeat password">
                            <section>
                                <input type="submit" name="btnupdate" class="w3-hover-green w3-hover-text-black" value="Cambiar">
                                <input type="submit" name="btncancelar" class="w3-hover-red w3-hover-text-white" value="Cancel">
                            </section>
                            <span><?php echo $error; ?></span>
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
<?php } ?>


