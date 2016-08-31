<?php


/* 
Datdabase class for define connection variable 
and database migration with mysql.   
*/

class Database
{   
    private $host = "localhost";
    private $db_name = "dblogin";
    private $username = "root";
    private $password = "";
    public $conn;
     
	 /* Function for database connection with pdo */
    public function dbConnection()
	{
     
	    $this->conn = null;    
        try
		{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        }
		catch(PDOException $exception)
		{
            echo "Connection error: " . $exception->getMessage();
        }
         
        return $this->conn;
    }
}
?>