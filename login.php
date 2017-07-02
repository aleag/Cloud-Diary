<?php

    include('conexion.php');
    session_start(); // Starting Session
    $error; // Variable To Store Error Message
    
    if (isset($_POST['submit'])) {
        if (empty($_POST['username']) || empty($_POST['password'])) {
            $error = "Usuario o contraseña incorrecto.";
        }
        else {
            // Define $username and $password
            $username=strtoupper($_POST['username']);
            $password=$_POST['password'];
            
            // To protect MySQL injection for Security purpose
            $username = stripslashes($username);
            $password = stripslashes($password);
            $username = mysqli_real_escape_string($db,$username);
            $password = mysqli_real_escape_string($db,$password);
            
            // SQL query to fetch information of registerd users and finds user match.
            $sql = "SELECT * FROM USUARIOS WHERE PASSWORD='$password' AND LOGNAME='$username'";
            $query = mysqli_query($db,$sql);
            $rows = mysqli_num_rows($query);
            
            if ($rows == 1) {
                $_SESSION['login_user']=$username; // Initializing Session
                header("location: content.php"); // Redirecting To Other Page
            } else {
                $error = "Usuario o contraseña incorrecto.";
            }
            
            mysqli_close($db); // Closing Connection
        }
    }
    
    /*if(isset($_SESSION['login_user'])){
        header("location: content.php");
    }*/
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Cloud Diary - Iniciar Sesión</title>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
        <!--Import materialize.css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
        
        <!-- Personal CSS -->
        <link type="text/css" rel="stylesheet" href="css/login.css"  media="screen,projection"/>
        
        <script src="https://use.fontawesome.com/f31f9c5054.js"></script>
        
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"/>
    </head>
    <body>
        <header>
            <nav class="top-nav">
                <div class="nav-wrapper blue darken-1" role="banner">
                    <a href="index.html" class="brand-logo center">Cloud Diary<!--i class="fa fa-cloud fa-lg" aria-hidden="true"></i--></a>
                </div>
            </nav>
        </header>
        
        <nav>
            <div class="nav-wrapper grey lighten-5" role="navigation">
                <div class="col s12">
                    <a href="index.html" class="breadcrumb">Página Principal</a>
                    <a href="login.php" class="breadcrumb">Iniciar Sesión</a>
                </div>
            </div>
        </nav>
        
        <div class="container" role="main">
            <div class="row">
                <div class="col s12 l8 offset-l2">
                    <h1>Iniciar Sesión</h1>
                    <div class="card-panel grey lighten-4">
                        <div class="row">
                            <form class="col s12" action="" method="post">
                                <?php if(isset($error)){ ?>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <div id="card-alert" class="card red lighten-5">
                                            <div class="card-content red-text">
                                                <p>Error de identificación. Compruebe que las credenciales sean válidas.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input title="Debe introducir un nombre de usuario valido" aria-required="true" id="name" type="text" name="username" class="validate" required>
                                        <label for="name">Usuario</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input title="Debe añadir una contraseña valida" aria-required="true" id="password" name="password" type="password" class="validate" required>
                                        <label for="password">Contraseña</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="btn waves-effect waves-light orange lighten-2" type="submit" name="submit">Iniciar Sesión&nbsp;<i class="fa fa-sign-in" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
    </body>
</html>
