$(document).ready(function(){
	if($(".img-responsive").length > 0){
		$(".img-responsive").each(function(){ 
			var image = $(this).data("mainimage"); 
			if(image){ 
				$.get(image, function(done){ 
					console.log("loaded !"); 
					$("#mainimage").attr({"src":image});
				});
			}
		});
	}

	$(".chooseMe").each(function(){
		var thisData = $(this).data("sect");
		var load = $(this).data("load");
		var htmlLoad = $("."+load).html(); 
		$("."+thisData).html("<ul>"+htmlLoad+"</ul>");
	});

	var tk = urlParamiters();
	if(tk['popup']=="true"){
		$("#insertText").html("Please wait..."); 
		$('#message_popup').modal('toggle'); 
		$.post("http://"+document.domain+"/en/ajax", { finalregister:"true", e:tk['email'], h:tk["hash"]  }, function(d){
			history.pushState("", document.title, "/");
			if(d=="Done"){
				$('#message_popup').modal('toggle'); 
				$('#login_popup').modal('toggle'); 
			}else{
				$("#insertText").html("Unknown error occurred ! Please try it again later."); 
			}
		});
	}
	var par = urlParamiters();
	if(par["search"]!=""){
		highlight_words(par["search"], $(".text_formats li"));
		highlight_words(par["search"], $(".filter_content .names"));
	}
	if(window.location.hash){
		scrollProducts();
	}
});

$(document).on("click","#register_catalog",function(e){
	//var companytype1 = $("#companytype1").val();
	var emailaddress1 = $("#emailaddress1").val();
	var password1 = $("#password1").val();
	var repeatpassword1 = $("#repeatpassword1").val();
	
	if(document.getElementById("agree1").checked){
		var agree1 = 1;
	}else{
		var agree1 = 2;
	}
	$(".error_message").fadeOut("slow");

	if(checkEmpty(emailaddress1,"#emailaddress1")!=true){
		$(".emailaddress1_required").fadeIn("slow");
	}else if(validateEmail(emailaddress1)!=true){
		$(".emailaddress1_message").fadeIn("slow");
	}else if(checkEmpty(password1,"#password1")!=true){
		$(".password1_required").fadeIn("slow");
	}else if(checkLength('#password1',6,20)!=true){
		$(".password1_length_message").fadeIn("slow");
	}else if(password1!=repeatpassword1){
		$(".repeatpassword1_match_message").fadeIn("slow");
	}else if(agree1==2){
		$(".agree_required").fadeIn("slow");
	}else{ 
		setCookie("emailaddress1", emailaddress1, "1");
		setCookie("password1", password1, "1");
		setCookie("repeatpassword1", repeatpassword1, "1");
		$.post("http://"+document.domain+"/en/ajax",{ sendemail1:true, email1:emailaddress1 },function(data){
			if(data=="Error"){
				$(".emailaddress1_exists").fadeIn("slow");
			}else{
				console.log(data);
				$(".modal-title small").hide();
				$("#first-step").hide();
				$(".modal-body ul").hide();
				$("#second-step").show(); 				
			}
		});
	}
	
});

$(document).on("click","#register_enquires",function(e){
	var registeras2 = $("#registeras2").val();
	var emailaddress2 = $("#emailaddress2").val();
	var password2 = $("#password2").val();
	var repeatpassword2 = $("#repeatpassword2").val();
	
	if(document.getElementById("agree2").checked){
		var agree2 = 1;
	}else{
		var agree2 = 2;
	}

	$(".error_message").fadeOut("slow");

	if(checkEmpty(registeras2,"#registeras2")!=true){
		$(".registeras2_required").fadeIn("slow"); 
	}else if(checkEmpty(emailaddress2,"#emailaddress2")!=true){
		$(".emailaddress2_required").fadeIn("slow");
	}else if(validateEmail(emailaddress2)!=true){
		$(".emailaddress2_message").fadeIn("slow");
	}else if(checkEmpty(password2,"#password2")!=true){
		$(".password2_required").fadeIn("slow");
	}else if(checkLength('#password2',6,20)!=true){
		$(".password2_length_message").fadeIn("slow");
	}else if(password2!=repeatpassword2){
		$(".repeatpassword2_match_message").fadeIn("slow");
	}else if(agree2==2){
		$(".agree2_required").fadeIn("slow");
	}else{ 
		setCookie("registeras2", registeras2, "1");
		setCookie("emailaddress2", emailaddress2, "1");
		setCookie("password2", password2, "1");
		setCookie("repeatpassword2", repeatpassword2, "1"); 

		$.post("http://"+document.domain+"/en/ajax",{ sendemail2:true, type2:registeras2, email2:emailaddress2 },function(data){
			if(data=="Error"){
				$(".emailaddress2_exists").fadeIn("slow");
			}else{
				$(".modal-title small").hide();
				$("#first-step2").hide();
				$(".modal-body ul").hide();
				$("#second-step2").show();
			}
		});

		
	}
});

$(document).on("click","#register__final_catalog",function(e){
	var emailcode = $("#emailcode").val();
	if(checkEmpty(emailcode,"#emailcode")!=true){
		$(".emailcode_required").fadeIn("slow"); 
	}else{
		var type = getCookie("companytype1");
		var email = getCookie("emailaddress1");
		var pass = getCookie("password1");
		var pass2 = getCookie("repeatpassword1");
		$.post("http://"+document.domain+"/en/ajax",{ finalregister:true, t:type, e:email, p:pass, p2:pass2, code:emailcode },function(data){
			if(data=="Done"){
				$("#second-step").html("<div>Congrats, You have successfully registered ! </div>");
			}else{
				$("#second-step").html("<div>Sorry, Your email already registered or Security code is not right or All fields have not been filled or Email is not valid !</div>");
			}
		});
	}
});

$(document).on("click","#register__final_catalog2",function(e){
	var emailcode2 = $("#emailcode2").val();
	if(checkEmpty(emailcode2,"#emailcode2")!=true){
		$(".emailcode_required2").fadeIn("slow"); 
	}else{ 
		var type = getCookie("registeras2");
		var email = getCookie("emailaddress2");
		var pass = getCookie("password2");
		var pass2 = getCookie("repeatpassword2");
		$("#second-step2").html("<div>Please wait...</div>");
		$.post("http://"+document.domain+"/en/ajax",{ finalregister2:true, t:type, e:email, p:pass, p2:pass2, code:emailcode2 },function(data){
			if(data=="Done"){
				$("#second-step2").html("<div>Congrats, You have successfully registered ! </div>");
			}else{
				$("#second-step2").html("<div>Sorry, Your email already registered or Security code is not right or All fields have not been filled or Email is not valid !</div>");
			}
		});
	}
});

$(document).on("click","#login_user",function(e){
	var logAs = $("#logAs").val();
	var emailaddress3 = $("#emailaddress3").val();
	var password3 = $("#password3").val();
	var captcha = $("#captcha").val();
	var captcha_length = captcha.length;
	
		
	$(".error_message").fadeOut("slow");

	if(checkEmpty(emailaddress3,"#emailaddress3")!=true){
		$(".emailaddress3_required").fadeIn("slow");
	}else if(validateEmail(emailaddress3)!=true){
		$(".emailaddress3_message").fadeIn("slow");
	}else if(checkEmpty(password3,"#password3")!=true){
		$(".password3_required").fadeIn("slow");
	}else if(checkEmpty(captcha,"#captcha")!=true){
		$(".captcha_required").fadeIn("slow");
	}else if(logAs==""){
		console.log("This is wrong man !");
	}else{
		$("#finalstep3").html("<div>Please wait...</div>");
		$(".modal-title small").hide();
		$.post("http://"+document.domain+"/en/ajax",{ logintry:true, lg:logAs, e:emailaddress3, p:password3, c:captcha }, function(d){
			if(d=="Done"){ 
				if(logAs=="manufacturer"){
					location.href = "/en/profile-products";
				}else if(logAs=="serviceprovider"){
					location.href = "/en/profile-service";
				}else if(logAs=="company"){
					location.href = "/en/profile-enquires";
				}else if(logAs=="individual"){
					location.href = "/en/profile-enquires";
				}
			}
			else{ $("#finalstep3").html("<div>Username, password or security code is incorrect, or you do not have permition to access your account yet</div>"); $(".reloadbutton").show(); }
		});
n	}
});

$(document).on("click","#logoutbutton",function(e){
	$(this).html("Please wait..."); 
	$.post("http://"+document.domain+"/en/ajax",{ logout:true },function(d){
		if(d=="Done"){
			location.reload();
		}else{ 
			$(this).html("Logout"); 
			alert("Error");
		}
	});
});

$(document).on("click","#reload",function(){
	location.reload();
});

$(document).on("change","#sector",function(){
	$("#subsector").html('<option value="">Plesae wait...</option>'); 
	$("#products").html('<option value="">Choose</option>'); 

	var chosen = []; 
	$('#sector :selected').each(function(i, selected){ 
	  chosen[i] = $(selected).val(); 
	});

	$.post("http://"+document.domain+"/en/ajax", { loadsubsector:true, sval:JSON.stringify(chosen) }, function(d){
		$("#subsector").html(d);
	});
});

$(document).on("change","#subsector",function(){
	var chosen = []; 
	$('#subsector :selected').each(function(i, selected){ 
	  chosen[i] = $(selected).val(); 
	});

	$("#products").html('<option value="">Plesae wait...</option>'); 
	$.post("http://"+document.domain+"/en/ajax", { loadsubsector:true, products:true, sval:JSON.stringify(chosen) }, function(d){
		$("#products").html(d);
		$("#products2").html(d);
	});
});

