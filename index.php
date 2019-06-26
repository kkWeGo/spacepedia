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
    <body id="body" onscroll="scroll()" style="overflow: scroll">
        <!-- BTN BACK TO TOP -->
        <span onclick="doRedirect('#hero')" class="backtop"><i class="material-icons">keyboard_arrow_up</i><i>Top</i></span>
        <!-- INIT PER ANIMATION -->
        <div id="init" class="div-center"></div>
        <!-- HERO -->
        <div class="hero" id="hero">
            <div class="hero-bg">
                <!-- DIV TITOLO -->
                <div class="title" id="title">
                    <h1>Spacepedia</h1>
                    <h3>l'enciclopedia dell'universo</h3>
                </div>
            </div> 
        </div>
        <!-- NAVBAR -->
        <span class="navbarbg"></span>
        <ul class="navbar notfixed" id="navbar">
            <li><a href="#introcorpicelesti">CORPI CELESTI</a></li>
            <li><a href="#introraggruppamenti">RAGGRUPPAMENTI</a></li>
            <li><a href="#introastronomi">ASTRONOMI</a></li>
            <li><a onclick="slidediv('div-search', 'div-top', 'div-center', '#hero', 1, 1), slidediv('cut', 'div-left', 'div-center', '#hero', 0, 0)">SEARCH</a></li>
            <?php
                if (!isset($_SESSION["tipouser"])){
            ?>
                    <li><a onclick="slidediv('div-account-l', 'div-top', 'div-center', '#hero', 1, 1), slidediv('cut', 'div-left', 'div-center', '#hero', 0, 0)">LOGIN</a></li>
                    <li><a onclick="slidediv('div-account-r', 'div-top', 'div-center', '#hero', 1, 1), slidediv('cut', 'div-left', 'div-center', '#hero', 0, 0);">REGISTER</a></li>
            <?php
                } else {
                if ($_SESSION["tipouser"]=='U'){
            ?>
                    <li><a>QUALCOSA</a></li>
                    <li><a onclick="slidediv('div-account-r', 'div-top', 'div-center', '#hero', 1, 1), slidediv('cut', 'div-left', 'div-center', '#hero', 0, 0);">EXIT</a></li>
            <?php
                }
                if ($_SESSION["tipouser"]=='A'){
            ?>
                    <li><a href="admin.php?tipo=pianeti">ADMIN</a></li>
                    <li><a onclick="slidediv('div-account-r', 'div-top', 'div-center', '#hero', 1, 1), slidediv('cut', 'div-left', 'div-center', '#hero', 0, 0);">EXIT</a></li>
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
                    <span class="close"  onclick="slidediv('div-msg', 'div-right', 'div-center', '#hero', 1, 1), slidediv('cut', 'div-left', 'div-center', 'hero', 0, 0)">
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
            <span class="close"  onclick="slidediv('div-account-l', 'div-top', 'div-center', '#hero', 1, 1), slidediv('cut', 'div-left', 'div-center', 'hero', 0, 0)">
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
            <span class="close"  onclick="slidediv('div-account-r', 'div-top', 'div-center', '#hero', 1, 1), slidediv('cut', 'div-left', 'div-center', 'hero', 0, 0)">
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
            <span class="close"  onclick="slidediv('div-search', 'div-top', 'div-center', '#hero', 1, 1), slidediv('cut', 'div-left', 'div-center', '#hero', 0, 0)">
                <i class="material-icons">close</i>
            </span>
            <?php
                include 'include/frmsearch.html';
            ?>
        </div>
        <!-- DIV CORPI CELESTI -->
        <div class="introcorpicelesti content" id="introcorpicelesti">
            <h1>Corpi Celesti</h1>
            <span class="leftline"></span>
            <p>Un oggetto celeste (dal latino caelum: cielo) o oggetto astronomico è un'entità fisica naturale, un'associazione o una struttura la cui esistenza nell'universo osservabile è stata appurata dalle attuali conoscenze scientifiche. A volte per lo stesso concetto si utilizza anche la dizione "corpo celeste", anche se in genere si preferisce il termine "corpo" quando ci si riferisce a una struttura unitaria e coesiva tenuta insieme dalla forza di gravità (o talvolta dalla forza elettromagnetica) come nel caso di asteroidi, satelliti naturali, pianeti e stelle. Gli oggetti celesti sono strutture legate gravitazionalmente che sono associate a una posizione nello spazio, ma possono consistere di singoli oggetti o corpi. Questi oggetti vanno da singoli pianeti ad ammassi stellari, nebulose o intere galassie. Le galassie a loro volta sono ordinate in una struttura gerarchica dell'universo, che include ammassi e superammassi di galassie ulteriormente organizzati in grandi filamenti, le strutture più estese attualmente note. Una cometa può essere descritta come un corpo celeste, se ci si riferisce solo al suo nucleo ghiacciato e alle polveri, o meglio come "oggetto" quando la si considera nel suo insieme includendo il nucleo, la chioma e la coda. Alcuni oggetti celesti, come Temi e Neith, sono considerati, alla luce di più recenti scoperte, completamente inesistenti. In altri casi, come per Plutone e Cerere, è stata stabilita una classificazione diversa da quella adottata precedentemente.</p>
            <h3>Clicca le card<br>per saperne di più</h3>
            <i class="material-icons iconcard">arrow_forward</i>
            <!-- CARD STELLE -->
            <div class="card">
                <h2>Stelle</h2>
                <span class="ciao"></span>
                <p>Una stella è un corpo celeste che brilla di luce propria. Genera energia nel proprio nucleo attraverso processi di fusione nucleare.</p>
                <form class="frmbtn" action="list.php">
                    <button>Altro</button>
                    <button><i class="material-icons">link</i></button>
                    <button></button>
                </form>
            </div>
            <!-- CARD PIANETI -->
            <div class="card">
                <h2>Pianeti</h2>
                <span class="ciao"></span>
                <p>Un pianeta è un <br>corpo celeste<br> che orbita attorno ad una stella, e la cui massa è sufficiente a conferirgli una forma sferoidale.</p>
                <form class="frmbtn" action="list.php">
	                <button>Altro</button>
                    <button><i class="material-icons">link</i></button>
                    <button></button>
                </form>
            </div>
            <!-- CARD SATELLITI -->
            <div class="card">
                <h2>Satelliti</h2>
                <span class="ciao"></span>
                <p>Un satellite naturale <br>è un qualunque corpo celeste che orbita attorno a un corpo diverso da una stella.</p>
                <form class="frmbtn" action="list.php">
                    <button>Altro</button>
                    <button><i class="material-icons">link</i></button>
                    <button></button>
                </form>
            </div>
        </div>
        <!-- DIV RAGGRUPPAMENTI -->
        <div class="introraggruppamenti content" id="introraggruppamenti">
            <h1>Raggruppamenti</h1>
            <span class="leftline"></span>
            <!-- CARD GALASSIE -->
            <div class="card">
                <h2>Galassie</h2>
                <h2>Galassie</h2>
                <span class="ciao"></span>
                <p>Una stella è un corpo celeste che brilla di luce propria. Genera energia nel proprio nucleo attraverso processi di fusione nucleare.</p>
                <form class="frmbtn" action="ciao.php">
                    <button>Altro</button>
                    <button><i class="material-icons">link</i></button>
                    <button></button>
                </form>
            </div>
            <!-- CARD SISTEMI PLANETARI -->
            <div class="card">
                <h2>Sistemi planetari</h2>
                <h2>Sistemi planetari</h2>
                <span class="ciao"></span>
                <p>Un pianeta è un <br>corpo celeste<br> che orbita attorno ad una stella, e la cui massa è sufficiente a conferirgli una forma sferoidale.</p>
                <form class="frmbtn" action="ciao.php">
	                <button>Altro</button>
                    <button><i class="material-icons">link</i></button>
                    <button></button>
                </form>
            </div>
            <!-- CARD COSTELLAZIONI -->
            <div class="card">
                <h2>Costellazioni</h2>
                <h2>Costellazioni</h2>
                <span class="ciao"></span>
                <p>Un satellite naturale <br>è un qualunque corpo celeste che orbita attorno a un corpo diverso da una stella.</p>
                <form class="frmbtn" action="ciao.php">
                    <button>Altro</button>
                    <button><i class="material-icons">link</i></button>
                    <button></button>
                </form>
            </div>
        </div>
        <!-- DIV ASTRONOMI, GLOSSARIO, STORIA -->
        <div class="introastronomi content" id="introastronomi">
            <h1>Astronomi</h1>
            <span class="leftline"></span>
            <!-- CARD GALASSIE -->
            <div class="card">
                <h2>Galassie</h2>
                <h2>Galassie</h2>
                <span class="ciao"></span>
                <p>Una stella è un corpo celeste che brilla di luce propria. Genera energia nel proprio nucleo attraverso processi di fusione nucleare.</p>
                <form class="frmbtn" action="ciao.php">
                    <button>Altro</button>
                    <button><i class="material-icons">link</i></button>
                    <button></button>
                </form>
            </div>
            <!-- CARD SISTEMI PLANETARI -->
            <div class="card">
                <h2>Sistemi planetari</h2>
                <h2>Sistemi planetari</h2>
                <span class="ciao"></span>
                <p>Un pianeta è un <br>corpo celeste<br> che orbita attorno ad una stella, e la cui massa è sufficiente a conferirgli una forma sferoidale.</p>
                <form class="frmbtn" action="ciao.php">
	                <button>Altro</button>
                    <button><i class="material-icons">link</i></button>
                    <button></button>
                </form>
            </div>
            <!-- CARD COSTELLAZIONI -->
            <div class="card">
                <h2>Costellazioni</h2>
                <h2>Costellazioni</h2>
                <span class="ciao"></span>
                <p>Un satellite naturale <br>è un qualunque corpo celeste che orbita attorno a un corpo diverso da una stella.</p>
                <form class="frmbtn" action="ciao.php">
                    <button>Altro</button>
                    <button><i class="material-icons">link</i></button>
                    <button></button>
                </form>
            </div>
        </div>
        <script>
            setTimeout(init, 500);
            setTimeout(initb, 1000);
        </script>
    </body>
</html>
