<?php
include_once './database/database.php';
include_once './objects/nfe.php';
include_once './retrieve_data_from_arquivei.php';

echo "<h1>Desafio Bolton</h1>";

$data = retrieveDataFromArquivei();

$db = new Database();
$db->startConnection();

foreach ($data as $nfe)
{
	$xml = "";
	for ($i=0; $i < ceil(strlen($nfe->xml)/256); $i++)
		$xml = $xml . base64_decode(substr($nfe->xml, $i*256, 256));
	$xml = new SimpleXMLElement($xml);
	$total = findTotal($xml);

	$nfeObj = new Nfe();
	$nfeObj->accessKey = $nfe->access_key; 
	$nfeObj->value = $total->ICMSTot->vNF;
	echo "<p> data " . $total->ICMSTot->vNF . "</p>";  
	$db->insert($nfeObj);
}
$db->closeConnection();

?>
