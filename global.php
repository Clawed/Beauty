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
	
	require_once "inc/config.php";
	$config = new BeautyConfig;
	
	if(($config->mysqli[0] == "" or $config->mysqli[1] == "" or $config->mysqli[2] == "" or $config->mysqli[3] == "") or (file_exists("install.php")))
	{
		header("location: install.php"); exit;
	}
	
	if($config->settings['maintenance'] != false)
	{
		die("In mainteance.");
	}
	
	$db = new MySQLi($config->mysqli[0], $config->mysqli[1], $config->mysqli[2], $config->mysqli[3]);
	if($db->connect_error)
	{
		die($db->connect_error);
	}
	
	require_once "inc/class.session.php";
	$session = new BeautySession;
	$session->Run();
	
	require_once "inc/class.core.php";
	$core = new BeautyCore;
	
	if($config->settings['values']['enabled'] != false)
	{
		require_once "inc/class.values.php";
		$values = new BeautyValues;
	}
	
	if($config->settings['vipshop']['enabled'] != false)
	{
		require_once "inc/class.values.php";
		$vip = new BeautyVIP;
	}
	
	if($config->settings['badgeshop']['enabled'] != false)
	{
		require_once "inc/class.badge.php";
		$badge = new BeautyBadge;
	}

?>