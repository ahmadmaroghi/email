<?php
include ('DBConfig.php');

class Mail{
	private $db;

	public function __construct($DB_con){
  		$this->db = $DB_con;
	 }
	
	public function sentMailHeader($username, $mail_subject,$mail_message,$mail_date,$mail_parent){
		try{
			$stmt = $this->db->prepare("INSERT INTO mail_header(username,mail_subject,mail_message,mail_date,mail_parent) VALUES(:username,:mail_subject,:mail_message,:mail_date,:mail_parent)");
			$stmt->bindparam(":username",$username);
			$stmt->bindparam(":mail_subject",$mail_subject);
			$stmt->bindparam(":mail_message",$mail_message);
			$stmt->bindparam(":mail_date",$mail_date);
			$stmt->bindparam(":mail_parent",$mail_parent);
			$stmt->execute();
			return $this->db->lastInsertId();
	  	}catch(PDOException $e){
	   		return $e->getMessage();
	  	}  
	}

	public function sentMailDetail($mail_id,$username,$mail_status){
		try{
			$stmt = $this->db->prepare("INSERT INTO mail_detail(mail_id,username,mail_status) VALUES(:mail_id, :username,:mail_status)");
			$stmt->bindparam(":mail_id",$mail_id);
			$stmt->bindparam(":username",$username);
			$stmt->bindparam(":mail_status",$mail_status);
			$stmt->execute();
			return true;
	  	}catch(PDOException $e){
	  		echo $e->getMessage(); 
	   		return false;
	  	}  
	}

	public function reply($username, $mail_subject,$mail_message,$mail_date,$mail_parent){
		try{
			$stmt = $this->db->prepare("INSERT INTO mail_header(username,mail_subject,mail_message,mail_date,mail_parent) VALUES(:username,:mail_subject,:mail_message,:mail_date,:mail_parent)");
			$stmt->bindparam(":username",$username);
			$stmt->bindparam(":mail_subject",$mail_subject);
			$stmt->bindparam(":mail_message",$mail_message);
			$stmt->bindparam(":mail_date",$mail_date);
			$stmt->bindparam(":mail_parent",$mail_parent);
			$stmt->execute();
			return $this->db->lastInsertId();
	  	}catch(PDOException $e){
	   		return $e->getMessage();
	  	}  
	}

	public function getMailAll($email){
		$stmt = $this->db->prepare("SELECT A.`mail_id`,A.`username`,A.`mail_subject`,A.`mail_message`,A.`mail_date`, B.`mail_status`, B.`username` AS 'mail_to' FROM mail_header A INNER JOIN mail_detail B ON A.`mail_id` = B.`mail_id` WHERE B.`username` = :email AND (B.`mail_status` = '2' OR B.`mail_status` = '1') ");
		$stmt->bindparam(":email", $email);
  		$stmt->execute();
  		if($stmt->rowCount()>0)
  		{
  			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  			return $result;
	   	}else{
	   		return $stmt->rowCount();
	   	}
	}

	public function getSentAll($email){
		$stmt = $this->db->prepare("SELECT A.`mail_id`,A.`username`,A.`mail_subject`,A.`mail_message`,A.`mail_date`, B.`mail_status`, B.`username` AS 'mail_to' FROM mail_header A INNER JOIN mail_detail B ON A.`mail_id` = B.`mail_id` WHERE A.`username` = :email AND NOT B.`mail_status` = '3' ");
		$stmt->bindparam(":email", $email);
  		$stmt->execute();
  		if($stmt->rowCount()>0)
  		{
  			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  			return $result;
	   	}else{
	   		return $stmt->rowCount();
	   	}
	}

	public function getTrashAll($email){
		$stmt = $this->db->prepare("SELECT A.`mail_id`,A.`username`,A.`mail_subject`,A.`mail_message`,A.`mail_date`, B.`mail_status`, B.`username` AS 'mail_to' FROM mail_header A INNER JOIN mail_detail B ON A.`mail_id` = B.`mail_id` WHERE B.`username` = :email AND B.`mail_status` = '3' ");
		$stmt->bindparam(":email", $email);
  		$stmt->execute();
  		if($stmt->rowCount()>0)
  		{
  			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  			return $result;
	   	}else{
	   		return $stmt->rowCount();
	   	}
	}

