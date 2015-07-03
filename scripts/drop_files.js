function upload_filev(idx){
	var hidden_input = $('#bgfile'); 
	var this_box = $("#flexbox2-"+idx);
	hidden_input.click();

	hidden_input.on('change',function(e){
		e.stopPropagation();
		e.preventDefault();
		var files = e.target.files;
		this_box.css({"border":"solid 1px red"});
		if(files.length<2){
		var file = files[0];
		var fileName = file.name;
		var ex = fileName.split(".");
		var extLast = ex[ex.length - 1].toLowerCase();
		var par = urlParamiters();

		var rforeign = /[^\u0000-\u007f]/;
		if (rforeign.test(fileName)) {
		  alert("File name error !");
		  return false;
		}

		// if(par['newsidx']){ var newsidx = par['newsidx']; }
		// else if(par['cidx']){ var newsidx = par['cidx']; }
		// else{ var newsidx = "false"; }

		xhr = new XMLHttpRequest();
		// initiate request
		xhr.open('post','/en/ajaxupload?extention='+extLast+'&videoimage='+idx+'&token='+par['token'],true);
		//set header
		xhr.setRequestHeader('Content-Type','multipart/form-data');
		xhr.setRequestHeader('X-File-Name',file.name);
		xhr.setRequestHeader('X-File-Size',file.size);
		xhr.setRequestHeader('X-File-Type',file.type);
		
			if(extLast!="jpeg" && extLast!="jpg" && extLast!="png" && extLast!="gif"){
				alert("Please drop jpeg,jpg,png or gif file !");
			}else{
				//send file
				xhr.send(file);

				// xhr.upload.addEventListener("progress",function(e){
				// 	var progress = (e.loaded / e.total) * 100;
				// 	$('#progress').html(Math.floor(progress)+'%'); 
				// },true);

				xhr.onreadystatechange = function(e){
					if(xhr.readyState == 4){
						if(xhr.status == 200){
							var res = xhr.responseText;
							if(res!="error"){  
								this_box.css({"border":"none"});
								$("#flexbox2-"+idx+" .extention2").html('<img src="/'+res+'" width="100%" />');
							}else{
								alert("Something went wrong !");
							}
						}
					}
				}
			}
		}else{
			alert("Multiple files not allowed!"); 
		}
	});

	//alert("hey ! "+idx);  #flexbox2-"+idx+" 
}















