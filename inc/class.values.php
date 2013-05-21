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
	
	class BeautyValues
	{
		public function GetCategories($id)
		{
			global $db, $config;
			if($query = $db->query("SELECT * FROM beauty_values_categories ORDER BY name ASC"))
			{
				$data = "";
				while($array = $query->fetch_assoc())
				{
					if($id == $array['id'])
					{
						$data .= "<div class=\"row selected\" id=\"cat-" . $array['id'] . "\">" . $array['name'] . "</div>";
					}
					else
					{
						$data .= "<a href=\"" . $config->settings['path'] . "/values.php?cat=" . $array['id'] . "\" class=\"row\" id=\"cat-" . $array['id'] . "\">" . $array['name'] . "</a>";
					}
				}
				return $data;
			}
			else
			{
				kill($db->error, true);
			}
		}
		
		public function GetCategoryName($id)
		{
			global $db;
			$stmt = $db->stmt_init();
			if($stmt->prepare("SELECT name FROM beauty_values_categories WHERE id = ? LIMIT 1"))
			{
				$stmt->bind_param("i", $id);
				$stmt->bind_result($name);
				$stmt->execute();
				$stmt->fetch();
				$stmt->close();
				return $name;
			}
			else
			{
				kill($db->error, true);
			}
		}
		
		public function ListItemsFromCategory($id)
		{
			global $db;
			$stmt = $db->stmt_init();
			if($stmt->prepare("SELECT name FROM beauty_values_items WHERE category_id = ?"))
			{
				$stmt->bind_param("i", $id);
				$stmt->bind_result($name);
				$stmt->execute();
				$stmt->store_result();
				$data = "";
				if($stmt->num_rows > 0)
				{
					while($stmt->fetch())
					{
						$data .= $name;
					}
				}
				else
				{
					$data = "Nothing in this category yet!";
				}
				$stmt->close();
				return $data;
			}
			else
			{
				kill($db->error, true);
			}
		}
	}

?>