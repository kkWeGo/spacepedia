<div id="cut" class="cut div-center">
    <div class="citazioni">
        <?php
            $citazioni = file_get_contents ("jsons/cit.json");
            $arraycit = json_decode($citazioni, true);
            $random = rand (0,2);
            echo '<p>'.$arraycit['cit'.$random][0].'<p>';
            echo '<h2>'.$arraycit['cit'.$random][1].'</h2>';
        ?>
    </div>
</div>