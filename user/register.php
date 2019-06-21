<?php
    include '../include/db_connection.php';
    include '../include/functions.php';
    
    session_start();

    if (!$error_message) {
        if (isset($_POST['btnreg'])) {
            $mail     = text_filter_lowercase($_POST["txtEmail"]);
            $password = text_filter_lowercase($_POST["txtPassword"]);
            $passwordconfirm = text_filter_lowercase($_POST["txtConfermaPassword"]);
            $tipo     = 'U';
            if ($password != $passwordconfirm) {
                $_SESSION['msg'] = 'Le password non corrispondono!';
                header("Location: ../index.php");
            } else {
                $query = "INSERT INTO tutenti (email, password, tipo) VALUES('$mail', '$password', '$tipo')";
                try{
                    $insert = mysqli_query($db_conn, $query);
                    if ($insert==null){ 
                        throw new exception ("Something bad has happened"); 
                    } 
                    $_SESSION['msg'] = 'Utente creato!';                               
                    header("Location: ../index.php");
                } catch (Exception $e){               
                    $info_message = true;
                    $_SESSION['msg'] = $e->getMessage();
                }    
            }        
        } else {
            header("Location: ../index.php");
        }
    } else {
        header("Location: ../index.php");
    }
?>