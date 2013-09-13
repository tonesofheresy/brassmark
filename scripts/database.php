<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/.private/config.php');

class MySQLDatabase {
	
	private $connection;
	public $last_query;
	
	function __construct() {
		$this->open_connection();
	}
	
	public function open_connection() {
		$this->connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
		if(!$this->connection) {
			die("Database connection failed: " . mysql_error());	
		} else {
			$db_select = mysql_select_db(DB_NAME, $this->connection);
			if(!$db_select) {
				die("Database select failed: " . mysql_error());
			}
		}
	}
	
	public function close_connection() {
		if(isset($this->connection)) {
			mysql_close($this->connection);
			unset($this->connection);
		}
	}
	
	public function query($sql) {
		$result = mysql_query($sql, $this->connection);
		$this->confirm_query($result);
		return $result;	
	}
	
	public function mysql_prep($value) {
		$magic_quotes_active = get_magic_quotes_gpc();
		$new_enough_php = function_exists("mysql_real_escape_string");
		if($new_enough_php) {
			if($magic_quotes_active) {
				$value = stripslashes($value);	
			}
			$value = mysql_real_escape_string($value);
		} else {
			if(!$magic_quotes_active) {
				$value = addslashes($value);	
			}
		}
		return $value;
	}
	
	public function fetch_assoc($result_set) {
		return mysql_fetch_assoc($result_set);
	}
	
	public function num_rows($result_set) {
		return mysql_num_rows($result_set);
	}
	
	private function confirm_query($result) {
		if(!$result) {
			$output = "Database query failed: " . mysql_error();
			die($output);	
	  }
    }
}

$database = new MySQLDatabase();

?>