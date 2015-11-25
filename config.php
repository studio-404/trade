<?php
defined('DIR') OR exit;

$c['cmsversion'] = '1.0.1';
$c['website.mode'] = 'WorkingMode'; // UnderDeveloper or WorkingMode
$c['developer.message'] = 'Website is under developer !'; // Developer message when under developer
$c['allowes.ips'] = array('176.73.234.42'); // allowed ips when website is under developer
// SITE CONFIGURATION
$c['site.url'] = 'http://tradewithgeorgia.com/'; 
$c["welcome.page.class"] = 'homepage';
$c["welcome.page.slug"] = 'start';
$c['site.name'] = 'Developer CMS';

$c['admin.slug'] = 'tadmin';
$c['folders.upload'] = DIR . 'files/';
$c['folders.backup'] = 'backup/'; 
$c['folders.plugins'] = '_plugins/';

$c['database.hostname'] = 'mysql1.tradewithgeorgia.com';
$c['database.charset'] = 'UTF8';
$c['database.username'] = 'tradegeorgia';
$c['database.password'] = 'georgiadbtrade';
$c['database.name'] = 'tradegeorgia';
// SITE CONFIGURATION
$c['date.timezone'] = 'Asia/Tbilisi';
$c['date.format'] = 'Y-m-d H:i:s';

$c['output.charset'] = 'UTF-8';
$c['main.language'] = 'en';
$c['time.limit'] = 300;
$c['execution.time'] = 300;
$c['post.max.size'] = "64M";
$c['upload.max.filesize'] = "64M";
$c['session.expire.time'] = 1200; // 20 minute
//image sizes
$c['admin.photo.dementions'] = "200-130";
$c["product.view.pre.slug"] = "view"; // product page inside
$c["gallery.view.pre.slug"] = "gallery"; // gallery page inside
$c["website.directory"] = "template";
$c["invoice.due.date"] = 259200; // 3 day
$c["max.send.email.per.day"] = 500; 
$c["max.user.connections"] = 200; 
$c["max.connections"] = 200; 

return $c;