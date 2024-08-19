<?php

namespace App\Controllers;
use App\Models\Model_Form;
class Home extends BaseController
{
    public $_db;
    public $Forum;
    public $Pages='Home';
   
     public function __construct()
    {
        $this->_db=db_connect();
        $this->Forum= new Model_Form($this->_db);
        $this->SESSION_TABLE_ = \Config\Services::session();
        
    }
    public function liason_donner($table,$where,$value,$affiche)
    {
        $liason_donner=$this->Forum->getOne($table,[$where=>$value]);
        if ($liason_donner) {
             return $liason_donner->$affiche;
        }else{
             return '--vide--';
        }
       
    }
    public function index()
    {
         
        return view('Login');
    }
    public function Dashboard(){
        return view('Admin/Dashboard');
    }
    public function Deconnexion(){
        $this->SESSION_TABLE_->destroy();
       return redirect()->to(base_url());

    }
    public function Connexion(){
        $Connexion=$this->request->getPost();
        $Nom=htmlspecialchars(trim($Connexion['UserName']));
        $Cle=htmlspecialchars(trim($Connexion['Password']));
        $donne_Connexion=['PSUEDO_UTILISATEUR'=>$Nom,'MOT_DE_PASS'=>$Cle];
        $Connexion_ok=$this->Forum->getOne('utilisateurs',$donne_Connexion);
        // print_r($Connexion_ok);
        // exit();
        if ($Connexion_ok)
         {
            $_SESSION=[
                'PSEUDO'=>$Connexion_ok->PSUEDO_UTILISATEUR,
                'ROLE'=>$Connexion_ok->CODE_ROLE,
                'IMG'=>'',
            ];
            $this->SESSION_TABLE_->set($_SESSION);
            return redirect()->to(base_url('Chambre/liste_news'));
        }else{
            $Message_error=['Message'=>'Erreur de connexion...','Type'=>'erreur'];
            $this->SESSION_TABLE_->setFlashdata($Message_error);
            return redirect()->to(base_url('Home'));
        }
        

        
        
    }
   
        
    
}
?>




