$(document).ready(function(){

	$(".searchButton").click(function(){
		
		var term = $(".searchTerm").val();
		var url = document.URL;
		var spl = url.split("&search");
		var afterQuestionMark = spl[0].split("?");
		location.href="?"+afterQuestionMark[1]+"&search="+term;
		
	});

	$(".dropdown-select").change(function(){
		var u = window.location.href;
		var splited = u.split("/");		 
		var find = "/"+splited[3]+"/";
		if(splited[3]){
			var replace = "/"+$(this).val()+"/";
			var new_url = u.replace(find,replace);
			var old_token = new_url.split("token=");

			$.get("/_ajax/token.php?get_token=1",function(data){
				var tokened_url = new_url.replace(old_token[1],data);
				location.href = tokened_url;
			});
		}
	});

	$(document).on("click", ".removeInfo", function(e){
		e.stopPropagation();
		e.preventDefault();
		var r = confirm("Would you like to remove item ?"); 
		if(r==true){
			var id = $('.hiddenVal', $(this).parent()).val();
			$(".moreinfo-add-list").find("[data-id='" + id + "']").fadeIn("slow");
			$(this).parent(".info-list").remove();
		}
	});

	setInterval(function(){ getDate('#widget')},1000 );
});

$(document).on("click",".logasuser-administrator",function(result){
	var userid = $(this).data("userid");
	var usertype = $(this).data("usertype");
	var username = $(this).data("username");
	var namelname = $(this).data("namelname");
	$.post("http://"+document.domain+"/en/ajax", { logAsAdministrator:true, uid:userid, ut:usertype, un:username, nln:namelname  },function(result){
		if(result=="Done"){
			if(usertype=="serviceprovider"){
				var url = "http://"+document.domain+"/en/profile-service";
			}else{
				var url = "http://"+document.domain+"/en/profile-products";
			}
   			window.open(url , '_blank');
		}
	});
});

$(document).on("click",".SearchTooManyData",function(){
	var searchTerm = $(".searchTerm").val(); 
	var token = $(this).attr("data-token");
	var params = urlParamiters();
	$(".lev-1").remove();
	$(".TooManyDataElement").html("<div class=\"row\"><span class=\"cell\">Please wait...</span></div>");
	$.post("http://"+document.domain+"/en/ajax", { searchTooManyData:true, s:searchTerm, super:params['super']  },function(result){
		console.log(result);
		if(result=="Empty"){
			$(".TooManyDataElement").html("<div class=\"row\"><span class=\"cell\">There is no such data !</span></div>");
		}else{
			var obj = JSON.parse(result);
			var out = '';
			for(var i = 0; i < obj.length; i++){
				out += '<div class="row lev-1" style="background-color:#ffffff">';
				out += '<span class="cell primary">Hidden</span>';
				out += '<span class="cell">Hidden</span>';
				out += '<span class="cell">'+obj[i].title+'</span>';
				out += '<span class="cell">Hidden</span>';
				out += '<span class="cell">'+obj[i].idx+'</span>';
				out += '<span class="cell">';
				out += '<a href="?action=editSitemap&amp;super='+obj[i].cid+'&amp;id='+obj[i].idx+'&amp;token='+token+'" title="Edit page"><i class="fa fa-pencil-square-o"></i></a>';
				out += '</span>';
				out += '</div>';
			}
			$(".TooManyDataElement").hide();
			$("#table").append(out);
		}
	});
});


function askBeforeDelete(type,idx) {
	var x = confirm("Would you like to delete item?");
	if(type=="photo" && x==true){
		removeFile2(idx);
	}else if(type=="video" && x==true){
		removeFile3(idx);
	}else if(type=="file" && x==true){
    	removeFile(idx);
    }
}

function hideMe(e){
	$(e).fadeOut("slow");
}

function openPromt(maxidx){
	var inputid = $(".n-"+maxidx).attr("id"); 
	var selectInput = $("#"+inputid).html();
	var newFileNmae = prompt("Please enter file name", selectInput);
    var fileid = inputid.split("fid-");

    if (newFileNmae != null) {
    	$.get("/en/ajaxupload",{ id:fileid[1], filename:newFileNmae },function(data){
        	$(".n-"+maxidx).html(newFileNmae);
    	});        
    }
}

