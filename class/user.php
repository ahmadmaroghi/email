<?php
include ('DBConfig.php');

class User{
	private $db;

	public function __construct($DB_con){
  		$this->db = $DB_con;
	 }
	
	public function saveUser($username,$email,$password,$address){
		try{
			$stmt = $this->db->prepare("INSERT INTO users(username,email,password,address) VALUES(:username, :email, :password, :address)");
			$stmt->bindparam(":username",$username);
			$stmt->bindparam(":email",$email);
			$stmt->bindparam(":password",$password);
			$stmt->bindparam(":address",$address);
			$stmt->execute();
			return true;
	  }catch(PDOException $e){
	  		echo $e->getMessage(); 
	   		return false;
	  }  
	}

	public function getUserEmail($username){
		$stmt = $this->db->prepare("SELECT email FROM users WHERE username <> '".$username."'");
  		$stmt->execute();
  		if($stmt->rowCount()>0)
  		{
  			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	   	}
	   	return $result;
	}

	public function getUserByLogin($email,$password){
		$stmt = $this->db->prepare("SELECT * FROM users WHERE email = '".$email."' AND password='".$password."'");
  		$stmt->execute();
  		if($stmt->rowCount()>0)
  		{
  			$result = $stmt->fetch();
  			return $result;
	   	}else{
	   		return $stmt->rowCount();
	   	}
	   	
	}

	public function print_r($data)
	{
		echo "string";
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}

}
$obj = new User($DB_con);
?>