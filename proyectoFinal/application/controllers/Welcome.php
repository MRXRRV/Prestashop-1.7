<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->view('subirInfo');
	}
	public function subirArchivo(){
		$path = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
	    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$path)){
	        if(is_uploaded_file($_FILES['file']['tmp_name'])){
	            
	            $file = fopen($_FILES['file']['tmp_name'], 'r');
	            
	            fgetcsv($file);
	            
	            while(($poss = fgetcsv($file)) !== FALSE){
	                $result = $this->db->get_where("tbl_promotor", array("nombre_promotor"=>$poss[0]))->result();
	                if(count($result) > 0){
	                    $this->db->update("tbl_promotor", array("nombre_promotor"=>$poss[0], "password"=>$poss[2], "status"=>$poss[3]), array("email"=>$poss[1]));
	                }else{
	                    $this->db->insert("tbl_promotor", array("nombre_promotor"=>$poss[0], "email"=>$poss[1], "password"=>$poss[2], "status"=>$poss[3]));
	                }
	            }
	            
	            fclose($file);

	            $response["status"] = 'Éxito';
	        }else{
	            $response["status"] = 'Error';
	        }
	    }else{
	        $response["status"] = 'Archivo Invalido';
	    }
	    $this->load->view('subirInfo',$response);
	}
}
