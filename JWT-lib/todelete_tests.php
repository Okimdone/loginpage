<?php
	require_once __DIR__ . '/vendor/autoload.php';

	$jwt = new \Lindelius\JWT\StandardJWT();

	$jwt->shimo7fa  = "HS3xxxx84";
	$jwt->exp = time() + (60 * 20); // Expire after 20 minutes
	$jwt->iat = time();
	$jwt->sub = "ACHRAF message HAHA";//$user->id;

	$accessToken = $jwt->encode("HS256");

	var_dump($accessToken);
	$accessToken[119]="k";
	var_dump($accessToken);
	

	//$accessToken

	$decoded_msg = \Lindelius\JWT\StandardJWT::decode($accessToken);

	echo "<pre>";
	var_dump($decoded_msg);
	echo "</pre>";
	
	$verfied = $decoded_msg->verify("HS256"); 
	var_dump($verfied);