$(document).on("click","#save_changes",function(){
	$(".error-msg").hide();
	//alert("shevide"); 
	var companyname = $("#companyname").val(); 
	var establishedin = $("#establishedin").val(); 
	var productioncapasity = $("#productioncapasity").val(); 
	var address = $("#address").val(); 
	var mobile = $("#mobile").val(); 
	var numemploy = $("#numemploy").val(); 
	//var certificates = $("#certificates").val(); 
	var contactperson = $("#contactperson").val(); 
	var officephone = $("#officephone").val(); 
	var companysize = $("#companysize").val(); 
	var webaddress = $("#webaddress").val(); 

	var ad_position1 = $("#ad_position1").val(); 
	var ad_email1 = $("#ad_email1").val(); 
	var ad_person2 = $("#ad_person2").val(); 
	var ad_position2 = $("#ad_position2").val(); 
	var ad_mobile2 = $("#ad_mobile2").val(); 
	var ad_email2 = $("#ad_email2").val();
	

	var contactemail = $("#contactemail").val(); 
	var about = $("#about").val(); 


	var sector = []; 
	$('.sector_ids:checked').each(function(i, selected){ 
	  sector[i] = $(selected).val(); 
	});

	var subsector = []; 
	$('.sector_ids2:checked').each(function(i, selected){ 
	  subsector[i] = $(selected).val(); 
	});

	var products = []; 
	$('.sector_ids3:checked').each(function(i, selected){ 
	  products[i] = $(selected).val(); 
	});

	var exportmarkets = []; 
	$('.sector_ids4:checked').each(function(i, selected){ 
	  exportmarkets[i] = $(selected).val(); 
	});

	var certificates = []; 
	$('.sector_ids5:checked').each(function(i, selected){ 
	  certificates[i] = $(selected).val(); 
	});

	//alert(document.getElementById("inputUserLogo").files.length + " " + picture_load);
	var picture_load = $("#profile_logo").data("uploaded");
	if(picture_load == "noimage"){
		$(".companylogo_required").fadeIn("slow");
		$("#insertText").html("Please fill/select all required fields !"); 
		$('#message_popup').modal('toggle'); 
		return false;
	}else if(companyname==""){
		$("#requiredx_companyname").fadeIn("slow");
		$("#insertText").html("Please fill/select all required fields !"); 
		$('#message_popup').modal('toggle'); 
		return false;
	}else if(sector.length<=0){
		$("#requiredx_sector").fadeIn("slow");
		$("#insertText").html("Please fill/select all required fields !"); 
		$('#message_popup').modal('toggle'); 
		return false;
	}else if(subsector.length<=0){
		$("#requiredx_subsector").fadeIn("slow");
		$("#insertText").html("Please fill/select all required fields !"); 
		$('#message_popup').modal('toggle'); 
		return false;
	}else if(products.length<=0){
		$("#requiredx_products").fadeIn("slow");
		$("#insertText").html("Please fill/select all required fields !"); 
		$('#message_popup').modal('toggle'); 
		return false;
	}else if(validateEmail(contactemail)!=true){
		$("#requiredx_contactemail").fadeIn("slow");
		$("#insertText").html("Please check email address field !"); 
		$('#message_popup').modal('toggle'); 
		return false;
	}else if(webaddress!='' && isUrl(webaddress)!=true){
		$("#requiredx_webformat").fadeIn("slow");
		$("#insertText").html("Please check web page url field !"); 
		$('#message_popup').modal('toggle'); 
		return false;
	}else if(contactperson==''){
		$("#requiredx_contactperson1").fadeIn("slow");
		$("#insertText").html("Please fill/select all required fields !"); 
		$('#message_popup').modal('toggle'); 
		return false;
	}else if(ad_position1==''){
		$("#requiredx_position1").fadeIn("slow");
		$("#insertText").html("Please fill/select all required fields !"); 
		$('#message_popup').modal('toggle'); 
		return false;
	}else if(ad_email1==''){
		$("#requiredx_email1").fadeIn("slow");
		$("#insertText").html("Please fill/select all required fields !"); 
		$('#message_popup').modal('toggle'); 
		return false;
	}else if(mobile==''){ 
		$("#requiredx_mobilenumber1").fadeIn("slow");
		$("#insertText").html("Please fill/select all required fields !"); 
		$('#message_popup').modal('toggle'); 
		return false;
	}else if(mobile!='' && isMobile(mobile)!=true){
		$("#requiredx_mobile").fadeIn("slow");
		$("#insertText").html("Please check mobile number field !"); 
		$('#message_popup').modal('toggle'); 
		return false;
	}else if(strlen(about) > 350){
		$("#insertText").html("Description is too long !"); 
		$('#message_popup').modal('toggle'); 
		return false;
	}else{ 
		$("#insertText").html("Please wait"); 
		$('#message_popup').modal('toggle'); 
		var f = $("#inputUserLogo").val();
		$.post("http://"+document.domain+"/en/ajax", 
		{ 
			changeprofile:true, 
			p_companyname:companyname, 
			p_sector:JSON.stringify(sector), 
			p_subsector:JSON.stringify(subsector), 
			p_establishedin:establishedin, 
			p_productioncapasity:productioncapasity, 
			p_address:address, 
			p_mobiles:mobile, 
			p_numemploy:numemploy, 
			p_certificates:JSON.stringify(certificates), 
			p_contactpersones:contactperson, 
			p_officephone:officephone, 
			p_companysize:companysize, 
			p_webaddress:webaddress, 
			p_ad_position1:ad_position1, 
			p_ad_email1:ad_email1, 
			p_ad_person2:ad_person2, 
			p_ad_position2:ad_position2, 
			p_ad_mobile2:ad_mobile2, 
			p_ad_email2:ad_email2, 
			p_contactemail:contactemail, 
			p_about:nl2br(about), 
			p_products:JSON.stringify(products), 
			p_exportmarkets:JSON.stringify(exportmarkets), 
			p_file: f
		}, 
		function(d){
			if(d=="Done"){ 
				//$("#insertText").html("Data updated !"); 
				//location.reload();
				$("#uploadDocuments").submit();
			} 
		});
	}
});



$(document).on("click","#save_company_changes",function(){
	$(".error-msg").hide();
	//alert("shevide"); 
	var companyname = $("#companyname").val(); 
	var establishedin = $("#establishedin").val(); 
	var address = $("#address").val(); 
	var mobile = $("#mobile").val(); 
	var numemploy = $("#numemploy").val(); 
	var contactperson = $("#contactperson").val(); 
	var officephone = $("#officephone").val(); 
	var companysize = $("#companysize").val(); 
	var webaddress = $("#webaddress").val(); 

	var ad_position1 = $("#ad_position1").val(); 
	var ad_email1 = $("#ad_email1").val(); 
	var ad_person2 = $("#ad_person2").val(); 
	var ad_position2 = $("#ad_position2").val(); 
	var ad_mobile2 = $("#ad_mobile2").val(); 
	var ad_email2 = $("#ad_email2").val(); 

	var contactemail = $("#contactemail").val(); 
	var about = $("#about").val(); 

	var sector = []; 
	$('.sector_ids:checked').each(function(i, selected){ 
	  sector[i] = $(selected).val(); 
	});


	if(companyname==""){
		$("#requiredx_companyname").fadeIn("slow");
		return false;
	}else if(sector.length<=0){
		$("#requiredx_sector").fadeIn("slow");
		return false;
	}else if(validateEmail(contactemail)!=true){
		$("#requiredx_contactemail").fadeIn("slow");
		return false;
	}else if(webaddress!='' && isUrl(webaddress)!=true){
		$("#requiredx_webformat").fadeIn("slow");
		return false;
	}else if(mobile!='' && isMobile(mobile)!=true){
		$("#requiredx_mobile").fadeIn("slow");
		return false;
	}else if(strlen(about) > 350){
		$("#insertText").html("Description is too long !"); 
		$('#message_popup').modal('toggle'); 
		return false;
	}else{ 
		$("#insertText").html("Please wait"); 
		$('#message_popup').modal('toggle'); 
		var f = $("#inputUserLogo").val();
		$.post("http://"+document.domain+"/en/ajax", 
		{ 
			changecompanyprofile:true, 
			p_companyname:companyname, 
			p_sector:JSON.stringify(sector), 
			p_establishedin:establishedin, 
			p_address:address, 
			p_mobiles:mobile, 
			p_numemploy:numemploy, 
			p_contactpersones:contactperson, 
			p_officephone:officephone, 
			p_companysize:companysize, 
			p_webaddress:webaddress, 
			p_ad_position1:ad_position1, 
			p_ad_email1:ad_email1, 
			p_ad_person2:ad_person2, 
			p_ad_position2:ad_position2, 
			p_ad_mobile2:ad_mobile2, 
			p_ad_email2:ad_email2, 
			p_contactemail:contactemail, 
			p_about:nl2br(about), 
			p_file: f 
		}, 
		function(d){
			if(d=="Done"){ 
				location.reload();
			} 
		});
	}
});



$(document).on("click","#save_individual_changes",function(){
	$(".error-msg").hide();
	//alert("shevide"); 
	var companyname = $("#companyname").val(); 
	var address = $("#address").val(); 
	var mobile = $("#mobile").val(); 
	var webaddress = $("#webaddress").val(); 
	var contactemail = $("#contactemail").val(); 

	var sector = []; 
	$('.sector_ids:checked').each(function(i, selected){ 
	  sector[i] = $(selected).val(); 
	});

	if(companyname==""){
		$("#requiredx_companyname").fadeIn("slow");
		return false;
	}else if(validateEmail(contactemail)!=true){
		$("#requiredx_contactemail").fadeIn("slow");
	}else if(sector.length<=0){
		$("#requiredx_sector").fadeIn("slow");
		return false;
	}else if(webaddress!='' && isUrl(webaddress)!=true){
		$("#requiredx_webformat").fadeIn("slow");
		return false;
	}else if(mobile!='' && isMobile(mobile)!=true){
		$("#requiredx_mobile").fadeIn("slow");
		return false;
	}else{ 
		$("#insertText").html("Please wait"); 
		$('#message_popup').modal('toggle'); 
		var f = $("#inputUserLogo").val();
		$.post("http://"+document.domain+"/en/ajax", 
		{ 
			changeindividualprofile:true, 
			p_companyname:companyname, 
			p_sector:JSON.stringify(sector), 
			p_address:address, 
			p_mobiles:mobile, 
			p_webaddress:webaddress, 
			p_contactemail:contactemail 
		}, 
		function(d){
			if(d=="Done"){ 
				//$("#insertText").html("Data updated !"); 
				location.reload();
			} 
		});
	}
});

$(document).on("change","#ad_upload_catalog",function(e){
	e.stopPropagation();
	e.preventDefault();
	var files = e.target.files;
	var ex = files[0].name.split(".");
	var extLast = ex[ex.length - 1].toLowerCase();
	if(extLast!="pdf" && extLast!="doc" && extLast!="docx" && extLast!="xls" && extLast!="xlsx" && extLast!="jpg"){
		$('#message_popup').modal('toggle'); 
		$("#insertText").html("Please choose pdf, doc, docx, xls, xlsx or jpg file !"); 
		return false;
	}else if(files[0].size > 5000000){
		$('#message_popup').modal('toggle'); 
		$("#insertText").html("File size must be under 5 MB !"); 
		return false;
	}else if(files[0].name){
		// $("#uploadcatalogform").submit();
		// $('#message_popup').modal('toggle'); 
		// $("#insertText").html("Please wait !"); 
	}
});


$(document).on("change","#p_image",function(e){
	e.stopPropagation();
	e.preventDefault();
	var files = e.target.files;
	var ex = files[0].name.split(".");
	var extLast = ex[ex.length - 1].toLowerCase();
	if(extLast!="jpg"){
		alert("Please choose jpg file !"); 
		$(this).val('');
		return false;
	}else if(files[0].size > 5000000){
		alert("File size must be under 5 MB !"); 
		$(this).val('');
		return false;
	}else if(files[0].name){
		// $("#uploadcatalogform").submit();
		// $('#message_popup').modal('toggle'); 
		// $("#insertText").html("Please wait !"); 
	}
});


$(document).on("change","#productAnalysis",function(e){
	e.stopPropagation();
	e.preventDefault();
	var files = e.target.files;
	var ex = files[0].name.split(".");
	var extLast = ex[ex.length - 1].toLowerCase();
	if(extLast!="pdf" && extLast!="doc" && extLast!="docx" && extLast!="xls" && extLast!="xlsx" && extLast!="jpg"){
		$('#message_popup').modal('toggle'); 
		$("#insertText").html("Please choose pdf, doc, docx, xls, xlsx or jpg file !"); 
		$(this).val('');
		return false;
	}else if(files[0].size > 5000000){
		$('#message_popup').modal('toggle'); 
		$("#insertText").html("File size must be under 5 MB !"); 
		$(this).val('');
		return false;
	}else if(files[0].name){
		// $("#uploadcatalogform").submit();
		// $('#message_popup').modal('toggle'); 
		// $("#insertText").html("Please wait !"); 
	}
});


$(document).on("change","#pa_product_analysis",function(e){
	e.stopPropagation();
	e.preventDefault();
	var files = e.target.files;
	var ex = files[0].name.split(".");
	var extLast = ex[ex.length - 1].toLowerCase();
	if(extLast!="pdf" && extLast!="doc" && extLast!="docx" && extLast!="xls" && extLast!="xlsx" && extLast!="jpg"){
		alert("Please choose pdf, doc, docx, xls, xlsx or jpg file !"); 
		$(this).val('');
		return false;
	}else if(files[0].size > 5000000){
		alert("File size must be under 5 MB !"); 
		$(this).val('');
		return false;
	}else if(files[0].name){
		// $("#uploadcatalogform").submit();
		// $('#message_popup').modal('toggle'); 
		// $("#insertText").html("Please wait !"); 
	}
});


$(document).on("change","#inputUserLogo",function(e){
	e.stopPropagation();
	e.preventDefault();
	var files = e.target.files;
	var nowFile = $("#profile_logo").data("oldimage");
	 
	var plz = "http://"+document.domain+"/template/img/plz.jpg";  
	$("#profile_logo").attr({ "src" : plz }); 
	var ex = files[0].name.split(".");
	var extLast = ex[ex.length - 1].toLowerCase();
	console.log(extLast);
	if(extLast!="jpeg" && extLast!="jpg" && extLast!="png" && extLast!="gif"){
		$('#message_popup').modal('toggle'); 
		$("#insertText").html("Please choose jpeg, jpg, gif or png file !"); 
		$("#profile_logo").attr({ "src" : nowFile }); 
		return false;
	}else if(files[0].size > 1000000){
		$('#message_popup').modal('toggle'); 
		$("#insertText").html("File size must be under 1 MB !"); 
		$("#profile_logo").attr({ "src" : nowFile }); 
		return false;
	}else if(files[0].name){
		$("#profile_logo").attr({ "src" : URL.createObjectURL(e.target.files[0]) }); 
		$("#profile_logo").data("uploaded","image"); 
		//$("#uploadImageForm").submit();
		// $('#message_popup').modal('toggle'); 
		// $("#insertText").html("Please wait !"); 
	}
});

