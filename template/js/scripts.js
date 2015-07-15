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
	$('#sector :selected').each(function(i, selected){ 
	  sector[i] = $(selected).val(); 
	});

	var subsector = []; 
	$('#subsector :selected').each(function(i, selected){ 
	  subsector[i] = $(selected).val(); 
	});

	var products = []; 
	$('#products :selected').each(function(i, selected){ 
	  products[i] = $(selected).val(); 
	});

	var exportmarkets = []; 
	$('#exportmarkets :selected').each(function(i, selected){ 
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


$(document).on("change",".input_type_file",function(e){
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

$(document).on("keyup","#hscode",function(e){
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
		$("#hscode_id").val(''); 
		$(".results").slideUp("slow");
	}
});

$(document).on("click",".resultx",function(e){
	var idx = $(this).data("idx"); 
	var val = $(this).html(); 
	val = val.replace(/[<]br[^>]*[>]/gi,"");
	$("#hscode").val(val); 
	$("#hscode_id").val(idx); 
	$(".results").slideUp("slow");
});

function selectSectors(sarray, sarray2, sarray3){
	for(i=0;i<=sarray.length;i++){
		$('#sector [value="'+sarray[i]+'"]').attr('selected',true).change();
	}
	setTimeout(function(){
		for(i=0;i<=sarray2.length;i++){
			$('#subsector [value="'+sarray2[i]+'"]').attr('selected',true).change();
		}
	},1500);

	setTimeout(function(){
		for(i=0;i<=sarray3.length;i++){
			$('#products [value="'+sarray3[i]+'"]').attr('selected',true).change();
		}
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