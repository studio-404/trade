$(document).ready(function() {insertEmailTo('<?=str_replace("@", "%*%", $data["language_data"]["emailvalue"])?>');$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {var target = $(this).attr('href');$(target).css('right','-'+$(window).width()+'px'); var left = $(target).offset().left;$(target).css({left:left}).animate({"left":"0px"}, "10");});}); function insertEmailTo(e){var x = e.replace('%*%','@'); $(".unclearemail").html(x);}$(document).ready(sizeContent); $(window).resize(sizeContent); function sizeContent() {var newHeight = ($("#container").height() - 215) + "px";$("#navbar-height-col").css("height", newHeight); } var xx = 1;$('.hone_news_slide').bxSlider({nextSelector: '#slider-next',prevSelector: '#slider-prev', autoControls: true});$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {if(xx==1){$('.hone_news_slide2').bxSlider({nextSelector: '#slider-next',prevSelector: '#slider-prev', autoControls: true});xx++;}});$(document).on("click",".ui-tabs-nav-item a",function(e){var u = $(this).data("gotourl");location.href=u;});$("#featured").tabs({event: 'mouseover'});function nextImage(){$("#featured").tabs("rotate", 1000, true);} var timeInterval;$(document).ready(function(){$("#featured").tabs({fx:{opacity: "toggle"}});timeInterval = window.setInterval(function(){nextImage()},3000);});$('#featured').hover(function() {$("#featured").tabs("rotate",0,true); window.clearInterval(timeInterval);}, function() {timeInterval = window.setInterval(function(){nextImage()},3000);});$(document).on("click",".callZopim",function(){$zopim.livechat.window.show();});