$(document).on("click","#change_pass",function(){
	var oldpass = $("#oldpass").val();
	var newpass = $("#newpass").val();
	var repass = $("#repass").val();

	$(".error_message").hide();
	if(oldpass==""){
		$(".oldpass_required").fadeIn("slow"); 
	}else if(newpass==""){
		$(".newpass_required").fadeIn("slow"); 
	}else if(newpass!=repass){
		$(".repass_required").fadeIn("slow"); 
	}else if(checkLength('#newpass',6,20)!=true){
		$(".newpass_minmax").fadeIn("slow"); 
	}else{
		$("#modal_containerx").html("<h3 class=\"modal-title\">Change passwod</h3> <p>Please wait...</p>");
		$.post("http://"+document.domain+"/en/ajax", {
			changepassword:true, 
			o:oldpass, 
			n:newpass, 
			r:repass			
		}, function(d){
			if(d=="Done"){
				$("#modal_containerx").html("<h3 class=\"modal-title\">Change passwod</h3> <p>Password changed !</p><a href=\"javascript:;\" id=\"reload\">Reload</a>");
			}else{
				$("#modal_containerx").html("<h3 class=\"modal-title\">Change passwod</h3> <p>Error, Please check fileds</p><a href=\"javascript:;\" id=\"reload\">Reload</a>");
			}
		});
	}
});

$(document).on("keyup",".hscode",function(e){
	var l = $(this).val();
	if(l.length>=3){
		$(".results ul").html("<li><a href=\"javascript:;\">Please wait...</a></li>"); 
		$(".results").slideDown("slow");
		$.post("http://"+document.domain+"/en/ajax", { hscode:true, s:l }, function(r){
			if(r!=""){
				$(".results ul").html(r); 
			}else{
				$(".results ul").html('<li><a href="javascript:;">No result</a></li>'); 
			}
		});
	}else{
		$(".hscode_id").val(''); 
		$(".results").slideUp("slow");
	}
});

$(document).on("click",".resultx",function(e){
	var idx = $(this).data("idx"); 
	var val = $(this).html(); 
	val = val.replace(/[<]br[^>]*[>]/gi,"");
	$(".hscode").val(val); 
	$(".hscode_id").val(idx); 
	$(".results").slideUp("slow");
});

$(document).on("click","#post_product",function(){
	var products2 = $("#products2").val(); 
	var shelf_life = $("#shelf_life").val(); 
	var product_name = $("#product_name").val(); 
	var packinging = $("#packinging").val(); 
	var hscode_id = $("#hscode_id").val(); 
	var awards = $("#awards").val(); 
	var productfile = $("#productfile").val(); 
	var productioncapasity = $("#productioncapasity").val(); 
	var product_description = $("#product_description").val(); 
	var product_desc_length = strlen(product_description);
	$(".error-msg").hide();
	if(products2==""){
		$("#requiredx_add_products").fadeIn("slow"); 
		return false;
	}else if(product_name==""){
		$("#requiredx_add_productsname").fadeIn("slow"); 
		return false;
	}else if(hscode_id==""){
		$("#requiredx_add_hscode").fadeIn("slow"); 
		return false;
	}else if(product_description==""){
		$("#requiredx_add_describe").fadeIn("slow"); 
		return false;
	}else if(productfile==""){
		$("#requiredx_add_photo").fadeIn("slow"); 
		return false;
	}else if(product_desc_length>350){
		$('#message_popup').modal('toggle'); 
		$("#insertText").html("Product description is loo long!"); 
		return false;
	}else{
		$("#insertText").html("Please wait"); 
		$('#message_popup').modal('toggle'); 
		$.post("http://"+document.domain+"/en/ajax", {
			addproduct:true, 
			p:products2, 
			s:shelf_life, 
			pn:product_name, 
			pkg:packinging, 
			prcap:productioncapasity, 
			c:hscode_id, 
			a:awards, 
			d:nl2br(product_description)
		}, function(r){
			if(r!="Error"){
				$("#pix").val(r); 
				$("#addproduct").submit(); 
			}else{
				$("#insertText").html("Error"); 
			} 
		});
	}
});


$(document).on("change","#productfile",function(e){
	e.stopPropagation();
	e.preventDefault();
	var files = e.target.files;
	var ex = files[0].name.split(".");
	var extLast = ex[ex.length - 1].toLowerCase();
	
	if(extLast!="jpeg" && extLast!="jpg"){
		$('#message_popup').modal('toggle'); 
		$("#insertText").html("Please choose jpg file !"); 
		return false;
	}else if(files[0].size > 1000000){
		$('#message_popup').modal('toggle'); 
		$("#insertText").html("File size must be under 1 MB !"); 
		return false;
	}else if(files[0].name){
		// $("#uploadImageForm").submit();
		// $('#message_popup').modal('toggle'); 
		// $("#insertText").html("Please wait !"); 
		var tmppath = URL.createObjectURL(e.target.files[0]);
    	$("#product_picture").attr('src',tmppath);  
	}
});

$(document).on("click",".delete-product",function(e){
	var i = $(this).data("prid"); 
	$("#insertText").html("<p>Would you like to delete product ? </p><div class=\"btn  btn-yellow\" style=\"width:100%\" data-p=\""+i+"\" id=\"deleteme\">DELETE</div><div class=\"btn btn-aproved btn-sm btn-block\" style=\"width:100%; margin-top:10px\" onclick=\"$('#message_popup').modal('toggle');\">CANCEL</div>");
	$('#message_popup').modal('toggle');  
});

$(document).on("click","#delete_service",function(e){
	var i = $(this).data("srvid");  
	$("#insertText").html("<p>Would you like to delete service ? </p><div class=\"btn  btn-yellow\" style=\"width:100%\" data-s=\""+i+"\" id=\"deleteme_service_true\">DELETE</div><div class=\"btn btn-aproved btn-sm btn-block\" style=\"width:100%; margin-top:10px\" onclick=\"$('#message_popup').modal('toggle');\">CANCEL</div>");
	$('#message_popup').modal('toggle');  
});

$(document).on("click","#delete_enquires",function(e){
	var i = $(this).data("enquid");  
	$("#insertText").html("<p>Would you like to delete enquire ? </p><div class=\"btn  btn-yellow\" style=\"width:100%\" data-e=\""+i+"\" id=\"deleteme_enquire_true\">DELETE</div><div class=\"btn btn-aproved btn-sm btn-block\" style=\"width:100%; margin-top:10px\" onclick=\"$('#message_popup').modal('toggle');\">CANCEL</div>");
	$('#message_popup').modal('toggle');  
});

$(document).on("click","#deleteme",function(e){
	var i = $(this).data("p"); 
	$("#insertText").html("<p>Please wait...</p>");
	$.post("http://"+document.domain+"/en/ajax", {
		delproduct:true, 
		pid:i
	}, function(r){
		if(r=="Done"){ location.reload(); }
		else{ $("#insertText").html("<p>Error, Please try it again later !</p>"); }
	})
});

$(document).on("click","#deleteme_service_true",function(e){
	var i = $(this).data("s"); 
	$("#insertText").html("<p>Please wait...</p>");
	$.post("http://"+document.domain+"/en/ajax", {
		delservice:true, 
		sid:i
	}, function(r){
		if(r=="Done"){ location.reload(); }
		else{ $("#insertText").html("<p>Error, Please try it again later !</p>"); }
	})
});

$(document).on("click","#deleteme_enquire_true",function(e){//test
	var i = $(this).data("e"); 
	$("#insertText").html("<p>Please wait...</p>");
	$.post("http://"+document.domain+"/en/ajax", {
		delenquire:true, 
		eid:i
	}, function(r){
		if(r=="Done"){ location.reload(); }
		else{ $("#insertText").html("<p>Error, Please try it again later !</p>"); }
	})
});

$(document).on("click",".makeitchange",function(e){
	var i = $(this).data("prid"); 
	//alert("a");
	$.post("http://"+document.domain+"/en/ajax", {
		loadproduct: true, 
		prid:i
	}, function(r){
		var obj = jQuery.parseJSON(r);
		$("#p_pid").val(obj[0].id);
		$("#p_prname").val(obj[0].title);
		$("#p_hscode").val(obj[0].hs_title);
		$(".hscode_id").val(obj[0].hs_id);
		$("#p_shelf_life").val(obj[0].shelf_life);
		$("#p_packaging").val(obj[0].packaging);
		$("#p_awards").val(obj[0].awards);
		$("#p_production_capacity").val(obj[0].production_capacity);
		$("#p_describe").val(obj[0].long_description);
		var num = strlen(obj[0].long_description); 
		$("#maxlengthproductpopup").html(num+' / 350');
	});
	$('#makechanges').modal('toggle');
});

$(document).on("click","#change_service",function(e){
	var i = $(this).data("sid");
	$.post("http://"+document.domain+"/en/ajax", {
		loadservices: true, 
		srid:i
	}, function(r){
		var obj = jQuery.parseJSON(r);
		$("#s_sid").val(obj[0].id);
		var prpr = obj[0].products;
		$("#s_service").html($("#service_title").html());
		$("#s_service").val(prpr);
		$("#s_service_x").val(obj[0].title);
		var regex = /<br\s*[\/]?>/gi;
		var desc_length = strlen(obj[0].long_description); 
		$("#maxlengthservicePopup").html(desc_length + " / 350"); 
		$("#s_sdescription").val(obj[0].long_description.replace(regex, "\n"));
	});
	$('#makeservicechange').modal('toggle'); 
});

$(document).on("click","#change_service_inside",function(e){
	var s_id = $("#s_sid").val();
	var s_service = $("#s_service").val();
	var s_service_x = $("#s_service_x").val();
	var s_sdescription = $("#s_sdescription").val();
	$(".error_message").fadeOut("slow"); 
	if(s_id==""){
		alert("something went wrong!");
	}else if(s_service==""){
		$(".p_prname_required").fadeIn("slow"); 
		return false;
	}else if(s_service_x==""){
		$(".p_prname_required_x").fadeIn("slow"); 
		return false;
	}else if(s_sdescription==""){
		$(".s_sdescription_required").fadeIn("slow"); 
		return false;
	}else if(strlen(s_sdescription) > 350){
		$(".s_sdescription_length").fadeIn("slow"); 
		return false;
	}else{
		$.post("http://"+document.domain+"/en/ajax", {
			changeservice: true, 
			i:s_id, 
			s:s_service, 
			t:s_service_x, 
			d:nl2br(s_sdescription) 
		}, function(r){
			if(r=="Done"){
				location.reload();
			}
		});
	}
});

$(document).on("click","#change_product",function(){
	var p_pid = $("#p_pid").val();
	var p_prname = $("#p_prname").val();
	var p_hscode = $(".hscode_id").val();
	var p_shelf_life = $("#p_shelf_life").val();
	var p_packaging = $("#p_packaging").val();
	var p_awards = $("#p_awards").val();
	var p_production_capacity = $("#p_production_capacity").val();
	var p_describe = $("#p_describe").val();
	var p_describe_length = strlen($("#p_describe").val());
	if(p_pid==""){
		return false; 
	}else if(p_prname==""){
		$(".p_prname_required").fadeIn("slow");
		return false; 
	}else if(p_hscode==""){
		$(".p_hscode_required").fadeIn("slow");
		return false; 
	}else if(p_describe==""){
		$(".p_describe_required").fadeIn("slow");
		return false; 
	}else if(p_describe_length > 350){
		$(".p_describe_lngz").fadeIn("slow");
		return false; 
	}else{
		$.post("http://"+document.domain+"/en/ajax", {
			makeitchange: true, 
			pi: p_pid, 
			pn :p_prname, 
			phs: p_hscode, 
			psl: p_shelf_life, 
			pp: p_packaging, 
			pa: p_awards, 
			prdcap: p_production_capacity, 
			pd: p_describe
		}, function(r){

			if(r=="Done"){
				$('#changeProductImagePopup').submit();
			}else{
				alert("Error"); 
			}

		});		
	}	
});


$(document).on("click",".selectBoxWithCheckbox",function(){
	var tog = $(this).data("toggle");
	$("#"+tog).slideToggle("slow"); 
});

