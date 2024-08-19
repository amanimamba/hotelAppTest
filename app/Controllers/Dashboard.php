<?php

namespace App\Controllers;
use App\Models\Model_Form;
class Dashboard extends BaseController
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
    
    public function index()
    {
         $chambre=$this->get_count_element('chambres',['IS_ACTIF'=>1]);
         $categorie=$this->get_count_element('categorie',['IS_ACTIF'=>1]);
         $Location=$this->get_count_element('location_chambres',['IS_ACTIF'=>1]);
         $Count_Categorie=$this->get_categorti_chambre();

         
         $donner=[
            'categorie_Chambre'=>$categorie,
            'Chambre'=>$chambre,
            'location_chambres'=>$Location,
            'CategoriCount'=>$Count_Categorie
         ];
         
        return view('Admin/Dashboard',$donner);
    }
    public function get_count_element($table,$where=array())
    {
       $valuer=$this->Forum->getWhereConditon($table,$where);
       return count($valuer);    
    }

    public function get_categorti_chambre(){
        $Categori=$this->Forum->getWhereConditon('categorie',['IS_ACTIF'=>1]);
        $rowCategorie="";
        foreach ($Categori as $key) 
        {
             $rowCategorie.='<div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-bed"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">'.$key->CATEGORIE.'</span>
                <span class="info-box-number">
                  10
                  <small></small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>';
        }
        return $rowCategorie;
       

    }
   
    
   
        
    
}
?>




