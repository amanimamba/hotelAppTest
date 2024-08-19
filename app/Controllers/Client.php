<?php

namespace App\Controllers;
use App\Models\Eglise_Model;


class Client extends BaseController
{
    public $_db;
    public $Eglise;
    public $Class='Client';
    public $table='clients';
    public $Champ=[
        'NOM_CLIENT'=>'text',
        'CNI'=>'number',
        'ETAT_CIVILE'=>'text',
        'TELEPHONE'=>'text',
        'PROVENANCE'=>'text',
        'DATE_NAISSANCE'=>'date',
        'ADRESS'=>'text',

    ];
    public $id='ID_CLIENT';
    public $Code='CODE_CLIENT';
     // link action 
    public $link_Add='Client/Add_news';
     public $link_edit='Client/Edite_news';
     public $link_update='Client/Update_news';

     public $link_delete='Client/Delete_news/';
     // link de form et liste
     public $link_liste='Client/liste_news';
     public $link_form='Client/';
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
             $debutListe='<table id="example1" class="table table-bordered table-hover" style="overflow:scroll;">
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
                    <td>'.$key->NOM_CLIENT.'</td>
                    <td>'.$key->CNI.'</td>
                     <td>'.$key->ETAT_CIVILE.'</td>
                    <td>'.$key->TELEPHONE.'</td>
                    <td>'.$key->PROVENANCE.'</td>
                    <td>'.$key->DATE_NAISSANCE.'</td>
                    <td>'.$key->ADRESS.'</td>
                    <td>'.$this->btn_action($key->CODE_CLIENT).'</td>
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

       
         $NOM_CLIENT=htmlspecialchars($this->request->getPost('NOM_CLIENT'));
         $CNI=htmlspecialchars($this->request->getPost('CNI'));
         $ETAT_CIVILE=htmlspecialchars($this->request->getPost('ETAT_CIVILE'));
         $TELEPHONE=htmlspecialchars($this->request->getPost('TELEPHONE'));
         $PROVENANCE=htmlspecialchars($this->request->getPost('PROVENANCE'));
         $DATE_NAISSANCE=htmlspecialchars($this->request->getPost('DATE_NAISSANCE'));
         $ADRESS=htmlspecialchars($this->request->getPost('ADRESS'));
         $CODE_CLIENT='CLI_'.uniqid((md5('CODE_TYPE_CLIENT')));
        

         $data=[
         'NOM_CLIENT'=>$NOM_CLIENT,
         'CNI'=>$CNI,
         'ETAT_CIVILE'=>$ETAT_CIVILE,
         'TELEPHONE'=>$TELEPHONE,
         
         'PROVENANCE'=>$PROVENANCE,
         'DATE_NAISSANCE'=>$DATE_NAISSANCE,
         'ADRESS'=>$ADRESS,
         'CODE_CLIENT'=>$CODE_CLIENT,
     ];
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
          $NOM_CLIENT=htmlspecialchars($this->request->getPost('NOM_CLIENT'));
         $CNI=htmlspecialchars($this->request->getPost('CNI'));
         $ETAT_CIVILE=htmlspecialchars($this->request->getPost('ETAT_CIVILE'));
         $TELEPHONE=htmlspecialchars($this->request->getPost('TELEPHONE'));
         $PROVENANCE=htmlspecialchars($this->request->getPost('PROVENANCE'));
         $DATE_NAISSANCE=htmlspecialchars($this->request->getPost('DATE_NAISSANCE'));
         $ADRESS=htmlspecialchars($this->request->getPost('ADRESS'));
        
        

         $data=[
         'NOM_CLIENT'=>$NOM_CLIENT,
         'CNI'=>$CNI,
         'ETAT_CIVILE'=>$ETAT_CIVILE,
         'TELEPHONE'=>$TELEPHONE,

         'PROVENANCE'=>$PROVENANCE,
         'DATE_NAISSANCE'=>$DATE_NAISSANCE,
         'ADRESS'=>$ADRESS,
     ];
         
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
         <input type="hidden"  name="id" value="'.$code->ID_CLIENT.'">

        <label for="text" style="color: black; font-size: 18px;"><b>NOM_CLIENT</b></label>
            <input type="text"  name="NOM_CLIENT" value="'.$code->NOM_CLIENT.'" class="form-control">

            <label for="text" style="color: black; font-size: 18px;"><b>CNI</b></label>
            <input type="text"  name="CNI"value="'.$code->CNI.'"class="form-control" >
            <label for="text" style="color: black; font-size: 18px;"><b>ETAT_CIVILE</b></label>
            <input type="text"  name="ETAT_CIVILE" value="'.$code->ETAT_CIVILE.'" class="form-control">

            <label for="text" style="color: black; font-size: 18px;"><b>TELEPHONE</b></label>
            <input type="text"  name="TELEPHONE"value="'.$code->TELEPHONE.'"class="form-control" >

            <label for="text" style="color: black; font-size: 18px;"><b>PROVENANCE</b></label>
            <input type="text"  name="PROVENANCE"value="'.$code->PROVENANCE.'"class="form-control" >
            <label for="" style="color: black; font-size: 18px;"><b>DATE_NAISSANCE</b></label>
            <input type="date"  name="DATE_NAISSANCE" value="'.$code->DATE_NAISSANCE.'" class="form-control">

            <label for="text" style="color: black; font-size: 18px;"><b>ADRESS</b></label>
            <input type="text"  name="ADRESS"value="'.$code->ADRESS.'"class="form-control" >
            
    
            ';
    }

}