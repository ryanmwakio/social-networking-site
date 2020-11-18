<?php

class User extends Db_object{


    protected $db_table="users";
    protected $db_table_fields=['first_name','last_name','username','email','password','signup_date','photo_filename','num_posts','num_likes','user_closed','friend_array'];
    public $id;
    public $first_name;
    public $last_name;
    public $username;
    public $email;
    public $password;
    public $signup_date;
    public $photo_filename;
    public $num_posts;
    public $num_likes;
    public $user_closed;
    public $friend_array;



    public $tmp_path;
    public $image_placeholder="http://placehold.it/400x400&text=image";

    public $upload_directory="../images/profile_pictures";
    public $errors=[];



     
    public function verify_user($username,$password){
        global $database;
        $username=$database->escape_string($username);
        $password=$database->escape_string($password);
        $sql1="SELECT * FROM ".$this->db_table." WHERE email='{$username}'";//pull the password from database for decryption
        $result1=$database->query($sql1);
        while($row=mysqli_fetch_assoc($result1)){
            $db_password=$row['password'];
        
        $password=decrypt_password($password,$db_password);
        $sql="SELECT * FROM ".$this->db_table." WHERE email='{$username}'  AND password='{$password}'";
        $result=$database->query($sql);
        if(mysqli_num_rows($result)==1){
            while($row=mysqli_fetch_assoc($result)){
                $user_id=$row['id'];
                return $user_id;
            }
           
        }else{
            $user_id=null;
            return $user_id;
        }
      }
    }



    // public function save(){
    //     return isset($this->id) ? $this->update() : $this->create();
    // }



    public function image_path_and_placeholder(){
       return empty($this->photo_filename) ? $this->image_placeholder : $this->upload_directory.DS.$this->photo_filename;
    }



    public function delete_user(){
        global $session;
        $target_path=$this->upload_directory.DS.$this->photo_filename;
        if($this->delete()){
            if($session->user_id==$this->id){
              $session->logout();
            }
            return unlink($target_path) ? true : false;
        }else{
            return false;
        }
    }



    public function find_user_by_username($username){
        global $database;
        $sql="SELECT * FROM ".$this->db_table." WHERE username='{$username}'";
        $result=$database->query($sql);
        if(mysqli_num_rows($result)>0){
            return true;
        }else{
            return false;
        }
    }



    public function picture_path(){
        return $this->upload_directory.DS.$this->photo_filename;
    }



    public function ajax_save_user_image($user_image,$user_id){
        global $database;

        $this->photo_filename=$database->escape_string($user_image);
        $this->id=$database->escape_string($user_id);

        $sql="UPDATE ".$this->db_table." SET photo_filename='{$this->photo_filename}' WHERE id={$this->id}";
        $result=$database->query($sql);
        if($result){
            echo $this->image_path_and_placeholder();
            return true;
        }else{
            return false;
        }
    }



    public function isClosed($username){
        global $database;
        $sql="SELECT * FROM ".$this->db_table." WHERE username='{$username}'";
        $results=$database->query($sql);
        while($row=mysqli_fetch_assoc($results)){
            if($row['user_closed']=='yes'){
                return true;
            }else{
                return false;
            }
        }
    }

    public function getNumPost(){
        global $database;
        global $post;

        $sql="SELECT * FROM posts WHERE added_by='{$this->username}'";
        $result=$database->query($sql);
        $post_count=mysqli_num_rows($result);
        return $post_count;
       
    }


    
}
$user=new User();

?>