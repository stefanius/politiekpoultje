<?php

class DeelnemersModel extends AuthModel{
    var $loginname='mail';
    var $table='user';
    var $data=array('nickname' =>array( 'data-validation'=>'empty', 
                                        'data-error'=>'Nickname verplicht',
                                        'caption'=>'Nickname',
                                        'fieldtype'=>'string'),
        
                    'mail'     =>array( 'data-validation'=>'email', 
                                        'data-error'=>'Email verplicht',
                                        'caption'=>'E-mail',
                                        'fieldtype'=>'string'),
        
                    'password' =>array( 'data-validation'=>'empty', 
                                        'data-error'=>'Wachwoord verplicht',
                                        'caption'=>'Wachtwoord',
                                        'fieldtype'=>'string'));
    
    public function isAdmin(){
        return ($this->admin === 1 || $this->admin === '1');
    }
}

?>