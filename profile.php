<?php
    include('session.php');
    
    $sql = "SELECT * FROM USUARIOS WHERE LOGNAME='$login_session'";
    $query = mysqli_query($db,$sql);
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    
    $sql2 = "SELECT * FROM USUARIOS NATURAL JOIN COMENTARIOS WHERE LOGNAME='$login_session'";
    $query2 = mysqli_query($db,$sql2);
    $rows2 = mysqli_num_rows($query2);
    
    $sql3 = "SELECT DISTINCT CUR FROM USUARIOS NATURAL JOIN MATRICULA NATURAL JOIN ASIGNATURAS WHERE LOGNAME='$login_session'";
    $query3 = mysqli_query($db,$sql3);
    $rows3 = mysqli_num_rows($query3);
    $curso = ['PRIMERO','SEGUNDO','TERCERO','CUARTO'];
    
    $sql4 = "SELECT ASI FROM USUARIOS NATURAL JOIN MATRICULA NATURAL JOIN ASIGNATURAS WHERE LOGNAME='$login_session'";
    $query4 = mysqli_query($db,$sql4);
    $rows4 = mysqli_num_rows($query4);

?>

<!DOCTYPE html>
<html lang="es">
    <head>

        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
        <meta name="theme-color" content="#2196F3">
        <title>Cloud Diary - Mi Perfil</title>

        <!-- CSS  -->
        <link href="min/plugin-min.css" type="text/css" rel="stylesheet">
        <link href="min/custom-min.css" type="text/css" rel="stylesheet">
        
        <!-- Personal CSS -->
        <link type="text/css" rel="stylesheet" href="css/login.css"  media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="css/content.css"  media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="css/profile.css"  media="screen,projection"/>
        
    </head>
    
    <body id="top" class="scrollspy">

    <!-- Pre Loader -->
    <div id="loader-wrapper">
        <div id="loader"></div>
 
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>

    <!--Navigation-->
    <div class="navbar">
        <nav id="nav_f" class="default_color" role="navigation">
            <div class="nav-wrapper">
                <a href="content.php" id="logo-container" class="center brand-logo" tabindex="1" role="banner">Cloud Diary</a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="./content.php" tabindex="2">Mis Asignaturas</a></li>
                    <li><a href="./logout.php" tabindex="3">Cerrar Sesión</a></li>
                </ul>
                <ul id="nav-mobile" class="side-nav">
                    <li><a href="./content.php" tabindex="-1">Mis Asignaturas</a></li>
                    <li><a href="./profile.php" tabindex="-1">Mi Perfil</a></li>
                    <li><a href="./logout.php" tabindex="-1">Cerrar Sesión</a></li>
                </ul>
                <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
            </div>
        </nav>
    </div>
    
    <nav>
        <div class="nav-wrapper grey lighten-5">
            <div class="col s12">
                <a href="content.php" class="breadcrumb" tabindex="4">Mis Asignaturas &nbsp&nbsp&nbsp></a>
                <a href="./profile.php" class="breadcrumb" tabindex="5">Mi Perfil</a>
            </div>
        </div>
    </nav>


    <!--div id="profile">
        <b id="welcome">Welcome : <i><?php //echo $login_session; ?></i></b>
    </div-->

    
    <!-- WAI-ARIA -->
    <div class="row" id=main role="main">
        <div class="col s12 l8 offset-l2">
            <div class="card">
                <div class="card-content">
                    <h1 tabindex="6">Mi perfil</h1>
                </div>
                <div class="card-tabs">
                    <ul class="tabs tabs-fixed-width">
                        <li class="tab"><a class="active" href="#test4" tabindex="7">Información Personal</a></li>
                        <li class="tab"><a href="#test5" tabindex="14">Expediente Académico</a></li>
                    </ul>
                </div>
                <div class="card-content grey lighten-4">
                    <div id="test4">
                        <ul class="collection">
                            <li class="collection-item avatar">
                                <span class="title" tabindex="8">Nombre y Apellidos</span>
                                <p tabindex="9"><?php echo $row[NOMBRE] ?><br><?php echo $row[APELLIDOS] ?></p>
                            </li>
                            <li class="collection-item avatar">
                                <span class="title" tabindex="10">DNI</span>
                                <p tabindex="11"><?php echo $row[DNI] ?></p>
                            </li>
                            <li class="collection-item avatar">
                                <span class="title" tabindex="12">Usuario</span>
                                <p tabindex="13"><?php echo $row[LOGNAME] ?></p>
                            </li>
                        </ul>
                    </div>
                    <div id="test5">
                        <ul class="collection">
                            <li class="collection-item avatar">
                                <span class="title" tabindex="15">Asignaturas Matriculadas</span>
                                <p tabindex="16">
                                    <?php
                                        if ($rows4 >= 1) {
                                            while($row4 = mysqli_fetch_assoc($query4)) {
                                                echo $row4[ASI] . '<br>';
                                            }
                                        } else {
                                            echo 'No hay asignaturas matriculadas';
                                        }
                                    ?>
                                </p>
                            </li>
                            <li class="collection-item avatar">
                                <span class="title" tabindex="17">Número de Comentarios</span>
                                <p tabindex="18"><?php echo $rows2 ?></p>
                            </li>
                            <li class="collection-item avatar">
                                <span class="title" tabindex="19">Cursos Matriculados</span>
                                <p tabindex="20">
                                    <?php
                                        if ($rows3 >= 1) {
                                            while($row3 = mysqli_fetch_assoc($query3)) {
                                                echo $curso[$row3[CUR]-1] . '<br>';
                                            }
                                        } else {
                                            echo 'No hay asignaturas matriculadas';
                                        }
                                        
                                        mysqli_close($db); // Closing Connection
                                    ?>   
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <!--  Scripts-->
    <script src="min/plugin-min.js"></script>
    <script src="min/custom-min.js"></script>
    
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
    
    <script src="https://use.fontawesome.com/f31f9c5054.js"></script>

    </body>
</html>
