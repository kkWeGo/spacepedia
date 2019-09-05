<?php
  session_start();
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
            <li><a href="#introcorpicelesti">CORPI CELESTI</a><div></div></li>
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
                    <li><a href="admin.php?tipo=pianeti">ADMIN</a></li>
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
        <!-- DIV LISTA -->
        <div id="lista" class="lista">
            <div class="headlist">
                <p>Nome</p>
                <p>Tipo pianeta</p>
                <p>Sistema Planetario</p>
                <p>Galassia</p>
                <p>Link</p>
            </div>
            <div>
                <p>Terra</p>
                <p>Pianeta Gioviano</p>
                <p>Sistema Solare</p>
                <p>Via Lattea</p>
                <span><a href="#1">link</a></span>
            </div>
            <div>
                <p>Terra</p>
                <p>Pianeta Gioviano</p>
                <p>Sistema Solare</p>
                <p>Via Lattea</p>
                <span><a href="#2">link</a></span>
            </div>
            <div>
                <p>Terra</p>
                <p>Pianeta Gioviano</p>
                <p>Sistema Solare</p>
                <p>Via Lattea</p>
                <span><a href="#3">link</a></span>
            </div>
            <!--<div>
                <p>Terra</p>
                <p>Pianeta Gioviano</p>
                <p>Sistema Solare</p>
                <p>Via Lattea</p>
                <span><a href="#3">link</a></span>
            </div>
            <div>
                <p>Terra</p>
                <p>Pianeta Gioviano</p>
                <p>Sistema Solare</p>
                <p>Via Lattea</p>
                <span><a href="#3">link</a></span>
            </div>
            <div>
                <p>Terra</p>
                <p>Pianeta Gioviano</p>
                <p>Sistema Solare</p>
                <p>Via Lattea</p>
                <span><a href="#3">link</a></span>
            </div>
            <div>
                <p>Terra</p>
                <p>Pianeta Gioviano</p>
                <p>Sistema Solare</p>
                <p>Via Lattea</p>
                <span><a href="#3">link</a></span>
            </div>
            <div>
                <p>Terra</p>
                <p>Pianeta Gioviano</p>
                <p>Sistema Solare</p>
                <p>Via Lattea</p>
                <span><a href="#3">link</a></span>
            </div>-->
        </div>
        <script>
            setTimeout(init, 500);
            setTimeout(initb, 1000);
        </script>
    </body>
</html>