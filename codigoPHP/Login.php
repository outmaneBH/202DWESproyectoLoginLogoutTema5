<?php


/*
 * @author: OUTMANE BOUHOU
 * @updated: 30/11/2021
 * @see : Desarrollo de una aplicación (Proyecto LoginLogoff) con control de acceso e identificación del
  usuario basado en un formulario (Login.php) con un botón de “Entrar” y en el uso de una tabla
  “Usuario” de la base de datos (PDO). En el caso de que tecleemos un usuario y password
  correctos se abrirá otra página (Programa.php) donde tendremos un botón de “Salir” que nos
  devolverá al Login.php (Funionalidad Logoff que nos redirige automáticamente a la página de
  autenticación).
 */
/* La configuracion de base de datos */
require_once '../config/confDBPDO.php';

/* usar la libreria de validacion */
require_once '../core/LibreriaValidacion.php';

/* definir un variable constante obligatorio a 1 */
define("OBLIGATORIO", 1);

/* Varible de entrada correcta inicializada a true */
$entradaOK = true;

/* definir un array para alamcenar errores del nombre y la altura */
$aErrores = ['username' => null,
    'password' => null
];

/* Array de respuestas inicializado a null */
$aRespuestas = ['username' => null,
    'password' => null,
    'ultimaConexionAnterior' => null
];

$error = "";
/* comprobar si ha pulsado el button entrar */
if (isset($_REQUEST['btnlogin'])) {
     $entradaOK = false;
    //Para cada campo del formulario: Validar entrada y actuar en consecuencia
    //Validar entrada
    //Comprobar si el campo username esta rellenado
    $aErrores["username"] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['username'], 8, 2, OBLIGATORIO);

    //Comprobar si el campo password esta rellenado
    $aErrores["password"] = validacionFormularios::validarPassword($_REQUEST['password'], 8, 3, 2, OBLIGATORIO);
   

    if (!$aErrores["username"] || !$aErrores["password"]) {
        /* comprobamos si el codigo existe en la base de datos */
        try {
            /* Establecemos la connection con pdo en global */
            $miDB = new PDO(HOST, USER, PASSWORD);

            /* configurar las excepcion */
            $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            /* Hgamos la comprobacion en la base de datos si existe este usuario con consulta preparada */
            $sql = "SELECT T01_FechaHoraUltimaConexion FROM T01_Usuario WHERE T01_CodUsuario='" . $_REQUEST['username'] . "' and T01_Password=sha2('" . $_REQUEST['username'] . $_REQUEST['password'] . "',256)";
            $resultadoConsulta = $miDB->prepare($sql);
            $resultadoConsulta->execute();
            $registro = $resultadoConsulta->fetchObject();

            /* Si existe este usuario alamacenamos en la session un variable user para recuperala enPrograma.php */
            if ($registro != null) {
                $entradaOK = true;
                /* Sacar el timestamp de usuario en un variable */
                $FechaHoraUltimaConnexionAnterior = $registro->T01_FechaHoraUltimaConexion;
                $aRespuestas['username'] = $_REQUEST['username'];
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
        $error = "! Algo mal ¡";
    }

    /* recorrer el array de errores */
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

    $aRespuestas = ['username' => $_REQUEST['username'],
        'password' => $_REQUEST['password'],
        'ultimaConexionAnterior' => $FechaHoraUltimaConnexionAnterior
    ];
    /* Usamos el timestamp desde fecha de Hoy */
    $ofecha = new DateTime();
    $time = $ofecha->getTimestamp();

    try {

        /* Establecemos la connection con pdo en global */
        $miDB = new PDO(HOST, USER, PASSWORD);

        /* configurar las excepcion */
        $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /* Modificamos la tabla usuario en campo T01_NumConexiones para darle +1 por cada connexion   */
        $sql2 = "UPDATE T01_Usuario SET T01_NumConexiones=T01_NumConexiones+1 ,T01_FechaHoraUltimaConexion=$time WHERE T01_CodUsuario='" . $aRespuestas['username'] . "'";
        $resultadoConsulta2 = $miDB->prepare($sql2);
        $resultadoConsulta2->execute();

        /* Iniciamos la session para alamacenar el codigo de usuario */
        session_start();

        /* Meter al codigo del usario en una session */
        $_SESSION['usuario202DWESAppLoginLogout'] = $aRespuestas['username'];

        /* Tambien el timestamp  almacenarlo en una session */
        $_SESSION['T01_FechaHoraUltimaConexionAnterior'] = $aRespuestas['ultimaConexionAnterior'];

        /* Entrar al pagina Programa */
        header('Location:Programa.php');
        exit;
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
    //Mostrar el formulario hasta que lo rellenemos correctamente
    //Mostrar formulario
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>OB-Log In</title>
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
            <a href="../indexProyectoLoginLogout.php" style="margin: 10px;font-weight: bold;" class="btn btn-warning" type="button"><?php echo ($_COOKIE["IdiomaReg"] != 'es' ? 'Go Back' : 'Volver'); ?></a
            <div class="container mt-3">
                <div class="d-flex mb-3">
                    <div class="p-2  flex-fill"></div>
                    <div id="bg" class="p-2 flex-fill bg-dark">
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                            <span> <?php echo ($_COOKIE["IdiomaReg"] != 'es' ? 'LOGIN' : 'Iniciar sesión'); ?> </span>
                            <input type="text" name="username"  value="<?php echo (isset($_REQUEST['username']) ? $_REQUEST['username'] : null); ?>"  placeholder="username">
                            <input type="password" name="password" value="<?php echo (isset($_REQUEST['password']) ? $_REQUEST['password'] : null); ?>"  placeholder="password"> 
                            <input type="submit" name="btnlogin" class="w3-hover-green w3-hover-text-black" value="<?php echo ($_COOKIE["IdiomaReg"] != 'es' ? 'Login' : 'Entrar'); ?>">
                            <a style="position: relative;left:  40%;" href="registro.php">Create a new account</a>
                            <span><?php echo $error; ?></span>
                        </form> 
                    </div>
                    <div class="p-2  flex-fill"></div>
                </div>
            </div>
            <div style="height:200px;"></div>
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
            <script>


            </script>
        </body>
    </html>
<?php } ?>


