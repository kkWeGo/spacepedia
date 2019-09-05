<?php
	session_start();
	if (!isset($_SESSION["tipouser"])){
		header('Location: index.php');
	}
	if ($_SESSION["tipouser"]=='U'){
		header("Location: index.php");
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Spacepedia admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
        <link rel="stylesheet" type="text/css" href="css/reset.css">
        <link rel="stylesheet" type="text/css" href="css/sliderdiv.css">
        <link rel="stylesheet" type="text/css" href="css/stili.css">
        <script src="js/script.js"></script>
    </head>
    <body id="body">
		<?php 
			if(isset($_SESSION['msg'])){
		?>
				<div id="div-msg" class="div-center">
					<span class="close"  onclick="slidediv('div-msg', 'div-right', 'div-center', '#hero', 0, 0)">
						<i class="material-icons">close</i>
					</span>
					<h2><?php echo $_SESSION['msg']; ?></h2>
				</div>
				<script>
					setTimeout(slidedivmsgadmin, 3000);
				</script>
        <?php
            }
            unset($_SESSION['msg']);
            $idtab = "ID_".$_GET['tipo'];
            $tab = "'t".$_GET['tipo']."'";
            $tabtosend = "t".$_GET['tipo']; 
            $i = 0;
		?>
		<div class="admin"><a href="index.php">Home</a></div>
        <select class="admin" name="tablist" onchange="location = this.value;">
			<option value="admin.php?tipo=corpicelesti" <?php if($_GET['tipo'] == 'corpicelesti'){echo ' selected';}?>>Corpi Celesti</option>
			<option value="admin.php?tipo=pianeti" <?php if($_GET['tipo'] == 'pianeti'){echo ' selected';}?>>Pianeti</option>
            <option value="admin.php?tipo=stelle" <?php if($_GET['tipo'] == 'stelle'){echo ' selected';}?>>Stelle</option>
            <option value="admin.php?tipo=satelliti" <?php if($_GET['tipo'] == 'satelliti'){echo ' selected';}?>>Satelliti</option>
            <option value="admin.php?tipo=astronomi" <?php if($_GET['tipo'] == 'astronomi'){echo ' selected';}?>>Astronomi</option>
            <option value="admin.php?tipo=sistemiplanetari" <?php if($_GET['tipo'] == 'sistemiplanetari'){echo ' selected';}?>>Sistemi Planetari</option>
            <option value="admin.php?tipo=costellazioni" <?php if($_GET['tipo'] == 'costellazioni'){echo ' selected';}?>>Costellazioni</option>
            <option value="admin.php?tipo=galassie" <?php if($_GET['tipo'] == 'galassie'){echo ' selected';}?>>Galassie</option>
            <option value="admin.php?tipo=utenti" <?php if($_GET['tipo'] == 'utenti'){echo ' selected';}?>>Utenti</option>
        </select>
        <form class="admin" id="frminsert" name="frmInsert" method="post" action="admin/insert.php">
            <input type="text" id="txtTab" name="txtTab" value="<?php echo $tabtosend?>" hidden>
            <button class="tab-button" id="btnInsert" name="btnInsert">Add new</button>
		</form>
		<div class="tableadmin">
			<table class="admin">
				<thead>
					<tr>
						<th>Elimina</th>
						<th>Modifica</th>
						<?php
							include 'include/db_connection.php';
							include 'include/functions.php';
							$query_nome_campi = "SELECT column_name FROM information_schema.columns WHERE table_name = $tab  AND table_schema LIKE 'spazio_db'";
							$resulset_nome_campi = @mysqli_query($db_conn, $query_nome_campi);
							while($row = mysqli_fetch_array($resulset_nome_campi, MYSQLI_ASSOC)) {
								$column_name = $row['column_name'];
								echo '<th>'.$column_name.'</th>';
								$listaCol[$i]=$column_name;
								$i = $i + 1;
							}
						?>
					</tr>
				</thead>
				<tbody>
					<?php
						$query = "SELECT ";
						for ($i=0; $i < sizeof($listaCol); $i++) { 
							
							if ($i == sizeof($listaCol)-1) {
								$query = $query."q.".$listaCol[$i]." ";
							} else {
								$query = $query."q.".$listaCol[$i].", ";
							}
						}
						$query = $query."FROM ".$tabtosend." as q";
						$resulset = @mysqli_query($db_conn, $query);
						while($row1 = mysqli_fetch_array($resulset, MYSQLI_ASSOC)) {
					?>
						<tr>
							<td>
								<form id="frmElimina" name="frmElimina" method="post" action="admin/delete.php">
									<input type="text" id="txtId" name="txtId" value="<?php echo $row1[$listaCol[0]]?>" hidden>
									<input type="text" id="txtTab" name="txtTab" value="<?php echo $tabtosend?>" hidden>
									<input type="text" id="txtIdTab" name="txtIdTab" value="<?php echo $idtab?>" hidden>
									<input type="text" id="txtTipo" name="txtTipo" value="<?php echo $_GET['tipo']?>" hidden>
									<button id="btnDelete" name="btnDelete"><i class="material-icons">remove</i></button>
								</form>
							</td>
							<td>
								<form id="frmModifica" name="frmModica" method="post" action="admin/modify.php">
									<input type="text" id="txtId" name="txtId" value="<?php echo $row1[$listaCol[0]]?>" hidden>
									<input type="text" id="txtTab" name="txtTab" value="<?php echo $tabtosend?>" hidden>
									<input type="text" id="txtIdTab" name="txtIdTab" value="<?php echo $idtab?>" hidden>
									<button id="btnModifica" name="btnModifica"><i class="material-icons">edit</i></button>
								</form>
							</td>
							<?php
								for ($i=0; $i < sizeof($listaCol); $i++) { 
									echo '<td class="">'.$row1[$listaCol[$i]];'</td>';
								}
							?>
						</tr>
					<?php 
					}
					?>
				</tbody>
			</table>
		</div>
    </body>
</html>
