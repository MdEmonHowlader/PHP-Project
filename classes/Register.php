<?php
include_once'../lib/Database.php';
include_once'../helpers/Format.php';
    class Register{
        public $ed;
        public $fr;


        public function __construct()
        {
            $this->ed=new Database();
            $this->fr=new Format();

        }
        public function AddUser($data){
            $name=$this->fr->validation($data['name']);
            $phone=$this->fr->validation($data['phone']);
            $email=$this->fr->validation($data['email']);
            $paassword=$this->fr->validation($data['password']);
            $v_token=md5(rand());

            // $e_query ="SELECT *FROM tbl_users WHERE email= '$email'";
            // $check_email = $this->ed->select($e_query);
            // if($check_email >0){
            //     $error = "This Email is alrady Exisit";
            //     return $error;
            //     header("Location:register.php");


            // }


            if(empty($name)|| empty($phone) || empty($email) || empty($paassword)){
                $error="Fild must not be Empty";
                return $error;

            }

        }

    }
?>