<?php
	session_start();
	if (!isset($_SESSION["tipouser"])){
		header('Location: ../index.php');
	}
	if ($_SESSION["tipouser"]=='U'){
		header("Location: index.php");
	} 
	include '../include/db_connection.php';
	include '../include/functions.php';	
	if (!$error_message){
		if (isset($_POST['btnEdit'])){
			$i = 0;
			$tipo = substr($_POST["txtTab"], 1);
			$idtab = $_POST["txtIdTab"];
			$id = $_POST["txtId"];
			$query_nome_campi = "SELECT column_name FROM information_schema.columns WHERE table_name = "."'".$_POST["txtTab"]."'"." AND table_schema LIKE 'dbspacepedia'";
			$resulset_nome_campi = @mysqli_query($db_conn, $query_nome_campi);
			while($row = mysqli_fetch_array($resulset_nome_campi, MYSQLI_ASSOC)) {
				$column_name = $row['column_name'];
				$listaCol[$i]=$column_name;
				$i = $i + 1;
			}
			$query_update = "UPDATE ".$_POST["txtTab"]." SET ";
			$i=0;
			foreach ($_POST as $prova) {
				$prova = "'".$prova."'";
				if ($i == sizeof($_POST)-5) {
					$query_update = $query_update.$listaCol[$i+1].'='.$prova;
					break;
				} else {
					$query_update = $query_update.$listaCol[$i+1].'='.$prova.', ';
				}
				$i++;
			}
			echo $query_update;
			$query_update = $query_update." WHERE ".$idtab."=". $id;
			echo $query_update;
			try{
				$resulset_update = @mysqli_query($db_conn, $query_update);

				if ($resulset_update==null){
					throw new exception ("Errore");
				}else{
					$_SESSION['msg'] = "Modificato da ".$tipo." elemento con ID ".$_POST['txtId'];
					header("Location: ../admin.php"."?tipo=".$tipo);
				}
			} catch (Exception $e){
				$info_message = true;
				$_SESSION['msg'] = $e->getMessage();
				header("Location: ../admin.php"."?tipo=".$tipo);
			}
		} else { 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Modify</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
        <link rel="stylesheet" type="text/css" href="../css/reset.css">
        <link rel="stylesheet" type="text/css" href="../css/sliderdiv.css">
        <link rel="stylesheet" type="text/css" href="../css/stili.css">
        <script defer src="../js/script.js"></script>
    </head>
    <body id="body">
		<div class="admin"><a href="../index.php">Home</a><a href= <?php echo '"../admin.php?tipo='.substr($_POST["txtTab"], 1).'"';?>>Back to tables</a></div>
		<form class="frmmodify" id="frmmodify" name="frmmodify" action="modify.php" method="post">
			<?php 
				$_SESSION['tipo'] = $_POST["txtTab"];
				$j = 0;
                $i = 0;
                $f = 0;
				$tab = "'".text_filter_lowercase(text_filter($_POST["txtTab"]))."'";
                $tabuq = text_filter_lowercase(text_filter($_POST["txtTab"]));
                $id = text_filter_lowercase(text_filter($_POST["txtId"]));
				$query_nome_campi = "SELECT column_name FROM information_schema.columns WHERE table_name = ".$tab." AND table_schema LIKE 'dbspacepedia'";
                $resulset_nome_campi = @mysqli_query($db_conn, $query_nome_campi);
				while($row = mysqli_fetch_array($resulset_nome_campi, MYSQLI_ASSOC)) {
					$column_name = $row['column_name'];
					$listaCol[$i]=$column_name;
					$i = $i + 1;
				}
				$query_tipo_campi = "SELECT data_type FROM information_schema.columns WHERE table_name = ".$tab." AND table_schema LIKE 'dbspacepedia'";
				$resulset_tipo_campi = @mysqli_query($db_conn, $query_tipo_campi);
				while($row1 = mysqli_fetch_array($resulset_tipo_campi, MYSQLI_ASSOC)) {
					$data_type = $row1['data_type'];
					$listaType[$j]=$data_type;
					$j = $j + 1;
                }
                $query_valori_campi = "SELECT * FROM ".$tabuq." WHERE ".$listaCol[0]."=".$id;
				$resulset_valori_campi = @mysqli_query($db_conn, $query_valori_campi);
                $row4 = mysqli_fetch_array($resulset_valori_campi, MYSQLI_NUM);
                for ($f=0; $f < sizeof($row4); $f++) { 
                    $valori = $row4[$f];
                    $listaValori[$f]=$valori;
                }
				for ($i=1; $i < sizeof($listaCol); $i++) { 
					echo '<label for="'.$listaCol[$i].'">'.$listaCol[$i].'</label>';
					if ((strpos($listaType[$i], 'int')) !== false) {
						echo '<input type="number" id="'.$listaCol[$i].'" name="txt'.$listaCol[$i].'" placeholder="'.$listaValori[$i].'" required="" maxlength="50" value="'.$listaValori[$i].'">';
					} else if ((strpos($listaType[$i], 'enum')) !== false) {
						echo '<select name = "'.$listaCol[$i].'">Select';
						echo '<option value="" disabled>Select your option</option>';
						$query = "SHOW COLUMNS FROM ".$tabuq." LIKE '".$listaCol[$i]."'";
						$result = @mysqli_query($db_conn, $query);
						$row2 = mysqli_fetch_array($result);
						$row3 = explode("','",preg_replace("/(enum|set)\('(.+?)'\)/","\\2", $row2['Type']));
                        for ($h=0; $h < sizeof($row3); $h++) {
                            echo $row3[$h]."<br>";
                            if ($row3[$h] == $listaValori[$i]) {
                                echo '<option value = "'.$row3[$h].' selected">'.$row3[$h].'</option>';
                            } else {
                                echo '<option value = "'.$row3[$h].'">'.$row3[$h].'</option>';
                            }
						}	
         				echo '</select>';
					} else if ((strpos($listaType[$i], 'date')) !== false) {
						echo '<input type="date" id="'.$listaCol[$i].'" name="date"'.$listaCol[$i].'" required="" maxlength="50" value="'.$listaValori[$i].'">';
					} else if ((strpos($listaType[$i], 'time')) !== false) {
						echo '<input type="time" id="'.$listaCol[$i].'" name="time"'.$listaCol[$i].'" required="" maxlength="50" value="'.$listaValori[$i].'">';
					} else if ((strpos($listaType[$i], 'char')) !== false) {
						if ((strpos($listaCol[$i], 'mail'))  !== false){
							echo '<input type="email" id="txtEmail" name="txtEmail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder='.$listaValori[$i].'" required="" maxlength="50" value="'.$listaValori[$i].'">';
						} else if ((strpos($listaCol[$i], 'password')) !== false){
							echo '<input type="password" id="txt'.$listaCol[$i].'" name="txt'.$listaCol[$i].'" placeholder="'.$listaValori[$i].'" required="" minlenght="8" maxlength="20" value="'.$listaValori[$i].'">';
						} else {
							echo '<input type="text" id="txt'.$listaCol[$i].'" name="txt'.$listaCol[$i].'" placeholder="'.$listaValori[$i].'" required="" maxlength="20" value="'.$listaValori[$i].'">';
						}
					}
				}	
			?>
			<input type="text" id="txtTab" name="txtTab" value="<?php echo $tabuq?>" hidden>
            <input type="text" id="txtId" name="txtId" value="<?php echo $id?>" hidden>
			<input type="text" id="txtIdTab" name="txtIdTab" value="<?php echo $listaCol[0]?>" hidden>
			<button type="submit" id="btnEdit" name="btnEdit">Edit</button>
		</form>
    </body>
</html>
<?php
		}
	}
?>