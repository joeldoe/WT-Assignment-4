<?php
	class Menu
	{	
		private $foodItems;

		function __construct(array $foodItems)
		{
			if(sizeof($foodItems) > 0)
			{
				$this->foodItems = $foodItems;
			}
			else
			{
				throw new Exception("Data unavailable!");
			}
		}

		public function getFoodList()
		{
			foreach($this->foodItems as $item)
			{
				$foodNames[] = array("id"=>$item['id'], "name"=>$item['name'], "description"=>$item['description']);
			}
			return json_encode($foodNames);
		}

		public function getFoodItem($foodName)
		{
			$response = ["Item doesn't exist"];
			if($foodName)
			{
				foreach($this->foodItems as $item)
				{
					if($foodName == $item['name'])
					{
						$response = $item;
						break;
					}
				}
			}
			return json_encode($response);
		}
	}
?>