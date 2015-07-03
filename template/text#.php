<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>title</title>
</head>
<body>


<h2>text_general</h2>
<?php
$text_general = json_decode($data["text_general"],true);
echo "<pre>";
print_r($text_general);
echo "</pre>";
?>

<h2>text_files</h2>
<?php
$text_files = json_decode($data["text_files"],true);
echo "<pre>";
print_r($text_files);
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

<h2>language_data</h2>
<?php
$main_menu = json_decode($data["main_menu"],true);
echo "<pre>";
print_r($main_menu);
echo "</pre>";
?>




</body>
</html>