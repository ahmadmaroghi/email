<?php
include ('DBConfig.php');

class Mail{
	private $db;

	public function __construct($DB_con){
  		$this->db = $DB_con;
	 }
	
	public function sentMailHeader($username, $mail_subject,$mail_message,$mail_date){
		try{
			$stmt = $this->db->prepare("INSERT INTO mail_header(username,mail_subject,mail_message,mail_date) VALUES(:username,:mail_subject,:mail_message,:mail_date)");
			$stmt->bindparam(":username",$username);
			$stmt->bindparam(":mail_subject",$mail_subject);
			$stmt->bindparam(":mail_message",$mail_message);
			$stmt->bindparam(":mail_date",$mail_date);
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

	public function replyMailHeader($mail_id,$username,$reply_message,$reply_date){
		try{
			$stmt = $this->db->prepare("INSERT INTO reply_header(mail_id,username,reply_message,reply_date) VALUES(:mail_id,:username,:reply_message,:reply_date)");
			$stmt->bindparam(":mail_id",$mail_id);
			$stmt->bindparam(":username",$username);
			$stmt->bindparam(":reply_message",$reply_message);
			$stmt->bindparam(":reply_date",$reply_date);
			$stmt->execute();
			return $this->db->lastInsertId();
	  	}catch(PDOException $e){
	   		return $e->getMessage();
	  	}  
	}

	public function replyMailDetail($reply_id,$username,$reply_status){
		try{
			$stmt = $this->db->prepare("INSERT INTO reply_detail(reply_id,username,reply_status) VALUES(:reply_id,:username,:reply_status)");
			$stmt->bindparam(":reply_id",$reply_id);
			$stmt->bindparam(":username",$username);
			$stmt->bindparam(":reply_status",$reply_status);
			$stmt->execute();
			return true;
	  	}catch(PDOException $e){
	  		echo $e->getMessage(); 
	   		return false;
	  	}  
	}

	public function getMailAll($email){
		$stmt = $this->db->prepare("SELECT A.`mail_id`,A.`username`,A.`mail_subject`,A.`mail_message`,A.`mail_date`, B.`mail_status`, B.`username` AS 'mail_to' FROM mail_header A INNER JOIN mail_detail B ON A.`mail_id` = B.`mail_id` WHERE B.`username` = :email AND NOT B.`mail_status` = '3' ");
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
		$stmt = $this->db->prepare("SELECT A.`mail_id`,A.`username`,A.`mail_subject`,A.`mail_message`,A.`mail_date`, B.`mail_status`, B.`username` AS 'mail_to' FROM mail_header A INNER JOIN mail_detail B ON A.`mail_id` = B.`mail_id` WHERE A.`username` = :email ");
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
		$stmt = $this->db->prepare("SELECT A.`username`, A.`mail_subject`,A.`mail_message`,A.`mail_date`,
				COALESCE(C.reply_id, '') AS reply_id, C.reply_message FROM mail_header A INNER JOIN mail_detail B ON A.mail_id = B.mail_id LEFT JOIN reply_header C ON A.mail_id = C.mail_id LEFT JOIN reply_detail D ON C.reply_id = D.reply_id  WHERE A.`mail_id` = :mail_id");
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

	public function getSentCount($email){
		$stmt = $this->db->prepare("SELECT COUNT(*) AS 'jmlSent' FROM mail_header A INNER JOIN mail_detail B ON A.`mail_id` = B.`mail_id` WHERE A.`username` = :email");
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
			$stmt = $this->db->prepare("UPDATE mail_detail SET mail_status = '3' WHERE mail_id = :mail_id AND username = :username");
			$stmt->bindparam(":mail_id",$mail_id);
			$stmt->bindparam(":username",$username);
			$stmt->execute();
			return $this->db->lastInsertId();
	  	}catch(PDOException $e){
	   		return $e->getMessage();
	  	}  
	}

	public function setTrashInSent($mail_id,$username){
		try{
			$stmt = $this->db->prepare("UPDATE mail_detail SET mail_status = '4' WHERE mail_id = :mail_id AND username = :username");
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