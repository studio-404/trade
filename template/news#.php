<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>title test</title>
</head>
<body>

<h2>news general</h2>
<?php
$news_general = json_decode($data["news_general"],true);
echo "<pre>";
print_r($news_general);
echo "</pre>";
?>

<h2>news list (7) from 2 to 8</h2>
<?php
$news_list = json_decode($data["news_list"],true);
echo "<pre>";
print_r($news_list);
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

<h2>language_data</h2>
<?php
$language_data = json_decode($data["language_data"],true);
echo "<pre>";
print_r($language_data);
echo "</pre>";
?>

<h2>main_menu</h2>
<?php
$main_menu = json_decode($data["main_menu"],true);
echo "<pre>";
print_r($main_menu);
echo "</pre>";
?>



</body>
</html>