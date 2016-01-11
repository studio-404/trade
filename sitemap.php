<?php 
header("Content-type: text/xml"); 
define("DIR",__FILE__);
@include('config.php');
@include('functions/connection.php');
$connection = new connection();
$conn = $connection->conn($c);
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">
<?php
try{
	$sql = 'SELECT `slug` FROM `studio404_module_item` WHERE `status`!=1 ORDER BY `id` DESC';
	$prepare = $conn->prepare($sql); 
	$prepare->execute();
	if($prepare->rowCount() > 0){
		$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC); 
		
		foreach($fetch as $val){
			echo '<url>';
			echo '<loc>http://tradewithgeorgia.com/en/'.$val['slug'].'</loc>';
			echo '<changefreq>always</changefreq>';
			echo '</url>';
		}
	}
?>

<?php
}catch(Exception $e){

}
?>
<url> 
<loc>http://tradewithgeorgia.com/en/start</loc>
<changefreq>always</changefreq>
</url>

<url> 
<loc>http://tradewithgeorgia.com/en/About-georgia/Country-profile</loc>
<changefreq>always</changefreq>
</url>

<url> 
<loc>http://tradewithgeorgia.com/en/About-georgia/Doing-Business-in-Georgia</loc>
<changefreq>always</changefreq>
</url>

<url> 
<loc>http://tradewithgeorgia.com/en/About-georgia/useful-information</loc>
<changefreq>always</changefreq>
</url>

<url> 
<loc>http://tradewithgeorgia.com/en/About-georgia/useful-links</loc>
<changefreq>always</changefreq>
</url>

<url> 
<loc>http://tradewithgeorgia.com/en/export-catalog</loc>
<changefreq>always</changefreq>
</url>

<url> 
<loc>http://tradewithgeorgia.com/en/trade-map/loadmap</loc>
<changefreq>always</changefreq>
</url>


<url> 
<loc>http://tradewithgeorgia.com/en/trade-map/export-analysis</loc>
<changefreq>always</changefreq>
</url>

<url> 
<loc>http://tradewithgeorgia.com/en/trade-map/how-to-export-from-Georgia</loc>
<changefreq>always</changefreq>
</url>
<url> 
<loc>http://tradewithgeorgia.com/en/trade-map/useful-links</loc>
<changefreq>always</changefreq>
</url>
<url> 
<loc>http://tradewithgeorgia.com/en/about-us/Enterprise-Georgia</loc>
<changefreq>always</changefreq>
</url>

<url> 
<loc>http://tradewithgeorgia.com/en/about-us/our-services</loc>
<changefreq>always</changefreq>
</url>

<url> 
<loc>http://tradewithgeorgia.com/en/about-us/events</loc>
<changefreq>always</changefreq>
</url>

<url> 
<loc>http://tradewithgeorgia.com/en/about-us/contact-us</loc>
<changefreq>always</changefreq>
</url>

</urlset>