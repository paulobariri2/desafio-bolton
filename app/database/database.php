<?php
include_once 'entity.php';

class Database
{
	private $servername = "mysql";
	private $dbname = "dbbolton";
	private $username = "user";
	private $password = "password";
	public $conn;

	public function startConnection()
	{
		$this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
		if ($this->conn->connect_error)
		{
			die("Connection falied: " . $this->conn->connect_error);
		}
		return $this->conn;
	}

	public function insert(Entity $entity)
	{
		$sql = $entity->insertSql();
		if ($this->conn->query($sql) === FALSE) 
		{
			echo "Error: " . $sql . "<br>" . $this->conn->error . "<br>";
		}
	}

	public function queryByPK(Entity $entity)
	{
		$sql = $entity->queryByPKSql();
		$result = $this->conn->query($sql);

		return $result;
	}

	public function closeConnection()
	{
		$this->conn->close();
	}
}

?>