$(document).on("click","body",function(e){
	if(e.target.className!="selectBoxWithCheckbox" && $(".selectBoxWithCheckbox").length){
		$(".selectBoxWithCheckbox_dropdown").slideUp();
	}
	if(e.target.className!="selectBoxWithCheckbox2" && $(".selectBoxWithCheckbox2").length){
		$(".selectBoxWithCheckbox_dropdown2").slideUp();
	}
	if(e.target.className!="selectBoxWithCheckbox3" && $(".selectBoxWithCheckbox3").length){
		$(".selectBoxWithCheckbox_dropdown3").slideUp();
	}
	if(e.target.className!="selectBoxWithCheckbox4" && $(".selectBoxWithCheckbox4").length){
		//alert(e.target.className);
		if(e.target.className!="form-control searchExportMarket"){
			$(".selectBoxWithCheckbox_dropdown4").slideUp();
		}
	}
	if(e.target.className!="selectBoxWithCheckbox5" && $(".selectBoxWithCheckbox5").length){
		$(".selectBoxWithCheckbox_dropdown5").slideUp();
	}
});

$(document).on("keyup","#searchExportMarket",function(e){
	var val = e.target.value;
	
	$(".loadCountriesExport").html("<div style='margin:10px'>Please wait...</div>"); 
	$('.loadCountriesExport').animate({scrollTop:100}, 'slow');
	$.post("http://"+document.domain+"/en/ajax", { loadCountriesExport:true, v:val }, function(d){
		var inx = "";
		var alreadyChecked = '';
		var obj = jQuery.parseJSON(d);
		if(obj.length > 0){				
			for(var x=0; x<obj.length; x++){					
				inx += '<div class="selectItem4" data-checkbox="selectItemxxx_js'+x+'">';
				if(obj[x].xx!=null){
					inx += '<input type="checkbox" name="selectItem4[]" class="sector_ids4" id="selectItemxxx_js'+x+'" checked="checked" value="'+obj[x].idx+'" />';
				}else{
					inx += '<input type="checkbox" name="selectItem4[]" class="sector_ids4" id="selectItemxxx_js'+x+'" value="'+obj[x].idx+'" />';
				}
				inx += "<span> "+obj[x].title+"</span>";
				inx += '</div>';
			}
			$(".loadCountriesExport").html(inx);
		}
		//document.getElementById("drop_sector2").innerHTML = d;
	});
});

$(document).on("click",".selectBoxWithCheckbox2",function(){
	var tog = $(this).data("toggle");
	$("#"+tog).slideToggle("slow"); 
});

$(document).on("click",".selectBoxWithCheckbox5",function(){
	var tog = $(this).data("toggle");
	$("#"+tog).slideToggle("slow"); 
});

$(document).on("click",".selectBoxWithCheckbox3",function(){
	var tog = $(this).data("toggle");
	$("#"+tog).slideToggle("slow"); 
});

$(document).on("click",".selectBoxWithCheckbox4",function(){
	var tog = $(this).data("toggle");
	$("#"+tog).slideToggle("slow"); 
});

$(document).on("click",".selectItem",function(e){
	e.stopPropagation();
	var c = $(this).data("checkbox"); 
	$("."+c).click(); 
	var names = [];
	var r = 0;
	$('.sector_ids:checked').each(function() {
    	names[r] = $(this).val() + ',';
    	r++;
	});
	var selectedName = $(this).data("selectedname"); 
	$(".selectBoxWithCheckbox").html("Selected "+ (r) +" "+selectedName);
	if(document.getElementById("drop_sector2")){
		$(".selectBoxWithCheckbox2").html("Choose");
		$(".selectBoxWithCheckbox3").html("Choose"); 
		document.getElementById("drop_sector2").innerHTML = "Please wait...";
		$.post("http://"+document.domain+"/en/ajax", { loadsubsector:true, sval:JSON.stringify(names) }, function(d){
			document.getElementById("drop_sector2").innerHTML = d;
		});
	}
});

$(document).on("click",".selectItem2",function(e){
	e.stopPropagation();
	
	var c2 = $(this).data("checkbox"); 
	$("#"+c2).click(); 
	var names2 = [];
	var r2 = 0;
	$('.sector_ids2:checked').each(function() {
    	names2[r2] = $(this).val() + ',';
    	r2++;
	});
	$(".selectBoxWithCheckbox3").html("Choose");
	var selectedname = $(this).data("selectedname");
	$(".selectBoxWithCheckbox2").html("Selected "+ (r2) +" "+selectedname);
	$("#drop_sector3").html("Please wait...");
	$("#products2").html("Please wait...");
	$.post("http://"+document.domain+"/en/ajax", { loadproducts:true, sval:JSON.stringify(names2) }, function(d){
		$("#drop_sector3").html(d);
	});

	$.post("http://"+document.domain+"/en/ajax", { loadproducts:true, option:true, sval:JSON.stringify(names2) }, function(d){
		$("#products2").html(d);
		if($("#service_title")){
			$("#service_title").html(d);
		}
	});
});

$(document).on("click","#post_service",function(e){ 
	var title = $("#service_title").val();
	var service = $("#service_real_title").val();
	var desc = $("#service_description").val();
	var desc_length = strlen($("#service_description").val());
	$(".error_message").hide(); 
	if(title==""){
		$("#servicetitle_required").fadeIn("slow"); 
		return false;
	}else if(service==""){
		$("#servicerealtitle_required").fadeIn("slow"); 
		return false;
	}else if(desc==""){
		$("#servicedesc_required").fadeIn("slow"); 
		return false;
	}else if(desc_length>350){
		$("#insertText").html("Description is too long !"); 
		$('#message_popup').modal('toggle');
	}else{
		$("#insertText").html("Please wait"); 
		$('#message_popup').modal('toggle');
		$.post("http://"+document.domain+"/en/ajax", {
			addservice:true, 
			t:title, 
			s:service, 
			d:nl2br(desc)
		}, function(r){
			if(r=="Done"){
				history.pushState("", document.title, "#serviceadded");
				location.reload();
			}else{
				$("#insertText").html("Error"); 
			}
		});
	}
});

$(document).on("click",".postEnquires",function(){
	var type = $("#etype").val();
	var sector = $("#esector").val();
	var title = $("#etitle").val();
	var description = nl2br($("#edescription").val());
	$(".error-msg").hide();
	if(type==''){
		$("#enquire_type_required").fadeIn("slow"); 
		return false;
	}else if(esector==''){
		$("#enquire_sector_required").fadeIn("slow"); 
		return false;
	}else if(etitle==''){
		$("#enquire_title_required").fadeIn("slow"); 
		return false;
	}else if(description==''){
		$("#enquire_description_required").fadeIn("slow"); 
		return false;
	}else if(strlen(description) > 350){
		$("#insertText").html("Description is too long !"); 
		$('#message_popup').modal('toggle');
		return false;
	}else{
		$("#insertText").html("Please wait"); 
		$('#message_popup').modal('toggle');
		$.post("http://"+document.domain+"/en/ajax", {
			addenquire:true, 
			t:type, 
			s:sector, 
			ti:title, 
			d:description 
		}, function(r){
			if(r=="Done"){
				history.pushState("", document.title, "#enquireadded");
				location.reload();
			}else{
				$("#insertText").html("Error"); 
			}
		});
	}

});

$(document).on("click",".selectItem3",function(e){
	e.stopPropagation();
	
	var c3 = $(this).data("checkbox"); 
	$("#"+c3).click(); 
	var r3 = 0;
	$('.sector_ids3:checked').each(function() {
    	r3++;
	});
	var selectedname = $(this).data("selectedname");
	$(".selectBoxWithCheckbox3").html("Selected "+ (r3) +" "+selectedname);
});

$(document).on("click",".selectItem4",function(e){
	e.stopPropagation();
	
	var c4 = $(this).data("checkbox"); 
	$("#"+c4).click(); 
	var r4 = 0;
	$('.sector_ids4:checked').each(function() {
    	r4++;
	});
	var selectedname = $(this).data("selectedname");
	$(".selectBoxWithCheckbox4").html("Selected "+ (r4) +" "+selectedname);

});

$(document).on("click",".selectItem5",function(e){
	e.stopPropagation();
	
	var c5 = $(this).data("checkbox"); 
	$("#"+c5).click(); 
	var r5 = 0;
	$('.sector_ids5:checked').each(function() {
    	r5++;
	});
	var selectedname = $(this).data("selectedname");
	$(".selectBoxWithCheckbox5").html("Selected "+ (r5) +" "+selectedname);
});


$(document).on("click","#change_enquires",function(e){
	var i = $(this).data("eid");
	$.post("http://"+document.domain+"/en/ajax", {
		loadenquires: true, 
		eid:i
	}, function(r){
		var obj = jQuery.parseJSON(r);

		$("#e_eid").val(obj[0].id);
		$("#e_type").val(obj[0].type);
		
		var prpr = obj[0].sector_id;
		$("#e_sector").html($("#esector").html());
		$("#e_sector").val(prpr);

		$("#e_title").val(obj[0].title);

		var regex = /<br\s*[\/]?>/gi;
		var desc_length = strlen(obj[0].long_description);
		$("#maxlengthenquirePopup").html(desc_length + " / 350"); 
		$("#e_description").val(obj[0].long_description.replace(regex, "\n"));
	});
	$('#makeenquireschange').modal('toggle');
});


$(document).on("click","#change_enquire_inside",function(e){
	var e_eid = $("#e_eid").val();
	var e_type = $("#e_type").val();
	var e_sector = $("#e_sector").val();
	var e_title = $("#e_title").val();
	var e_description = nl2br($("#e_description").val());
	
	if(e_eid==""){
		alert("something went wrong");
	}else if(e_type==""){
		$(".e_type_required").fadeIn("slow"); 
		return false;
	}else if(e_sector==""){
		$("#e_sector_required").fadeIn("slow"); 
		return false;
	}else if(e_title==""){
		$("#e_title_required").fadeIn("slow"); 
		return false;
	}else if(e_description==""){
		$("#e_description_required").fadeIn("slow"); 
		return false;
	}else if(strlen(e_description) > 350){
		$(".s_sdescription_length").fadeIn("slow"); 
		return false;
	}else{
		$.post("http://"+document.domain+"/en/ajax", {
			changeenquire: true, 
			i:e_eid, 
			t:e_type, 
			s:e_sector, 
			ti:e_title, 
			d:e_description
		}, function(r){
			if(r=="Done"){
				location.reload();
			}
		});
	}
});

$(document).on("click",".subscribeproductsenquires",function(){
	var spe_val = $("#spe_val").val(); 
	if(spe_val==''){
		$("#spe_val").attr({"placeholder":"Please type your email address"});
	}else{
		if(validateEmail(spe_val)){
			$("#insertText").html("Please wait"); 
			$('#message_popup').modal('toggle');
			$.post("http://"+document.domain+"/en/ajax",{
				saveusersemail:true, 
				latestupdates:true, 
				e:spe_val
			}, function(r){
				if(r=="Exists"){
					$("#insertText").html("You are registered already!");
				}else if(r=="Done"){
					$("#insertText").html("You registered successfully!");
				}else{
					$("#insertText").html("Error");
				}
				$("#spe_val").attr({"placeholder":"Your Email Address"}).val('');
			});

		}else{
			$("#spe_val").val('');
			$("#spe_val").attr({"placeholder":"Please type valid email address"});
		}
	}
});

$(document).on("click",".readmore",function(e){
	var par = urlParamiters(); 
	var p = $(this).data("pid");
	if(parseInt(par["i"])){
		getReadmoreInfo(par["i"],p);
	}
});


$(document).on("click",".usersigned",function(){	
	$("#insertText").html("Please logout and then register.."); 
	$('#message_popup').modal('toggle');			
});

$(document).on("click",".eventRegister",function(){
	location.href = "http://"+document.domain+"/en/about-us/events"; 
	// var datax = $(this).data("homepage");
	// if(datax=="true"){
	// 	location.href= "http://"+document.domain+"/en/about-us/events";
	// }else{
	// 	$("#insertText").html("Please wait..."); 
	// 	$('#message_popup').modal('toggle');
	// 	var eid = $(this).data("eventid"); 
	// 	$.post("http://"+document.domain+"/en/ajax", {
	// 		loadevents:true
	// 	}, function(r){
	// 		var obj = jQuery.parseJSON(r); 
	// 		var opt = '';
	// 		if(obj.length > 0){
	// 			for(var i=0; i<obj.length; i++){
	// 				opt += '<option value="'+obj[i]["smi_idx"]+'">'+obj[i]["smi_title"]+'</option>'; 
	// 			}
	// 			$("#chooseEvent").html(opt); 
	// 			if(eid){
	// 				$("#chooseEvent").val(eid); 
	// 			}
	// 			$('#message_popup').modal('toggle');
	// 			$('#register_for_event').modal('toggle');	
	// 		}else{
	// 			$("#insertText").html("Sorry there is no event at the moment!"); 
	// 		}
	// 	});
	// }
	
});

