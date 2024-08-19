<?php

namespace App\Controllers;
use App\Models\Eglise_Model;


class Location extends BaseController
{
    public $_db;
    public $Eglise;
    public $Class='Location';
    public $table='location_chambres';
    public $Champ=[
        'DELAIT_LOCATION'=>'text',
        'DATE_ENTRE'=>'date',
        'DATE_SORTI'=>'date',
        'PRIX_PAYER'=>'text'
        
    ];
    public $id='ID_LOCATION';
    public $Code='CODE_LOCATION';
     // link action 
    public $link_Add='Location/Add_news';
     public $link_edit='Location/Edite_news';
     public $link_update='Location/Update_news';

     public $link_delete='Location/Delete_news/';
     // link de form et liste
     public $link_liste='Location/liste_news';
     public $link_form='Location/';
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
       
       $devise='<label for="text" style="color: black; font-size: 18px;"><b>Devise</b></label>
    <select name="DEVISE" class="form-control">
      <option value="">Selctionner Devise</option>

      <option value="Dollard">Dollard</option>
      <option value="Franc Congolais">Franc Congolais</option>

    </select>';
    $Type_sejours='<label for="text" style="color: black; font-size: 18px;"><b>TYPE DE RESERVATION</b></label>
    <select name="CODE_TYPE_SEJOURS" class="form-control">
      <option value="">Selctionner TYPE DE RESERVATION</option>

      <option value="Nuit">Nuit</option>
      <option value="Passage">Passage</option>

    </select>';
     $chambre='
        <label style="color: black; font-size: 18px;"><b> Chambre </b></label>
          <select class="form-control" name="CODE_CHAMBRE">
            <option value=""> SELECTIONNER CHAMBRE</option>
            '.$this->Getoption('chambres','CODE_CHAMPRE','NUMERO_CHAMBRE','').'
          </select>';
          
