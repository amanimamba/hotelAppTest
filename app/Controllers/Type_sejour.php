<?php

namespace App\Controllers;
use App\Models\Eglise_Model;


class Type_sejour extends BaseController
{
    public $_db;
    public $Eglise;
    public $Class='Type_sejour';
    public $table='type_sejours';
    public $Champ=[
        'TYPE_SEJOURS'=>'text',
    ];
    public $id='ID_TYPE_SEJOURS';
    public $Code='CODE_TYPE_SEJOURS';
     // link action 
    public $link_Add='Type_sejour/Add_news';
     public $link_edit='Type_sejour/Edite_news';
     public $link_update='Type_sejour/Update_news';

     public $link_delete='Type_sejour/Delete_news/';
     // link de form et liste
     public $link_liste='Type_sejour/liste_news';
     public $link_form='Type_sejour/';
     // 
     
     public function __construct()
    {
        $this->_db=db_connect();
        $this->Eglise= new Eglise_Model($this->_db);
        $this->SESSION_TABLE_ = \Config\Services::session();
       
    }
    
    function Formatage_text($textGet){
       
        $text=explode('_', $textGet);
        $TextOUt='';
        foreach ($text as $key) 
        {
             $TextOUt.=$key."   ";
        }

        return strtoupper($TextOUt);

    }
    public function Getoption($table,$id,$name,$validation)
    {
    $option='';
    $OPt= $getListe=$this->Eglise->getAll($table);
    if ($OPt) {
        foreach ($OPt as $key) 
    {
        if ($validation==$key->$id) {
            $option.='<option value="'.$key->$id.'" selected>'.$key->$name.'</option>';
        }else{
            $option.='<option value="'.$key->$id.'">'.$key->$name.'</option>';
        }
        
    }
    return$option;
    }
    else{
        return "<option value=''>-----VIDE-------</option>";
    }
    

}
public function getLiaison($table,$Where,$id,$value)
{
        $lia='';
   
     $Liaison=$this->Eglise->getOne($table,[$Where=>$id]);
    // print_r($Liaison);
    // exit();
    if ($Liaison) {
    return$Liaison->$value;
    }else{
        return"--vide--";
    }
    
    

}
    function get_imag($imagefile){
               
        if ($imagefile) 
        {
               
                $imagefile->move('./uploads/News/', $imagefile->getName());
                return './uploads/News/'.$imagefile->getName();
        }else{
            return './uploads/News/';
        }
               
            
             
    }
    public function formulaire(){
       
            $form='';
        $key=array_keys($this->Champ);
        $i=0;
        foreach ($this->Champ as $output) 
        {
           $form.='<label for="text" style="color: black; font-size: 18px;"><b>'.$key[$i].'</b></label>
            <input type="'.$output.'" placeholder="Enter '.$key[$i].'" class="form-control" name="'.$key[$i].'" >';
           $i++;
        }
       
       
        return $form;
        
        
    }
    public function header_table(){
         $theader="";
         $key=array_keys($this->Champ);
        $i=0;
        foreach ($this->Champ as $output) 
        {
           $theader.='<th>'.$key[$i].'</th>';
           $i++;
        }
        return $theader;
    }
    // FONCTION DE RECUPERATIONNDE LISTE
    public function getListe(){
        $liste='';
             $getListe=$this->Eglise->getAll($this->table);
             // print_r($getListe);

             // exit();
             $debutListe='<table id="example1" class="table table-bordered table-hover">
            <thead>
                <th>#</th>'.$this->header_table().'<th>Action</th>
            </thead>
            <tbody>';
            $finList='</tbody>
        </table>';
        $i=1;
        
             foreach ($getListe as $key) 
             {
                  $liste.='
                 
                <tr>
                    <td>'.$i.'</td>
                    <td>'.$key->TYPE_SEJOURS.'</td>
                  
                  

                   
                    <td>'.$this->btn_action($key->CODE_TYPE_SEJOURS).'</td>
                </tr>
            ';
            $i++;
             }

             return $debutListe.$liste.$finList;
    }
    // FORMULAIRE D' EVENEMENT
    public function index()
    {
        
       $formulaire=$this->formulaire();
       
       $data['formulaire']=$formulaire;
        $data['liste']=$this->getListe();
        $data['link']=base_url($this->link_Add);
        $data['link_btn']=$this->link_btn();
        $data['titre']=$this->Class;
       return view('Admin/Admin_form',$data);

    }
    // LISTE DE EVENEMENT 
    public function liste_news(){
        // helper('verifier');
        // verifer();
        $data['liste']=$this->getListe();
        $data['link']=base_url($this->link_Add);
        $data['link_btn']=$this->link_btn();
        $data['titre']=$this->Class;
       return view('Admin/Admin_liste',$data);

    }
    // BOUTON DE NAVIGATION AJOUT ET LISTE
    public function link_btn(){
        return'<li class="breadcrumb-item" >
        <strong><a href="'.base_url($this->link_form).'" id="btn-link" style="text-decoration: none;color: black;">Ajouter</a></strong>
        </li>
                <li class="breadcrumb-item" >
               <strong> <a href="'.base_url($this->link_liste).'" id="btn-link" style="text-decoration: none;color: black;">Liste</a></strong>
                </li>';
    }
    // BUTTON DE SUPPRSION ET  MODIFICATION
    public function btn_action($codes){
        return'<a href="'.base_url($this->link_edit.'/'.$codes).'" id="btn" class="btn btn-info">Modifier</a>
                <a href="#" id='.base_url($this->Class.'/Delete_news/'.$codes).' class="btn btn-danger" onclick="get_delete(this)">Suprimer</a>';
     
    }
    // FONCTION AJOUT
    public function Add_news(){
         $TYPE_SEJOURS=htmlspecialchars($this->request->getPost('TYPE_SEJOURS'));
         
         $CODE_TYPE_SEJOURS='TYS_'.uniqid((md5('TYPE_SEJOURS')));

         $data=['TYPE_SEJOURS'=>$TYPE_SEJOURS,'CODE_TYPE_SEJOURS'=>$CODE_TYPE_SEJOURS];
          $Entre=$this->Eglise->insert($this->table,$data);
          if ($Entre) {
           return redirect()->to(base_url($this->link_liste));
        }else{
            return redirect()->to(base_url($this->link_form));         
        }
    }
    // FONCTION DELETE
    public function Delete_news($id_delete){
        $id=htmlspecialchars($id_delete);

        $delete_action=$this->Eglise->delete($this->table,[$this->Code=>$id]);

      
        if ($delete_action) {
            $Message_error=['Message'=>'Element Effacer avec success','Type'=>'success'];
            $this->SESSION_TABLE_->setFlashdata($Message_error);
           echo base_url($this->link_liste);
        }else{
            $Message_error=['Message'=>'Erreur de suppression...','Type'=>'erreur'];
            $this->SESSION_TABLE_->setFlashdata($Message_error);
            echo base_url($this->link_form);         
        }
    }
    // FUNCTION UPDATE
    function Update_news(){
        $id=htmlspecialchars($this->request->getPost('id'));
          $TYPE_SEJOURS=htmlspecialchars($this->request->getPost('TYPE_SEJOURS'));
         
        

         $data=['TYPE_SEJOURS'=>$TYPE_SEJOURS];

         
         
          $Entre=$this->Eglise->update($this->table,[$this->id=>$id],$data);
          if ($Entre) {
           return redirect()->to(base_url($this->link_liste));
        }else{
            return redirect()->to(base_url($this->link_form));         
        }
    }
    // FUNCTION EDITE ACTION
    function Edite_news($id_update){
        $id=htmlspecialchars($id_update);
        $Form_edite=$this->Eglise->getOne($this->table,[$this->Code=>$id]);
        // print_r($Form_edite);
        
        $formulaire=$this->formulaire_edite($Form_edite);
       
       $data['formulaire']=$formulaire;
        $data['liste']=$this->getListe();
        $data['link']=base_url($this->link_update);
        $data['link_btn']=$this->link_btn();
        $data['titre']=$this->Class;
       return view('Admin/Admin_edite',$data);
    }
    function formulaire_edite($code){
 
        return'
         <input type="hidden"  name="id" value="'.$code->ID_TYPE_SEJOURS.'">

        <label for="text" style="color: black; font-size: 18px;"><b>TYPE_SEJOURS</b></label>
            <input type="text"  name="TYPE_SEJOURS" value="'.$code->TYPE_SEJOURS.'" class="form-control">

            
            
    
            ';
    }

}