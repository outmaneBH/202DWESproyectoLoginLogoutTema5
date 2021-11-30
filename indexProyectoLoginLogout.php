<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Index LogIn LogOut</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
        <style>
            footer {
                position: fixed;
                left: 0;
                bottom: 0;
                width: 100%;
                background-color: red;
                color: white;
                text-align: center;
            }
            body{
                background-image: url(webroot/media/building-g458550d32_1920.jpg);
                background-repeat: no-repeat;
          
                background-size: cover;
            }
            h3{
                color: black;
                background: aqua;
                width: 250px;
                padding: 5px;
                font-weight: bold;
            }
        </style>

    </head>
    <body>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="container-fluid">

                <div class="collapse navbar-collapse" id="mynavbar">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="../202proyectoDWES/indexProyectoDWES.php">Back</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <a href="codigoPHP/Login.php" style="margin-right: 5px;" class="btn btn-primary" type="button">Login</a>
                        <button class="btn btn-info" type="button">Register</button>
                    </form>
                </div>
            </div>
        </nav>
        <div class="container-fluid mt-3">
            <h3>Index OUTMANE</h3>
            
        </div>
        <footer class="bg-dark text-center text-white">
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                © 2021 Copyright:
                <a class="text-white" href="">OUTMANE BOUHOU</a>
            </div>
        </footer>
    </body>
</html>

