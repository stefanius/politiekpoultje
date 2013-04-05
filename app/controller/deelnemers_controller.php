<?php

class DeelnemersController extends AuthController{
    function registreer($data=false){
        $formFields=array('nickname', 'mail', 'password');
        if(!$data){
            $this->render(array('Deelnemer'=> $this->Deelnemers, 'formFields'=>$formFields));
        }else{
            $data['validation'] = md5($data['mail']).':'.md5($data['mail'].time().rand().'*');
            $result = $this->Deelnemers->addnew($data);         

            if($result > 0){
                $Deelnemer = $this->Deelnemers->load('id', $result); 
                $link = 'http://politiekpoultje.nl/deelnemers/validate/'.$Deelnemer->mail.'/'.$Deelnemer->created.'/'.$Deelnemer->validation.'/';
                $Mailer = new Mailer(MAILER_HOST, MAILER_ADDRES, MAILER_PASSWORD, MAILER_PORT, MAILER_FROM);
                $Mailer->send('U kunt uw account activeren met behulp van de volgende link: <a href="'.$link.'">Activieer!</a>','Politiekpoultje Activatie', $Deelnemer->mail, $Deelnemer->nickname);
                $this->render(array('view' => 'registerok.php', 'feedback'=>'succes.php'));
            }else{
                $message='Gebruikersnaam of email bestaat al. Als u het zelf bent, kunt u het wachtwoord herstellen. Anders kunt u een andere gebruikersnaam kiezen.';
                $args = array('Deelnemer'=> $this->Deelnemers,'$msgType'=>'error', 'formFields'=>$formFields, 'message'=>$message);
                $this->render($args);
            }
        }
    }

    private function validate_mail_hash($email, $validation_hash){
        $exploded = explode(':' , $validation_hash);
        return (md5($email)===$exploded[0]);
    }
    
    function validate($email=false, $created=false, $validation_hash=false ){
        $validated = false;
        
        if($email !==false || $created !==false || $validation_hash !==false){
            if($this->validate_mail_hash($email, $validation_hash)){
                $Deelnemer = $this->Deelnemers->load('validation', $validation_hash);
                if($Deelnemer !== false){
                    if($Deelnemer->created === $created && $Deelnemer->mail ==$email ){
                        $validated = true;
                    }
                }
            }
        }
        
        if($validated){
            $Deelnemer->update(array('online'=>1, 'validation'=>''));
            $this->render(array('view' => 'validateok.php'));
        }else{
            $this->render(array('view' => 'validatenotok.php'));
        }
    }
    
    function login($data=false){  
        $user=parent::login($this->Deelnemers, $data);
        $this->Registry->Session
            ->set("User.id",  $user->id)
            ->set("User.nickname",  $user->nickname)
            ->set("timestamp", time());
        $this->render();
    }   
    
    function logout(){
        parent::logout();
        header('location: /');
    }    
}
?>
