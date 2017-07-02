<?php
    include('session.php');
    
    $asignatura = $_GET[id];
    
    $sql = "SELECT ASI FROM ASIGNATURAS WHERE CAS='$asignatura'";
    $query = mysqli_query($db,$sql);
    $row = mysqli_fetch_assoc($query);
    
    $location = "location: asignatura.php?id=$asignatura";
    
    $sql2 = "SELECT DNI FROM USUARIOS WHERE LOGNAME='$login_session'";
    $query2 = mysqli_query($db,$sql2);
    $row2 = mysqli_fetch_assoc($query2);
    $dni = $row2[DNI];
    
    $sql4 = "SELECT * FROM USUARIOS NATURAL JOIN PROFESORES WHERE LOGNAME='$login_session'";
    $query4 = mysqli_query($db,$sql4);
    $rows4 = mysqli_num_rows($query4);
    $profesor = FALSE;
    
    if($rows4 == 1) {
       $profesor = TRUE; 
    }
    
    $error; // Variable To Store Error Message
    
    if (isset($_POST['submit'])) {
        if (empty($_POST['titulo']) || empty($_POST['comentario'])) {
            $error = "Debe añadir un título y un comentario.";
        } else if (empty($_POST['color'])) {
            $error = "Debe añadir un color para el comentario.";
        } else {
            // Define $username and $password
            $tit=$_POST['titulo'];
            $com=$_POST['comentario'];
            $col=$_POST['color'];
            
            echo $col . ' ';
            
            if($col == 'azul') { $color = 0;}
            if($col == 'verde') { $color = 1;}
            if($col == 'rojo') { $color = 2;}
            
            echo $dni . ' ' . $asignatura . ' ' . $com . ' ' . $color . ' ' . $tit;
            
            // SQL query to fetch information of registerd users and finds user match.
            $sql3 = "INSERT INTO COMENTARIOS (DNI,CAS,C,COL,T) VALUES ('$dni',$asignatura,'$com',$color,'$tit')";
            $query3 = mysqli_query($db,$sql3);
            
            mysqli_close($db);
        
            header($location); // Redirecting To Other Page
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Cloud Diary - Añadir Comentario</title>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
        <!--Import materialize.css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
        
        <!-- Personal CSS -->
        <link type="text/css" rel="stylesheet" href="css/login.css"  media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="css/comentario.css"  media="screen,projection"/>
        
        <script src="https://use.fontawesome.com/f31f9c5054.js"></script>
        
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"/>
    </head>
    <body>
        <header>
            <nav class="top-nav">
                <div class="nav-wrapper blue darken-1">
                    <a href="index.html" class="brand-logo center" tabindex="1" role="banner">Cloud Diary<!--i class="fa fa-cloud fa-lg" aria-hidden="true"></i--></a>
                </div>
            </nav>
        </header>
        
        <nav class="hide-on-small-only">
            <div class="nav-wrapper grey lighten-5">
                <div class="col s12">
                    <a href="content.php" class="breadcrumb" tabindex="2">Mis Asignaturas</a>
                    <a <?php echo 'href="asignatura.php?id=' . $asignatura . '"'; ?> class="breadcrumb" tabindex="3"> <?php echo $row[ASI] ?></a>
                    <a <?php echo 'href="comentario.php?id=' . $asignatura . '"'; ?> class="breadcrumb" tabindex="4">Añadir Comentario</a>
                </div>
            </div>
        </nav>
        
        <div class="container">
            <div class="row">
                <div class="col s12 l8 offset-l2">
                    <h1 tabindex="5">Añadir Comentario</h1>
                    <div class="card-panel grey lighten-4">
                        <div class="row">
                            <form class="col s12" action="" method="post">
                                <?php if(isset($error)){ ?>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <div id="card-alert" class="card red lighten-5">
                                                <div class="card-content red-text">
                                                    <p><?php echo $error ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="titulo" type="text" name="titulo" class="validate" aria-required="true" data-length="30" required tabindex="6">
					<label for="tiulo">Titulo <span id="contar-titulo" aria-live="polite"></span></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <textarea id="comentario" name="comentario" class="materialize-textarea"  aria-required="true" data-length="200" required tabindex="7"></textarea>
                                        <label for="comentario">Comentario</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <fieldset>
                                            <legend tabindex="8">Color de fondo</legend>
                                            
                                            <input class="with-gap" name="color" type="radio" id="azul" value="azul" required/ tabindex="9">
                                            <label for="azul">Azul</label>
                                            
                                            <input class="with-gap" name="color" type="radio" id="verde" value="verde" tabindex="10"/>
                                            <label for="verde">Verde</label>
                                            <?php if($profesor) { ?>
                                                <input class="with-gap" name="color" type="radio" id="rojo" value="rojo"/>
                                                <label for="rojo">Rojo</label>
                                            <?php } else { ?>
                                                <input class="with-gap" name="color" type="radio" id="rojo" disabled="disabled"/>
                                                <label for="rojo">Rojo (Solo profesores)</label>
                                            <?php } ?>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="btn waves-effect waves-light orange lighten-2" type="submit" name="submit">Añadir Comentario</button>
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
