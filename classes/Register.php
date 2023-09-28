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

             $mail->Host= 'smtp.gmail. com';
             $mail->Username='emonhowlader@gmail.com';
             $mail->Password='123456788';

             $mail->SMTPSecure='tls';
             $mail->Port=587;

             $mail->setFrom('emonhowlader@gamil.com', $name);
             $mail->addAddress($name);

             $mail->isHTML(true);
             $mail->Subject='Email Verification From Emon Howlader';


             $email_templet="
             <h2>Your have register with Emon</h2>
             <h5>Verify your email address to login please click the link below</h5>
             <a href='http://localhost/phpmyadmin/verify-email.php? token= v_token'>Click Here</a>
             ";


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