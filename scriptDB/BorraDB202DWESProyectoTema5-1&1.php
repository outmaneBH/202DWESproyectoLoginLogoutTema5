<!DOCTYPE html>
<html lang="en">
    <head>
        <title>DELETE - PDO</title>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <style>
            div{
                padding: 10px;
            }
        </style>
    </head>
    <body>
        <?php
        require_once '../config/confDBPDO.php';
        try {
            /* Establecemos la connection con pdo */
            $miDB = new PDO(HOST, USER, PASSWORD);

            /* configurar las excepcion */
            $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = <<<OB
                    USE dbs4868775;
                    DROP TABLE IF EXISTS T01_Usuario ;
                    DROP TABLE IF EXISTS T02_Departamento ;
            OB;
            $miDB ->exec($sql);
            echo '          <div class="w3-panel w3-blue">
                            <h3>Information!</h3>
                            <p>Se ha borrado la tabla</p>
                            </div>';
        } catch (PDOException $ex) {
            /* Si hay algun error el try muestra el error del codigo */
            echo '<span> Codigo del Error :' . $exception->getCode() . '</span> <br>';

            /* Muestramos su mensage de error */
            echo '<span> Error :' . $exception->getMessage() . '</span> <br>';
        } finally {
            unset($miDB);
        }
        ?>
    </body>
</html>
