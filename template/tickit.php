<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ticket</title>
	<link rel="icon" type="image/gif" href="<?=WEBSITE?>template/img/favicon.ico?v=1.4.9" />
	<meta charset="utf-8" />
	<style type="text/css">
	body {
	  -webkit-print-color-adjust: exact;
	  width:800px;
	}
	@media print {
	  .contentbox {
	    background-color:red !important;
	  }
	  #message{ display:none; }
	}
	</style>
	<style type="text/css" media="print">
        @page 
        {
        	size: A4;
            margin: 0mm; 
        }

        html, body 
        {
            background-color:#f2f2f2; 
            margin: 0px;  
            width: 210mm;
    		height: 297mm;
       }
    </style>
</head>
<body style="margin:0; padding:0;">
	<div class="contentbox" style="margin:0; padding:0; background-color:#f2f2f2 !important;">
		<div style="margin:10px; padding:0; width:150px; height:82px; float:left;">
			<img src="<?=WEBSITE?>template/img/logo.png" width="150" height="82" alt="" />
		</div>
		<div style="margin:10px; float:right">
			<p style="margin:0; padding:0 0 10px 0; font-size:18px; line-height:18px; text-align:right; font-family:roboto; color:#555555;">
				<?=date("d M Y G:i",$data["output"]["set_date"])?>
			</p>
			<p style="margin:0; padding:0 0 10px 0; font-size:18px; line-height:18px; text-align:right; font-family:roboto; color:#555555;">
				Ticket ID: <?=$data["output"]["set_uid"]?>
			</p>
		</div>
		<div style="clear:both"></div>
		<p style="margin:20px 0 0 10px; padding:0; font-size:18px; line-height:18px; font-family:roboto; color:#0278c1;">
			<?=$data["output"]["smi_title"]?>
		</p>
		<p style="margin:0; padding:10px 10px 10px 10px; font-size:14px; line-height:18px; text-align:left; font-family:roboto; color:#555555;">
		<b>When:</b> <br />
		Start: <?=date("d M Y G:i",$data["output"]["smi_date"])?> <br />
		End: <?=date("d M Y G:i",$data["output"]["smi_expiredate"])?> 
		</p>
		<p style="margin:0; padding:0 10px 10px 10px; font-size:14px; line-height:18px; text-align:left; font-family:roboto; color:#555555;">
		<b>Place:</b> <br />
		<?=$data["output"]["smi_place"]?>
		</p>
		<p style="margin:0; padding:0 10px 10px 10px; font-size:14px; line-height:18px; text-align:left; font-family:roboto; color:#555555;">
		<b>Booth N:</b> <br />
		<?=$data["output"]["smi_booth"]?>
		</p>
		<p style="margin:0; padding:0 10px 10px 10px; font-size:14px; line-height:18px; text-align:left; font-family:roboto; color:#555555;">
		<b>Venue:</b> <br />
		<?=$data["output"]["smi_venue"]?>
		</p>
		<p style="margin:0; padding:0 10px 10px 10px; font-size:14px; line-height:18px; text-align:left; font-family:roboto; color:#555555;">
			<b>Web page:</b> <br />
			<a href="<?=$data["output"]["smi_website"]?>" style="color:#0278c1"><?=$data["output"]["smi_website"]?></a>
		</p>
		<p style="margin:0; padding:0 10px 10px 10px; font-size:14px; line-height:18px; text-align:left; font-family:roboto; color:#555555;">
			<b>Company / Person name:</b> <br />
			<?=$data["output"]["set_namelname"]?>
		</p>
		<p style="margin:0; padding:0 10px 10px 10px; font-size:14px; line-height:18px; text-align:left; font-family:roboto; color:#555555;">
			<b>E-mail address:</b> <br />
			<?=$data["output"]["set_email"]?>
		</p>
		<p style="margin:0; padding:0 10px 10px 10px; font-size:14px; line-height:18px; text-align:left; font-family:roboto; color:#555555;">
			<b>Mobile / Phone number:</b> <br />
			<?=$data["output"]["set_mobile"]?>
		</p>
		<div style="clear:both"></div>
		<p style="margin:0; padding:0 10px 10px 10px; font-size:14px; line-height:18px; text-align:left; font-family:roboto; color:#ff0000;" id="message">
			<strong>Thank you for registering the event, We will contact you as soon as posiable. Please <a href="javascript:window.print()" style="color:#ff0000">print</a> the document.</strong>
		</p>
		<!-- <a href="https://www.giz.de" target="_blank" style="margin:20px 10px 10px 10px; display:block; float:right"><img src="<?=WEBSITE?>template/img/donor_org.png" style="width:250px;"></a> -->
		<div style="clear:both"></div>
	</div>
</body>
</html>
				
		