<?php
    include('session.php');
    
    $asignatura = $_GET[id];
    $sql = "SELECT ASI FROM USUARIOS NATURAL JOIN MATRICULA NATURAL JOIN ASIGNATURAS WHERE LOGNAME='$login_session' AND CAS='$asignatura' ORDER BY CUR, ASI";
    $query = mysqli_query($db,$sql);
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    $curso = ['PRIMERO','SEGUNDO','TERCERO','CUARTO'];
    
    $sql2 = "SELECT * FROM COMENTARIOS NATURAL JOIN USUARIOS WHERE CAS='$asignatura' ORDER BY F DESC;";
    $query2 = mysqli_query($db,$sql2);
    $rows2 = mysqli_num_rows($query2);
    
    $sql3 = "SELECT * FROM PROFESORES NATURAL JOIN USUARIOS NATURAL JOIN MATRICULA WHERE CAS='$asignatura';";
    $query3 = mysqli_query($db,$sql3);
    $rows3 = mysqli_num_rows($query3);
    $estado = ['No estoy en el despacho', 'Estoy en el despacho'];
    
    $sql4 = "SELECT * FROM USUARIOS NATURAL JOIN PROFESORES WHERE LOGNAME='$login_session'";
    $query4 = mysqli_query($db,$sql4);
    $rows4 = mysqli_num_rows($query4);
    $profesor = FALSE;
    
    if($rows4 == 1) {
       $profesor = TRUE; 
    }
    
    $color = ["light-blue lighten-4","green lighten-4","red lighten-3",]
?>
<!DOCTYPE html>
<html lang="es">
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
        <meta name="theme-color" content="#2196F3">
        <title>Cloud Diary - <?php echo $row[ASI] ?></title>

        <!-- CSS  -->
        <link href="min/plugin-min.css" type="text/css" rel="stylesheet">
        <link href="min/custom-min.css" type="text/css" rel="stylesheet">
        
        <!-- Personal CSS -->
        <link type="text/css" rel="stylesheet" href="css/login.css"  media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="css/asi.css"  media="screen,projection"/>
    </head>
    
    <body id="top" class="scrollspy">

        <!-- Pre Loader -->
        <div id="loader-wrapper">
            <div id="loader"></div>
            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>
        </div>
    
        <!--Navigation-->
        <div class="navbar-fixed">
            <nav id="nav_f" class="default_color" role="navigation">
                <div class="nav-wrapper">
                    <a href="content.php" id="logo-container" class="center brand-logo" tabindex="1" role="banner">Cloud Diary</a>
                    <ul class="right hide-on-med-and-down">
                        <li><a href="./profile.php" tabindex="2">Mi Perfil</a></li>
                        <li><a href="./logout.php" tabindex="3">Cerrar Sesión</a></li>
                    </ul>
                    <ul id="nav-mobile" class="side-nav">
                        <li><a <?php echo 'href="comentario.php?id=' . $asignatura . '"'; ?> tabindex="-1">Añadir comentario</a></li>
			<li><a href="#!" tabindex="-1">Desmatricularse</a></li>
			<li><a href="./profile.php"tabindex="-1">Mi Perfil</a></li>
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
                    <a <?php echo 'href="asignatura.php?id=' . $asignatura . '"'; ?>class="breadcrumb" tabindex="5"><?php echo $row[ASI] ?></a>
                </div>
            </div>
        </nav>
    
        <div class="row" id=main role="main">
            <div class="col l2 m3 hide-on-small-only">
                <h2 tabindex="9">Opciones</h2>
                <ul class="collection with-header">
                    <!--li class="collection-header"><h4>Opciones del Curso</h4></li-->
                    <a <?php echo 'href="comentario.php?id=' . $asignatura . '"'; ?> class="collection-item blue-text" tabindex="10">Añadir Comentario</a>
                    <a href="#!" class="collection-item blue-text" tabindex="11">Desmatricularse</a>
                </ul>
            </div>
            <div class="col s12 l7 m9">
                <h1 tabindex="6">Comentarios</h1>
                <?php
                    if ($rows2 >= 1) {
                        while($row2 = mysqli_fetch_assoc($query2)) {
                            echo '<div class="card ' . $color[$row2[COL]] . '" tabindex="6"><div class="card-title">' . $row2[T] .'</div>';
                            echo '<div class="card-content center-align"><p id="comentario">' . strtolower($row2[C]) .'</p>';
                            echo '<div class="chip">'  . $row2[NOMBRE] . ' ' . $row2[APELLIDOS] . '</div>';
                            echo '<div class="chip">'  . $row2[F] . '</div></div></div>';
                        }
                    } else { ?>
                        <div class="row">
                            <div class="input-field col s12">
                                <div id="card-alert" class="card red lighten-5">
                                    <div class="card-content orange-text">
                                        <p tabindex="6">No existe ningún comentario para esta asignatura.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php } ?>
                
            </div>
            <div class="col s12 l3 m9 offset-m3">
                <h2 tabindex="7">Profesores</h2>
                <?php
                    if ($rows3 >= 1) {
                        echo '<div class="row" tabindex="8">';
			while($row3 = mysqli_fetch_assoc($query3)) {
                            echo '<div class="card-panel grey"><span class="white-text">' . $row3[NOMBRE] .' ' . $row3[APELLIDOS];
                            echo '</span><p>' . $row3[DESPACHO] . '</p><p>' . $row3[TUTO] . '</p><div class="center-align">';
                            if($row3[ESTADO]==0) {
                                echo '<div class="chip red lighten-2" aria-live="polite">No estoy en el despacho</div>';
                            } else {
                                echo '<div class="chip green lighten-2" aria-live="polite">Estoy en el despacho</div>';
                            }
                            
                            if ($profesor && $login_session==$row3[LOGNAME]) {
                                echo '<span><a class="waves-effect waves-light btn orange lighten-2" id="cambiarEstado">Cambiar Estado</a></span>';
			    }
			    echo '</div></div>';
                        }
			echo '</div>';
                    } else { ?>
                        <div class="row">
                            <div class="input-field col s12">
                                <div id="card-alert" class="card red lighten-5">
                                    <div class="card-content orange-text">
                                        <p>No existe ningún profesor para esta asignatura.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php }
                    mysqli_close($db);
                ?>
            </div>
        </div>
        
        <div class="fixed-action-btn hide-on-small-only">
            <a <?php echo 'href="comentario.php?id=' . $asignatura . '"'; ?> class="waves-effect waves-light btn btn-floating btn-large orange lighten-2"><i class="fa fa-plus" aria-hidden="true"></i></a>
        </div>
        
        <div class="fixed-action-btn hide-on-med-and-up">
            <a <?php echo 'href="comentario.php?id=' . $asignatura . '"'; ?> class="waves-effect waves-light btn btn-floating orange lighten-2"><i class="fa fa-plus" aria-hidden="true"></i></a>
        </div>

        <!--  Scripts-->
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="https://use.fontawesome.com/f31f9c5054.js"></script>
        <script src="min/plugin-min.js"></script>
        <script src="min/custom-min.js"></script>
        <script src="js/estado.js"></script>
    </body>
</html>
