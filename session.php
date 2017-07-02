<?php
    include('conexion.php');
    session_start();// Starting Session

    // Storing Session
    $user_check=$_SESSION['login_user'];
    
    // SQL Query To Fetch Complete Information Of User
    $sql = "SELECT LOGNAME FROM USUARIOS WHERE LOGNAME='$user_check'";
    $ses_sql = mysqli_query($db,$sql);
    $row = mysqli_fetch_assoc($ses_sql);
    $login_session =$row['LOGNAME'];
    
    if(!isset($login_session)){
        mysqli_close($db); // Closing Connection
        header('Location: login.php'); // Redirecting To Home Page
    }
?>
