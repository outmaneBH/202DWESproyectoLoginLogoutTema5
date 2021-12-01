<?php
session_start();
if (!isset($_SESSION['usuario202DWESAppLoginLogout'])) {
    header('Location: Login.php');
}



