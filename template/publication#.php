<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>title</title>
</head>
<body>
<div id="publication_general"></div>
<div id="publication_list"></div>
<div id="components"></div>
<div id="languages"></div>
<div id="language_data"></div>
<div id="main_menu"></div>

<script type="text/javascript" charset="utf-8">

/*
* team general information
*/
var data1 = '<?=$data["publication_general"]?>';
var obj1 = JSON.parse(data1);
console.log(obj1);
if(obj1.length){
	document.getElementById("publication_general").innerHTML = '<h2>General info</h2> '+ obj1[0].title;
}

/*
* team list & needs ajax request for catalog more info
*/
var publication_list = '<?=$data["publication_list"]?>';
var objp = JSON.parse(publication_list);
console.log(objp);
if(objp.length){
	document.getElementById("publication_list").innerHTML = '<h2>catalog list</h2> '+ objp[0].title + '<br />' + objp[0].pic;
}

/*
* Social networks
* Slider
* Banners
* Big homepage banner
*/
var data2 = '<?=$data["components"]?>';
var obj2 = JSON.parse(data2);
console.log(obj2);
if(obj2.length){
	document.getElementById("components").innerHTML = '<h2>Components</h2> '+ obj2[0].title;
}

/*
* languages
*/
var data3 = '<?=$data["languages"]?>';
var obj3 = JSON.parse(data3);
console.log(obj3);
if(obj3.length){
	document.getElementById("languages").innerHTML = '<h2>Languages</h2> '+ obj3[0].text;
}

/*
* language data Variables
*/
var data4 = '<?=$data["language_data"]?>';
var obj4 = JSON.parse(data4);
console.log(obj4);
if(obj4){
	document.getElementById("language_data").innerHTML = '<h2>Language data</h2> '+ obj4[0].text;
}

/*
* main manu, footer menu
*/
var data5 = '<?=$data["main_menu"]?>';
var obj5 = JSON.parse(data5);
console.log(obj5);
if(obj5.title.length){
	document.getElementById("main_menu").innerHTML = '<h2>Main menu</h2> '+ obj5.title[0];
}

</script>


</body>
</html>