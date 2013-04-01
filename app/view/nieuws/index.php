<h1>Nieuws</h1>

    <?php   
   
        foreach($Nieuwsitems as $Nieuwsitem){
            echo '<dd><a href="' . URL_BASE.'nieuws/'.$Nieuwsitem->urlpart.'">'. $Nieuwsitem->titel.'</a></dd>';
        }
    ?>