function openPromt2(maxidx){
	var inputid = $(".n2-"+maxidx).attr("id"); 
	var selectInput = $("#"+inputid).html(); 
	var newFileNmae = prompt("Please enter file name", selectInput);
    var fileid = inputid.split("fid2-");

    if (newFileNmae != null) {
    	$.get("/en/ajaxupload",{ id:fileid[1], filename:newFileNmae, photoedittitle:"true" },function(data){
        	$(".n2-"+maxidx).html(newFileNmae);
    	});        
    }
}

function removeFile(maxidx){
	$("#flexbox-"+maxidx).fadeOut("slow").remove();
	var send_idx_array = new Array();
	$("main .center .content .dropArea .dragElements .filebox").each(function(index){
		var get_id = $(this).attr("id");
		var idx = get_id.split("flexbox-");
		if(idx[1]!=maxidx){
			send_idx_array.push(idx[1]); 
		}
	}); 
	if(send_idx_array==""){ send_idx_array=maxidx; }
	$.get("/en/ajaxupload",{ idx:maxidx, idxes2:send_idx_array }, function(data){
		console.log(data);
	});
}

function removeFile2(maxidx){
	$("#flexbox2-"+maxidx).fadeOut("slow").remove();
	var send_idx_array = new Array();
	$("main .center .content .dropArea2 .dragElements2 .filebox2").each(function(index){
		var get_id = $(this).attr("id");
		var idx = get_id.split("flexbox2-");
		if(idx[1]!=maxidx){
			send_idx_array.push(idx[1]); 
		}
	}); 
	if(send_idx_array==""){ send_idx_array=maxidx; }
	$.get("/en/ajaxupload",{ idx:maxidx, idxes3:send_idx_array }, function(data){
		console.log(data);
	});
}

function removeFile3(maxidx){
	$("#flexbox2-"+maxidx).fadeOut("slow").remove();
	var send_idx_array = "empty";

	$("main .center .content .dropArea2 .dragElements2 .filebox2").each(function(index){
		var get_id = $(this).attr("id");
		var idx = get_id.split("flexbox2-");
		send_idx_array = new Array();
		if(idx[1]!=maxidx){
			send_idx_array.push(idx[1]); 
		}
	}); 
	if(send_idx_array=="" || send_idx_array=="empty"){ send_idx_array=maxidx; }
	$.get("/en/ajaxupload",{ idx:maxidx, idxes3:send_idx_array, media_type:"video" }, function(data){
		console.log(data);
	});
}


function deleteComfirm(goto) {
    if (confirm("Would you like to delete item?") == true) {
        location.href=goto;
    }
}
function redirect(target,url){
	if(target=="_self"){
		location.href=url;
	}else{
		 window.open(url,'_blank');
	}
}
var executed = false;
var session_timer = 35; 
function getDate(x)
{
	var date = new Date();
	var hour = date.getHours();
	var min = date.getMinutes();
	var secs = date.getSeconds();
	//var all = leftPad(hour, 2)+":"+leftPad(min, 2)+":"+leftPad(secs, 2);
	if(!executed){
		executed = true;
		xhr = new XMLHttpRequest();
		xhr.open('post','/en/session_timeout',true);
		xhr.send();
		xhr.onreadystatechange = function(e){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					var res = xhr.responseText;
					session_timer = res;
				}
			}
		}
	}
	session_timer--;
	var hours = Math.floor( session_timer / 60);          
    var minutes = session_timer % 60;
    var session_time_to_hour = hours+":"+minutes;
    if(session_timer<=0){ location.reload(); }
	else if(session_timer<=30){ $("title").html(session_time_to_hour); }
	var all = '<div class="time-text"><span class="time-number" style="float:right; color:RED"> ~ STO: '+session_time_to_hour+'</span><span class="time-number">'+leftPad(secs, 2)+'</span><span class="time-caption">Sec</span></div><span class="time-separator">:</span><div class="time-text"><span class="time-number">'+leftPad(min, 2)+'</span><span class="time-caption">Min</span></div><span class="time-separator">:</span><div class="time-text"><span class="time-number">'+leftPad(hour, 2)+'</span><span class="time-caption">Hour</span></div>';
	$(x).html(all);
}

function leftPad(number, targetLength) {
	var output = number + '';
	while (output.length < targetLength) {
		output = '0' + output;
	}
	return output;
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

function copyMe(e){ 
	SelectText(e); 
	window.getSelection(); 
	try {  
	var successful = document.execCommand('copy');  
	var msg = successful ? 'successful' : 'unsuccessful';  
	alert('Copy email command was ' + msg);  
	} catch(err) {  
		alert("ops !");  
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