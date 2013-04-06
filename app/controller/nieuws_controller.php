<?php

class NieuwsController extends AuthController{
    function index($urlpart=false){
        if(!$urlpart){
            $Nieuwsitems = $this->Nieuws->getList();
            $this->render(array('Nieuwsitems'=> $Nieuwsitems));             
        }else{
            $this->Nieuws->load('urlpart', $urlpart);
            $this->render(array('Nieuwsitem' => $this->Nieuws, 'view'=>'view.php'));  
        }
      
    }
    
    function view($id=false){
        if($id !== false){
            $this->Nieuws->load('id', $id);
            $this->render(array('Nieuwsitem' => $this->Nieuws));           
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
                    $this->render();
                }else{;                 
                    Loader::loadHelper('String');
                    $data['urlpart'] = StringHelper::urlpart($data['titel']);
                    $result = $this->Nieuws->addnew($data);
                    $this->render(array('result' => $result));
                }               
            }
        }
        if($allowAction===false){
            $this->redirect('nieuws/');
        }
    } 
   
    function edit($data=false){        
        if($this->checkLogin()){
            if(is_numeric($data)){
               $this->Page->load('id', $data);
               $this->render(array('Page' => $this->Page));
            }elseif(!$data){
                //$this->render();
            }else{              
                $result = $this->Page->update($data);
                if(!$result){
                    $message = "Bijwerken is mislukt";
                    $msgType = 'error';
                }else{
                    $message = "Auteur is succesvol bijgewerkt";
                    $msgType = 'succes';
                }
                $this->render(array('message' => $message, 'msgType' => $msgType, 'Page' => $this->Page));
            }
        }
    }
    
    function showpage($urlpart){
       $this->Page->load('urlpart', $urlpart);
       $this->render(array('Page' => $this->Page));
    }
}
?>
