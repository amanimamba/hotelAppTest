<?php

namespace App\Controllers;
use App\Models\Eglise_Model;


class Chambre extends BaseController
{
    public $_db;
    public $Eglise;
    public $Class='Chambre';
    public $table='chambres';
    public $Champ=[
        'NUMERO_CHAMBRE'=>'text',
        'DESCRIPTION'=>'text',
        
    ];
    public $id='ID_CHAMBRE';
    public $Code='CODE_CHAMPRE';
     // link action 
    public $link_Add='Chambre/Add_news';
     public $link_edit='Chambre/Edite_news';
     public $link_update='Chambre/Update_news';

     public $link_delete='Chambre/Delete_news/';
     // link de form et liste
     public $link_liste='Chambre/liste_news';
     public $link_form='Chambre/';
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
        $CODE_CATEGORI='
        <label style="color: black; font-size: 18px;"><b> Categorie </b></label>
          <select class="form-control" name="CODE_CATEGORI">
            <option value=""> SELECTIONNER CATEGORIE</option>
            '.$this->Getoption('categorie','CODE_CATEGORI','CATEGORIE','').'
          </select>';
          $CODE_TYPE_CLIENT='
        <label style="color: black; font-size: 18px;"><b> TYPE_CLIENT </b></label>
          <select class="form-control" name="CODE_TYPE_CLIENT">
            <option value=""> SELECTIONNER TYPE CLIENT</option>
            '.$this->Getoption('type_client','CODE_TYPE_CLIENT','TYPE_CLIENT','').'
          </select>';
       
        return $form.$CODE_TYPE_CLIENT.$CODE_CATEGORI;
        
        
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
                    <td>'.$key->NUMERO_CHAMBRE.'</td>
                    <td>'.$key->DESCRIPTION.'</td>
                    <td>'.$this->getLiaison('categorie','CODE_CATEGORI',$key->CODE_CATEGORI,'CATEGORIE').'</td>
                    <td>'.$this->getLiaison('type_client','CODE_TYPE_CLIENT',$key->CODE_TYPE_CLIENT,'TYPE_CLIENT').'</td>

                    

                   
                    <td>'.$this->btn_action($key->CODE_CHAMPRE).'</td>
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
       
         $DESCRIPTION=htmlspecialchars($this->request->getPost('DESCRIPTION'));
         $CODE_CATEGORI=htmlspecialchars($this->request->getPost('CODE_CATEGORI'));
         $CODE_CHAMPRE='CHB_'.uniqid((md5('CODE_CHAMPRE')));
         $NUMERO_CHAMBRE=htmlspecialchars($this->request->getPost('NUMERO_CHAMBRE'));
         $CODE_TYPE_CLIENT=htmlspecialchars($this->request->getPost('CODE_TYPE_CLIENT'));

            

        // $path = $this->request->getFile('AFFICHE');
        //  $AFFICHE=$this->get_imag($path);

         $data=['DESCRIPTION'=>$DESCRIPTION,'CODE_CATEGORI'=>$CODE_CATEGORI,'CODE_CHAMPRE'=>$CODE_CHAMPRE,'NUMERO_CHAMBRE'=>$NUMERO_CHAMBRE,'CODE_TYPE_CLIENT'=>$CODE_TYPE_CLIENT];
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
         $DESCRIPTION=htmlspecialchars($this->request->getPost('DESCRIPTION'));
         $CODE_CATEGORI=htmlspecialchars($this->request->getPost('CODE_CATEGORI'));
         $NUMERO_CHAMBRE=htmlspecialchars($this->request->getPost('NUMERO_CHAMBRE'));
         $CODE_TYPE_CLIENT=htmlspecialchars($this->request->getPost('CODE_TYPE_CLIENT'));

            

        // $path = $this->request->getFile('AFFICHE');
        //  $AFFICHE=$this->get_imag($path);

         $data=['DESCRIPTION'=>$DESCRIPTION,'CODE_CATEGORI'=>$CODE_CATEGORI,'NUMERO_CHAMBRE'=>$NUMERO_CHAMBRE,'CODE_TYPE_CLIENT'=>$CODE_TYPE_CLIENT];
         
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
         <input type="hidden"  name="id" value="'.$code->ID_CHAMBRE.'">

        <label for="text" style="color: black; font-size: 18px;"><b>NUMERO_CHAMBRE</b></label>
            <input type="text"  name="NUMERO_CHAMBRE" value="'.$code->NUMERO_CHAMBRE.'" class="form-control">

            <label for="text" style="color: black; font-size: 18px;"><b>DESCRIPTION</b></label>
            <input type="text"  name="DESCRIPTION"value="'.$code->DESCRIPTION.'"class="form-control" >
            <label for="text" style="color: black; font-size: 18px;"><b>CODE_CATEGORI</b></label>
          <select class="form-control" name="CODE_CATEGORI">
            <option value=""> SELECTIONNER CATEGORIE</option>
            '.$this->Getoption('categorie','CODE_CATEGORI','CATEGORIE',$code->CODE_CATEGORI).'
          </select>

        <label style="color: black; font-size: 18px;"><b> TYPE_CLIENT </b></label>
          <select class="form-control" name="CODE_TYPE_CLIENT">
            <option value=""> SELECTIONNER TYPE CLIENT</option>
            '.$this->Getoption('type_client','CODE_TYPE_CLIENT','TYPE_CLIENT',$code->CODE_TYPE_CLIENT).'
          </select>
    
            ';
    }

}