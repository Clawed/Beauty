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
	
	class BeautyVIP
	{
		public function LoadVIPs()
		{
			global $db;
			if($query = $db->query("SELECT * FROM beauty_vip ORDER BY price DESC"))
			{
				$data = "";
				if($query->num_rows > 0)
				{
					$j = "a";
					while($array = $query->fetch_assoc())
					{
						$data .= "<div class=\"row " . $j . "\" id=\"vip-" . $array['id'] . "\">";
						$data .= "";
						$data .= "";
						$data .= "";
						$data .= "</div>";
						
						$j++;
						if($j == "c")
						{
							$j = "a";
						}
					}
				}
				else
				{
					$data = "<center>Curretly VIP for sale.</center>";
				}
			}
			else
			{
				kill($db->error, true);
			}
			return $data;
		}
		
		public function BuyVIP($id)
		{
			global $db;
			if($id > 0)
			{
				$stmt = $db->stmt_init();
				if($stmt->prepare("SELECT name, price, type FROM beauty_vip WHERE id = ? LIMIT 1"))
				{
				}
				else
				{
					kill($db->error, true);
				}
			}
			else
			{
				return "Fatal error while loading";
			}
		}
	}

?>