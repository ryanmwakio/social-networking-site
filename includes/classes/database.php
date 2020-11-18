<?php

require_once("new_config.php");

class Database
{

    public $connection;


    function __construct()
    {
        $this->open_db_connection();
    }




    public function open_db_connection()
    {
        // $this->connection=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->connection->connect_errno) {
            die("Database connection failed badly" . $this->connection->connect_error);
        }
    }



    //method to send in any query
    //returns true or false or the result of query as result
    public function query($sql)
    {
        $result = $this->connection->query($sql);
        $result = $this->confirm_query($result);
        return $result;
    }



    //method to check if the query has been sent correctly
    private function confirm_query($result)
    {
        if (!$result) {
            die("Query Failed" . mysqli_error($this->connection));
        }
        return $result;
    }



    //method to sanitize the data
    public function escape_string($string)
    {
        $escaped_string = $this->connection->real_escape_string(trim(strip_tags($string)));
        return $escaped_string;
    }



    public function the_insert_id()
    {
        return $this->connection->insert_id;
    }
}
$database = new Database();

?>