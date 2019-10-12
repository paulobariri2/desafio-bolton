<?php

function findTotal($element)
{
	if (count($element->children()) == 0)
	{
		return null;
	}
	if ("total" == $element->getName())
	{
		return $element;
	}
	foreach ($element->children() as $child)
	{
		$total = findTotal($child);
		if (!is_null($total))
		{
			return $total;
		}
	}
	return null;
}

function populateDataBase() 
{
	$curl = curl_init();

	curl_setopt($curl, CURLOPT_URL, "https://sandbox-api.arquivei.com.br/v1/nfe/received");
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json','x-api-id: f96ae22f7c5d74fa4d78e764563d52811570588e','x-api-key: cc79ee9464257c9e1901703e04ac9f86b0f387c2'));
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	$response = curl_exec($curl);
	$response = json_decode($response);

	$data =  $response->data;
	foreach ($data as $nfe)
	{
		$xml = "";
		for ($i=0; $i < ceil(strlen($nfe->xml)/256); $i++)
			$xml = $xml . base64_decode(substr($nfe->xml, $i*256, 256));
		$xml = new SimpleXMLElement($xml);
		$total = findTotal($xml);
		insertIntoDB($nfe->access_key, $total->ICMSTot->vNF);
	}
	curl_close($curl);
}

function insertIntoDB($access_key, $value)
{
	$servername = "mysql";
	$username = "user";
	$password = "password";
	$dbname = "dbbolton";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error)
	{
		die("Connection falied: " . $conn->connect_error);
	}
	
	$sql = "INSERT INTO nfevalue (access_key, value) VALUES ('" . $access_key . "','" . $value . "')";
	
	if ($conn->query($sql) === TRUE) 
	{
		echo " -> " . $access_key . " - " . $value . "<br>";
	}
	else
	{
		echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
	}

	$conn->close();   
}

?>