        return $chambre.$form.$Type_sejours.$devise;
        
        
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
                <th>#</th><th>NUMERO_CHAMBRE</th>'.$this->header_table().'<th>TYPE RESERVATION</th><th>Action</th>
            </thead>
            <tbody>';
            $finList='</tbody>
        </table>';
        $i=1;
             foreach ($getListe as $key) 
             {
                if ($key->DATE_SORTI==date('Y-m-d'))
                 {
                    $btn='danger';
                }else{
                    $btn='default';
                }
                $liste.='
                 
                <tr class="alert alert-'.$btn.'">
                    <td>'.$i.'</td>
                    <td>'.$this->getLiaison('chambres','CODE_CHAMPRE',$key->CODE_CHAMBRE,'NUMERO_CHAMBRE').'</td>
                    <td>'.$key->DELAIT_LOCATION.'</td>
                    <td>'.$key->DATE_ENTRE.'</td>
                    <td>'.$key->DATE_SORTI.'</td>
                    <td>'.$key->PRIX_PAYER.''.$key->DEVISE.'</td>
                    <td>'.$key->CODE_TYPE_SEJOURS.'</td>
                   
                    <td>'.$this->btn_action($key->CODE_LOCATION).'</td>
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

        
        $DELAIT_LOCATION=htmlspecialchars($this->request->getPost('DELAIT_LOCATION'));
         $DATE_ENTRE=htmlspecialchars($this->request->getPost('DATE_ENTRE'));
         $DATE_SORTI=htmlspecialchars($this->request->getPost('DATE_SORTI'));
         $PRIX_PAYER=htmlspecialchars($this->request->getPost('PRIX_PAYER'));
         $CODE_CHAMBRE=htmlspecialchars($this->request->getPost('CODE_CHAMBRE'));
         $CODE_TYPE_SEJOURS=htmlspecialchars($this->request->getPost('CODE_TYPE_SEJOURS'));
         $CODE_LOCATION='LOC_'.uniqid(md5('CODE_LOCATION'));
         
         $DEVISE=htmlspecialchars($this->request->getPost('DEVISE'));

         

        // $path = $this->request->getFile('AFFICHE');
        //  $AFFICHE=$this->get_imag($path);

         $data=[
         'DELAIT_LOCATION'=>$DELAIT_LOCATION,
         'DATE_ENTRE'=>$DATE_ENTRE,
         'DATE_SORTI'=>$DATE_SORTI,
         'PRIX_PAYER'=>$PRIX_PAYER,
         'DEVISE'=>$DEVISE,
         'CODE_TYPE_SEJOURS'=>$CODE_TYPE_SEJOURS,
         'CODE_LOCATION'=>$CODE_LOCATION,
         'CODE_CHAMBRE'=>$CODE_CHAMBRE
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
         $DELAIT_LOCATION=htmlspecialchars($this->request->getPost('DELAIT_LOCATION'));
         $DATE_ENTRE=htmlspecialchars($this->request->getPost('DATE_ENTRE'));
         $DATE_SORTI=htmlspecialchars($this->request->getPost('DATE_SORTI'));
         $PRIX_PAYER=htmlspecialchars($this->request->getPost('PRIX_PAYER'));
         $CODE_CHAMBRE=htmlspecialchars($this->request->getPost('CODE_CHAMBRE')); 
         $DEVISE=htmlspecialchars($this->request->getPost('DEVISE'));
         $CODE_TYPE_SEJOURS=htmlspecialchars($this->request->getPost('CODE_TYPE_SEJOURS'));
         

        // $path = $this->request->getFile('AFFICHE');
        //  $AFFICHE=$this->get_imag($path);

         $data=[
         'DELAIT_LOCATION'=>$DELAIT_LOCATION,
         'DATE_ENTRE'=>$DATE_ENTRE,
         'DATE_SORTI'=>$DATE_SORTI,
         'PRIX_PAYER'=>$PRIX_PAYER,
         'DEVISE'=>$DEVISE,
         'CODE_TYPE_SEJOURS'=>$CODE_TYPE_SEJOURS,
         'CODE_CHAMBRE'=>$CODE_CHAMBRE
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
        if ($code->DEVISE=='Dollard') {
           $devise='
                <select name="DEVISE" class="form-control">
                  <option value="">Selctionner Devise</option>

                  <option value="Dollard" selected>Dollard</option>
                  <option value="Franc Congolais">Franc Congolais</option>

                </select>';
        }else if ($code->DEVISE=='Franc Congolais') {
             $devise='
                <select name="DEVISE" class="form-control">
                  <option value="">Selctionner Devise</option>

                  <option value="Dollard">Dollard</option>
                  <option value="Franc Congolais" selected>Franc Congolais</option>

                </select>';
        }else{
             $devise='
                <select name="DEVISE" class="form-control">
                  <option value="">Selctionner Devise</option>

                  <option value="Dollard">Dollard</option>
                  <option value="Franc Congolais">Franc Congolais</option>

                </select>';
        }

        if ($code->DEVISE=='Nuit') {
           $Type_sejours='<label for="text" style="color: black; font-size: 18px;"><b>TYPE DE RESERVATION</b></label>
    <select name="CODE_TYPE_SEJOURS" class="form-control">
      <option value="">Selctionner TYPE DE RESERVATION</option>

      <option value="Nuit" selected>Nuit</option>
      <option value="Passage">Passage</option>

    </select>';
        }else if ($code->DEVISE=='Passage') {
             $Type_sejours='<label for="text" style="color: black; font-size: 18px;"><b>TYPE DE RESERVATION</b></label>
    <select name="CODE_TYPE_SEJOURS" class="form-control">
      <option value="">Selctionner TYPE DE RESERVATION</option>

      <option value="Nuit">Nuit</option>
      <option value="Passage"selected>Passage</option>

    </select>';
        }else{
             $Type_sejours='
             <label for="text" style="color: black; font-size: 18px;"><b>TYPE DE RESERVATION</b></label>
    <select name="CODE_TYPE_SEJOURS" class="form-control">
      <option value="">Selctionner TYPE DE RESERVATION</option>

      <option value="Nuit">Nuit</option>
      <option value="Passage">Passage</option>

    </select>';
        }




        
     $chambre='
        <label style="color: black; font-size: 18px;"><b> Chambre </b></label>
          <select class="form-control" name="CODE_CHAMBRE">
            <option value=""> SELECTIONNER CHAMBRE</option>
            '.$this->Getoption('chambres','CODE_CHAMPRE','NUMERO_CHAMBRE',$code->CODE_CHAMBRE).'
          </select>';

        
        return'
         <input type="hidden"  name="id" value="'.$code->ID_LOCATION .'">
                '.$chambre.'
        <label for="text" style="color: black; font-size: 18px;"><b>DELAIT_LOCATION</b></label>
            <input type="text"  name="DELAIT_LOCATION" value="'.$code->DELAIT_LOCATION.'" class="form-control">

            <label for="text" style="color: black; font-size: 18px;"><b>DATE_ENTRE</b></label>
            <input type="text"  name="DATE_ENTRE"value="'.$code->DATE_ENTRE.'"class="form-control" >

            <label for="text" style="color: black; font-size: 18px;"><b>DATE_SORTI</b></label>
            <input type="text"  name="DATE_SORTI"value="'.$code->DATE_SORTI.'"class="form-control" >

             

             <label for="text" style="color: black; font-size: 18px;"><b>PRIX_PAYER</b></label>
            <input type="text"  name="PRIX_PAYER"value="'.$code->PRIX_PAYER.'"class="form-control" >
            '.$Type_sejours.'
             <label for="text" style="color: black; font-size: 18px;"><b>DEVISE</b></label>
            '.$devise.'
            ';
    }

}