	public function getMailRead($mail_id){
		$stmt = $this->db->prepare("SELECT A.`username`, A.`mail_subject`,A.`mail_message`,A.`mail_date`
									FROM mail_header A 
									INNER JOIN mail_detail B ON A.mail_id = B.mail_id 
									WHERE A.`mail_id` = :mail_id OR A.`mail_parent` = :mail_id
									GROUP BY A.`username`, A.`mail_subject`,A.`mail_message`,A.`mail_date`");
  		$stmt->bindparam(":mail_id", $mail_id);
  		$stmt->execute();
  		if($stmt->rowCount()>0)
  		{
  			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  			return $result;
	   	}else{
	   		return $stmt->rowCount();
	   	}
	}

	public function getMailRecipient($mail_id){
		$stmt = $this->db->prepare("SELECT A.`mail_id`, B.`username` FROM mail_detail WHERE A.`mail_id` = :mail_id");
		$stmt->bindparam(":mail_id", $mail_id);
  		$stmt->execute();
  		if($stmt->rowCount()>0)
  		{
  			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  			return $result;
	   	}else{
	   		return $stmt->rowCount();
	   	}
	}

	public function getInboxCount($email){
		$stmt = $this->db->prepare("SELECT COUNT(*) AS 'jmlInbox' FROM mail_detail A WHERE A.`username` = :email AND A.`mail_status` = 1");
		$stmt->bindparam(":email",$email);
  		$stmt->execute();
  		$result = $stmt->fetch(PDO::FETCH_ASSOC);
  		$row = $result;
  		return $row['jmlInbox'];
	}

	public function getSubject($mail_id){
		$stmt = $this->db->prepare("SELECT A.`mail_subject` 
									FROM mail_header A 
									WHERE A.`mail_id` = :mail_id");
		$stmt->bindparam(":mail_id",$mail_id);
  		$stmt->execute();
  		$result = $stmt->fetch(PDO::FETCH_ASSOC);
  		$row = $result;
  		return $row['mail_subject'];
	}

	public function getSentCount($email){
		$stmt = $this->db->prepare("SELECT COUNT(*) AS 'jmlSent' FROM mail_header A INNER JOIN mail_detail B ON A.`mail_id` = B.`mail_id` WHERE A.`username` = :email AND NOT B.`mail_status` = '3'");
		$stmt->bindparam(":email",$email);
  		$stmt->execute();
  		$result = $stmt->fetch(PDO::FETCH_ASSOC);
  		$row = $result;
  		return $row['jmlSent'];
	}

	public function getTrashCount($email){
		$stmt = $this->db->prepare("SELECT COUNT(*) AS 'jmlTrash' FROM mail_detail A WHERE A.`username` = :email AND A.`mail_status` = '3'");
		$stmt->bindparam(":email",$email);
  		$stmt->execute();
  		$result = $stmt->fetch(PDO::FETCH_ASSOC);
  		$row = $result;
  		return $row['jmlTrash'];
	}

	public function setStatusMessage($mail_id,$username){
		try{
			$stmt = $this->db->prepare("UPDATE mail_detail SET mail_status = '2' WHERE mail_id = :mail_id AND username = :username");
			$stmt->bindparam(":mail_id",$mail_id);
			$stmt->bindparam(":username",$username);
			$stmt->execute();
			return $this->db->lastInsertId();
	  	}catch(PDOException $e){
	   		return $e->getMessage();
	  	}  
	}

	public function setTrash($mail_id,$username){
		try{
			echo $mail_id;
			$stmt = $this->db->prepare("UPDATE mail_detail SET mail_status = '3' WHERE mail_id = :mail_id AND username = :username");
			$stmt->bindparam(":mail_id",$mail_id);
			$stmt->bindparam(":username",$username);
			$stmt->execute();
			return $this->db->lastInsertId();
	  	}catch(PDOException $e){
	   		return $e->getMessage();
	  	}  
	}

	public function deleteTrash($mail_id,$username){
		try{
			$stmt = $this->db->prepare("DELETE FROM mail_detail WHERE mail_id = :mail_id AND username = :username");
			$stmt->bindparam(":mail_id",$mail_id);
			$stmt->bindparam(":username",$username);
			$stmt->execute();
			return $this->db->lastInsertId();
	  	}catch(PDOException $e){
	   		return $e->getMessage();
	  	}  
	}
}

$mail = new Mail($DB_con);
?>