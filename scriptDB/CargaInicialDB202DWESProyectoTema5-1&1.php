
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Insert</title>
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
                    INSERT INTO T02_Departamento(T02_CodDepartamento,T02_DescDepartamento,T02_FechaCreacionDepartamento,T02_VolumenNegocio) VALUES 
                      ('FOL', 'departamento FOL', 1406149672, 102.4),
                      ('DAW', 'departamento DAW', 1406149672, 1000.3),
                      ('DIW', 'departamento DIW', 1406149672, 289.3);

                    INSERT INTO T01_Usuario(T01_CodUsuario,T01_Password,T01_DescUsuario)  VALUES 
                    ('outmane', sha2('outmanepaso',256), "OUTMANE BOUHOU"),
                    ('heraclio', sha2('heracliopaso',256), "HERACLIO"),
                    ('amor', sha2('amorpaso',256), "AMOR"),
                    ('alberto', sha2('albertopaso',256), "ALBERTO"),
                    ('antoño', sha2('antoñopaso',256), "ANTOÑO");
            OB;
            $miDB ->exec($sql);
            echo '          <div class="w3-panel w3-blue">
                            <h3>Information!</h3>
                            <p>Se insertado bien.</p>
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