$(function(){
	var f_obj = $(".dropArea");
	var click_area = $(".dropArea .Droptitle");
	var hidden_input = $('#bgfile2');

	click_area.on('click', function(e){
		hidden_input.click();
	});

	click_area.on('mouseenter', function(e){
		$(this).html("Click To Choose File !");
	});

	click_area.on('mouseleave', function(e){
		$(this).html("Drag and drop file (pdf,doc,docx,xls,xlsx,zip,rar) <span id=\"progress\">0%</span>");
	});

	hidden_input.on('change',function(e){
		e.stopPropagation();
		e.preventDefault();
		$(this).css({"border":"none"});
		var files = e.target.files;
		$('#progress').html('1%...');
		if(files.length<2){
			upload_file(files[0]);
		}else{
			alert("Multiple files not allowed!"); 
		}
	});


	f_obj.on('dragover', function(e){
		e.stopPropagation();
		e.preventDefault();
		$(this).css({"border":"solid 1px #ef4836"});
	});

	f_obj.on('dragleave', function(e){
		e.stopPropagation();
		e.preventDefault();
		$(this).css({"border":"none"});
	});


	f_obj.on('drop', function(e){
		e.stopPropagation();
		e.preventDefault();
		$(this).css({"border":"none"});
		$('#progress').html('1%...');
		var files = e.originalEvent.dataTransfer.files; 
		if(files.length<2){
			upload_file(files[0]);
		}else{
			alert("Multiple files not allowed!"); 
		}
	});

	function upload_file(file){
		var fileName = file.name;
		var ex = fileName.split(".");
		var extLast = ex[ex.length - 1].toLowerCase();
		var par = urlParamiters();

		var rforeign = /[^\u0000-\u007f]/;
		if (rforeign.test(fileName)) {
		  alert("File name error !");
		  return false;
		}

		if(par['newsidx']){ var newsidx = par['newsidx']; }
		else if(par['cidx']){ var newsidx = par['cidx']; }
		else{ var newsidx = "false"; }
		xhr = new XMLHttpRequest();
		// initiate request
		xhr.open('post','/en/ajaxupload?extention='+extLast+'&pageidx='+par['id']+"&newsidx="+newsidx+"&token="+par['token'],true);
		//set header
		xhr.setRequestHeader('Content-Type','multipart/form-data');
		xhr.setRequestHeader('X-File-Name',file.name);
		xhr.setRequestHeader('X-File-Size',file.size);
		xhr.setRequestHeader('X-File-Type',file.type);
		
		if(extLast!="doc" && extLast!="docx" && extLast!="xls" && extLast!="xlsx" && extLast!="zip" && extLast!="rar" && extLast!="pdf"){
			alert("Please drop doc, docx,xls,xlsx,zip,pdf or rar file !");
		}else{
			//send file
			xhr.send(file);

			xhr.upload.addEventListener("progress",function(e){
				var progress = (e.loaded / e.total) * 100;
				$('#progress').html(Math.floor(progress)+'%'); 
			},true);

			xhr.onreadystatechange = function(e){
				if(xhr.readyState == 4){
					if(xhr.status == 200){
						var res = xhr.responseText;
						if(res!="error"){  
							$('#progress').html('100%'); 
							$(".dragElements").append(res);
						}else{
							alert("Something went wrong !");
						}
					}
				}
			}
		}
	}

/////////////////////////////////////// photo upload 
var f_obj2 = $(".dropArea2");

	var hidden_input2 = $('#bgfile3');
	var click_area2 = $(".dropArea2 .Droptitle2");

	click_area2.on('click', function(e){
		hidden_input2.click();
	});

	click_area2.on('mouseenter', function(e){
		$(this).html("Click To Choose File !");
	});

	click_area2.on('mouseleave', function(e){
		$(this).html("Drag and drop photo (jpeg,jpg,gif,png) <span id=\"progress2\">0%</span>");
	});

	hidden_input2.on('change',function(e){
		e.stopPropagation();
		e.preventDefault();
		$(this).css({"border":"none"});
		var files2 = e.target.files;

		$('#progress2').html('1%...');
		if(files2.length<2){
			upload_file2(files2[0]);
		}else{
			alert("Multiple files not allowed!"); 
		}
	});

	f_obj2.on('dragover', function(e){
		e.stopPropagation();
		e.preventDefault();
		$(this).css({"border":"solid 1px #ef4836"});
	});

	f_obj2.on('dragleave', function(e){
		e.stopPropagation();
		e.preventDefault();
		$(this).css({"border":"none"});
	});


	f_obj2.on('drop', function(e){
		e.stopPropagation();
		e.preventDefault();
		$(this).css({"border":"none"});
		$('#progress2').html('1%...');

		var files2 = e.originalEvent.dataTransfer.files; 
		if(files2.length<2){
			upload_file2(files2[0]);
		}else{
			alert("Multiple files not allowed!"); 
		}
	});

	function upload_file2(file){
		var fileName = file.name;
		var ex = fileName.split(".");
		var extLast = ex[ex.length - 1].toLowerCase();
		var par = urlParamiters();

		var rforeign = /[^\u0000-\u007f]/;
		if (rforeign.test(fileName)) {
		  alert("File name error !");
		  return false;
		}
		var media="false";
		xhr = new XMLHttpRequest();
		if(par['newsidx']){ var newsidx = par['newsidx']; }
		else if(par['cidx']){ var newsidx = par['cidx']; }
		else if(par['midx']){ var newsidx = par['midx']; }
		else{ var newsidx = "false"; }

		if(par["type"]!="videogallerypage"){ media="true"; }
		// initiate request
		xhr.open('post','/en/ajaxupload?extention='+extLast+'&pageidx='+par['id']+"&newsidx="+newsidx+"&media="+media+"&token="+par['token'],true);
		//set header
		xhr.setRequestHeader('Content-Type','multipart/form-data');
		xhr.setRequestHeader('X-File-Name',file.name);
		xhr.setRequestHeader('X-File-Size',file.size);
		xhr.setRequestHeader('X-File-Type',file.type);
		
		if(extLast!="jpeg" && extLast!="jpg" && extLast!="png" && extLast!="gif" && media!="false"){
			alert("Please drop jpeg, jpg, gif or png file !");
		}else if(media=="false" && par["type"]=="videogallerypage" && extLast!="mp4" && extLast!="avi"){
			alert("Please drop mp4 or avi file !");
		}else{
			//send file
			xhr.send(file);

			xhr.upload.addEventListener("progress",function(e){
				var progress = (e.loaded / e.total) * 100;
				$('#progress2').html(Math.floor(progress)+'%'); 
			},true);

			xhr.onreadystatechange = function(e){
				if(xhr.readyState == 4){
					if(xhr.status == 200){
						var res = xhr.responseText;
						if(res!="error"){  
							$('#progress2').html('100%'); 
							$(".dragElements2").append(res);
						}else{
							alert("Something went wrong !");
						}
					}
				}
			}
		}
	}



});