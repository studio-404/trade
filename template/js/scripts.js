$(document).ready(function(){
	$(".img-responsive").each(function(){ 
		var image = $(this).data("mainimage"); 
		console.log(image); 
		if(image){ 
			$.get(image, function(done){ 
				console.log("loaded !"); 
				$("#mainimage").attr({"src":image});
			});
		}
	});
});
$(document).on("click","#register_catalog",function(e){
	var companytype1 = $("#companytype1").val();
	var emailaddress1 = $("#emailaddress1").val();
	var password1 = $("#password1").val();
	var repeatpassword1 = $("#repeatpassword1").val();
	
	if(document.getElementById("agree1").checked){
		var agree1 = 1;
	}else{
		var agree1 = 2;
	}
	$(".error_message").fadeOut("slow");

	if(checkEmpty(companytype1,"#companytype1")!=true){
		$(".companytype1_required").fadeIn("slow"); 
	}else if(checkEmpty(emailaddress1,"#emailaddress1")!=true){
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
		setCookie("companytype1", companytype1, "1");
		setCookie("emailaddress1", emailaddress1, "1");
		setCookie("password1", password1, "1");
		setCookie("repeatpassword1", repeatpassword1, "1");
		$.post("http://"+document.domain+"/en/ajax",{ sendemail1:true, type1:companytype1, email1:emailaddress1 },function(data){
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
	}else{
		$("#finalstep3").html("<div>Please wait...</div>");
		$(".modal-title small").hide();
		$.post("http://"+document.domain+"/en/ajax",{ logintry:true, e:emailaddress3, p:password3, c:captcha }, function(d){
			if(d=="Done"){ location.reload(); }
			else{ $("#finalstep3").html("<div>Username, password or captcha code is incorrect, or you do not have permition to access your account yet</div>"); $(".reloadbutton").show(); }
		});
	}
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
	var certificates = $("#certificates").val(); 
	var contactperson = $("#contactperson").val(); 
	var officephone = $("#officephone").val(); 
	var companysize = $("#companysize").val(); 
	var webaddress = $("#webaddress").val(); 
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


	if(companyname==""){
		$("#requiredx_companyname").fadeIn("slow");
		return false;
	}else if(sector.length<=0){
		$("#requiredx_sector").fadeIn("slow");
		return false;
	}else if(subsector.length<=0){
		$("#requiredx_subsector").fadeIn("slow");
		return false;
	}else if(products.length<=0){
		$("#requiredx_products").fadeIn("slow");
		return false;
	}else if(exportmarkets.length<=0){ 
		$("#requiredx_exportmarkets").fadeIn("slow");
		return false;
	}else if(validateEmail(contactemail)!=true){
		$("#requiredx_contactemail").fadeIn("slow");
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
			p_certificates:certificates, 
			p_contactpersones:contactperson, 
			p_officephone:officephone, 
			p_companysize:companysize, 
			p_webaddress:webaddress, 
			p_contactemail:contactemail, 
			p_about:nl2br(about), 
			p_products:JSON.stringify(products), 
			p_exportmarkets:JSON.stringify(exportmarkets), 
			p_file: f
		}, 
		function(d){
			if(d=="Done"){ 
				$("#insertText").html("Data updated !"); 
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
	var contactemail = $("#contactemail").val(); 
	var about = $("#about").val(); 


	var sector = []; 
	$('.sector_ids:checked').each(function(i, selected){ 
	  sector[i] = $(selected).val(); 
	});

	// var subsector = []; 
	// $('.sector_ids2:checked').each(function(i, selected){ 
	//   subsector[i] = $(selected).val(); 
	// });

	// var products = []; 
	// $('.sector_ids3:checked').each(function(i, selected){ 
	//   products[i] = $(selected).val(); 
	// });

	// var exportmarkets = []; 
	// $('.sector_ids4:checked').each(function(i, selected){ 
	//   exportmarkets[i] = $(selected).val(); 
	// });


	if(companyname==""){
		$("#requiredx_companyname").fadeIn("slow");
		return false;
	}else if(sector.length<=0){
		$("#requiredx_sector").fadeIn("slow");
		return false;
	}else if(validateEmail(contactemail)!=true){
		$("#requiredx_contactemail").fadeIn("slow");
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
			p_contactemail:contactemail, 
			p_about:nl2br(about), 
			p_file: f
		}, 
		function(d){
			if(d=="Done"){ 
				$("#insertText").html("Data updated !"); 
			} 
		});
	}
});
$(document).on("change","#inputUserLogo",function(e){
	e.stopPropagation();
	e.preventDefault();
	var files = e.target.files;


	var ex = files[0].name.split(".");
	var extLast = ex[ex.length - 1].toLowerCase();
	console.log(extLast);
	if(extLast!="jpeg" && extLast!="jpg" && extLast!="png" && extLast!="gif"){
		$('#message_popup').modal('toggle'); 
		$("#insertText").html("Please choose jpeg, jpg, gif or png file !"); 
		return false;
	}else if(files[0].size > 1000000){
		$('#message_popup').modal('toggle'); 
		$("#insertText").html("File size must be under 1 MB !"); 
		return false;
	}else if(files[0].name){
		$("#uploadImageForm").submit();
		$('#message_popup').modal('toggle'); 
		$("#insertText").html("Please wait !"); 
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
	var product_description = $("#product_description").val(); 
	$(".error-msg").hide();
	if(products2==""){
		$("#requiredx_add_products").fadeIn("slow"); 
	}else if(product_name==""){
		$("#requiredx_add_productsname").fadeIn("slow"); 
	}else if(hscode_id==""){
		$("#requiredx_add_hscode").fadeIn("slow"); 
	}else if(product_description==""){
		$("#requiredx_add_describe").fadeIn("slow"); 
	}else if(productfile==""){
		$("#requiredx_add_photo").fadeIn("slow"); 
	}else{
		$("#insertText").html("Please wait"); 
		$('#message_popup').modal('toggle'); 
		$.post("http://"+document.domain+"/en/ajax", {
			addproduct:true, 
			p:products2, 
			s:shelf_life, 
			pn:product_name, 
			pkg:packinging, 
			c:hscode_id, 
			a:awards, 
			d:nl2br(product_description)
		}, function(r){
			if(r!="Error"){
				$("#pi").val(r); 
				$("#addproduct").submit(); 
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
	console.log(extLast);
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
		$("#p_describe").val(obj[0].long_description);
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
		var regex = /<br\s*[\/]?>/gi;
		$("#s_sdescription").val(obj[0].long_description.replace(regex, "\n"));
	});
	$('#makeservicechange').modal('toggle');
});

$(document).on("click","#change_service_inside",function(e){
	var s_id = $("#s_sid").val();
	var s_service = $("#s_service").val();
	var s_sdescription = $("#s_sdescription").val();
	$.post("http://"+document.domain+"/en/ajax", {
		changeservice: true, 
		i:s_id, 
		s:s_service, 
		d:nl2br(s_sdescription) 
	}, function(r){
		if(r=="Done"){
			location.reload();
		}
	});
});

$(document).on("click","#change_product",function(){
	var p_pid = $("#p_pid").val();
	var p_prname = $("#p_prname").val();
	var p_hscode = $(".hscode_id").val();
	var p_shelf_life = $("#p_shelf_life").val();
	var p_packaging = $("#p_packaging").val();
	var p_awards = $("#p_awards").val();
	var p_describe = $("#p_describe").val();
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
	}else{
		$.post("http://"+document.domain+"/en/ajax", {
			makeitchange: true, 
			pi: p_pid, 
			pn :p_prname, 
			phs: p_hscode, 
			psl: p_shelf_life, 
			pp: p_packaging, 
			pa: p_awards, 
			pd: p_describe
		}, function(r){

			if(r=="Done"){
				if($("#p_image").val()){
					document.getElementById('changeProductImage').submit();
				}else{
					location.reload();
				}
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

$(document).on("click",".selectBoxWithCheckbox2",function(){
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
	$(".selectBoxWithCheckbox").html("Selected "+ (r) +" items");
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
	if(r2>0){
		$(".selectBoxWithCheckbox2").html("Selected "+ (r2) +" items");
	}
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
	var desc = $("#service_description").val();
	$(".error_message").hide(); 
	if(title==""){
		$("#servicetitle_required").fadeIn("slow"); 
		return false;
	}else if(desc==""){
		$("#servicedesc_required").fadeIn("slow"); 
		return false;
	}else{
		$("#insertText").html("Please wait"); 
		$('#message_popup').modal('toggle');
		$.post("http://"+document.domain+"/en/ajax", {
			addservice:true, 
			t:title, 
			d:nl2br(desc)
		}, function(r){
			if(r=="Done"){
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
	}else if(edescription==''){
		$("#enquire_description_required").fadeIn("slow"); 
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

	if(r3>0){
		$(".selectBoxWithCheckbox3").html("Selected "+ (r3) +" items");
	}
});

$(document).on("click",".selectItem4",function(e){
	e.stopPropagation();
	
	var c4 = $(this).data("checkbox"); 
	$("#"+c4).click(); 
	var r4 = 0;
	$('.sector_ids4:checked').each(function() {
    	r4++;
	});

	if(r4>0){
		$(".selectBoxWithCheckbox4").html("Selected "+ (r4) +" items");
	}
});


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