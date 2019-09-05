<?php
	session_start();
	if (!isset($_SESSION["tipouser"])){
		header('Location: ../index.php');
	}
	if ($_SESSION["tipouser"]=='U'){
		header("Location: ../index.php");
	} 
	include '../include/db_connection.php';
	include '../include/functions.php';

	if (!$error_message){
        if (isset($_POST['btnDelete'])){
			$id = text_filter($_POST['txtId']);
			$query_delete = "DELETE FROM ".$_POST['txtTab']." WHERE ".$_POST['txtIdTab']." = ".$id;
            try{
				$resultset_delete = mysqli_query($db_conn, $query_delete);
                if ($resultset_delete==null){
					throw new exception ("Errore in elimina".$_POST['txtTab']."!");
				} else {
					$header = "Location: ../admin.php?tipo=".$_POST['txtTipo'];
					$_SESSION['msg'] = "Eliminato da ".$_POST['txtTipo']." elemento con ID ".$_POST['txtId'];
					header($header);
				}
            } catch (Exception $e){
				$info_message = true;
				$_SESSION['msg'] = $e->getMessage();
            }
		}
	}
?>