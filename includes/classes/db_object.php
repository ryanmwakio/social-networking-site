<?php

/*
|--------------------------------------------------------------------------
| The Db_object class
|--------------------------------------------------------------------------
|
| This class contains all the code on CRUD (Create | Read | Update | Delete)
| This is abstracted code to ensure it is used in any class
| For each class you will have to create a property named $db_table that will hold the table name e.g  $db_table="users"
| For each class you will have to create a property named $db_table_fields that will hold the table fields in an array e.g $db_table_fields=['username', 'password','firstname','lastname'];
| 
|
*/

class Db_object{

    public $limit;
    public $tmp_path;
    public $where;
    public $variable;

    
    public $upload_errors=[
        UPLOAD_ERR_OK          =>  "There is no error",
        UPLOAD_ERR_INI_SIZE    =>  "The uploaded file exceeds the maximum upload file size",
        UPLOAD_ERR_FORM_SIZE   =>  "The uploaded file exceeds the maximum file size",
        UPLOAD_ERR_PARTIAL     =>  "The uploaded file was only partially uploaded",
        UPLOAD_ERR_NO_FILE     =>  "No file was uploaded",
        UPLOAD_ERR_NO_TMP_DIR  =>  "Missing a temporary folder",
        UPLOAD_ERR_CANT_WRITE  =>  "Failed to write file to disk",
        UPLOAD_ERR_EXTENSION   =>  "A PHP extension stopped the file upload"
    ];


    protected function properties(){
        $properties=[];
        foreach($this->db_table_fields as $db_field){
            if(property_exists($this,$db_field)){
                $properties[$db_field]=$this->$db_field;//this $db_field variable is being created on the fly
            }
        }
        return $properties;
    }



    protected function clean_properties(){
        global $database;
        $clean_properties=[];
        foreach($this->properties() as $key=>$value){
            $clean_properties[$key]=$database->escape_string($value);
        }
        return $clean_properties;
    }



    public function create(){
        global $database;
        $properties=$this->clean_properties();
        $sql="INSERT INTO ".$this->db_table."(".implode(",",array_keys($properties)).") VALUES('".implode("','",array_values($properties))."')";
        if($database->query($sql)){
            $this->id=$database->the_insert_id();
            return true;
        }else{
            return false;
        }

    }



    public function read(){
        global $database;
        $sql="SELECT * FROM ".$this->db_table." ORDER BY id DESC LIMIT ".$this->limit."";
        $result=$database->query($sql);
        return $result;
    }



    public function read_where(){
        global $database;
        $sql="SELECT * FROM ".$this->db_table." WHERE {$this->where}='{$this->variable}' ORDER BY id DESC LIMIT ".$this->limit."";
        $result=$database->query($sql);
        return $result;
    }



    public function update(){
        global $database;
        $properties=$this->clean_properties();
        foreach($properties as $key=>$value){
            $properties_pairs[]="{$key}='{$value}'";
        }
        $id=$database->escape_string($this->id);
        $sql="UPDATE ".$this->db_table." SET ".implode(",",$properties_pairs)." WHERE id=$id";
        if($database->query($sql)){
            return true;
        }else{
            return false;
        }
    }



    public function delete(){
        global $database;
        $id=$database->escape_string($this->id);
        $sql="DELETE FROM ".$this->db_table." WHERE id=$id";
        if($database->query($sql)){
            return true;
        }else{
            return false;
        }
    }



    
    public function find_item_by_id($id){
        global $database;
        $sql="SELECT * FROM ".$this->db_table." WHERE id=$id LIMIT 1";
        $result=$database->query($sql);
        return $result;
    }



       //The below method is taking $_FILES['uploaded_file'] as an argument
       public function set_file($file){
        if(empty($file) || !$file || !is_array($file)){
            $this->errors[]="There was no file uploaded here";
            return false;
        }elseif($file['error']!=0){
            $this->errors[]=$this->upload_errors[$file['error']];
            return false;
        }else{
            $this->photo_filename=mktime().uniqid().basename($file['name']);
            $this->tmp_path=$file['tmp_name'];
            $this->photo_type=$file['type'];
            $this->photo_size=$file['size'];
        }
    }

   

    public function save(){
        if($this->id){
            $this->update();
        }else{
            if(!empty($this->errors)){
                return false;
            }
            if(empty($this->photo_filename) || empty($this->tmp_path)){
                $this->errors[]='the file was not available';
                return false;
            }
            $target_path=SITE_ROOT.DS.$this->upload_directory.DS.$this->photo_filename;
            if(file_exists($target_path)){
                $this->errors[]="The file ".$this->photo_filename." already exists";
                return false;
            }
            if(move_uploaded_file($this->tmp_path,$target_path)){
                if($this->create()){
                    unset($this->tmp_path);
                    return true;
                }
            }else{
                $this->errors[]="The file directory probably does not have permission";
                return false;
            }
        }
    }



    public function count_all(){
        global $database;
        $sql="SELECT COUNT(*) FROM ".$this->db_table;
        $result=$database->query($sql);
        $row=mysqli_fetch_assoc($result);
        return array_shift($row);
    }



}

$db_object=new Db_object();



?>