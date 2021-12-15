<?php
/*Iniciar session para meter los datos del catch en sessiones 
 * y despues mostrar el mensaje del error*/
session_start();

$_SESSION['CodeError'] = $exception->getCode();
$_SESSION['MsgError'] = $exception->getMessage();

header("Location:../error/erroresTry.php");

