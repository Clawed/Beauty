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
	
	defined("IN_BEAUTY") or header("location: /");

?><!DOCTYPE html>
<html lang="en">

<head>

	<title><?php echo $config->settings['sitename']; ?> &raquo; <?php echo $page['title']; ?></title>
	
	<link type="text/css" rel="stylesheet" href="<?php echo $config->settings['path']; ?>/files/css/global.css" />

</head>

<body>

<div id="header-container">
	<div id="margin-container">
		<ul id="tabs">
			<li class="<?php if($page['id'] == "index"){ echo "selected"; } ?>">
			<?php if($page['id'] == "index"){ ?>Home
			<?php }else{ ?><a href="<?php echo $config->settings['path']; ?>/">Home</a>
			<?php } ?>
			</li>
			<?php
			
				if($config->settings['values']['enabled'] != false)
				{
			
			?><li class="<?php if($page['id'] == "values"){ echo "selected"; } ?>">
			<?php if($page['id'] == "values"){ ?>Rare Values
			<?php }else{ ?><a href="<?php echo $config->settings['path']; ?>/values.php">Rare Values</a>
			<?php } ?>
			</li>
			<?php } ?>
			<?php
			
				if($config->settings['vipshop']['enabled'] != false)
				{
			
			?><li class="<?php if($page['id'] == "vipshop"){ echo "selected"; } ?>">
			<?php if($page['id'] == "vipshop"){ ?>VIP Shop
			<?php }else{ ?><a href="<?php echo $config->settings['path']; ?>/vip.php">VIP Shop</a>
			<?php } ?>
			</li>
			<?php } ?>
			<?php
			
				if($config->settings['badgeshop']['enabled'] != false)
				{
			
			?><li class="<?php if($page['id'] == "badgeshop"){ echo "selected"; } ?>">
			<?php if($page['id'] == "badgeshop"){ ?>Badge Shop
			<?php }else{ ?><a href="<?php echo $config->settings['path']; ?>/badge.php">Badge Shop</a>
			<?php } ?>
			</li>
			<?php } ?>
		</ul>
		<?php
		
			$minrank = min($config->settings['values']['minrank'], $config->settings['badgeshop']['minrank'], $config->settings['vipshop']['minrank']);
			if($session->HasRank($minrank))
			{
		
		?><div id="staff-container">
			<span>Staff</span>
			<div id="staff-drop-container">
				<?php
				
					if($session->HasRank($config->settings['values']['minrank']))
					{
				
				?><a href="<?php echo $config->settings['path']; ?>/staff.php?do=values">Rare Values</a>
				<?php } ?>
				<?php
				
					if($session->HasRank($config->settings['vipshop']['minrank']))
					{
				
				?><a href="<?php echo $config->settings['path']; ?>/staff.php?do=vip">VIP Shop</a>
				<?php } ?>
				<?php
				
					if($session->HasRank($config->settings['badgeshop']['minrank']))
					{
				
				?><a href="<?php echo $config->settings['path']; ?>/staff.php?do=badge">Badge Shop</a>
				<?php } ?>
			</div>
		</div>
		<?php } ?>
	</div>
</div>
