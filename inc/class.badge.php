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
										return "Not enough points";
									}
								}
								else
								{
									return "Not enough pixels";
								}
							}
							else
							{
								return "Not enough credits";
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
		
		public function AddBadge($name, $description, $credits, $pixels, $points, $badge, $amount)
		{
			global $db;
			if(strlen($name) > 0)
			{
				if(strlen($description) > 0)
				{
					if(is_numeric($credits))
					{
						if(is_numeric($pixels))
						{
							if(is_numeric($points))
							{
								if(strlen($badge) > 0)
								{
									if(is_numeric($amount))
									{
										$stmt = $db->stmt_init();
										if($stmt->prepare("INSERT INTO beauty_badges VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)"))
										{
											$stmt->bind_param("ssiiisi", $name, $description, $credits, $pixels, $points, $badge, $amount);
											$stmt->execute();
											$stmt->close();
										}
										else
										{
											kill($db->error, true);
										}
									}
									else
									{
										return "Amount needs to be a number";
									}
								}
								else
								{
									return "Badge needs to be longer than 0 characters in lenth";
								}
							}
							else
							{
								return "Points needs to be a number";
							}
						}
						else
						{
							return "Pixels needs to be a number";
						}
					}
					else
					{
						return "Credits needs to be a number";
					}
				}
				else
				{
					return "Description needs to be longer than 0 characters in lenth";
				}
			}
			else
			{
				return "Name needs to be longer than 0 characters in lenth";
			}
		}
		
		public function RemoveBadge($id)
		{
			global $db;
			if($id > 0)
			{
				$stmt = $db->stmt_init();
				if($stmt->prepare("DELETE FROM beauty_badges WHERE id = ? LIMIT 1"))
				{
					$stmt->bind_param("i", $id);
					$stmt->execute();
					$stmt->close();
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