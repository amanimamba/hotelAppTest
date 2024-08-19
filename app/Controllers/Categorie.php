<?php

namespace App\Controllers;
use App\Models\Eglise_Model;


class Categorie extends BaseController
{
    public $_db;
    public $Eglise;
    public $Class='Categorie';
    public $table='categorie';
    public $Champ=[
        'CATEGORIE'=>'text',
        'PRIX_CATEGORI'=>'text',
        'PRIX_PASSAGE'=>'text',
        
    ];
    public $id='ID_CATEGORIE';
    public $Code='CODE_CATEGORI';
     // link action 
    public $link_Add='Categorie/Add_news';
     public $link_edit='Categorie/Edite_news';
     public $link_update='Categorie/Update_news';

     public $link_delete='Categorie/Delete_news/';
     // link de form et liste
     public $link_liste='Categorie/liste_news';
     public $link_form='Categorie/';
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
       
       $devise='<label>Devise</label>
    <select name="DEVISE" class="form-control">
      <option value="">Selctionner Devise</option>

      <option value="Dollard">Dollard</option>
      <option value="Franc Congolais">Franc Congolais</option>

    </select>';
        return $form.$devise;
        
        
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
                <th>#</th>'.$this->header_table().'<th>DEVISE</th><th>Action</th>
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
                    <td>'.$key->CATEGORIE.'</td>
                    <td>'.$key->PRIX_CATEGORI.'</td>
                    <td>'.$key->PRIX_PASSAGE.'</td>
                    <td>'.$key->DEVISE.'</td>
                   
                    <td>'.$this->btn_action($key->CODE_CATEGORI).'</td>
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
       
        $CATEGORIE=htmlspecialchars($this->request->getPost('CATEGORIE'));
         $PRIX_CATEGORI=htmlspecialchars($this->request->getPost('PRIX_CATEGORI'));
         $PRIX_PASSAGE=htmlspecialchars($this->request->getPost('PRIX_PASSAGE'));
         $CODE_CATEGORI='CAT_'.uniqid(md5('CODE_CATEGORI'));
         
         $DEVISE=htmlspecialchars($this->request->getPost('DEVISE'));

         

        // $path = $this->request->getFile('AFFICHE');
        //  $AFFICHE=$this->get_imag($path);

         $data=['CATEGORIE'=>$CATEGORIE,'CODE_CATEGORI'=>$CODE_CATEGORI,'PRIX_CATEGORI'=>$PRIX_CATEGORI,'PRIX_PASSAGE'=>$PRIX_PASSAGE,'DEVISE'=>$DEVISE];
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
         $CATEGORIE=htmlspecialchars($this->request->getPost('CATEGORIE'));
         $PRIX_CATEGORI=htmlspecialchars($this->request->getPost('PRIX_CATEGORI'));
         $PRIX_PASSAGE=htmlspecialchars($this->request->getPost('PRIX_PASSAGE'));
        
         $DEVISE=htmlspecialchars($this->request->getPost('DEVISE'));
         // if (empty($IMG)) 
         // {
             
         //       $data=['TITRE'=>$TITRE,'AUTEUR'=>$AUTEUR,'MESSAGE'=>$MESSAGE];

         // }else{
         //    $AFFICHE=$this->get_imag($IMG);
         //     $data=['TITRE'=>$TITRE,'AUTEUR'=>$AUTEUR,'MESSAGE'=>$MESSAGE,'AFFICHE'=>$AFFICHE];
         // }
          $data=['CATEGORIE'=>$CATEGORIE,'PRIX_CATEGORI'=>$PRIX_CATEGORI,'PRIX_PASSAGE'=>$PRIX_PASSAGE,'DEVISE'=>$DEVISE];
         
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

        return'
         <input type="hidden"  name="id" value="'.$code->ID_CATEGORIE.'">

        <label for="text" style="color: black; font-size: 18px;"><b>CATEGORIE</b></label>
            <input type="text"  name="CATEGORIE" value="'.$code->CATEGORIE.'" class="form-control">

            <label for="text" style="color: black; font-size: 18px;"><b>PRIX_CATEGORI</b></label>
            <input type="text"  name="PRIX_CATEGORI"value="'.$code->PRIX_CATEGORI.'"class="form-control" >
            <label for="text" style="color: black; font-size: 18px;"><b>PRIX_PASSAGE</b></label>
            <input type="text"  name="PRIX_PASSAGE"value="'.$code->PRIX_PASSAGE.'"class="form-control" >
             <label for="text" style="color: black; font-size: 18px;"><b>DEVISE</b></label>
            '.$devise.'
            ';
    }

}