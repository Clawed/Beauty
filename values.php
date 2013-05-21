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
		"title" => "Rare Values",
		"id" => "values"
	);
	
	require_once "global.php";
	
	if($config->settings['values']['enabled'] != true and $config->settings['badgeshop']['enabled'] != true and $config->settings['vipshop']['enabled'] != true)
	{
		kill("You have to have at least one thing enabled. Other wise there's no point in having this script.");
	}
	
	require_once "header.php";
	
	$cat = (($_GET['cat'] > 0) ? $core->FilterInput($_GET['cat']) : 0);

?>

<div id="wrapper-container">
	<div id="margin-container">
		<div id="column2-container">
			<div class="box-container">
				<div class="head-container">Categories</div>
				<div class="content-container">
					<?php echo $values->GetCategories($cat); ?>
				</div>
			</div>
		</div>
		<div id="column3-container">
			<div class="box-container">
				<div class="head-container"><?php echo $values->GetCategoryName($cat); ?></div>
				<div class="content-container">
					<?php echo $values->ListItemsFromCategory($cat); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php

	require_once "footer.php";

?>