$(document).on("click",".regEvent",function(e){
	var chooseEvent = $("#chooseEvent").val();
	var comname = $("#comname").val();
	var er_email = $("#er_email").val();
	var er_mobile_phone = $("#er_mobile_phone").val();
	$(".error_message").hide(); 
	if(chooseEvent==""){
		$(".er_chooseevent_require").fadeIn("slow"); 
		return false;
	}else if(comname==""){
		$(".er_name_require").fadeIn("slow"); 
		return false;
	}else if(er_email==""){
		$(".er_email_require").fadeIn("slow"); 
		return false;
	}else if(er_mobile_phone==""){
		$(".er_mobile_require").fadeIn("slow"); 
		return false;
	}else{

		if(validateEmail(er_email)){
			$('#register_for_event').modal('toggle');
			$("#insertText").html("Please wait..."); 
			$('#message_popup').modal('toggle');
			$.post("http://"+document.domain+"/en/ajax", {
				regEvent:true, 
				ei:chooseEvent,
				n:comname,  
				e:er_email, 
				m:er_mobile_phone
			}, function(r){
				if(r=="Done"){
					$("#insertText").html("Registration completed!"); 
				}else{
					$("#insertText").html("Error!"); 
				}
			});
		}else{
			$(".er_checkemail_require").fadeIn("slow"); 
			return false;
		}

	}

});

$(document).on("click",".registernewuser",function(){
	var spe_val = $("#rnu_val").val(); 
	if(spe_val==''){
		$("#rnu_val").attr({"placeholder":"Please type your email address"});
	}else{
		if(validateEmail(spe_val)){
			$("#emailaddress1").val(spe_val); 
			$("#emailaddress2").val(spe_val); 
			$('#register_popup').modal('toggle');
			$("#rnu_val").val('');
			$("#rnu_val").attr({"placeholder":"Your Email Address"});
		}else{
			$("#rnu_val").val('');
			$("#rnu_val").attr({"placeholder":"Please type valid email address"});
		}
	}
});

$(document).on("click",".checkboxsearch",function(e){
	$('.checkboxsearch').prop('checked', false);
	$(this).prop('checked', true); 
});

$(document).on("click",".searchButtonHomepage",function(e){
	var hpsv = $("#hpsv").val();
	var go = '';
	if($("#check_company").prop('checked')){
		go = "http://"+document.domain+"/en/export-catalog?view=companies&search="+hpsv;
	}else if($("#check_product").prop('checked')){
		go = "http://"+document.domain+"/en/export-catalog?view=products&search="+hpsv;
	}else if($("#check_service").prop('checked')){
		go = "http://"+document.domain+"/en/export-catalog?view=services&search="+hpsv;
	}
	if(go!=''){
		location.href = go;
	}
});

$(document).on("click",".msgtouser",function(e){
	var par = urlParamiters();
	var uid = parseInt(par["i"]);
	var ccname = $("#ccname").val();
	var cccountry = $("#cccountry").val();
	var ccemail = $("#ccemail").val();
	var cccontact_number = $("#cccontact_number").val();
	var ccmessage = nl2br($("#ccmessage").val());
	$(".error-msg").hide(); 
	if(uid=="" || uid<=0){
		$("#page_enquires_popup").modal("toggle");
		$("#insertText").html("Error !"); 
		$('#message_popup').modal('toggle');
		return false; 
	}else if(ccname==""){
		$("#ccname_required").fadeIn("slow"); 
		return false; 
	}else if(cccountry==""){
		$("#cccountry_required").fadeIn("slow"); 
		return false; 
	}else if(ccemail==""){
		$("#ccemail_required").fadeIn("slow"); 
		return false; 
	}else if(cccontact_number==""){
		$("#cccontact_number_required").fadeIn("slow"); 
		return false; 
	}else if(ccmessage==""){
		$("#ccmessage_required").fadeIn("slow"); 
		return false; 
	}else{

		if(validateEmail(ccemail)){
			$("#page_enquires_popup").modal("toggle");
			$("#insertText").html("Please wait..."); 
			$('#message_popup').modal('toggle');
			$.post("http://"+document.domain+"/en/ajax", {
				sendmsgtouser:true, 
				i:uid, 
				n:ccname, 
				c:cccountry, 
				e:ccemail, 
				cn:cccontact_number, 
				m:ccmessage
			}, function(r){
				if(r=="Done"){
					$("#ccname").val('');
					$("#cccountry").val('');
					$("#ccemail").val('');
					$("#cccontact_number").val('');
					$("#ccmessage").val('');
					$("#insertText").html("Message sent successfully!"); 
				}else{
					$("#insertText").html("Error"); 
				}
			});
		}else{
			$("#ccemail_check_required").fadeIn("slow"); 
			return false; 
		}

	}

});

$(document).on("click",".callChatButton",function(){
	callChat(); 
});

