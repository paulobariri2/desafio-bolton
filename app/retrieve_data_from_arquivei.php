<?php
include_once dirname(".") . "/database/database.php";
include_once dirname(".") . "/objects/nfe.php";

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

function retrieveDataFromArquivei() 
{
	$curl = curl_init();

	curl_setopt($curl, CURLOPT_URL, "https://sandbox-api.arquivei.com.br/v1/nfe/received");
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json','x-api-id: f96ae22f7c5d74fa4d78e764563d52811570588e','x-api-key: cc79ee9464257c9e1901703e04ac9f86b0f387c2'));
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	$response = curl_exec($curl);
	$response = json_decode($response);
	$data = $response->data;

	curl_close($curl);
	
	return  $data;
	
}

?>
