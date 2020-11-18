<?php

class Session{


    private $signed_in=false;
    public $user_id;
    public $message;
    public $count;
    
    
    
    function __construct(){
        $this->check_the_login();
        $this->check_message();
        $this->visitor_count();
    }



    public function is_signed_in(){
        return $this->signed_in;
    }



    public function login($user){
        if(isset($user)){
            $this->user_id=$_SESSION['user_id']=$user;//the user id is set
            $this->signed_in=true;
        }
    }



    public function logout(){
        unset($_SESSION['user_id']);
        unset($this->user_id);
        session_unset();
        session_destroy();
        setcookie('PHPSESSID', 0, time() - 3600);

        $this->signed_in=false;
    }



    private function check_the_login(){
        if(isset($_SESSION['user_id'])){
            $this->user_id=$_SESSION['user_id'];
            $this->signed_in=true;
        }else{
            unset($this->user_id);
            $this->signed_in=false;
        }
    }



    public function message($msg=null){
        if(!empty($msg)){
            $_SESSION['message']=$msg;
        }else{
            return $this->message;
        }
    }



    private function check_message(){
        if(isset($_SESSION['message'])){
            $this->message=$_SESSION['message'];
            unset($_SESSION['message']);
        }else{
            $this->message='';
        }
    }



    public function visitor_count(){
            if(isset($_SESSION['count'])){
                return $this->count=$_SESSION['count']++;
            }else{
                return $_SESSION['count']=1;
            }
    }



}

$session=new Session();
$message=$session->message();

?>