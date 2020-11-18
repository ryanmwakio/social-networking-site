<?php
  

  if(isset($_POST['login_button'])){
      $log_email=$_POST['log_username'];
      $log_password=$_POST['log_password'];

      if(empty($log_email)||empty($log_password)){
          $message="Your email or password cannot be empty"; 
      }else{

        
        //method to check database user
        $user_found=$user->verify_user($log_email,$log_password);

        if(isset($user_found)){
        $session->login($user_found);
        
        $the_user=$user->find_item_by_id($user_found);//get the user by id and pull the username from the database
        while($row=mysqli_fetch_assoc($the_user)){
          $user->username=$_SESSION['username']=$row['username'];//assign the username to session
        }
        $session->message("Hello {$user->username}, You are now logged in");
        redirect("index.php");
        }else if($user_found==null){
        $message="Your password or email is incorrect";
        }
        
    }  

      }else {

          $log_email=null;
          $log_password=null;
      
      }
  

 ?>