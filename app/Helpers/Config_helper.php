<?php 

function get_count($table,$Where=array()){
	$db_= db_connect();
	$Sql_query= new App\Models\Eglise_Model($db_);
           $Count_produit=$Get_Client->getWhereConditon($table,$Where);

           return count($Count_produit);
}





 ?>