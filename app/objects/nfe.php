<?php
include_once "/var/www/html/database/entity.php";

class Nfe implements Entity
{
	public $accessKey;
	public $value;

	public function insertSql()
	{
		return "INSERT INTO nfevalue (access_key, value) VALUES ('" . $this->accessKey . "','" . $this->value . "')";
	}

	public function queryByPKSql()
	{
		return "SELECT access_key, value FROM nfevalue WHERE access_key = '" . $this->accessKey . "'";  
	}
}

?>
