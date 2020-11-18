<?php

$fname='';
$lname='';
$email='';
$email2='';
$password='';
$password2='';
$date='';
$message=null;
$message2=null;


if(isset($_POST['register_button'])){
 
    //Registration form values

    //First name
    $fname=strip_tags($_POST['reg_fname']);
    $fname=str_replace(' ','',$fname);
    $fname=ucfirst(strtolower($fname));
    

    //Last name
    $lname=strip_tags($_POST['reg_lname']);
    $lname=str_replace(' ','',$lname);
    $lname=ucfirst(strtolower($lname));

    //Email
    $email=strip_tags($_POST['reg_email']);
    $email=str_replace(' ','',$email);

    //Email2
    $email2=strip_tags($_POST['reg_email2']);
    $email2=str_replace(' ','',$email2);

    //Password
    $password=strip_tags($_POST['reg_password']);

    //Password2
    $password2=strip_tags($_POST['reg_password2']);

    //Date
    $date=mktime();

    $db_object->limit=1;
    $db_object->db_table='users';

    // $db_object->where='username';//from the Db_Object class
    // $db_object->variable=$email;

    if(strlen($fname) > 25 || strlen($fname) < 2){
        $message="Your first name must be between 2 and 25 characters"; 
    }

    if(strlen($lname) > 25 || strlen($lname) < 2){
        $message="Your last name must be between 2 and 25 characters"; 
    }

    
    $db_object->where='email';
    $db_object->variable=$email;

    if($email==$email2){
        //Check if email is in the valid format
        if(filter_var($email,FILTER_VALIDATE_EMAIL)){
            $email=filter_var($email,FILTER_VALIDATE_EMAIL);

            //Check if email already exists
            $results=$db_object->read_where();
            $count=mysqli_num_rows($results);

            if($count > 0){
                $message="Email already in use"; 
            }
        }else{
            $message="Invalid email format";
        }
    }else{
        $message="Emails do not match"; 
    }

    if($password !== $password2){
        $message="Your passwords do not match please check"; 
    }else{
        if(preg_match('/[^A-Za-z0-9]/',$password)){
            $message="Your password can only contain english characters or numbers";
        }
    }

    
    if(strlen($password) < 8){
        $message="Please choose a longer stronger password";
    }


   //If we do not have any error message
   if(!isset($message)){
    $password=encrypt_password($password);

    //Generate username
    $username=strtolower($fname."_".$lname);

    $db_object->where='username';
    $db_object->variable=$username;
    $results=$db_object->read_where();
    $count=mysqli_num_rows($results);
    $i=0;
    //If username exists then add a number
    while($count != 0 ){
        $i++;
        $username=$username."_".$i;
        $db_object->where='username';
        $db_object->variable=$username;
        $results=$db_object->read_where();
        $count=mysqli_num_rows($results);
    }

    //Prfile picture assignment
    $rand=rand(1,16);
    if($rand==1){
        $profile_pic="assets/images/profile_pics/defaults/head_alizarin.png";
    }else if($rand==2){
        $profile_pic="assets/images/profile_pics/defaults/head_amethyst.png";
    }else if($rand==3){
        $profile_pic="assets/images/profile_pics/defaults/head_belize_hole.png";
    }else if($rand==4){
        $profile_pic="assets/images/profile_pics/defaults/head_carrot.png";
    }else if($rand==5){
        $profile_pic="assets/images/profile_pics/defaults/head_deep_blue.png";
    }else if($rand==6){
        $profile_pic="assets/images/profile_pics/defaults/head_emerald.png";
    }else if($rand==7){
        $profile_pic="assets/images/profile_pics/defaults/head_green_sea.png";
    }else if($rand==8){
        $profile_pic="assets/images/profile_pics/defaults/head_nephritis.png";
    }else if($rand==9){
        $profile_pic="assets/images/profile_pics/defaults/head_pete_river.png";
    }else if($rand==10){
        $profile_pic="assets/images/profile_pics/defaults/head_pomegranate.png";
    }else if($rand==11){
        $profile_pic="assets/images/profile_pics/defaults/head_pumpkin.png";
    }else if($rand==12){
        $profile_pic="assets/images/profile_pics/defaults/head_red.png";
    }else if($rand==13){
        $profile_pic="assets/images/profile_pics/defaults/head_sun_flower.png";
    }else if($rand==14){
        $profile_pic="assets/images/profile_pics/defaults/head_turqoise.png";
    }else if($rand==15){
        $profile_pic="assets/images/profile_pics/defaults/head_wet_asphalt.png";
    }else if($rand==16){
        $profile_pic="assets/images/profile_pics/defaults/head_wisteria.png";
    }

    $user->first_name=$fname;
    $user->last_name=$lname;
    $user->username=$username;
    $user->email=$email;
    $user->password=$password;
    $user->signup_date=mktime();
    $user->photo_filename=$profile_pic;
    $user->num_posts=0;
    $user->num_likes=0;
    $user->user_closed='no';
    $user->friend_array=',';
    if($user->create()){
    $message2="The user {$user->username} was created successfully";
    }

    $fname=null;
    $lname=null;
    $email=null;
    $email2=null;
    $password=null;
    $password2=null;

   }

}

?>