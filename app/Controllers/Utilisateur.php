<?php

namespace App\Controllers;
use App\Models\Eglise_Model;


class Utilisateur extends BaseController
{
    public $_db;
    public $Eglise;
    public $Class='Utilisateur';
    public $table='utilisateurs';
    public $Champ=[
        'NOM_UTILISATEUR'=>'text',
        'PSUEDO_UTILISATEUR'=>'text',
        'MOT_DE_PASS'=>'password',
    ];
    public $id='ID_UTILISATEURS';
    public $Code='CODE_UTILISATEUR';
     // link action 
    public $link_Add='Utilisateur/Add_news';
     public $link_edit='Utilisateur/Edite_news';
     public $link_update='Utilisateur/Update_news';

     public $link_delete='Utilisateur/Delete_news/';
     // link de form et liste
     public $link_liste='Utilisateur/liste_news';
     public $link_form='Utilisateur/';
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
        $CODE_ROLE='
        <label style="color: black; font-size: 18px;"><b> CODE_ROLE </b></label>
          <select class="form-control" name="CODE_ROLE">
            <option value=""> SELECTIONNER CODE_ROLE</option>
            '.$this->Getoption('role_utilisateur','CODE_ROLE','ROLE','').'
          </select>';
         
       
        return $form.$CODE_ROLE;
        
        
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
                <th>#</th>'.$this->header_table().'<th>Categorie</th><th>TYPE_CLIENT</th><th>Action</th>
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
                    <td>'.$key->NOM_UTILISATEUR.'</td>
                    <td>'.$key->PSUEDO_UTILISATEUR.'</td>
                    <td>'.$key->MOT_DE_PASS.'</td>

                    <td>'.$this->getLiaison('role_utilisateur','CODE_ROLE',$key->CODE_ROLE,'ROLE').'</td>
                   
                    <td>'.$this->btn_action($key->CODE_UTILISATEUR).'</td>
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

       
         $NOM_UTILISATEUR=htmlspecialchars($this->request->getPost('NOM_UTILISATEUR'));
         $PSUEDO_UTILISATEUR=htmlspecialchars($this->request->getPost('PSUEDO_UTILISATEUR'));
         $CODE_UTILISATEUR='UTI_'.uniqid((md5('CODE_UTILISATEUR')));
         $MOT_DE_PASS=htmlspecialchars($this->request->getPost('MOT_DE_PASS'));
         $CODE_ROLE=htmlspecialchars($this->request->getPost('CODE_ROLE'));

     
         $data=['NOM_UTILISATEUR'=>$NOM_UTILISATEUR,'PSUEDO_UTILISATEUR'=>$PSUEDO_UTILISATEUR,'CODE_UTILISATEUR'=>$CODE_UTILISATEUR,'MOT_DE_PASS'=>$MOT_DE_PASS,'CODE_ROLE'=>$CODE_ROLE];
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
          $NOM_UTILISATEUR=htmlspecialchars($this->request->getPost('NOM_UTILISATEUR'));
         $PSUEDO_UTILISATEUR=htmlspecialchars($this->request->getPost('PSUEDO_UTILISATEUR'));
        
         $MOT_DE_PASS=htmlspecialchars($this->request->getPost('MOT_DE_PASS'));
     
        $CODE_ROLE=htmlspecialchars($this->request->getPost('CODE_ROLE'));

     
         $data=['NOM_UTILISATEUR'=>$NOM_UTILISATEUR,'PSUEDO_UTILISATEUR'=>$PSUEDO_UTILISATEUR,'MOT_DE_PASS'=>$MOT_DE_PASS,'CODE_ROLE'=>$CODE_ROLE];
         
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
         <input type="hidden"  name="id" value="'.$code->ID_UTILISATEURS.'">

        <label for="text" style="color: black; font-size: 18px;"><b>NOM_UTILISATEUR</b></label>
            <input type="text"  name="NOM_UTILISATEUR" value="'.$code->NOM_UTILISATEUR.'" class="form-control">

            <label for="text" style="color: black; font-size: 18px;"><b>PSUEDO_UTILISATEUR</b></label>
            <input type="text"  name="PSUEDO_UTILISATEUR"value="'.$code->PSUEDO_UTILISATEUR.'"class="form-control" >
             <label for="text" style="color: black; font-size: 18px;"><b>MOT_DE_PASS</b></label>
            <input type="text"  name="MOT_DE_PASS"value="'.$code->MOT_DE_PASS.'"class="form-control" >

            <label for="text" style="color: black; font-size: 18px;"><b>CODE_ROLE</b></label>
          <select class="form-control" name="CODE_ROLE">
            <option value=""> SELECTIONNER CATEGORIE</option>
            '.$this->Getoption('role_utilisateur','CODE_ROLE','ROLE',$code->CODE_ROLE).'
          </select>

        
    
            ';
    }

}