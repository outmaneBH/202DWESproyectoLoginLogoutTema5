<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Crear </title>
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
                    CREATE TABLE IF NOT EXISTS T01_Usuario (
                       T01_CodUsuario VARCHAR(8) PRIMARY KEY,
                       T01_Password VARCHAR(255) NOT NULL,
                       T01_DescUsuario VARCHAR(255) NOT NULL,
                       T01_NumConexiones INT DEFAULT 0,
                       T01_FechaHoraUltimaConexion INT,
                       T01_Perfil enum('administrador', 'usuario') DEFAULT 'usuario', 
                       T01_ImagenUsuario mediumblob
                   ) ENGINE=INNODB;
            
                    CREATE TABLE IF NOT EXISTS T02_Departamento (
                       T02_CodDepartamento CHAR(3) PRIMARY KEY,
                       T02_DescDepartamento VARCHAR(255) NOT NULL,
                       T02_FechaCreacionDepartamento INT NOT NULL,
                       T02_VolumenNegocio FLOAT NOT NULL,
                       T02_FechaBajaDepartamento INT NULL
                   ) ENGINE=INNODB;
            OB;
            $miDB->exec($sql);
            echo '          <div class="w3-panel w3-blue">
                            <h3>Information!</h3>
                            <p>La tabla ha insertado bien.</p>
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