$(document).on("click",".clearFilter", function(e){
	e.preventDefault();
	e.stopPropagation(); 

	$("#insertText").html("Please wait..."); 
	$('#message_popup').modal('toggle');

	var dat = $(this).data("clearme"); 
	var par = urlParamiters(); 
	var view = (par["view"]) ? par["view"] : '';
	var sort = (par["sort"]) ? par["sort"] : '';
	var subsector = (par["subsector"]) ? par["subsector"] : '';
	var products = (par["products"]) ? par["products"] : '';
	var exportmarkets = (par["exportmarkets"]) ? par["exportmarkets"] : '';
	var certificate = (par["certificate"]) ? par["certificate"] : '';
	var type = (par["type"]) ? par["type"] : '';
	var sector = (par["sector"]) ? par["sector"] : '';
	var search = (par["search"]) ? par["search"] : '';
	var pn = (par["pn"]) ? par["pn"] : '';
	var token = (par["token"]) ? par["token"] : '';
	var build = "http://"+document.domain+"/en/export-catalog";

	if(par["view"]=="companies" && dat=="subsector"){
		build += "?view=companies&sort"+sort+"&subsector=&products=&exportmarkets="+exportmarkets+"&certificate="+certificate+"&search="+search+"&pn="+pn+"&token="+token;
	}else if(par["view"]=="companies" && dat=="products"){
		build += "?view=companies&sort"+sort+"&subsector="+subsector+"&products=&exportmarkets="+exportmarkets+"&certificate="+certificate+"&search="+search+"&pn="+pn+"&token="+token;
	}else if(par["view"]=="companies" && dat=="exportmarkets"){
		build += "?view=companies&sort"+sort+"&subsector="+subsector+"&products="+products+"&exportmarkets=&certificate="+certificate+"&search="+search+"&pn="+pn+"&token="+token;
	}else if(par["view"]=="companies" && dat=="certificate"){
		build = "?view=companies&sort"+sort+"&subsector="+subsector+"&products="+products+"&exportmarkets="+exportmarkets+"&certificate=&search="+search+"&pn="+pn+"&token="+token;
	}else if(par["view"]=="products" && dat=="subsector"){
		build += "?view=products&sort"+sort+"&subsector=&products=&exportmarkets="+exportmarkets+"&certificate="+certificate+"&search="+search+"&pn="+pn+"&token="+token;
	}else if(par["view"]=="products" && dat=="products"){
		build += "?view=products&sort"+sort+"&subsector="+subsector+"&products=&exportmarkets="+exportmarkets+"&certificate="+certificate+"&search="+search+"&pn="+pn+"&token="+token;
	}else if(par["view"]=="services" && dat=="subsector"){
		build += "?view=services&sort"+sort+"&subsector=&products=&exportmarkets="+exportmarkets+"&certificate="+certificate+"&search="+search+"&pn="+pn+"&token="+token;
	}else if(par["view"]=="services" && dat=="products"){
		build += "?view=services&sort"+sort+"&subsector="+subsector+"&products=&exportmarkets="+exportmarkets+"&certificate="+certificate+"&search="+search+"&pn="+pn+"&token="+token;
	}else if(dat=="xview"){
		build = "http://"+document.domain+"/en/business-portal?view=&type="+type+"&sector="+sector+"&token="+token;
	}else if(dat=="xtype"){
		build = "http://"+document.domain+"/en/business-portal?view="+view+"&type=&sector="+sector+"&token="+token;
	}else if(dat=="xsector"){
		build = "http://"+document.domain+"/en/business-portal?view="+view+"&type="+type+"&sector=&token="+token;
	}

	location.href = build; 
});
var newfrom = 1;
$(document).on("click",".loadmore",function(){
	var type = $(this).data("type"); 
	var typex = $(this).data("typex"); 
	var sector = $(this).data("sector"); 
	var subsector = $(this).data("subsector"); 
	var products = $(this).data("products"); 
	var exportmarkets = $(this).data("exportmarkets"); 
	var certificate = $(this).data("certificate");
	var view = $(this).data("view");
	var from = $(this).attr("data-from");
	var load = $(this).data("load");
	var search = $("#svalue").val();

	if(type=="companylist"){
		$(this).hide();
		$(".loader").fadeIn("slow"); 
		$.post("http://"+document.domain+"/en/ajax",{
			loadmore:true, 
			t:type,
			ss:subsector, 
			p:products, 
			e:exportmarkets, 
			c:certificate, 
			f:from, 
			l:load, 
			ser:search
		},function(r){
			nf = parseInt(load) * newfrom;
			$(".loader").hide();
			$(".loadmore").attr({"data-from":nf}); 
			if(r!="Empty"){
				var obj = jQuery.parseJSON(r);
				var insert = '';
				for(i=0; i<obj.length; i++){
					insert += '<a href="http://'+document.domain+'/en/user?t='+obj[i].su_companytype+'&amp;i='+obj[i].su_id+'&amp;token=nope">';
					insert += '<div class="filter_content">';
					insert += '<div class="names">'+obj[i].su_namelname+'</div>';
					insert += '<div class="content_divs">';
					insert += '<div class="col-sm-2 no-float itemssss"><img src="http://'+document.domain+'/image?f=http://'+document.domain+'/files/usersimage/'+obj[i].su_picture+'&w=150&h=75" class="img-responsive" alt="logo" /></div>';
					insert += '<div class="col-sm-2 no-float itemssss">';
					insert += '<ul class="text_formats">';
					insert += '<li>'+obj[i].su_sub_sector_id+'</li>';
					insert += '</ul>';
					insert += '</div>';
					insert += '<div class="col-sm-2 no-float itemssss">';
					insert += '<ul class="text_formats">';
					insert += '<li>'+obj[i].su_products+'</li>';
					insert += '</ul>';
					insert += '</div>';
					insert += '<div class="col-sm-4 no-float itemssss">';
					insert += '<ul class="text_formats">';
					insert += '<li>'+obj[i].su_export_markets_id+'</li>';
					insert += '</ul>';
					insert += '</div>';
					insert += '<div class="col-sm-2 no-float itemssss">';
					insert += '<ul class="text_formats">';
					insert += '<li>'+obj[i].su_certificates+'</li>';
					insert += '</ul>';
					insert += '</div>';
					insert += '</div>';
					insert += '</div>';
					insert += '</a>';
				}
				$(".appends").append(insert);
				$(".loadmore").show(); 
			}else{
				$(".appends").append("<p>Sorry, there is no more data!</p>");
			}
		});
	}else if(type=="productslist"){
		$(this).hide();
		$(".loader").fadeIn("slow"); 
		$.post("http://"+document.domain+"/en/ajax",{
			loadmore:true, 
			t:type,
			ss:subsector, 
			p:products, 
			f:from, 
			l:load
		},function(r){
			nf = parseInt(load) * newfrom;
			$(".loader").hide();
			$(".loadmore").attr({"data-from":nf}); 
			if(r!="Empty"){
				var obj = jQuery.parseJSON(r);
				var insert = '';
				for(i=0; i<obj.length; i++){
					insert += '<a href="http://'+document.domain+'/en/user?t='+obj[i].su_companytype+'&amp;i='+obj[i].users_id+'&amp;p='+obj[i].id+'&amp;token=nope">';
					insert += '<div class="filter_content">';
					insert += '<div class="names">'+obj[i].title+'</div>';
					insert += '<div class="content_divs">';
					if(obj[i].picture!=""){
						insert += '<div class="col-sm-2 no-float itemssss">p<img src="http://'+document.domain+'/image?f=http://'+document.domain+'/files/usersproducts/'+obj[i].picture+'&w=175&h=175" class="img-responsive" width="100%" alt="" /></div>';
					}else{
						insert += '<div class="col-sm-2 no-float itemssss"><img src="http://'+document.domain+'/template/img/p.png" class="img-responsive" width="100%" alt="" /></div>';
					}
					insert += '<div class="col-sm-2 no-float itemssss">';
					insert += '<ul class="text_formats">';
					insert += '<li>'+obj[i].sub_sector_id+'</li>';
					insert += '</ul>';
					insert += '</div>';
					insert += '<div class="col-sm-2 no-float itemssss">';
					insert += '<ul class="text_formats">';
					insert += '<li>'+obj[i].products+'</li>';
					insert += '</ul>';
					insert += '</div>';
					insert += '<div class="col-sm-2 no-float itemssss">';
					insert += '<ul class="text_formats">';
					insert += '<li>'+obj[i].users_name+'</li>';
					insert += '</ul>';
					insert += '</div>';
					insert += '<div class="col-sm-4 no-float itemssss">';
					insert += '<ul class="text_formats">';
					insert += '<li><span>Packiging:</span> '+obj[i].packaging+'</li>';
					insert += '<li><span>Shelf Life:</span> '+obj[i].shelf_life+'</li>';
					insert += '<li><span>Awards:</span> '+obj[i].awards+'</li>';
					if(obj[i].productanalisis){
						insert += '<li><span>Product Analysis:</span> <a href="http://'+document.domain+'/files/document/'+obj[i].productanalisis+'" style="color:#337ab7" target="_blank">PDF</a></li>';
					}
					insert += '</ul>';
					insert += '<ul class="text_formats" style="margin-top:20px;">';
					insert += '<li><span>About:</span> '+obj[i].long_description+'</li>';
					insert += '</ul>';
					insert += '</div>';
					insert += '</div>';
					insert += '</div>';
					insert += '</a>';
				}
				$(".appends").append(insert);
				$(".loadmore").show(); 
			}else{
				$(".appends").append("<p>Sorry, there is no more data!</p>");
			}
		});
	}else if(type=="servicelist"){
		$(this).hide();
		$(".loader").fadeIn("slow"); 
		$.post("http://"+document.domain+"/en/ajax",{
			loadmore:true, 
			t:type,
			ss:subsector, 
			p:products, 
			f:from, 
			l:load
		},function(r){
			nf = parseInt(load) * newfrom;
			$(".loader").hide();
			$(".loadmore").attr({"data-from":nf}); 
			if(r!="Empty"){
				var obj = jQuery.parseJSON(r);
				var insert = '';
				for(i=0; i<obj.length; i++){
					insert += '<a href="http://'+document.domain+'/en/user?t='+obj[i].su_companytype+'&amp;i='+obj[i].users_id+'&amp;p='+obj[i].id+'&amp;token=nope">';
					insert += '<div class="filter_content">';
					insert += '<div class="names">'+obj[i].title+'</div>';
					insert += '<div class="content_divs">';
					insert += '<div class="col-sm-2 no-float itemssss"><img src="http://'+document.domain+'/image?f=http://'+document.domain+'/files/usersimage/'+obj[i].picture+'&w=150&h=75" class="img-responsive" width="100%" alt="" /></div>';
					insert += '<div class="col-sm-2 no-float itemssss">';
					insert += '<ul class="text_formats">';
					insert += '<li>'+obj[i].sub_sector_id+'</li>';
					insert += '</ul>';
					insert += '</div>';
					insert += '<div class="col-sm-2 no-float itemssss">';
					insert += '<ul class="text_formats">';
					insert += '<li>'+obj[i].products+'</li>';
					insert += '</ul>';
					insert += '</div>';
					insert += '<div class="col-sm-6 no-float itemssss">';
					insert += '<ul class="text_formats">';
					insert += '<li>'+obj[i].long_description+'</li>';
					insert += '</ul>';
					insert += '</div>';
					insert += '</div>';
					insert += '</div>';
					insert += '</a>';
				}
				$(".appends").append(insert);
				$(".loadmore").show(); 
			}else{
				$(".appends").append("<p>Sorry, there is no more data!</p>");
			}
		});
	}else if(type=="enquirelist"){
		$(this).hide();
		$(".loader").fadeIn("slow"); 
		$.post("http://"+document.domain+"/en/ajax",{
			loadmore:true, 
			t:type,
			v:view, 
			tx:typex, 
			sec:sector, 
			f:from, 
			l:load
		},function(r){
			nf = parseInt(load) * newfrom;
			$(".loader").hide();
			$(".loadmore").attr({"data-from":nf}); 
			if(r!="Empty"){
				var obj = jQuery.parseJSON(r);
				var insert = '';
				for(i=0; i<obj.length; i++){
					insert += '<div class="content_divs" style="margin-bottom:38px;">';					
					insert += '<a href="http://'+document.domain+'/en/user?t='+obj[i].su_companytype+'&amp;i='+obj[i].users_id+'&amp;p='+obj[i].id+'&amp;token=nope">'; 
					insert += '<div class="col-sm-8 no-float itemssss" style="text-align:left;">'; 
					insert += '<div class="enquire enquire_small no_border">'; 
					insert += '<div class="date">'+obj[i].date+'</div>'; 
					insert += '<div class="col-sm-12">'; 
					insert += '<div class="title">'+obj[i].title+'</div>'; 
					insert += '<div class="text">'; 
					insert += obj[i].long_description; 
					insert += '<small>'+obj[i].type+'</small>'; 
					insert += '</div>'; 
					insert += '</div>'; 
					insert += '</div>'; 
					insert += '</div>'; 
					insert += '</a>'; 
					insert += '<div class="col-sm-2 no-float itemssss">'; 
					insert += '<a href="http://'+document.domain+'/en/user?t='+obj[i].su_companytype+'&amp;i='+obj[i].users_id+'&amp;token=nope" style="color:#0278c1; text-decoration:underline">'+obj[i].users_name+'</a>'; 
					insert += '</div>'; 
					insert += '<div class="col-sm-2 no-float itemssss">';
					insert += '<ul class="text_formats">';
					insert += '<li>';
					insert += obj[i].sector_name; 
					insert += '</li>';
					insert += '</ul>';
					insert += '</div>';
					insert += '</div><div style="clear:both"></div>'; 
				}
				$(".appends").append(insert);
				$(".loadmore").show(); 
			}else{
				$(".appends").append("<p>Sorry, there is no more data!</p>");
			}
		});
	}else if(type=="profileservicelist"){
		$(this).hide();
		$(".loader").fadeIn("slow"); 
		$.post("http://"+document.domain+"/en/ajax",{
			loadmore:true, 
			t:type,
			f:from, 
			l:load
		},function(r){
			nf = parseInt(load) * newfrom;
			$(".loader").hide();
			$(".loadmore").attr({"data-from":nf}); 
			if(r!="Empty"){
				var obj = jQuery.parseJSON(r);
				var insert = '';
				for(i=0; i<obj.length; i++){
					insert += '<div class="services" style="float:left; margin-bottom:10px; width:100%">';
					insert += '<div class="col-sm-12 col-md-12 col-xs-12 col-gl-12 service_item">';
					insert += '<div class="col-sm-10 col-md-10 col-xs-12 col-gl-10 product_info padding_0">';
					insert += '<div class="title">'+obj[i].title+'</div>';
					insert += '<div class="text">';
					insert += obj[i].long_description;
					insert += '</div>';
					insert += '</div>';
					insert += '<div class="col-sm-2">';
					insert += '<button class="btn btn-yellow btn-sm btn-service_item" style="width:100%;" id="change_service" data-sid="'+obj[i].id+'">MAKE CHANGES</button>';
					insert += '<button class="btn btn-yellow btn-sm btn-service_item" style="background:red; width:100%;" id="delete_service" data-srvid="'+obj[i].idx+'">DELETE</button>';
					if(obj[i].visibility==2){
						insert += '<button class="btn btn-aproved btn-sm btn-service_item" style="width:100%;">APPROVED</button>';	
					}else{
						insert += '<button class="btn btn-aproved btn-sm btn-service_item" style="width:100%;">PENDING</button>';	
					}
					insert += '</div>';
					insert += '</div>';
					insert += '</div>';
				}
				$(".appends").append(insert);
				$(".loadmore").show(); 
			}else{
				$(".appends").append("<p>Sorry, there is no more data!</p>");
			}
		});
	}else if(type=="profileproductlist"){
		$(this).hide();
		$(".loader").fadeIn("slow"); 
		$.post("http://"+document.domain+"/en/ajax",{
			loadmore:true, 
			t:type,
			f:from, 
			l:load
		},function(r){
			nf = parseInt(load) * newfrom;
			$(".loader").hide();
			$(".loadmore").attr({"data-from":nf}); 
			if(r!="Empty"){
				var obj = jQuery.parseJSON(r);
				var insert = '';
				for(i=0; i<obj.length; i++){
					insert += '<div class="col-sm-12 padding_0 product_box">';
					insert += '<div class="products">';
					insert += '<div class="col-sm-12 col-md-12 col-xs-12 col-gl-12 product_item">';
					insert += '<div class="col-sm-12 col-md-2 col-xs-12 col-lg-2 padding_0" style="padding-bottom:10px;">';
					if(obj[i].picture!=""){
						insert += '<div class="image"><img src="http://'+document.domain+'/image?f=http://'+document.domain+'/files/usersproducts/'+obj[i].picture+'&w=180&h=180" class="img-responsive" width="100%" alt="" /></div>';
					}else{
						insert += '<div class="image"><img src="http://'+document.domain+'/template/img/p.png" class="img-responsive" width="100%" alt="" /></div>';
					}
					insert += '</div>';
					insert += '<div class="col-sm-12 col-md-7 col-xs-12 col-gl-7 product_info padding_0">';
					insert += '<ul>';
					insert += '<li><span>'+obj[i].title+' - </span>HS code: '+obj[i].hs_title+'</li>';
					insert += '<li><span>Packaging </span> '+obj[i].packaging+'</li>';
					insert += '<li><span>Awardsxx </span> '+obj[i].awards+'</li>';
					if(obj[i].productanalisis){
						insert += '<li><span>Product Analysis:</span> <a href="http://'+document.domain+'/files/document/'+obj[i].productanalisis+'" style="color:#337ab7" target="_blank">PDF</a></li>';
					}
					insert += '</ul>';
					insert += '</div>';
					insert += '<div class="col-sm-12 col-md-8 col-xs-12 col-gl-8 product_info padding_0">';
					insert += '<ul>';
					insert += '<li><span>About - </span>';
					insert += obj[i].long_description;
					insert += '</li>';
					insert += '</ul>';
					insert += '</div>';
					insert += '<div class="col-sm-2 " style="margin-top:30px;">';
					insert += '<button class="btn btn-yellow btn-sm btn-block makeitchange" data-prid="'+obj[i].idx+'">MAKE CHANGES</button>';
					insert += '<button class="btn btn-yellow btn-sm btn-block delete-product" data-prid="'+obj[i].idx+'" style="background:red">DELETE</button>';
					if(obj[i].visibility==1){						
						insert += '<button class="btn btn-aproved btn-sm btn-block">PENDING</button>';
					}else{
						insert += '<button class="btn btn-aproved btn-sm btn-block">APPROVED</button>';
					}
					insert += '</div>';
					insert += '</div>';
					insert += '</div>';
					insert += '</div>';
				}
				$(".appends").append(insert);
				$(".loadmore").show(); 
			}else{
				$(".appends").append("<p>Sorry, there is no more data!</p>");
			}
		});
	}else if(type=="profileenquirelist"){
		$(this).hide();
		$(".loader").fadeIn("slow"); 
		$.post("http://"+document.domain+"/en/ajax",{
			loadmore:true, 
			t:type,
			f:from, 
			l:load
		},function(r){
			nf = parseInt(load) * newfrom;
			$(".loader").hide();
			$(".loadmore").attr({"data-from":nf}); 
			if(r!="Empty"){
				var obj = jQuery.parseJSON(r);
				var insert = '';
				for(i=0; i<obj.length; i++){
					insert += '<div class="enquire">';
					insert += '<div class="date">'+obj[i].date+'</div>';
					insert += '<div class="col-sm-10">';
					insert += '<div class="title">';
					insert += obj[i].title;
					insert += '</div>';
					insert += '<div class="text">';
					insert += obj[i].long_description;
					insert += '</div>';
					insert += '</div>';
					insert += '<div class="col-sm-2">';
					insert += '<div class="text-right">';
					insert += '<button class="btn btn-yellow" style="width:100%; padding: 7px 0; float:left;" id="change_enquires" data-eid="'+obj[i].id+'">MAKE CHANGES</button>';
					insert += '<button class="btn btn-aproved" style="width:100%; padding: 7px 0; margin-top:8px; float:left; background:red" id="delete_enquires" data-enquid="'+obj[i].idx+'">DELETE</button>';
					if(obj[i].visibility==2){
						insert += '<button class="btn btn-aproved" style="width:100%; padding: 7px 0; margin-top:8px; float:left;">APPROVED</button>';
					}else{
						insert += '<button class="btn btn-aproved" style="width:100%; padding: 7px 0; margin-top:8px; float:left;">PENDING</button>';
					}
					insert += '</div>';
					insert += '</div>';
					insert += '<div style="clear:both"></div>';
					insert += '</div>';
				}
				$(".appends").append(insert);
				$(".loadmore").show(); 
			}else{
				$(".appends").append("<p>Sorry, there is no more data!</p>");
			}
		});
	}else if(type=="eventslist"){
		$(this).hide();
		$(".loader").fadeIn("slow"); 
		$.post("http://"+document.domain+"/en/ajax",{
			loadmore:true, 
			t:type,
			f:from, 
			l:load
		},function(r){
			nf = parseInt(load) * newfrom;
			$(".loader").hide();
			$(".loadmore").attr({"data-from":nf}); 
			if(r!="Empty"){
				var obj = jQuery.parseJSON(r);
				var insert = '';
				var old = '';
				var bw = '';
				for(i=0; i<obj.length; i++){
					old = (obj[i].datetime < time()) ? ' oldeventitem' : '';
					bw = (obj[i].datetime < time()) ? '&amp;bw=1' : '';
					insert += '<div class="col-sm-4 col-md-3 col-xs-4 event_item'+old+'">';
					insert += '<a href="http://'+document.domain+'/en/'+obj[i].slug+'">';
					insert += '<div class="date">'+obj[i].date+'</div>';
					insert += '<div class="image"><img src="http://'+document.domain+'/image?f=http://'+document.domain+'/'+obj[i].pic+'&amp;w=270&amp;h=130'+bw+'" class="img-responsive" alt="" /></div>';
					insert += '<div class="text"><b>'+obj[i].title+'</b> <p class="booth">Booth N: '+obj[i].event_booth+'</p></div>';
					insert += '</a>';
					insert += '</div>';
				}
				$(".appends").append(insert);
				$(".loadmore").show(); 
			}else{
				$(".appends").append("<p style=\"width:100%; clear:both\">Sorry, there is no more data!</p>");
			}
		});
	}else if(type=="newslist"){
		$(this).hide();
		$(".loader").fadeIn("slow"); 
		$.post("http://"+document.domain+"/en/ajax",{
			loadmore:true, 
			t:type,
			f:from, 
			l:load
		},function(r){
			nf = parseInt(load) * newfrom;
			$(".loader").hide();
			$(".loadmore").attr({"data-from":nf}); 
			if(r!="Empty"){
				var obj = jQuery.parseJSON(r);
				var insert = '';
				for(i=0; i<obj.length; i++){
					insert += '<div class="col-sm-4 col-md-3 col-xs-4 news_item">';
					insert += '<a href="http://'+document.domain+'/en/'+obj[i].slug+'">';
					insert += '<div class="date">'+obj[i].date+'</div>';
					insert += '<div class="text">'+obj[i].title+'</div>';
					insert += '</a>';
					insert += '</div>';
				}
				$(".appends").append(insert);
				$(".loadmore").show(); 
			}else{
				$(".appends").append("<p style=\"width:100%; clear:both\">Sorry, there is no more data!</p>");
			}
		});
	}else if(type=="userspageserviceprovider"){
		$(this).hide();
		$(".loader").fadeIn("slow"); 
		var par = urlParamiters(); 
		$.post("http://"+document.domain+"/en/ajax",{
			loadmore:true, 
			t:type,
			uid:par["i"], 
			f:from, 
			l:load
		},function(r){
			nf = parseInt(load) * newfrom;
			$(".loader").hide();
			$(".loadmore").attr({"data-from":nf}); 
			if(r!="Empty"){
				var obj = jQuery.parseJSON(r);
				var insert = '';
				for(i=0; i<obj.length; i++){
					insert += '<div class="service_box readmore" data-pid="'+obj[i].id+'" style="cursor:pointer">';
					insert += '<ul class="text_formats_ul">';
					insert += '<li class="text_formats"><span>'+obj[i].title+'</span></li>';
					insert += '<li class="text_formats">';
					insert += '<p>'+obj[i].long_description+'</p>';
					insert += '</li>';
					insert += '</ul>';
					insert += '</div>';
				}
				$(".appends").append(insert);
				$(".loadmore").show(); 
			}else{
				$(".appends").append("<p>Sorry, there is no more data!</p>");
			}
		});
	}else if(type=="userspagemanufacturer"){
		$(this).hide();
		$(".loader").fadeIn("slow"); 
		var par = urlParamiters(); 
		$.post("http://"+document.domain+"/en/ajax",{
			loadmore:true, 
			t:type,
			uid:par["i"], 
			f:from, 
			l:load
		},function(r){
			nf = parseInt(load) * newfrom;
			$(".loader").hide();
			$(".loadmore").attr({"data-from":nf}); 
			if(r!="Empty"){
				var obj = jQuery.parseJSON(r);
				var insert = '';
				for(i=0; i<obj.length; i++){
					insert += '<div class="col-sm-12 col-md-12 col-xs-12 col-gl-12 product_item" style="margin-bottom:10px;">';
					insert += '<div class="col-sm-12 col-md-3 col-xs-12 col-lg-3 padding_0">';
					insert += '<div class="image"><img src="http://'+document.domain+'/image?f=http://'+document.domain+'/files/usersproducts/'+obj[i].picture+'&w=175&h=175" class="img-responsive" alt="" /></div>';
					insert += '</div>';
					insert += '<div class="col-sm-12 col-md-7 col-xs-12 col-gl-7 product_info padding_0">';
					insert += '<ul>';
					insert += '<li><span>'+obj[i].title+'</span> - HS '+obj[i].hscode+'</li>';
					insert += '<li><span>Packiging: </span>'+obj[i].packaging+'</li>';
					insert += '<li><span>Shelf life: </span>'+obj[i].shelf_life+'</li>';
					insert += '<li><span>Awards: </span>'+obj[i].awards+'</li>';
					insert += '<li style="margin-top:15px;"><a href="javascript:;" class="readmore" data-pid="'+obj[i].id+'">View describtion</a></li>';
					insert += '</ul>';
					insert += '</div>';
					insert += '</div>';
				}
				$(".appends").append(insert);
				$(".loadmore").show(); 
			}else{
				$(".appends").append("<p>Sorry, there is no more data!</p>");
			}
		});
	}else if(type=="userspageenquires"){
		$(this).hide();
		$(".loader").fadeIn("slow"); 
		var par = urlParamiters(); 
		$.post("http://"+document.domain+"/en/ajax",{
			loadmore:true, 
			t:type,
			uid:par["i"], 
			f:from, 
			l:load
		},function(r){
			nf = parseInt(load) * newfrom;
			$(".loader").hide();
			$(".loadmore").attr({"data-from":nf}); 
			if(r!="Empty"){
				var obj = jQuery.parseJSON(r);
				var insert = '';
				for(i=0; i<obj.length; i++){
					insert += '<div class="enquire enquire_small readmore" data-pid="'+obj[i].id+'" style="cursor:pointer">';
					insert += '<div class="date">'+obj[i].date+'</div>';
					insert += '<div class="col-sm-12" style="float:none;">';
					insert += '<div class="title">';
					insert += obj[i].title;
					insert += '</div>';
					insert += '<div class="text">';
					insert += obj[i].long_description;
					insert += '<small>'+obj[i].type+'</small>';
					insert += '</div>';
					insert += '</div>';
					insert += '</div>';
				}
				$(".appends").append(insert);
				$(".loadmore").show(); 
			}else{
				$(".appends").append("<p>Sorry, there is no more data!</p>");
			}
		});
	}else if(type=="usefulllinks"){
		$(this).hide();
		$(".loader").fadeIn("slow"); 
		$.post("http://"+document.domain+"/en/ajax",{
			loadmore:true, 
			t:type,
			f:from, 
			l:load
		},function(r){
			nf = parseInt(load) * newfrom;
			$(".loader").hide();
			$(".loadmore").attr({"data-from":nf}); 
			if(r!="Empty"){
				var obj = jQuery.parseJSON(r);
				var insert = '';
				for(i=0; i<obj.length; i++){
					insert += '<a href="'+obj[i].url+'" target="_blank" title="'+obj[i].title+'">';
					insert += '<div class="col-sm-4 useful_item">';
					insert += '<div class="image"><img src="'+obj[i].image+'" alt="" /></div>';
					insert += '<div class="title" style="max-height:60px">'+obj[i].titleShort+' »</div>';
					insert += '</div>';
					insert += '</a>';
				}
				$(".appends").append(insert);
				$(".loadmore").show(); 
			}else{
				$(".appends").append("<p style=\"width=100%; clear:both; padding:0 10px;\">Sorry, there is no more data!</p>");
			}
		});
	}
	newfrom++;
});

