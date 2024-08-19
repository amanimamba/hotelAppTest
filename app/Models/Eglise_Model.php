<?php namespace App\Models;

// Use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;
class Eglise_Model 
{
      // protected $db;
     //  protected $returnType = 'array';
     public function __construct(ConnectionInterface &$db)
     {
          $this->db = & $db;
     }
     public function getAll($tabel)
     {
      return $this->db->table($tabel)->get()->getResult();
     
     
     }
     
     
     public function getWhereConditon($table,$var)
     {
          return  $this->db->table($table)
                         ->Where($var)
                         ->get()
                         ->getResult();
     }
     
     function helper_generate_code($table,$champs,$ext)
     {
          $table=$table;
          $code=$ext.sha1(md5(uniqid()));
          $cond=array($champs=>$code);
          while(!empty($this->getWhereConditon($table,$cond))){
          $code=$ext.sha1(md5(uniqid()));
          }

          return $code;   
     }
     public function insert($table, $var)
     {
          $data=$this->db->table($table)
                         ->insert($var);
          if($data){
               return true;
          }
          return false;
     
     }
     public function getOne($table, $var)
     {
          return $this->db->table($table)
                         ->where($var)
                         ->get()
                         ->getRow();
         
     
     }

     public function querySql($sql){
          $donne= $this->db->query($sql, FALSE)
           ;
           
           return $donne->getResult();
           
     }
     public function querySqlOne($sql){
          $donne= $this->db->query($sql, FALSE)
           ;
           
           return $donne->getRow();
           
     }

     public function update($table,$condition,$data)
     {
         return $this->db->table($table)
                         ->where($condition)
                         ->update($data);

     }

     public function delete($table,$condition)
     {
         return $this->db->table($table)
                         ->where($condition)
                         ->delete();

     }
      

}
