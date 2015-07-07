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
		alert("yeah");
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
		alert("yeah");
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
		alert("yeah");
	}
});

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