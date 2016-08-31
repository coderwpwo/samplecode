<?php

require_once('../dbconfig.php');

/*

ADMIN class for login/logout admin add/edit user.

*/


class ADMIN
{	

	private $conn;
	
	/* Construtor */
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	/* Function for run queries for fetch data from database */
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	/* Function for add user By Admin */
	
	public function register($uname,$umail,$upass)
	{
		try
		{
			$new_password = password_hash($upass, PASSWORD_DEFAULT);
			
			$stmt = $this->conn->prepare("INSERT INTO admin(user_name,user_email,user_pass) 
		                                               VALUES(:uname, :umail, :upass)");
												  
			$stmt->bindparam(":uname", $uname);
			$stmt->bindparam(":umail", $umail);
			$stmt->bindparam(":upass", $new_password);										  
				
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	/* Function for Update users by Admin */

	public function updateUser($userid,$uname,$umail,$upass)
	{
		try
		{
			$new_password = password_hash($upass, PASSWORD_DEFAULT);
			
			$sql = "UPDATE users SET user_name = :uname,
									 user_email = :umail,
									 user_pass = :upass
						WHERE user_id = :userid";
			$stmt = $this->conn->prepare($sql);												  

												  
			$stmt->bindparam(":uname", $uname);
			$stmt->bindparam(":umail", $umail);
			$stmt->bindparam(":upass", $new_password);										  
			$stmt->bindparam(":userid", $userid);										  
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	/* Function for admin check login details,login,create admin session */
	
	public function doLogin($uname,$umail,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT user_id, user_name, user_email, user_pass FROM admin WHERE user_name=:uname OR user_email=:umail ");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{
				if(password_verify($upass, $userRow['user_pass']))
				{
					$_SESSION['user_admin_session'] = $userRow['user_id'];
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	/* Function for Check Admin login or not login */
	
	public function is_loggedin()
	{
		if(isset($_SESSION['user_admin_session']))
		{
			return true;
		}
	}
	
	/* Function for redirect page to another page */
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	/* Function for logout admin and unset admin session */
	
	public function doLogout()
	{
		session_destroy();
		unset($_SESSION['user_admin_session']);
		return true;
	}

	
	/* Function for redirect page to another page */

}

//The child class inherits the code from the parent class

class MOOD extends ADMIN{	

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }

	/* Function for Add mood by Admin */
	
	public function addMood($mood)
	{
		try
		{
			
			$stmt = $this->conn->prepare("INSERT INTO mood(mood) 
		                                               VALUES(:mood)");
												  
			$stmt->bindparam(":mood", $mood);
				
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	/* Function for Update mood by Admin */

	public function updateMood($moodadd,$moodid)
	{
		try
		{
			
			$sql = "UPDATE mood SET mood = :moodadd 
						WHERE id = :moodid";
			$stmt = $this->conn->prepare($sql);												  
			$stmt->bindparam(":moodadd", $moodadd);
			$stmt->bindParam(":moodid", $moodid);	
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
}
?>