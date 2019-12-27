<?php
    session_start();
    include 'include/db_connection.php';
    $colId = "ID_".$_GET["tipo"];
    //echo $colId;
    $id = $_GET["id"];
    $tabname = "t".$_GET["tipo"];
    $query_valori = "SELECT * FROM ".$tabname." WHERE ".$colId."=".$id;
    //echo $query_valori;
    $resulset_valori = @mysqli_query($db_conn, $query_valori);
    $val = mysqli_fetch_array($resulset_valori);
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
            <h1><?php echo ucfirst($_GET["tipo"]); ?></h1>
        </div>
        <!-- NAVBAR -->
        <ul class="navbar navbarlist" id="navbar">
            <li><a href="index.php">HOME</a></li>
            <li><a href="#introcorpicelesti">CORPI CELESTI</a><div><a href="list.php?tipo=pianeta">Pianeti</a><a href="list.php?tipo=stella">Stelle</a><a href="list.php?tipo=satellite">Satelliti</a></div></li>
            <li><a href="#introraggruppamenti">RAGGRUPPAMENTI</a><div></div></li>
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
        <!-- DIV PAGINA -->
        <div id="pagina" class="pagina">
            <div class="titpag"><h2><?php echo $val["Nome"]; ?></h2></div>
            <div class="testopagina">
                <p>
                    <?php
                        //$fpath = 'pages/'.$val[].'.txt';
                        $fpath = $val['Descrizione'];
                        $text = file_get_contents($fpath);
                        echo $text;
                    ?>
                    <span></span>               
                </p>
            </div>
            <div class="imgpag"><img src="img/pianeta.jpg" alt="img"></div>
            <div class="attributi">
                <ul>
                    <?php
                        include 'include/db_connection.php';
                        include 'include/functions.php';

                        $tab = "'t".$_GET['tipo']."'";

                        $query_nome_campi = "SELECT column_name FROM information_schema.columns WHERE table_name = $tab  AND table_schema LIKE 'dbspacepedia'";

                        $result_nome_campi = @mysqli_query($db_conn, $query_nome_campi);
                        
                        $tab = "t".$_GET['tipo'];

                        $query_valori = "SELECT * FROM ".$tab." WHERE ID_pianeta = ".$_GET["id"];

                        $result_valori = @mysqli_query($db_conn, $query_valori);
                        
                        $valori = mysqli_fetch_array($result_valori, MYSQLI_ASSOC);
                        
                        while($row = mysqli_fetch_array($result_nome_campi, MYSQLI_ASSOC)) {
                            foreach($row as $s)
                            {
                                if (stripos($s, 'ID_') === false){
                                    if (stripos($s, 'FK_') === false){
                                        $words = preg_replace('/(?<!\ )[A-Z]/', ' $0', $s); 
                                        echo '<li class="tipo">'.$words."</li>";
                                        echo '<li class="valore">'.$valori[$s]."</li>";
                                    } else {
                                        $words = preg_replace('/(?<!\ )[A-Z]/', ' $0', substr($s, 3)); 
                                        echo '<li class="tipo">'.$words."</li>";
                                    }                                    
                                } 
                            }
                        }                   
                    ?>
                    

                </ul>
            </div>
            <?php
                switch ($_GET["tipo"]){
                    case 'pianeta':
            ?>
            <?php
                        break;
                    case 'stella': 
            ?>
            <?php
                        break;
                    case 'satellite':
            ?>
            <?php
                        break;
                    case 'costellazione':
            ?>
            <?php
                        break;
                    case 'sistemaplanetario':
            ?>
            <?php
                        break;
                    case 'galassia':
            ?>
            <?php
                        break;
                    default:
                }
            ?>
        </div>
        <script>
            setTimeout(init, 500);
            setTimeout(initb, 1000);
        </script>
    </body>
</html>