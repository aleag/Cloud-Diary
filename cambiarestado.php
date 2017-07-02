<?php
    include('session.php');
    
    $sql = "SELECT ESTADO FROM PROFESORES NATURAL JOIN USUARIOS WHERE LOGNAME='$login_session'";
    $query = mysqli_query($db,$sql);
    $row = mysqli_fetch_assoc($query);
    
    if ($row[ESTADO] == 0) {
        $update = "UPDATE PROFESORES SET ESTADO=1 WHERE DNI IN (SELECT DNI FROM USUARIOS WHERE LOGNAME='$login_session');";
        $query = mysqli_query($db,$update);
    } else if ($row[ESTADO] == 1) {
        $update = "UPDATE PROFESORES SET ESTADO=0 WHERE DNI IN (SELECT DNI FROM USUARIOS WHERE LOGNAME='$login_session');";
        $query = mysqli_query($db,$update);
    }
?>