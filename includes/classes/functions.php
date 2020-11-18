<?php

function classAutoLoader($class){
    $class=strtolower($class);
    $the_path="includes/{$class}.php";
    if(file_exists($the_path)){
        require_once($the_path);
    }else{
        die("This file named {$class}.php was not found...");
    }
}
spl_autoload_register('classAutoLoader');



function redirect($path){
    header("Location: {$path}");
}



/*---------Show time ago function----------*/
function get_time_ago($time){
    $time_difference=time()-$time; 
    if($time_difference<1){
    return 'less than 1 second ago';
    }
    $condition=array(12*30*24*60*60=> 'year',
    30*24*60*60=> 'month',
    24*60*60=> 'day',
    60*60=>'hour',
    60=> 'minute',
    1=>'second');

    foreach($condition as $secs => $str){
        $d=$time_difference/$secs;
        if($d>=1){
            $t=round($d);
            return $t . ' ' . $str . ($t>1 ? 's' : '' ) . ' ago';
        }
    }
}





function generate_salt($length){

    $unique_random_string=md5(uniqid(mt_rand(),true));//md5 returns 32 characters

    $base64_string=base64_encode($unique_random_string);//valid characters are a-z,A-Z,0-9,./]

    $modified_base64_string=str_replace('+','.',$base64_string);//but not + which is valid base 64 character

    $salt=substr($modified_base64_string,0,$length);//truncate string to current length

    return  $salt;
    }


/*----------function to encrypt password---------*/
function encrypt_password($password){
        $hash_format="$2y$10$";
        $salt_length=22;
        $salt=generate_salt($salt_length);
        $format_and_salt=$hash_format.$salt;
    
        $password=crypt($password,$format_and_salt);  
        return $password;
}


function decrypt_password($password,$db_password){
    $password=crypt($password,$db_password);
    return $password;
}

?>