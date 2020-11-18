<?php

class Post extends Db_object{


    protected $db_table="posts";
    protected $db_table_fields=['body','photo_filename','added_by','user_to','date_added','user_closed','deleted','likes'];
    public $id;
    public $photo_filename;
    public $body;
    public $added_by;
    public $user_to;
    public $date_added;
    public $user_closed;
    public $deleted;
    public $likes;

    public $photo_type;
    public $photo_size;
    public $tmp_path;
    public $image_placeholder="http://placehold.it/1920x1020&text=image";

    public $upload_directory="assets/images/posts";
    public $errors=[];


    public function image_path_and_placeholder(){
        return empty($this->photo_filename) ? $this->image_placeholder : $this->upload_directory.DS.$this->photo_filename;
     }

     public function picture_path(){
        return $this->upload_directory.DS.$this->photo_filename;
    }



    public function submit_post(){
        if($this->create()){
            return true;
        }else{
            return false;
        }
    }

    public function delete_post(){
        $target_path=$this->upload_directory.DS.$this->photo_filename;
        if($this->delete()){
            return unlink($target_path) ? true : false;
        }else{
            return false;
        }
    }



 
  





}
$post=new Post();

?>