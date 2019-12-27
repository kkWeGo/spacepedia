<?php
    session_start();
    
    include '../wikiscraper.php';

	if (!isset($_SESSION["tipouser"])){
		header('Location: ../index.php');
	}
	if ($_SESSION["tipouser"]=='U'){
		header("Location: ../index.php");
	} 
    echo $_POST["txtName"];
    if (isset($_POST['btnUpdate'])){
        scrape($_POST["txtName"]);
        $_SESSION['msg'] = "Aggiornata descrizione del ".$_POST['txtTipo'].$_POST['txtName'];
    }
    $header = "Location: ../admin.php?tipo=".$_POST['txtTipo'];
    header($header);
?>