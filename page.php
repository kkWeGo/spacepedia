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
        <!-- DIV PAGINA -->
        <div id="pagina" class="pagina">
            <div class="titpag"><h2>Titolo</h2></div>
            <div class="testopagina">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis vel est at leo posuere porta sed a nulla. Nam id blandit diam, eget fermentum leo. Phasellus sodales laoreet lacus, at ullamcorper nunc pharetra ut. Morbi a mauris laoreet, fermentum libero quis, vulputate lectus. Donec nibh nulla, tempor nec varius et, blandit a tortor. Sed eget tristique est. Vestibulum feugiat vel dolor at congue. Phasellus vel dictum lectus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In interdum fermentum massa id faucibus.Pellentesque vitae suscipit felis, sed malesuada est. In hac habitasse platea dictumst. Proin consequat ante nec facilisis aliquam. Mauris ultrices tempus justo, sit amet elementum dui tempor quis. Aenean nec metus ut diam mollis sodales eget id odio. Duis et lectus bibendum, ultricies est id, finibus nisi. Morbi elit erat, commodo at pharetra a, venenatis id lacus. Suspendisse lobortis tincidunt neque, venenatis euismod justo. Maecenas eget elementum magna, non accumsan mauris.Donec scelerisque nunc a placerat scelerisque. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sed magna vel arcu tristique sagittis efficitur sed nunc. Vivamus et enim nibh. Sed in interdum lorem. Donec sit amet ipsum efficitur ligula scelerisque luctus id id libero. Sed sit amet accumsan sem. Duis varius tincidunt erat nec eleifend. Nullam a tempor lacus. Donec pellentesque aliquet nulla et elementum. Cras volutpat erat accumsan eleifend pretium. Suspendisse ac gravida purus, eget eleifend ante. Vestibulum rutrum convallis odio sed fringilla. Nunc eu luctus eros, ac iaculis justo.Donec quis euismod eros, eu tincidunt metus. Aliquam id dui quis nulla mattis dictum. Cras molestie urna vitae libero semper iaculis. Sed elementum sit amet lacus non maximus. Aenean porttitor blandit gravida. Ut pharetra varius nulla sed vulputate. Ut sollicitudin ornare augue, ac egestas est maximus eu. Integer fermentum, orci at interdum ullamcorper, lacus augue pulvinar erat, eu rhoncus libero magna id dui.Mauris sodales, sem nec semper viverra, metus urna condimentum orci, et finibus metus sem interdum felis. Phasellus feugiat accumsan nunc vel fringilla. Nunc tempus mauris odio, eget suscipit mauris facilisis ac. Phasellus dictum semper lorem a cursus. Sed vehicula ipsum maximus massa suscipit, a suscipit tortor auctor. Nam posuere dolor in dolor condimentum, quis laoreet enim hendrerit. Vestibulum at feugiat ligula. Nullam vel diam id ex scelerisque tempor. Donec at arcu bibendum, dictum dui id, dignissim massa. Aenean consequat scelerisque ipsum non iaculis. Donec molestie gravida elit. Ut in cursus orci. Aenean ac orci eros. Integer gravida dui magna, maximus facilisis ligula suscipit non. Cras eu orci ipsum.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis vel est at leo posuere porta sed a nulla. Nam id blandit diam, eget fermentum leo. Phasellus sodales laoreet lacus, at ullamcorper nunc pharetra ut. Morbi a mauris laoreet, fermentum libero quis, vulputate lectus. Donec nibh nulla, tempor nec varius et, blandit a tortor. Sed eget tristique est. Vestibulum feugiat vel dolor at congue. Phasellus vel dictum lectus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In interdum fermentum massa id faucibus.Pellentesque vitae suscipit felis, sed malesuada est. In hac habitasse platea dictumst. Proin consequat ante nec facilisis aliquam. Mauris ultrices tempus justo, sit amet elementum dui tempor quis. Aenean nec metus ut diam mollis sodales eget id odio. Duis et lectus bibendum, ultricies est id, finibus nisi. Morbi elit erat, commodo at pharetra a, venenatis id lacus. Suspendisse lobortis tincidunt neque, venenatis euismod justo. Maecenas eget elementum magna, non accumsan mauris.Donec scelerisque nunc a placerat scelerisque. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sed magna vel arcu tristique sagittis efficitur sed nunc. Vivamus et enim nibh. Sed in interdum lorem. Donec sit amet ipsum efficitur ligula scelerisque luctus id id libero. Sed sit amet accumsan sem. Duis varius tincidunt erat nec eleifend. Nullam a tempor lacus. Donec pellentesque aliquet nulla et elementum. Cras volutpat erat accumsan eleifend pretium. Suspendisse ac gravida purus, eget eleifend ante. Vestibulum rutrum convallis odio sed fringilla. Nunc eu luctus eros, ac iaculis justo.Donec quis euismod eros, eu tincidunt metus. Aliquam id dui quis nulla mattis dictum. Cras molestie urna vitae libero semper iaculis. Sed elementum sit amet lacus non maximus. Aenean porttitor blandit gravida. Ut pharetra varius nulla sed vulputate. Ut sollicitudin ornare augue, ac egestas est maximus eu. Integer fermentum, orci at interdum ullamcorper, lacus augue pulvinar erat, eu rhoncus libero magna id dui.Mauris sodales, sem nec semper viverra, metus urna condimentum orci, et finibus metus sem interdum felis. Phasellus feugiat accumsan nunc vel fringilla. Nunc tempus mauris odio, eget suscipit mauris facilisis ac. Phasellus dictum semper lorem a cursus. Sed vehicula ipsum maximus massa suscipit, a suscipit tortor auctor. Nam posuere dolor in dolor condimentum, quis laoreet enim hendrerit. Vestibulum at feugiat ligula. Nullam vel diam id ex scelerisque tempor. Donec at arcu bibendum, dictum dui id, dignissim massa. Aenean consequat scelerisque ipsum non iaculis. Donec molestie gravida elit. Ut in cursus orci. Aenean ac orci eros. Integer gravida dui magna, maximus facilisis ligula suscipit non. Cras eu orci ipsum.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis vel est at leo posuere porta sed a nulla. Nam id blandit diam, eget fermentum leo. Phasellus sodales laoreet lacus, at ullamcorper nunc pharetra ut. Morbi a mauris laoreet, fermentum libero quis, vulputate lectus. Donec nibh nulla, tempor nec varius et, blandit a tortor. Sed eget tristique est. Vestibulum feugiat vel dolor at congue. Phasellus vel dictum lectus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In interdum fermentum massa id faucibus.Pellentesque vitae suscipit felis, sed malesuada est. In hac habitasse platea dictumst. Proin consequat ante nec facilisis aliquam. Mauris ultrices tempus justo, sit amet elementum dui tempor quis. Aenean nec metus ut diam mollis sodales eget id odio. Duis et lectus bibendum, ultricies est id, finibus nisi. Morbi elit erat, commodo at pharetra a, venenatis id lacus. Suspendisse lobortis tincidunt neque, venenatis euismod justo. Maecenas eget elementum magna, non accumsan mauris.Donec scelerisque nunc a placerat scelerisque. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sed magna vel arcu tristique sagittis efficitur sed nunc. Vivamus et enim nibh. Sed in interdum lorem. Donec sit amet ipsum efficitur ligula scelerisque luctus id id libero. Sed sit amet accumsan sem. Duis varius tincidunt erat nec eleifend. Nullam a tempor lacus. Donec pellentesque aliquet nulla et elementum. Cras volutpat erat accumsan eleifend pretium. Suspendisse ac gravida purus, eget eleifend ante. Vestibulum rutrum convallis odio sed fringilla. Nunc eu luctus eros, ac iaculis justo.Donec quis euismod eros, eu tincidunt metus. Aliquam id dui quis nulla mattis dictum. Cras molestie urna vitae libero semper iaculis. Sed elementum sit amet lacus non maximus. Aenean porttitor blandit gravida. Ut pharetra varius nulla sed vulputate. Ut sollicitudin ornare augue, ac egestas est maximus eu. Integer fermentum, orci at interdum ullamcorper, lacus augue pulvinar erat, eu rhoncus libero magna id dui.auris sodales, sem nec semper viverra, metus urna condimentum orci, et finibus metus sem interdum felis. Phasellus feugiat accumsan nunc vel fringilla. Nunc tempus mauris odio, eget suscipit mauris facilisis ac. Phasellus dictum semper lorem a cursus. Sed vehicula ipsum maximus massa suscipit, a suscipit tortor auctor. Nam posuere dolor in dolor condimentum, quis laoreet enim hendrerit. Vestibulum at feugiat ligula. Nullam vel diam id ex scelerisque tempor. Donec at arcu bibendum, dictum dui id, dignissim massa. Aenean consequat scelerisque ipsum non iaculis. Donec molestie gravida elit. Ut in cursus orci. Aenean ac orci eros. Integer gravida dui magna, maximus facilisis ligula suscipit non. Cras eu orci ipsum.
                    <span></span>               
                </p>
            </div>
            <div class="imgpag"><img src="img/pianeta.jpg" alt="img"></div>
            <div class="attributi">
                <ul>
                    <li>ciao: come vaS</li>
                    <li>ciao2</li>
                    <li>ciao: come vaS</li>
                    <li>ciao3</li>
                    <li>ciao: come vaS</li>
                    <li>ciao4</li>
                    <li>ciao: come vaS</li>
                    <li>ciao5</li>

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