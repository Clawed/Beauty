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
	
	class BeautyConfig
	{
		public $mysqli = array(
			"localhost", // Hostname
			"root", // Username
			"kyle123", // Password
			"base" // Database
		);
		public $settings = array(
			"sitename" => "Beauty", // Your site/hotel name
			"path" => "http://127.0.0.1/Beauty", // Path to this, no final slash
			"maintenance" => false, // true or false
			"values" => array(
				"enabled" => true, // true or false
				"minrank" => 4 // Min rank for staff.
			),
			"badgeshop" => array(
				"enabled" => true, // true or false
				"minrank" => 6 // Min rank for staff.
			),
			"vipshop" => array(
				"enabled" => true, // true or false
				"minrank" => 7 // Min rank for staff.
			),
			"ipn" => array(
				"paypal" => array(
					"enabled" => true, // true or false
					"email" => "email@you.com" // Paypal email
				),
				"paygol" => array(
					"enabled" => true // true or false
				)
			)
		);
	}

?>