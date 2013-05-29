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
	
	define("IN_BEAUTY", true);
	
	session_start();
	
	function kill($string, $noExit = false)
	{
		echo "<h1>Beauty Error</h1>";
		echo "<hr>";
		echo $string;
		echo "<hr>";
		if(!$noExit) exit;
	}
	
	require_once "inc/config.php";
	$config = new BeautyConfig;
	
	$minrank = min($config->settings['values']['minrank'], $config->settings['badgeshop']['minrank'], $config->settings['vipshop']['minrank']);
	
	if($config->mysqli[0] == "" or $config->mysqli[1] == "" or $config->mysqli[2] == "" or $config->mysqli[3] == "")
	{
		if(file_exists("installer.php"))
		{
			header("location: installer.php"); exit;
		}
		else
		{
			kill("Your missing your installer file.");
		}
	}
	
	$db = new MySQLi($config->mysqli[0], $config->mysqli[1], $config->mysqli[2], $config->mysqli[3]);
	if($db->connect_error)
	{
		kill($db->connect_error);
	}
	
	if(isset($_GET['devLogin']))
	{
		$_SESSION['BASE']['USERNAME'] = "Clawed";
	}
	
	require_once "inc/class.session.php";
	$session = new BeautySession;
	$session->Run();
	
	require_once "inc/class.core.php";
	$core = new BeautyCore;
	
	if($config->settings['maintenance'] != false and !$session->HasRank($minrank))
	{
		kill("In mainteance.");
	}
	
	if($config->settings['values']['enabled'] != false)
	{
		require_once "inc/class.values.php";
		$values = new BeautyValues;
	}
	
	if($config->settings['vipshop']['enabled'] != false)
	{
		require_once "inc/class.vip.php";
		$vip = new BeautyVIP;
		
		if($config->settings['ipn']['paypal']['enabled'] != false or $config->settings['ipn']['paygol']['enabled'] != false)
		{
			require_once "inc/class.ipns.php";
			
			if($config->settings['ipn']['paypal']['enabled'] != false)
			{
				$paypal = new BeautyPaypal;
			}
			
			if($config->settings['ipn']['paygol']['enabled'] != false)
			{
				$paygol = new BeautyPaygol;
			}
		}
		else
		{
			kill("You need atleast 1 IPN system enabled.");
		}
	}
	
	if($config->settings['badgeshop']['enabled'] != false)
	{
		require_once "inc/class.badge.php";
		$badge = new BeautyBadge;
	}

?>