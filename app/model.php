<?php
/**
* 
*/
date_default_timezone_set('Asia/Ho_Chi_Minh');
class Database 
{
	private $host;
	private $username;
	private $password;
	private $databaseName;
	private $conn;

	function __construct($databaseName)
	{
		$this->host = 'localhost';
		$this->username = 'root';
		$this->password = 'root';
		$this->databaseName = $databaseName;
		$this->connect();
	}

	function connect() {
		$this->conn = new mysqli($this->host, $this->username, $this->password, $this->databaseName);
		if($this->conn->connect_error){
			die("Connection failed: " . $this->conn->connect_error);
		}
	}

	function disconnect() {
		if(is_object($this->conn))
			$this->conn->close();
	}

	function escape_string($s) {
		return $this->conn->escape_string($s);
	} 
	
	function insert($table, $data) {
		if(!is_array($data) || !is_string($table)) 
			return false;
		$keys = "";
		$values = "";
		foreach ($data as $key => $value) {
			$keys .= ($key).",";
			$values .= "'".$this->conn->escape_string($value)."',";
		}
		$keys = trim($keys, ',');
		$values = trim($values, ',');
		$sql = "INSERT INTO `$table` ($keys) VALUES ($values);";
		if($this->conn->query($sql)) 
			return $this->conn->insert_id;
		return false;
	}

	function update($table, $data, $id) {
		$id = (int)$id;
		if(!is_string($table) || !is_array($data) || !is_integer($id))
			return false;
		$content = "";
		foreach ($data as $key => $value) {
			$content .= $key." = '".$this->conn->escape_string($value)."', ";
		}
		$content = trim($content, ', ');
		$sql = "UPDATE `$table` SET $content WHERE id = $id;";
		return $this->conn->query($sql);
	}

	function delete($table, $id) {
		$id = (int)$id;
		if(!is_string($table) || !is_integer($id))
			return false;
		$sql = "DELETE FROM `$table` WHERE id = $id;";
		return $this->conn->query($sql);
	}

	function getArray($table) {
		if(!is_string($table)) 
			return false;
		$sql = "SELECT * FROM `$table`;";
		if($result = $this->conn->query($sql)) {
			$data = null;
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		} 
		return false;
	}

	function getObject($table) {
		if(!is_string($table)) 
			return false;
		$sql = "SELECT * FROM `$table`;";
		if($result = $this->conn->query($sql)) {
			$data = null;
			while ($row = $result->fetch_object()) {
				$data[] = $row;
			}
			return $data;
		} 
		return false;
	}

	function getLimitArray($table, $start, $limit) {
		$start = (int)$start;
		$limit = (int)$limit;
		if(!is_string($table) || !is_integer($start) || !is_integer($limit)) 
			return false;
		$sql = "SELECT * FROM `$table` LIMIT $start, $limit;";
		if($result = $this->conn->query($sql)) {
			$data = null;
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function getLimitObject($table, $start, $limit) {
		$start = (int)$start;
		$limit = (int)$limit;
		if(!is_string($table) || !is_integer($start) || !is_integer($limit)) 
			return false;
		$sql = "SELECT * FROM `$table` LIMIT $start, $limit;";
		if($result = $this->conn->query($sql)) {
			$data = null;
			while ($row = $result->fetch_object()) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function getRowArray($table, $id) {
		$id = (int)$id;
		if(!is_string($table) || !is_integer($id))
			return false;
		$sql = "SELECT * FROM `$table` WHERE id = $id;";
		if($result = $this->conn->query($sql)) {
			$data = null;
			$data = $result->fetch_assoc();
			return $data;
		}
		return false;
	}

	function getRowObject($table, $id) {
		$id = (int)$id;
		if(!is_string($table) || !is_integer($id))
			return false;
		$sql = "SELECT * FROM `$table` WHERE id = $id;";
		if($result = $this->conn->query($sql)) {
			$data = null;
			$data = $result->fetch_object();
			return $data;
		}
		return false;
	}

	function query($sql, $return = false) {
		$return = (bool)$return;
		if(!is_string($sql) || !is_bool($return)) 
			return false;
		if($result = $this->conn->query($sql)) {
			if($return) {
				$data = null;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				return $data;
			} else {
				return true;
			}
		}
		return false;
	}

	function mention($message){
		$message = preg_replace("/([A-Za-z0-9])@/", "$1 @", $message);	
		$result = array(
			'message' => $message, 
			'id_user' => array()
		);
		$pattern = '/@(.+?)[, ;.!?-]/';
		preg_match_all($pattern, $message.'.', $matches);
		
		for ($i=0; $i < count($matches[1]); $i++) { 
			$sql = "SELECT id FROM `user` 
					WHERE username = '{$matches[1][$i]}'";
			if($res = $this->conn->query($sql)) {
				$row = $res->fetch_assoc();
				if($row !== NULL){
					$result['id_user'][] = $row['id'];
					$user = "@".$matches[1][$i];
					$link = "<a class='mention'  href='index.php?controller=account&id={$row['id']}'>{$user}</a>";
					$result['message'] = preg_replace("/{$user}/", $link, $result['message']);	
				}
			} else return false;
		}

		return $result;	
	}
}

function changeDateTime($date, $isNoti = false) {
	$now = date("Y-m-d H:i:s");
	$t = strtotime($now) - strtotime($date);
	$result;
	if($t < 3600) {
		$result = floor($t / 60);
		if($result == 0) $result = 1;
		if($isNoti) $result .= 'm';
		else $result .= ' minute'. ($result > 1 ? 's' : '') .' ago';
	} else if($t < 24 * 3600){
		$result = floor($t / 3600);
		if($isNoti) $result .= 'h';
		else $result .= ' hour'. ($result > 1 ? 's' : '') .' ago';
	} else if($t < 24 * 3600 * 5){
		$result = floor($t / (24 * 3600));
		if($isNoti) $result .= 'd';
		else $result .= ' day'. ($result > 1 ? 's' : '') .' ago';
	} else {
		$timestamp = $isNoti ? "M d" : "F d";
		$result = date($timestamp, strtotime($date));
	}
	return $result;
}

?>
