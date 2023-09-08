<?php

include_once'../lib/Database.php';
include_once'../helpers/Format.php';

class Register{
    public $db;
    public $fr;

    public function _construct()
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

        // $e_query="SELECT * FROM tbl_user WHERE  email='$emali'";
        // $check_email= $this->db->select($e_query);

        // if($check_email>0){
        //     $error="Your email is alrady Existlib";

        //     return $error;

        //     header("location:register.php");

        // }

    if(empty($name) || empty($phone) || empty($emali) || empty($password)){
        $error="Fild most not empty";
        return $error;

    }

    }

}

?>