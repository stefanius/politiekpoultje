<h1>Gefeliciteerd</h1>
<p>Gefeliciteerd, uw account voor politiekpultje.nl is gevalideert en actief. U kunt vanaf nu inloggen met uw emailadres en wachtwoord. </p>

       <?php
            $args['basepath']='app';
            $args['element']='login_small.php';
            $args['renderpath']='login/';      
            echo $Template->render($args);
        ?>
