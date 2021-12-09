<?php
/*Iniciar la session para recuperar el usuario*/
session_start();


/*Si no existe sessiones volvemos a Login y borramos los variables de sessiones*/
if (!isset($_SESSION['usuario202DWESAppLoginLogout'])) {
    session_unset();
    session_destroy();
    header('Location: Login.php');
    exit;
}



