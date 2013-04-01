<?php

class DeelnemersModel extends AuthModel{
    var $loginname='mail';
    var $table='user';
    var $data=array('nickname' =>array( 'data-validation'=>'empty', 
                                        'data-error'=>'Nickname verplicht',
                                        'caption'=>'Nickname'),
        
                    'mail'     =>array( 'data-validation'=>'email', 
                                        'data-error'=>'Email verplicht',
                                        'caption'=>'E-mail'),
        
                    'password' =>array( 'data-validation'=>'empty', 
                                        'data-error'=>'Wachwoord verplicht',
                                        'caption'=>'Wachtwoord'));
}

?>