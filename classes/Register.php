<?php
include_once'../lib/Database.php';
include_once'../helpers/Format.php';
include_once'../PHPmailer/PHPMailer.php';
include_once'../PHPmailer/SMTP.php';
include_once'../PHPmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
    class Register{
        public $ed;
        public $fr;


        public function __construct()
        {
            $this->ed=new Database();
            $this->fr=new Format();

        }
        public function AddUser($data){

            function sendemail_verifi($name, $email, $v_token){
            $mail = new PHPMailer(true);
             $mail->isSMTP();
             $mail->SMTPAuth   = true; 


            }
            $name=$this->fr->validation($data['name']);
            $phone=$this->fr->validation($data['phone']);
            $email=$this->fr->validation($data['email']);
            $paassword=$this->fr->validation($data['password']);
            $v_token=md5(rand());

            if(empty($name)|| empty($phone) || empty($email) || empty($paassword)){
                $error="Fild must not be Empty";
                return $error;

            }else{
                
                $e_query ="SELECT *FROM tbl_users WHERE email= '$email'";
                $check_email = $this->ed->select($e_query);
                if($check_email >0){
                    $error = "This Email is alrady Exisit";
                    return $error;
                    header("Location:register.php");
                }else{
                    $insert_query="INSERT INTO tbl_user(name, email, phone, password, v_token) VALUES('$name', '$email', '$phone', '$paassword', '$v_token')";
                    $insert_row=$this->ed->insert($insert_query);

                    if($insert_row){
                        sendemail_verifi($name, $email, $v_token);
                        $success="Registration successfully. Place check your email inbox for verifi email";
                        return $success;
                    }else{
                        $error ="Registrstion failed";
                        return $error;
                    }
                }

            }

        }

    }
?>