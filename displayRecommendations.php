<?php
	if (!($_GET['city'] == '') && !($_GET['gender'] == '')) {
		$url = 'http://lukas.mtin.de/kleiderschrank/getClothesRecommendation.php';
		$city = $_GET['city'];
		$gender = $_GET['gender'];
		$url .= '?city=';
		$url .= $city;
		$json = file_get_contents($url);
		$data = json_decode($json);
		$top = $data->top;
		$trousers = $data->trousers;
		$icon_url = $data->icon;
		$city_display = $data->location;
		//$weather_description = $data->description;
		$rain = $data->rain;
	} else if (!($_GET['lat'] == '') && !($_GET['lon'] == '') && !($_GET['gender'] == '')) {
		$url = 'http://lukas.mtin.de/kleiderschrank/getClothesRecommendation.php';
		$lat = $_GET['lat'];
		$lon = $_GET['lon'];
		$gender = $_GET['gender'];
		$url .= '?lat=';
		$url .= $lat;
		$url .= '&lon=';
		$url .= $lon;
		$json = file_get_contents($url);
		$data = json_decode($json);
		$top = $data->top;
		$trousers = $data->trousers;
		$icon_url = $data->icon;
		$city_display = $data->location;
		//$weather_description = $data->description;
		$rain = $data->rain;
	} else {
		header('Location: index.htm');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Kleiderschrank: Empfehlungen</title>
		<link href='http://fonts.googleapis.com/css?family=Rancho' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/screen.css" media="screen, projection" />
	</head>
	<body>
		<div id="content">
			<h1 style="font-size: 50px;">Das solltest du heute in <? if($city == '') { echo $city_display; } else { echo $city; } ?> anziehen</h1>
			<div id="box_extras">
			<?php
			echo '<img width="300" id="weather_icon" src="http://openweathermap.org/img/w/'.$icon_url.'.png" />';
			if ($rain) {
				echo '<img class="clothes" id="umbrella" src="images/umbrella.png" alt="umbrella" width="150" height="140" style="margin-top: 20px;" />';
			}
			?>
			<br />
			</div>
			<div id="box_clothes">
			<?php
			echo '<img class="clothes" id="head" src="images/head-'.$gender.'.png" alt="head" width="80" height="80" />';
			echo '<img class="clothes" id="top" src="images/'.$top.'-'.$gender.'.png" alt="'.$top.'" width="160" height="160" style="margin-top: -10px;" />';
			echo '<img class="clothes" id="trousers" src="images/'.$trousers.'-'.$gender.'.png" alt="'.$trousers.'" width="160" height="240" />';
			echo '<img class="clothes" id="shoes" src="images/shoes-'.$gender.'.png" alt="shoes" width="160" height="40" />'; ?>
			</div>
			<div id="box_navigation">
			<a href="index.htm">&lt; Zurück</a>
			</div>
		</div>
	</body>
</html>