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
		kill("You have to have at least one thing enabled. Other wise there's no point in having this script.");
	}
	
	require_once "header.php";

?>

<div id="wrapper-container">
	<div id="margin-container">
		<div id="column1-container">
			<div class="box-container">
				<div class="head-container">Home</div>
				<div class="content-container">
					Welcome to <strong>Beauty</strong>!
					<br /><br />
					Here with <strong>Beauty</strong> you can buy <strong>Badges</strong> & <strong>VIP</strong>!
					<br />
					You can also use Beauty to view your hotels <strong>Rare Values</strong>, with loads and loads of features involved!
					<br />
					You can view how many of these items are in the hotel, you can also view what items are where, eg: you just click the item & click rooms & it will tell youhow many of this item is in a certain room!
				</div>
			</div>
		</div>
	</div>
</div>

<?php

	require_once "footer.php";

?>