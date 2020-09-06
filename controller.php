<?php
header("Content-type: application/json");
require "class.php";

$request = $_GET['req'] ?? null;

if($request)
{
	//$fileData = file_get_contents("https://davids-restaurant.herokuapp.com/menu_items.json");
	$fileData = file_get_contents("restaurant.json");
	$menuItems = json_decode($fileData,true)["menu_items"];
	//echo $menuItems;
	
	try
	{
		$menu = new Menu($menuItems);
	}
	catch(Exception $e)
	{
		echo("Error aa gaya: ");
		echo json_encode([$e->getMessage()]);
		return;
	}
}

switch($request)
{
	case 'dropdownList': echo $menu->getFoodList();
						 break;
	case 'foodItem': $foodName = $_GET['foodName'] ?? null;
					 echo $menu->getFoodItem($foodName);
					 break;
	default: echo json_encode(["Invalid request"]);
			 break;
}

?>