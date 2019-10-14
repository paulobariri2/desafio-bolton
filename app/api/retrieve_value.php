<?php
include_once "/var/www/html/database/database.php";
include_once "/var/www/html/objects/nfe.php";

if (!isset($_GET['access_key']))
{
	die(json_encode(array("error" => "access_key is mandatory.")));
}

$nfe = new Nfe();
$nfe->accessKey = $_GET['access_key'];

$db = new Database();
$db->startConnection();
$result = $db->queryByPK($nfe);

if ($result->num_rows > 0)
{
	$row = $result->fetch_assoc();
	$nfeArray = array("access_key" => $row['access_key'], "value" => $row['value']);
	
	#http_respose_code(200);
	echo json_encode($nfeArray);	
}
else
{
	#http_response_code(404);
	echo json_encode(array("message" => "Access key does not exist in Database"));
}

?>
