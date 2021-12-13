<?php
 /*Recuperar la session y en el if borramos los variables de session */
session_start();

if (isset($_REQUEST['btndestroy'])) {
    session_unset();
    session_destroy();
   
}
?>
<!DOCTYPE html>
<html>
    <title>Errores Try Catch</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <body class="w3-container">
        <form>
            <button style="margin-top: 10px;" type="submit" name="btndestroy" class="w3-button w3-blue w3-hover-blue ">Destroy SESSION</button> 
        </form>
        <div class="w3-panel w3-yellow w3-card-4">
            <!--Mostramos el codigo del error y su mensage-->
            <h1>Error Codigo :<?php echo $_SESSION['CodeError']; ?></h1>
            <p><strong>Mensaje :</strong><?php echo $_SESSION['MsgError']; ?></p>
        </div>

    </body>
</html>

