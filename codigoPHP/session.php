<?php
session_start();
if (!isset($_SESSION['USER'])) {
    header('Location: Login.php');
}



