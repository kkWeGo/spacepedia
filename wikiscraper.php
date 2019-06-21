<?php
    include 'include/simple_html_dom.php';

    $page = $_GET['page'];
    $link = 'https://it.wikipedia.org/wiki/'.$page;

    $html = file_get_html($link);

    $parse = true;

    $write = "";

    foreach($html->find('p sup') as $parsing) 
    {
        $parsing->innertext = "";
    }

    $write = $write.'<h2 class="title-page">'.$html->find('#firstHeading', 0)->plaintext.'</h2>';

    $write = $write.'<h6 class="title-sub">'.$html->find('#siteSub', 0)->plaintext.'<h6>';

    foreach($html->find('p, h2 span.mw-headline') as $parsing) {
        if ($parsing->plaintext == 'Note'){
            $parse = false;
        }
        if ($parse){
            if ($parsing->tag == 'span') {
                $write = $write.'<h3 class="title-p">'.$parsing->plaintext.'</h3>';
            } else {
                $write = $write.'<p class="page-p">'.$parsing->plaintext.'</p>';
            }
        }
    } 
    $page = "pages/".$page.".txt";
    $file = fopen($page, 'w');
    fwrite($file, $write);
?>