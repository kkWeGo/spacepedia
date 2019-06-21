<?php
    include '../include/db_connection.php';
    include '../include/functions.php';
    
    session_start();

    
    $trovato_utente  = false;   
    if (isset($_POST['btnlogout'])) {
        session_destroy();
        header("Location: ../index.php");	
    }

    if (!$error_message) {
        if (isset($_POST['btnacc'])) {
            $mail     = text_filter_lowercase($_POST["txtEmail"]);
            $password = text_filter_lowercase($_POST["txtPassword"]);
            
            $query_utenti   = "SELECT * FROM tutenti";       
            $resulset_utenti = @mysqli_query($db_conn, $query_utenti);

            while($row = mysqli_fetch_array($resulset_utenti, MYSQLI_ASSOC)) {
                $email = $row["Email"];
                $pass = $row["Password"];
                echo $mail.' form<br>';
                echo $password.' form<br>';
                echo $email.' db<br>';
                echo $pass.' db<br>';
                if ($mail == $email && $password==$pass) {
                    $_SESSION['tipouser'] = $row["Tipo"];
                    $_SESSION['nome'] = $row["Email"];					
                }
            }
        }
        if(!isset($_SESSION['tipouser']))				
            header("Location: ../index.php");
        if($_SESSION["tipouser"] == 'U')					
            header("Location: ../index.php");	
        if($_SESSION["tipouser"] == 'A')					
            header("Location: ../admin.php?tipo=pianeti");
    }
    header("Location: ../index.php");
?>
