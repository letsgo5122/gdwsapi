<?php 
$port = getenv("PORT");
//print($port );


$id = 1;
$field = 'myfield';
$data = array(
    "id" => $id,
    "field" => $field
);

function httpRequest($api, $data_string){
	$ch = curl_init($api);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	  'Content-Type: application/json',
	  'Content-Length: ' . strlen($data_string))
	);
	$result = curl_exec($ch);
	if($result === false){
		echo curl_errno($curl);
		exit();
	}
	curl_close($ch);
	return json_decode($result, true);
}

$retdata = httpRequest('http://localhost:'.$port.'/4.php', json_encode($data));
echo $retdata['id'].':'.$retdata['name'].'<br/>';
echo 'I have stuff:'.'<br/>';
foreach ($retdata['stuff'] as $values)
{
	print $values.'<br/>';
}

function phpsend($port){	
	$url = 'http://localhost:'.$port.'/3.php';
	$opt_data = 'name=BY2&age=999&sex=MAXMAN';

	$curl = curl_init();  //初始化
	curl_setopt($curl,CURLOPT_URL,$url);  //設定url
	curl_setopt($curl,CURLOPT_HTTPAUTH,CURLAUTH_BASIC);  //設定http驗證方法
	curl_setopt($curl,CURLOPT_HEADER,0);  //設定頭資訊
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);  //設定curl_exec獲取的資訊的返回方式
	curl_setopt($curl,CURLOPT_POST,1);  //設定傳送方式為post請求
	curl_setopt($curl,CURLOPT_POSTFIELDS,$opt_data);  //設定post的資料

	$result = curl_exec($curl);
	if($result === false){
		echo curl_errno($curl);
		exit();
	}
	print_r($result);
	curl_close($curl);
}
echo phpsend($port);
?>