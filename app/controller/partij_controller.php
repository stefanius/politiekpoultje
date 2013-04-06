<?php

class PartijController extends AuthController{
    
    function index(){
        $Partijen = $this->Partij->getList();
        $this->render(array('Partijen'=> $Partijen));       
    }
    
    function view($id=false){
        if($id !== false){
            $this->Partij->load('id', $id);
            $this->render(array('Partij' => $this->Partij));           
        }
    }
    
    function add($data=false){
        Loader::loadModel('Deelnemers');
        $Deelnemers = new DeelnemersModel();
        $allowAction = false;
        if($this->checkLogin()){
            $Deelnemer = $Deelnemers->load('id', $this->Registry->Session->get('User.id')); 
            if($Deelnemer->isAdmin()){
                $allowAction=true;
                if(!$data){
                    $this->render(array('Partij'=> $this->Partij));
                }else{                 
                    Loader::loadHelper('String');
                    $data['urlpart'] = StringHelper::urlpart($data['naam']);
                    $data['naam_kort'] = strtoupper($data['naam_kort']);
                    $data['user_id'] = $Deelnemer->id;
                    $result = $this->Partij->addnew($data);
                    if($result > 0){
                        $message=   'Partij "'.$data['naam'].'" ('.$data['naam_kort'].') is succesvol 
                                    opgeslagen. U kunt hieronder een nieuwe partij toevoegen of het 
                                    naar het <a href="/partij/'.$data['urlpart'].'/">profiel</a>';
                        $msgType='success';
                    }else{
                        $message=   'Partij "'.$data['naam'].'" ('.$data['naam_kort'].') is niet 
                                    opgeslagen. Waarschijnlijk bestaat deze partij al in onze database
                                    of is er een technisch probleem met onze website/database. 
                                    Controleer de naam van de partij en of deze al bestaat. Als dit 
                                    probleem blijft voordoen neemt u dan contact op met onze helpdesk.';                            
                        $msgType='error';                     
                    }                  
                    $args = array('Partij'=> $this->Partij,'msgType'=>$msgType, 'message'=>$message);
                    $this->render($args);                    
                }               
            }
        }
        if($allowAction===false){
            $this->redirect('partij/');
        }
    } 
   
    function edit($data=false){        
        if($this->checkLogin()){
            if(is_numeric($data)){
               $this->Partij->load('id', $data);
               $this->render(array('Partij' => $this->Partij));
            }elseif(!$data){
                //$this->render();
            }else{              
                $this->Partij->load('id', $data['id']);
                $result = $this->Partij->update($data);
                if(!$result){
                    $message = "Bijwerken is mislukt";
                    $msgType = 'error';
                }else{
                    $message = "Partij is succesvol bijgewerkt";
                    $msgType = 'succes';
                }
                $this->render(array('message' => $message, 'msgType' => $msgType, 'Partij' => $this->Partij));
            }
        }
    }  
}
?>