$(document).on("click","#recover_submit",function(){
	var recoveremail = $("#recoveremail").val();
	var recovercaptcha = $("#recovercaptcha").val();
	$(".error_message").hide();
	if(recoveremail==""){
		$(".recover_email_required").fadeIn("slow"); 
		return false;
	}else if(recovercaptcha==""){
		$(".recover_captcha_required").fadeIn("slow"); 
		return false;
	}else{
		if(validateEmail(recoveremail)){
			$(".boxarea").html("Please wait");
			$.post("http://"+document.domain+"/en/ajax", {
				passwordRecover:true, 
				e:recoveremail, 
				c:recovercaptcha 
			}, function(r){
				if(r=="Error"){
					$(".boxarea").html("<p>We can not send recover email, Please make sure you are registed and register email is rigth! </p><a href=\"javascript:;\" id=\"reload\">Reload</a>");
				}else{
					$(".boxarea").html(r);
				}				
			});
		}else{
			$(".recover_emailcorrect_required").fadeIn("slow"); 
			return false;
		}
	}
});

$(document).on("click","#change_re_password",function(){
	var npassword = $("#npassword").val();
	var cpassword = $("#cpassword").val();
	$(".error_message").hide();
	if(npassword==""){
		$(".npassword_required").fadeIn();
		return false;
	}else if(npassword.length < 6 || npassword.length > 20){
		$(".npassword_must6cher").fadeIn();
		return false;
	}else if(npassword!=cpassword){
		$(".cpassword_match_required").fadeIn();
		return false;
	}else {
		$("#recoverPassword_form").submit();
	}

});

$(document).on("click",".share",function(){ 
	var u = window.location.href; 
	$("#u").html(u); 
	$("#insertText").html("Please wait..."); 
	$('#message_popup').modal('toggle');
	copyMe("u"); 
});

$(document).on("click",".print",function(){ 
	window.print();
});


$(document).on("mouseenter",".homePageSmallBanner",function(){
	$(this).stop().fadeTo("slow" , 0.6);
});

$(document).on("mouseleave",".homePageSmallBanner",function(){
	$(this).stop().fadeTo("slow" , 1);
});
var opm = 1;
$(document).on("click",".filters_in_mobile",function(){
	if(opm==1){
		var degrees = 180;
		$(".after",this).css({'-webkit-transform' : 'rotate('+ degrees +'deg)',
	                 '-moz-transform' : 'rotate('+ degrees +'deg)',
	                 '-ms-transform' : 'rotate('+ degrees +'deg)',
	                 'transform' : 'rotate('+ degrees +'deg)'});
		$(".showLevel1").slideDown("slow"); 
		opm = 2;
	}else{
		var degrees = 0;
		$(".after",this).css({'-webkit-transform' : 'rotate('+ degrees +'deg)',
	                 '-moz-transform' : 'rotate('+ degrees +'deg)',
	                 '-ms-transform' : 'rotate('+ degrees +'deg)',
	                 'transform' : 'rotate('+ degrees +'deg)'});
		$(".showLevel1").slideUp("slow"); 
		opm = 1;
	}
});



