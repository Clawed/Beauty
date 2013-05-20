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
	
	class BeautyCore
	{
		public function GetIp()
		{
			return $this->FilterInput($_SERVER['HTTP_CF_CONNECTING_IP'] ? $_SERVER['HTTP_CF_CONNECTING_IP'] : $_SERVER['REMOTE_ADDR']);
		}
		public function InsertLog($activity)
		{
			global $db;
			if($stmt = $db->prepare("INSERT INTO beauty_logs VALUES (NULL, ?, ?, ?, ?);"))
			{
				$stmt->bind_param("ssis", $_SESSION['BEAUTY']['USERNAME'], $activity, time(), $this->GetIp());
				$stmt->execute();
				$stmt->close();
			}
			else
			{
				die($db->error);
			}
		}
		public function FilterInput($string)
		{
			global $db;
			return $db->real_escape_string(stripslashes(trim($string)));
		}
	}

?>