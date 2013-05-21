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
	
	class BeautySession
	{
		public function Run()
		{
			if(isset($_SESSION['BEAUTY']['USERNAME']))
			{
				if(!$this->ValidateUser($_SESSION['BASE']['USERNAME']))
				{
					session_destroy();
					kill("Unable to validate session username.");
				}
			}
			elseif(isset($_SESSION['UBER_USER_N']))
			{
				if($this->ValidateUser($_SESSION['UBER_USER_N']))
				{
					$_SESSION['BEAUTY']['USERNAME'] = $_SESSION['UBER_USER_N'];
				}
			}
			elseif(isset($_SESSION['user']['id']))
			{
				if($this->ValidateUser($_SESSION['user']['username']))
				{
					$_SESSION['BEAUTY']['USERNAME'] = $_SESSION['user']['username'];
				}
			}
			elseif(isset($_SESSION['BASE']['USERNAME']))
			{
				if($this->ValidateUser($_SESSION['BASE']['USERNAME']))
				{
					$_SESSION['BEAUTY']['USERNAME'] = $_SESSION['BASE']['USERNAME'];
				}
			}
			else
			{
				kill("No session.");
			}
		}
		
		public function ValidateUser($username)
		{
			global $db;
			$stmt = $db->stmt_init();
			if($stmt->prepare("SELECT username FROM server_users WHERE username = ? LIMIT 1"))
			{
				$stmt->bind_param("s", $username);
				$stmt->execute();
				$stmt->store_result();
				return (($stmt->num_rows > 0) ? true : false);
			}
			else
			{
				kill($db->error);
			}
		}
		
		public function HasRank($rank)
		{
			global $db;
			$stmt = $db->stmt_init();
			if($stmt->prepare("SELECT rank FROM server_users WHERE username = ? AND rank >= ? LIMIT 1"))
			{
				$stmt->bind_param("si", $_SESSION['BEAUTY']['USERNAME'], $rank);
				$stmt->execute();
				$stmt->store_result();
				return (($stmt->num_rows > 0) ? true : false);
			}
			else
			{
				kill($db->error);
			}
		}
	}

?>