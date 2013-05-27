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
	
	class BeautyBadge
	{
		public function LoadBadges()
		{
			global $db;
			if($query = $db->query("SELECT * FROM beauty_badges ORDER BY name ASC"))
			{
				$data = "";
				if($query->num_rows > 0)
				{
					$j = "a";
					while($array = $query->fetch_assoc())
					{
						$data .= "<div class=\"row " . $j . "\" id=\"badge-" . $array['id'] . "\">";
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
					$data = "<center>Curretly no badges for sale.</center>";
				}
				return $data;
			}
			else
			{
				kill($db->error, true);
			}
		}
		
		public function BuyBadge($id)
		{
			global $db;
			if($id > 0)
			{
				$stmt = $db->stmt_init();
				if($stmt->prepare("SELECT price_credits, price_pixels, price_vip_points, amount FROM beauty_badges WHERE id = ? LIMIT 1"))
				{
					$stmt->bind_param("i", $id);
					$stmt->bind_result($credits, $pixels, $points, $amount);
					$stmt->execute();
					$stmt->store_result();
					$count = $stmt->num_rows;
					$stmt->fetch();
					$stmt->close();
					if($count > 0)
					{
						$stmt2 = $db->stmt_init();
						if($stmt2->prepare("SELECT credits, activity_points, vip_points FROM server_users WHERE username = ? LIMIT 1"))
						{
							$stmt2->bind_param("s", $_SESSION['BEAUTY']['USERNAME']);
							$stmt2->bind_result($credits2, $pixels2, $points2);
							$stmt2->execute();
							$stmt2->fetch();
							$stmt2->close();
							if($credits2 > $credits)
							{
								if($pixels2 > $pixels)
								{
									if($points2 > $points)
									{
									}
									else
									{
										return "No enough points";
									}
								}
								else
								{
									return "No enough pixels";
								}
							}
							else
							{
								return "No enough credits";
							}
						}
						else
						{
							kill($db->error, true);
						}
					}
					else
					{
						return "Fatel error while loading";
					}
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