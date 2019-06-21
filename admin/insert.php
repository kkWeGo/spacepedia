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
		if (isset($_POST['btnAdd'])){
			$i = 0;
			$tipo = substr($_POST["txtTab"], 1);
			$query_nome_campi = "SELECT column_name FROM information_schema.columns WHERE table_name = "."'".$_POST["txtTab"]."'"." AND table_schema LIKE 'spazio_db'";
			$resulset_nome_campi = @mysqli_query($db_conn, $query_nome_campi);
			echo $query_nome_campi;
			while($row = mysqli_fetch_array($resulset_nome_campi, MYSQLI_ASSOC)) {
				$column_name = $row['column_name'];
				$listaCol[$i]=$column_name;
				$i = $i + 1;
			}
			$query_insert = "INSERT INTO ".$_POST["txtTab"]." (";
			for ($i=1; $i < sizeof($listaCol); $i++) { 
				if ($i == sizeof($listaCol) - 1) {
					$query_insert = $query_insert.$listaCol[$i].') VALUES (';
				} else {
					$query_insert = $query_insert.$listaCol[$i].', ';
				}
			} 
			$i = 1;
			foreach ($_POST as $prova) {
				$prova = "'".$prova."'";
				$query_insert = $query_insert.$prova;
				if ($i == sizeof($_POST)-2) {
					$query_insert = $query_insert.')';
					break;
				} else {
					$query_insert = $query_insert.', ';
				}
				echo $query_insert.'<br>';
				$i++;
			}
			echo $query_insert.'<br>';
			try{
				$resulset_insert = @mysqli_query($db_conn, $query_insert);

				if ($resulset_insert==null){
					throw new exception ("Errore");
				}else{
					header("Location: ../admin.php"."?tipo=".$tipo);
				}
			} catch (Exception $e){
				$info_message = true;
				header("Location: ../admin.php"."?tipo=".$tipo);
			}
		} else { 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Insert</title>
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
		<form class="frminsert" id="frminsert" name="frminsert" action="insert.php" method="post">
			<?php 
				$_SESSION['tipo'] = $_POST["txtTab"];
				$j = 0;
				$i = 0;
				$tab = "'".text_filter_lowercase(text_filter($_POST["txtTab"]))."'";
				$tabuq = text_filter_lowercase(text_filter($_POST["txtTab"]));
				$query_nome_campi = "SELECT column_name FROM information_schema.columns WHERE table_name = ".$tab." AND table_schema LIKE 'spazio_db'";
				$resulset_nome_campi = @mysqli_query($db_conn, $query_nome_campi);
				while($row = mysqli_fetch_array($resulset_nome_campi, MYSQLI_ASSOC)) {
					$column_name = $row['column_name'];
					$listaCol[$i]=$column_name;
					$i = $i + 1;
				}
				$query_tipo_campi = "SELECT data_type FROM information_schema.columns WHERE table_name = ".$tab." AND table_schema LIKE 'spazio_db'";
				$resulset_tipo_campi = @mysqli_query($db_conn, $query_tipo_campi);
				while($row1 = mysqli_fetch_array($resulset_tipo_campi, MYSQLI_ASSOC)) {
					$data_type = $row1['data_type'];
					$listaType[$j]=$data_type;
					$j = $j + 1;
				}
				for ($i=1; $i < sizeof($listaCol); $i++) { 
					if ((strpos($listaType[$i], 'int')) !== false) {
						echo '<input type="number" id="txt'.$listaCol[$i].'" name="txt'.$listaCol[$i].'" placeholder="'.$listaCol[$i].'" required="" maxlength="50">';
					} else if ((strpos($listaType[$i], 'enum')) !== false) {
						echo '<select name = "'.$listaCol[$i].'">Select';
						echo '<option value="" disabled selected>Select your option</option>';
						$query = "SHOW COLUMNS FROM ".$tabuq." LIKE '".$listaCol[$i]."'";
						$result = @mysqli_query($db_conn, $query);
						$row2 = mysqli_fetch_array($result);
						$row3 = explode("','",preg_replace("/(enum|set)\('(.+?)'\)/","\\2", $row2['Type']));
						for ($h=0; $h < sizeof($row3); $h++) { 
							echo '<option value = "'.$row3[$h].'">'.$row3[$h].'</option>';
						}	
         				echo '</select>';
					} else if ((strpos($listaType[$i], 'date')) !== false) {
						echo '<input type="date" id="'.$listaCol[$i].'" name="date"'.$listaCol[$i].'" required="" maxlength="50">';
					} else if ((strpos($listaType[$i], 'time')) !== false) {
						echo '<input type="time" id="'.$listaCol[$i].'" name="time"'.$listaCol[$i].'" required="" maxlength="50">';
					} else if ((strpos($listaType[$i], 'char')) !== false) {
						if ((strpos($listaCol[$i], 'mail'))  !== false){
							echo '<input type="email" id="txtEmail" name="txtEmail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="'.$listaCol[$i].'" required="" maxlength="50">';
						} else if ((strpos($listaCol[$i], 'password')) !== false){
							echo '<input type="password" id="txt'.$listaCol[$i].'" name="txt'.$listaCol[$i].'" placeholder="'.$listaCol[$i].'" required="" minlenght="8" maxlength="20">';
						} else {
							echo '<input type="text" id="txt'.$listaCol[$i].'" name="txt'.$listaCol[$i].'" placeholder="'.$listaCol[$i].'" required="" maxlength="20">';
						}
					}
				}	
			?>
			<input type="text" id="txtTab" name="txtTab" value="<?php echo $tabuq?>" hidden>
			<button type="submit" id="btnAdd" name="btnAdd">Clicca qui per inserire in <?php echo $_POST["txtTab"];?></button>
		</form>
    </body>
</html>
<?php
		}
	}
?>