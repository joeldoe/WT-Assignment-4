<!DOCTYPE html>
<html>
<head>
	<title>Restaurant Menu</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>	
	<style>
		body
		{
			background-color: #0A3D62;
			font-family: "Verdana";
			width: 100%;
			height: 100%;
		}

		.container
		{
			border: 2px solid navy;
			margin-left: 240px;
			margin-top: 10%;
			width: 60%;
			padding: 15px;
			text-align: center;
			border-radius: 5px;
			background-color: #1BCA9B;
		}

		select, button
		{
			font-family: "Verdana";
			padding: 5px;
			margin: 2px;
			border: none;
			border-radius: 3px;
		}

		@media (min-width: 360px) and (max-width: 480px)
		{
			body
			{
				background-color: #0A3D62;
				font-family: "Verdana";
				width: 97.5%;
				height: 100%;
			}

			.container
			{
				border: 2px solid navy;
				margin-left: 60px;
				margin-top: 12%;
				width: 60%;
				padding: 15px;
				text-align: center;	
				border-radius: 5px;
				background-color: #1BCA9B;
				font-size: 16px;
			}

			select
			{
				font-family: "Verdana";
				padding: 5px;
				margin: 2px;
				border: none;
				border-radius: 3px;
				width: 70%;
			}

			button
			{
				font-family: "Verdana";
				padding: 5px;
				margin: 2px;
				border: none;
				border-radius: 3px;
			}					
		}
	</style>
</head>
<body>
	<div class="container">
		<p style="font-weight: bold; font-size: 20px;">Food Menu</p>
		<p>Choose the food item:</p>
		<select id="list" onchange="changingData();">
			<option>Select an item</option>
		</select>

		<p id="food-short-name"></p>
		<p id="food-name"></p>
		<p id="data"></p>
		<p id="min-price"></p>
		<p id="max-price"></p>
	</div>
	<script>
		var options = [];
		$(document).ready(function()
		{
			let url = "controller.php?req=dropdownList";
			$.get(url, function(data)
			{
				console.log(data);
				for(let i = 0; i < data.length; i++)
				{
					options.push(data[i]);
				}
				createOptions();
			});
		});

		function createOptions()
		{
			var list = document.getElementById('list');

			options.forEach(function(o){
				let option = document.createElement('option');
				option.textContent = o.name;
				list.appendChild(option);
			});
		}

		function changingData()
		{
			let foodName = document.getElementById('list').value;
			let url = "controller.php?req=foodItem&foodName="+foodName;
			$.get(url,function(data)
			{
				console.log(data);
				if(data == "Item doesn't exist")
				{
					alert("Please select an item!");
				}
				else
				{
					$("#food-short-name").html("<b>Short name:</b> " + data.short_name);
				$("#food-name").html("<b>Name:</b> " + data.name);
				$("#data").html("<b>About the item:</b> " + data.description);
				if(data.price_small == null)
				{
					$("#max-price").html("<b>Price(large):</b> " + data.price_large);
				}
				else
				{
					$("#min-price").html("<b>Price(small):</b> " + data.price_small);
					$("#max-price").html("<b>Price(large):</b> " + data.price_large);
				}
				}
			});
		}
	</script>
</body>
</html>