<!-- <!DOCTYPE html>
<html>
<head>
<style>
div#video_player_box{ width:550px; background:#000; margin:0px auto;}
div#video_controls_bar{ background: #333; padding:10px; color:#CCC; font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;}
button#playpausebtn{
	background:url(pause.png);
	border:none;
	width:16px;
	height:18px;
	cursor:pointer;
	opacity:0.5;
}
button#playpausebtn:hover{ opacity:1; }
input#seekslider{ width:180px; }
input#volumeslider{ width: 80px;}
input[type='range'] {
    -webkit-appearance: none !important;
    background: #000;
	border:#666 1px solid;
    height:4px;
}
input[type='range']::-webkit-slider-thumb {
    -webkit-appearance: none !important;
    background: #FFF;
    height:15px;
    width:15px;
	border-radius:100%;
	cursor:pointer;
}
</style>
<script>
var vid, playbtn, seekslider, curtimetext, durtimetext, mutebtn, volumeslider, fullscreenbtn;
function intializePlayer(){
	// Set object references
	vid = document.getElementById("my_video");
	playbtn = document.getElementById("playpausebtn");
	seekslider = document.getElementById("seekslider");
	curtimetext = document.getElementById("curtimetext");
	durtimetext = document.getElementById("durtimetext");
	mutebtn = document.getElementById("mutebtn");
	volumeslider = document.getElementById("volumeslider");
	fullscreenbtn = document.getElementById("fullscreenbtn");
	// Add event listeners
	playbtn.addEventListener("click",playPause,false);
	seekslider.addEventListener("change",vidSeek,false);
	vid.addEventListener("timeupdate",seektimeupdate,false);
	mutebtn.addEventListener("click",vidmute,false);
	volumeslider.addEventListener("change",setvolume,false);
	fullscreenbtn.addEventListener("click",toggleFullScreen,false);
}
window.onload = intializePlayer;
function playPause(){
	if(vid.paused){
		vid.play();
		playbtn.style.background = "url(pause.png)";
	} else {
		vid.pause();
		playbtn.style.background = "url(play.png)";
	}
}
function vidSeek(){
	var seekto = vid.duration * (seekslider.value / 100);
	vid.currentTime = seekto;
}
function seektimeupdate(){
	var nt = vid.currentTime * (100 / vid.duration);
	seekslider.value = nt;
	var curmins = Math.floor(vid.currentTime / 60);
	var cursecs = Math.floor(vid.currentTime - curmins * 60);
	var durmins = Math.floor(vid.duration / 60);
	var dursecs = Math.floor(vid.duration - durmins * 60);
	if(cursecs < 10){ cursecs = "0"+cursecs; }
	if(dursecs < 10){ dursecs = "0"+dursecs; }
	if(curmins < 10){ curmins = "0"+curmins; }
	if(durmins < 10){ durmins = "0"+durmins; }
	curtimetext.innerHTML = curmins+":"+cursecs;
	durtimetext.innerHTML = durmins+":"+dursecs;
}
function vidmute(){
	if(vid.muted){
		vid.muted = false;
		mutebtn.innerHTML = "Mute";
	} else {
		vid.muted = true;
		mutebtn.innerHTML = "Unmute";
	}
}
function setvolume(){
	vid.volume = volumeslider.value / 100;
}
function toggleFullScreen(){
	if(vid.requestFullScreen){
		vid.requestFullScreen();
	} else if(vid.webkitRequestFullScreen){
		vid.webkitRequestFullScreen();
	} else if(vid.mozRequestFullScreen){
		vid.mozRequestFullScreen();
	}
}
</script>
</head>
<body>

<iframe width="560" height="315" src="https://www.youtube.com/embed/U8vvl5dA4vk" frameborder="0" allowfullscreen></iframe>

<div id="video_player_box">

  <div id="video_controls_bar">
    <button id="playpausebtn"></button>
    <input id="seekslider" type="range" min="0" max="100" value="0" step="1">
    <span id="curtimetext">00:00</span> / <span id="durtimetext">00:00</span>
    <button id="mutebtn">Mute</button>
    <input id="volumeslider" type="range" min="0" max="100" value="100" step="1">
    <button id="fullscreenbtn">[ &nbsp; ]</button>
  </div>
</div>
</body>
</html> -->