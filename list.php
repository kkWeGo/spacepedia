<?php
    session_start();
    include 'include/db_connection.php';
    include 'include/functions.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Spacepedia</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
        <link rel="stylesheet" type="text/css" href="css/reset.css">
        <link rel="stylesheet" type="text/css" href="css/stili.css">
        <link rel="stylesheet" type="text/css" href="css/sliderdiv.css">
        <script src="js/script.js"></script>
    </head>
    <body id="body" style="overflow: scroll" class="bg-col">
        <div id="init" class="div-center"></div>
        <!-- HERO -->
        <div class="hero herolist" id="hero">
            <div class="hero-bg"></div> 
        </div>
        <!-- DIV TITOLO -->
        <div class="title titlelist" id="title">
            <h1>Pianeti</h1>
        </div>
        <!-- NAVBAR -->
        <ul class="navbar navbarlist" id="navbar">
            <li><a href="index.php">HOME</a></li>
            <li><a href="#">CORPI CELESTI</a><div><a href="list.php?tipo=pianeta">Pianeti</a><a href="list.php?tipo=stella">Stelle</a><a href="list.php?tipo=satellite">Satelliti</a></div></li>
            <li><a href="">RAGGRUPPAMENTI</a><div></div></li>
            <li><a href="#introastronomi">ASTRONOMI</a><div></div></li>
            <?php
                if (!isset($_SESSION["tipouser"])){
            ?>
                    <li><a onclick="slidediv('div-account-l', 'div-top', 'div-center', '#hero', 1, 1, 1), slidediv('cut', 'div-left', 'div-center', '#hero', 0, 0)">LOGIN</a></li>
                    <li><a onclick="slidediv('div-account-r', 'div-top', 'div-center', '#hero', 1, 1, 1), slidediv('cut', 'div-left', 'div-center', '#hero', 0, 0);">REGISTER</a></li>
            <?php
                } else {
                if ($_SESSION["tipouser"]=='U'){
            ?>
                    <li><a>QUALCOSA</a></li>
                    <li><a onclick="slidediv('div-account-r', 'div-top', 'div-center', '#hero', 1, 1, 1), slidediv('cut', 'div-left', 'div-center', '#hero', 0, 0);">EXIT</a></li>
            <?php
                }
                if ($_SESSION["tipouser"]=='A'){
            ?>
                    <li><a href="admin.php?tipo=pianeta">ADMIN</a></li>
                    <li><a onclick="slidediv('div-account-r', 'div-top', 'div-center', '#hero', 1, 1, 1), slidediv('cut', 'div-left', 'div-center', '#hero', 0, 0);">EXIT</a></li>
            <?php
                }}
            ?>
        </ul>
        <!-- DIVS CUT, CITAZIONI E MSG -->
        <?php 
            include 'include/cit.php';
            if(isset($_SESSION['msg'])){
        ?>
                <div id="div-msg" class="div-center">
                    <span class="close"  onclick="slidediv('div-msg', 'div-right', 'div-center', '#hero', 1, 1, 1), slidediv('cut', 'div-left', 'div-center', 'hero', 0, 0)">
                        <i class="material-icons">close</i>
                    </span>
                    <h2><?php echo $_SESSION['msg']; ?></h2>
                </div>
                <script>
                    setTimeout(slidedivmsg, 3000);
                </script>
        <?php
            }
            unset($_SESSION['msg']);
        ?>
        <!-- DIV ACCOUNT LOGIN-->
        <div id="div-account-l" class="div-center">
            <span class="close"  onclick="slidediv('div-account-l', 'div-top', 'div-center', '#hero', 1, 1, 1), slidediv('cut', 'div-left', 'div-center', 'hero', 0, 0)">
                <i class="material-icons">close</i>
            </span>
            <?php
                if (!isset($_SESSION['tipouser'])){
                    include 'user/frmacc.html';
                } else {
                    include 'user/frmexit.html';
                }
            ?>
        </div>
        <!-- DIV ACCOUNT REGISTRAZIONE -->
        <div id="div-account-r" class="div-center">
            <span class="close"  onclick="slidediv('div-account-r', 'div-top', 'div-center', '#hero', 1, 1, 1), slidediv('cut', 'div-left', 'div-center', 'hero', 0, 0)">
                <i class="material-icons">close</i>
            </span>
            <?php
                if (!isset($_SESSION['tipouser'])){
                    include 'user/frmreg.html';
                } else {
                    include 'user/frmexit.html';
                }
            ?>
        </div>
        <!-- DIV RESEARCH -->
        <div id="div-search" class="div-center">
            <span class="close"  onclick="slidediv('div-search', 'div-top', 'div-center', '#hero', 1, 1, 1), slidediv('cut', 'div-left', 'div-center', '#hero', 0, 0)">
                <i class="material-icons">close</i>
            </span>
            <?php
                include 'include/frmsearch.html';
            ?>
        </div>
        <script>
            setTimeout(init, 500);
            setTimeout(initb, 1000);
        </script>
        <!-- DIV LISTA -->
        <div id="lista" class="lista">
            <?php
                switch ($_GET["tipo"]){
                    case 'pianeta':
            ?>
                        <div class="headlist pianeti">
                            <p>Nome</p>
                            <p>Tipo pianeta</p>
                            <p>Stella madre</p>
                            <p>Link</p>
                        </div>
            <?php              
                            for ($i = 0; $i < 22; $i++){
                                $query = "SELECT ID_pianeta, Nome, Classificazione, FK_StellaMadre FROM tpianeta WHERE ID_pianeta = $i";                                
                                $resulset = @mysqli_query($db_conn, $query);
                                while($row1 = mysqli_fetch_array($resulset, MYSQLI_ASSOC)) {
                                    echo '<div class="pianeti">';
                                    echo '<p>'.$row1['Nome'].'</p>';
                                    echo '<p>'.$row1['Classificazione'].'</p>';
                                    echo '<p>'.$row1['FK_StellaMadre'].'</p>';
                                    echo '<span><a href="page.php?tipo=pianeta&id='.$i.'">link</a></span>';
                                    echo '</div>';
                                } 
                            }                                          
                        break;
                    case 'stella':
            ?>
                    <div class="headlist stelle">
                        <p>Nome</p>
                        <p>Tipo stella</p>
                        <p>Sistema Planetario</p>
                        <p>Link</p>
                    </div>
            <?php
                        for ($i = 0; $i < 11; $i++){
                            $query = "SELECT ID_stella, Nome, Classificazione, FK_SistemaPlanetario FROM tstella WHERE ID_stella = $i";                                
                            $resulset = @mysqli_query($db_conn, $query);
                            while($row1 = mysqli_fetch_array($resulset, MYSQLI_ASSOC)) {
                                echo '<div class="stelle">';
                                echo '<p>'.$row1['Nome'].'</p>';
                                echo '<p>'.$row1['Classificazione'].'</p>';
                                echo '<p>'.$row1['FK_SistemaPlanetario'].'</p>';
                                echo '<span><a href="page.php?tipo=stella&id='.$i.'">link</a></span>';
                                echo '</div>';
                            } 
                        }     
                        break;
                    case 'satellite':
            ?>
                    <div class="headlist satelliti">
                        <p>Nome</p>
                        <p>Tipo satellite</p>
                        <p>Sistema Planetario</p>
                        <p>Link</p>
                    </div>
            <?php
                        for ($i = 0; $i < 11; $i++){
                            $query = "SELECT ID_satellite, Nome, Classificazione, FK_SistemaPlanetario FROM tsatelliti WHERE ID_satellite = $i";                                
                            $resulset = @mysqli_query($db_conn, $query);
                            while($row1 = mysqli_fetch_array($resulset, MYSQLI_ASSOC)) {
                                echo '<div class="satellite">';
                                echo '<p>'.$row1['Nome'].'</p>';
                                echo '<p>'.$row1['Classificazione'].'</p>';
                                echo '<p>'.$row1['FK_SistemaPlanetario'].'</p>';
                                echo '<span><a href="page.php?tipo=satellite&id='.$i.'">link</a></span>';
                                echo '</div>';
                            } 
                        }     
                        break;
                    case 'costellazione':
            ?>
                    <div class="headlist costellazioni">
                        <p>Nome</p>
                        <p>Tipo costellazione</p>
                        <p>Sistema Planetario</p>
                        <p>Link</p>
                    </div>
            <?php
                        break;
                    case 'sistemaplanetario':
            ?>
                    <div class="headlist sistemiplanetari">
                        <p>Nome</p>
                        <p>Tipo sistema planetario</p>
                        <p>Galassia</p>
                        <p>Link</p>
                    </div>
            <?php
                        break;
                    case 'galassia':
            ?>
                    <div class="headlist galassie">
                        <p>Nome</p>
                        <p>Tipo galassia</p>
                        <p>Link</p>
                    </div>
            <?php
                        break;
                    default:
                    
                }
            ?>

        </div>
    </body>
</html>