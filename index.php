<?php

	/*
		 _____ _____ _____ _   _ _____ _   _
		|  _  |  ___|  _  | | | |_   _| | | |
		| |_| | |__ | |_| | | | | | | | |_| |
		|  _  |  __||  _  | | | | | |  \   /
		| |_| | |___| | | | |_| | | |   | |
		|_____|_____|_| |_|_____| |_|   |_|
		
		Beauty V1.0.0
		Rare Values, VIP Shop & Badge Shop
		Copyright Clawed 2013
	
	*/
	
	$page = array(
		"title" => "Home",
		"id" => "index"
	);
	
	require_once "global.php";
	
	if($config->settings['values']['enabled'] != true and $config->settings['badgeshop']['enabled'] != true and $config->settings['vipshop']['enabled'] != true)
	{
		die("You have to have at least one thing enabled. Other wise there's no point in having this shop.");
	}
	
	require_once "header.php";

?>

<?php

	require_once "footer.php";

?>