$(document).on("click",".chooseMe",function(){
	var thisData = $(this).data("sect"); 
	// var load = $(this).data("load");
	// var htmlLoad = $("."+load).html(); 
	var turn = $(this).data("turn"); 
	if(turn=="off"){
		$("."+thisData).slideDown();
		$(this).data("turn","on");
		var degrees = 270;
		$(".downArrow",this).css({'-webkit-transform' : 'rotate('+ degrees +'deg)',
	                 '-moz-transform' : 'rotate('+ degrees +'deg)',
	                 '-ms-transform' : 'rotate('+ degrees +'deg)',
	                 'transform' : 'rotate('+ degrees +'deg)'});

	}else{
		$("."+thisData).slideUp();
		$(this).data("turn","off");
		var degrees = 0;
		$(".downArrow",this).css({'-webkit-transform' : 'rotate('+ degrees +'deg)',
	                 '-moz-transform' : 'rotate('+ degrees +'deg)',
	                 '-ms-transform' : 'rotate('+ degrees +'deg)',
	                 'transform' : 'rotate('+ degrees +'deg)'});
	}
});

$(document).on("keyup","#about",function(){
	var ab = $(this).val();
	var num = strlen(ab);
	if(num>350){ $(this).css({"color":"red"}); }
	else{ $(this).css({"color":"#3895ce"}); }
	$("#maxlength").html(num+' / 350');
});

$(document).on("keyup","#product_description",function(){
	var ab = $(this).val();
	var num = strlen(ab);
	if(num>350){ $(this).css({"color":"red"}); }
	else{ $(this).css({"color":"#3895ce"}); }
	$("#maxlengthproduct").html(num+' / 350');
});

$(document).on("keyup","#service_description",function(){
	var ab = $(this).val();
	var num = strlen(ab);
	if(num>350){ $(this).css({"color":"red"}); }
	else{ $(this).css({"color":"#3895ce"}); }
	$("#maxlengthservice").html(num+' / 350');
});

$(document).on("keyup","#edescription",function(){
	var ab = $(this).val();
	var num = strlen(ab);
	if(num>350){ $(this).css({"color":"red"}); }
	else{ $(this).css({"color":"#3895ce"}); }
	$("#maxlengthedescription").html(num+' / 350');
});

$(document).on("keyup","#p_describe",function(){
	var ab = $(this).val();
	var num = strlen(ab);
	if(num>350){ $(this).css({"color":"red"}); }
	else{ $(this).css({"color":"#3895ce"}); }
	$("#maxlengthproductpopup").html(num+' / 350');
});

$(document).on("keyup","#s_sdescription",function(){
	var ab = $(this).val();
	var num = strlen(ab);
	if(num>350){ $(this).css({"color":"red"}); }
	else{ $(this).css({"color":"#3895ce"}); }
	$("#maxlengthservicePopup").html(num+' / 350');
});

$(document).on("keyup","#e_description",function(){
	var ab = $(this).val();
	var num = strlen(ab);
	if(num>350){ $(this).css({"color":"red"}); }
	else{ $(this).css({"color":"#3895ce"}); }
	$("#maxlengthenquirePopup").html(num+' / 350');
});

$(document).on("click","#askToAddCertificate",function(){
	var certi = $("#certi").val(); 
	$(".error_message").fadeOut("slow");
	if(certi==""){
		$(".certi_required").fadeIn("slow");
		return false;
	}else{
		$("#certificateAddBox").html("<div class=\"form-group\"><p>Please wait...</p></div>"); 
		$.post("http://"+document.domain+"/en/ajax",{ asktoaddcertificate:true, c:certi },function(r){
			if(r=="Done"){
				$("#certificateAddBox").html("<div class=\"form-group\"><p>Thank you, Your request received successfully ! Certificate will be added after administrator permision.</p></div>"); 
			}else if(r=="Exists"){
				$("#certificateAddBox").html("<div class=\"form-group\"><p>Sorry, Certificate already exists !</p></div>"); 
			}else{
				$("#certificateAddBox").html("<div class=\"form-group\"><p>Sorry, error occurred !</p></div>"); 
			}
		});
	}
});

function copyMe(e){ 
	SelectText(e); 
	window.getSelection(); 
	try { 
		var successful = document.execCommand('copy'); 
		var msg = (successful) ? 'successful. Paste it any social network you would like.' : 'unsuccessful. Your browser does not support it.'; 
		$("#insertText").html('Copy url command was ' + msg); 
	}catch(err) { 
		$("#insertText").html('Error'); 
	} 
	window.getSelection().removeAllRanges(); 
} 

function SelectText(element) { 
	var doc = document, text = doc.getElementById(element), range, selection; 
	if (doc.body.createTextRange) { 
		range = document.body.createTextRange(); 
		range.moveToElementText(text); 
		range.select(); 
	} else if (window.getSelection) { 
		selection = window.getSelection(); 
		range = document.createRange(); 
		range.selectNodeContents(text); 
		selection.removeAllRanges(); 
		selection.addRange(range); 
	} 
}


function callChat(){
	$("#insertText").html("Please wait..."); 
	$('#message_popup').modal('toggle');
	window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
	d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
	_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
	$.src="//v2.zopim.com/?39RyjmvEGfikM3GPxh7EiUJlsKNbZgyI";z.t=+new Date;$.
	type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
	
	$zopim(function() {
		$zopim.livechat.window.show();
		});
	$('#message_popup').modal('toggle');
}

function getReadmoreInfo(uid,pid){
	$("#insertText").html("Please wait..."); 
	$('#message_popup').modal('toggle');
	$.post("http://"+document.domain+"/en/ajax", {
		loadreadmore:true, 
		u:uid, 
		p:pid 
	}, function(r){
		$('#message_popup').modal('toggle');
		$("#insertHtmlP").html(r); 
		$('#readmore_popup').modal('toggle');
	});
}

function selectOnlySectors(sarray){
	$("#drop_sector .selectItem .sector_ids").each(function(e){
		var v = $(this).val(); 
		for(i=0;i<=sarray.length;i++){
			if(v==sarray[i]){
				$(this).click();
			}
		}
	});
	$(".selectBoxWithCheckbox").html("Selected "+ (sarray.length) +" items");

}

function selectSectors(sarray, sarray2, sarray3){
	$("#drop_sector .selectItem .sector_ids").each(function(e){
		var v = $(this).val(); 
		for(i=0;i<=sarray.length;i++){
			if(v==sarray[i]){
				$(this).click();
			}
		}
	});

	setTimeout(function(){
		$("#drop_sector2 .selectItem2 .sector_ids2").each(function(e){
			var v2 = $(this).val(); 
			for(i=0;i<=sarray2.length;i++){
				if(v2==sarray2[i]){
					$(this).click();
				}
			}
		});
	},1500);

	setTimeout(function(){
		$("#drop_sector3 .selectItem3 .sector_ids3").each(function(e){
			var v3 = $(this).val(); 
			for(i=0;i<=sarray3.length;i++){
				if(v3==sarray3[i]){
					$(this).click();
				}
			}
		});
	},2500);
}

(function ($) {
    "use strict";
    function centerModal() {
        $(this).css('display', 'block');
        var $dialog  = $(this).find(".modal-dialog"),
        offset       = ($(window).height() - $dialog.height()) / 2,
        bottomMargin = parseInt($dialog.css('marginBottom'), 10);

        // Make sure you don't hide the top part of the modal w/ a negative margin if it's longer than the screen height, and keep the margin equal to the bottom margin of the modal
        if(offset < bottomMargin) offset = bottomMargin;
        $dialog.css("margin-top", offset);
    }

    $(document).on('show.bs.modal', '.modal', centerModal);
    $(window).on("resize", function () {
        $('.modal:visible').each(centerModal);
    });
}(jQuery));


function nl2br(str) {
  var breakTag = '<br />'; 
  return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}


function checkLength(ele,min,max){
	var lengthx = $(ele).val().length;
	if(lengthx<min){ 
		return false;
	}
	if(lengthx>max){
		return false;
	}
	return true; 
}

function checkEmpty(v,id){
	if(v==""){
		return false;
	}
	return true;
}

function validateEmail(email) {
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(email);
}

function setCookie(cname, cvalue, exdays){
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}

function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

function urlParamiters()
{
	var query_string = new Array();
	var query = window.location.search.substring(1);
	var vars = query.split("&");
	for (var i=0;i<vars.length;i++) {
		var pair = vars[i].split("=");
		if (typeof query_string[pair[0]] === "undefined") {
		  query_string[pair[0]] = pair[1];
		} else if (typeof query_string[pair[0]] === "string") {
		  var arr = [ query_string[pair[0]], pair[1] ];
		  query_string[pair[0]] = arr;
		} else {
			if(query_string.length){
		  		query_string[pair[0]].push(pair[1]);
			}else{
				query_string[pair[0]] = '';
			}
		}
	} 
	return query_string;		
}

function isUrl(s) {
	if(s.charAt(0)=="w" && s.charAt(1)=="w" && s.charAt(2)=="w" && s.charAt(3)=="."){
		return true;
	}else{
		return false;	
	}	
}

function isMobile(s) {
	console.log(s.length);
	if(s.charAt(0)=="+" && s.charAt(1)=="9" && s.charAt(2)=="9" && s.charAt(3)=="5"){
		return true;
	}else{
		return false;	
	}
}

function strlen(string) {
  var str = string + '';
  var i = 0,
    chr = '',
    lgth = 0;

  if (!this.php_js || !this.php_js.ini || !this.php_js.ini['unicode.semantics'] || this.php_js.ini[
    'unicode.semantics'].local_value.toLowerCase() !== 'on') {
    return string.length;
  }

  var getWholeChar = function(str, i) {
    var code = str.charCodeAt(i);
    var next = '',
      prev = '';
    if (0xD800 <= code && code <= 0xDBFF) { // High surrogate (could change last hex to 0xDB7F to treat high private surrogates as single characters)
      if (str.length <= (i + 1)) {
        throw 'High surrogate without following low surrogate';
      }
      next = str.charCodeAt(i + 1);
      if (0xDC00 > next || next > 0xDFFF) {
        throw 'High surrogate without following low surrogate';
      }
      return str.charAt(i) + str.charAt(i + 1);
    } else if (0xDC00 <= code && code <= 0xDFFF) { // Low surrogate
      if (i === 0) {
        throw 'Low surrogate without preceding high surrogate';
      }
      prev = str.charCodeAt(i - 1);
      if (0xD800 > prev || prev > 0xDBFF) { //(could change last hex to 0xDB7F to treat high private surrogates as single characters)
        throw 'Low surrogate without preceding high surrogate';
      }
      return false; // We can pass over low surrogates now as the second component in a pair which we have already processed
    }
    return str.charAt(i);
  };

  for (i = 0, lgth = 0; i < str.length; i++) {
    if ((chr = getWholeChar(str, i)) === false) {
      continue;
    } // Adapt this line at the top of any loop, passing in the whole string and the current iteration and returning a variable to represent the individual character; purpose is to treat the first part of a surrogate pair as the whole character and then ignore the second part
    lgth++;
  }
  return lgth;
}

function scrollProducts(){
	//serviceadded
	var hh = window.location.hash; 
	//alert(hh);
	if(hh=="#serviceadded"){
		var classx = '.services';
	}else if(hh=="#enquireadded"){
		var classx = '.enquire';
	}else{
		var classx = '.product_box';
	}
	$('html, body').animate({
        scrollTop: $(classx).first().offset().top
    }, 2000, function(){
    	history.pushState("", document.title, window.location.pathname);
    });
}

function time() {
  return Math.floor(new Date().getTime() / 1000);
}

function highlight_words(word, element) {
    if(word) {
        var textNodes;
       // word = word.replace(/\W/g, '');
        var str = word.split('%20');
        $(str).each(function() {
            var term = this;
            var textNodes = $(element).contents().filter(function() { return this.nodeType === 3 });
            textNodes.each(function() {
              var content = $(this).text();
              var regex = new RegExp(term, "gi");
              content = content.replace(regex, '<span class="highlight">' + term + '</span>');
              $(this).replaceWith(content);
            });
        });
    }
}