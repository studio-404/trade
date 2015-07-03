<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>title</title>
</head>
<body>
<h2>General info</h2>
<?php
$homepage_general = json_decode($data["homepage_general"],true);
echo "<pre>";
print_r($homepage_general); 
echo "</pre>"; 
?>

<h2>components</h2>
<?php
$components = json_decode($data["components"],true);
echo "<pre>";
print_r($components); 
echo "</pre>"; 
?>

<h2>languages</h2>
<?php
$languages = json_decode($data["languages"],true);
echo "<pre>";
print_r($languages); 
echo "</pre>";
?>

<h2>language data</h2>
<?php
$language_data = json_decode($data["language_data"],true);
echo "<pre>";
print_r($language_data); 
echo "</pre>";
?>

<h2>main menu</h2>
<?php
$main_menu = json_decode($data["main_menu"],true);
echo "<pre>";
print_r($main_menu); 
echo "</pre>";
?>

<h2>multimedia</h2>
<?php
$multimedia = json_decode($data["multimedia"],true);
echo "<pre>";
print_r($multimedia); 
echo "</pre>";
?>

<h2>news</h2>
<?php
$news = json_decode($data["news"],true);
echo "<pre>";
print_r($news); 
echo "</pre>";
?>

<h2>events</h2>
<?php
$events = json_decode($data["events"],true);
echo "<pre>";
print_r($events); 
echo "</pre>";
?>


</body>
</html>