<?php
    include('session.php');
?>
<!DOCTYPE html>
<html lang="es">
    <head>

        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
        <meta name="theme-color" content="#2196F3">
        <title>Cloud Diary - Mis Asignaturas</title>

        <!-- CSS  -->
        <link href="min/plugin-min.css" type="text/css" rel="stylesheet">
        <link href="min/custom-min.css" type="text/css" rel="stylesheet">
        
        <!-- Personal CSS -->
        <link type="text/css" rel="stylesheet" href="css/login.css"  media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="css/content.css"  media="screen,projection"/>
        
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
                    <li><a href="./profile.php" tabindex="2">Mi Perfil</a></li>
                    <li><a href="./logout.php" tabindex="3">Cerrar Sesión</a></li>
                </ul>
                <ul id="nav-mobile" class="side-nav">
                    <li><a href="./profile.php" tabindex="-1">Mi Perfil</a></li>
                    <li><a href="./logout.php" tabindex="-1">Cerrar Sesión</a></li>
                </ul>
                <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
            </div>
        </nav>
    </div>

    <!--div id="profile">
        <b id="welcome">Welcome : <i><?php //echo $login_session; ?></i></b>
    </div-->

    
    <!-- WAI-ARIA -->
    <div class="row" id=main role="main">
        <div class="col s12 l8 offset-l2">
            <h1 tabindex="4">Asignaturas</h1>
            <!-- WAI-ARIA -->
            <div class="collection with-header" tabindex="-1">
                <ul><li class="collection-header"><h4 tabindex="5">Curso 2016-2017</h4></li></ul>
                <!-- WAI-ARIA -->
                <?php
                    $sql = "SELECT ASI, CUR, CAS FROM USUARIOS NATURAL JOIN MATRICULA NATURAL JOIN ASIGNATURAS WHERE LOGNAME='$login_session' ORDER BY CUR, ASI";
                    $query = mysqli_query($db,$sql);
                    $rows = mysqli_num_rows($query);
                    $curso = ['PRIMERO','SEGUNDO','TERCERO','CUARTO'];
                    $cnt = 0;
                    
                    if ($rows >= 1) {
                        while($row = mysqli_fetch_assoc($query)) {
                            if($cnt%2==0) {
                                echo '<a href="asignatura.php?id=' . $row[CAS] . '" class="collection-item blue-text">' . utf8_decode($row["ASI"]) .'<br><span id="curso">' . $curso[$row[CUR]-1] . '</span></a>';
                            } else {
                                echo '<a href="asignatura.php?id=' . $row[CAS] . '" class="collection-item blue-text grey lighten-4">' . utf8_decode($row["ASI"]) .'<br><span id="curso">' . $curso[$row[CUR]-1] . '</span></a>';
                            }
                            
                            $cnt++;
                        }
                    } else { ?>
                        <div class="row">
                            <div class="input-field col s12">
                                <div id="card-alert" class="card red lighten-5">
                                    <div class="card-content orange-text">
                                        <p>No tiene asignaturas para este curso.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    <?php }
                    
                    mysqli_close($db);
                ?>
            </div>
        </div>
    </div>
    

    <!--  Scripts-->
    <script src="min/plugin-min.js"></script>
    <script src="min/custom-min.js"></script>
    
    <script src="https://use.fontawesome.com/f31f9c5054.js"></script>

    </body>
</html>
