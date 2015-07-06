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

	if(checkEmpty(companytype1,"#companytype1") && checkEmpty(emailaddress1,"#emailaddress1") && checkEmpty(password1,"#password1") && checkEmpty(repeatpassword1,"#repeatpassword1")){
		if(validateEmail(emailaddress1)){
			$("#emailaddress1").css({"border":"solid 1px #3895ce"}); 
			if(password1!=repeatpassword1){
				$("#password1").css({"border":"solid red 1px"}); 
				$("#repeatpassword1").css({"border":"solid red 1px"}); 
			}else{
				$("#password1").css({"border":"solid #3895ce 1px"}); 
				$("#repeatpassword1").css({"border":"solid #3895ce 1px"}); 

				if(agree1==2){
					alert("Please check users agreement checkbox !");
					return false; 
				}
				alert("Cool"); 
			}
		}else{
			$("#emailaddress1").css({"border":"solid red 1px"});
		}
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

	if(checkEmpty(registeras2,"#registeras2") && checkEmpty(emailaddress2,"#emailaddress2") && checkEmpty(password2,"#password2") && checkEmpty(repeatpassword2,"#repeatpassword2")){
		if(validateEmail(emailaddress2)){
			$("#emailaddress2").css({"border":"solid 1px #3895ce"}); 
			if(password2!=repeatpassword2){
				$("#password2").css({"border":"solid red 1px"}); 
				$("#repeatpassword2").css({"border":"solid red 1px"}); 
			}else{
				$("#password2").css({"border":"solid #3895ce 1px"}); 
				$("#repeatpassword2").css({"border":"solid #3895ce 1px"}); 

				if(agree2==2){
					alert("Please check users agreement checkbox !");
					return false; 
				}
				alert("Cool"); 
			}
		}else{
			$("#emailaddress2").css({"border":"solid red 1px"});
		}
	}
});

$(document).on("click","#login_user",function(e){
	var emailaddress3 = $("#emailaddress3").val();
	var password3 = $("#password3").val();
	if(checkEmpty(emailaddress3,"#emailaddress3") && checkEmpty(password3,"#password3")){
		if(validateEmail(emailaddress3)){
			$("#emailaddress3").css({"border":"solid 1px #3895ce"}); 
			alert("Cool"); 
		}else{
			$("#emailaddress3").css({"border":"solid 1px red"});
		}
	}
});

function checkEmpty(v,id){
	if(v==""){
		$(id).css({"border":"solid 1px red"}); 
		return false;
	}else{
		$(id).css({"border":"solid #3895ce 1px"});
	}
	return true;
}

function validateEmail(email) {
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(email);
}