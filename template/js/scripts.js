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

	window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
	d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
	_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
	$.src="//v2.zopim.com/?33nOoVc1ieuSTySRcVQAGgbuM6NmZSC6";z.t=+new Date;$.
	type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
	$zopim(function(){
		$zopim.livechat.setOnStatus(bubble);

		function bubble(status){
			if(status=='online')
			{
				$("#chatstatus").html("Online");
			}
			else if(status=='away')
			{
				$("#chatstatus").html("Away");
			}
			else if(status=='offline')
			{
				$("#chatstatus").html("Offline");
			}

		}
	});

	$(".searchinput").keyup(function (e) {
	    if (e.keyCode == 13) {
	    	$("#searchinput").click();
	    }
	});

	$("#clinetEmail").keyup(function (e) {
	    if (e.keyCode == 13) {
	    	$("#subsc").click();
	    }
	});

	$(document).on("click","#subsc",function(){
		var clinetEmail = $("#clinetEmail").val();
		var hostname = window.location.hostname;
		var postemail = "http://"+hostname+"/insertemail"; 
		if(validateEmail(clinetEmail)){
			$("#clinetEmail").css({"color":"white"});
			$.post(postemail, {email:clinetEmail}, function(data){
				if(data==1){
					$("#clinetEmail").css({"color":"green"});
					$("#clinetEmail").val(" :) ");
				}else{
					$("#clinetEmail").css({"color":"red"});
					$("#clinetEmail").val(" :( ");
				}
			})
		}else{
			$("#clinetEmail").css({"color":"#ff7b00"});
		}
		
	});

	$(document).on("click","#searchinput",function(){
		var prefix = $(this).data("prefix");
		var val = encodeURIComponent($(".searchinput").val());
	  	location.href = prefix+val;
	});

});

function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
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
		  query_string[pair[0]].push(pair[1]);
		}
	} 
	return query_string;		
}
 