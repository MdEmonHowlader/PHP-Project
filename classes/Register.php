<?php

include_once'../lib/Database.php';
include_once'../helpers/format.php';

class Register{
    public $db;
    public $fr;

    public function __construct()
    {
      $this->db= new Database();  
      $this->fr=new Format(); 
    }
    public function AddUser($data){
        $name=$this->fr->validation($data['name']);
        $phone=$this->fr->validation($data['phone']);
        $emali=$this->fr->validation($data['emali']);
        $password=$this->fr->validation($data['password']);
        $v_token= md5(rand());

    }

}

?>