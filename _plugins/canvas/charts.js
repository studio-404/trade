var p = new Array();
var np = new Array();
var c = new Array();
var r = new Array();

np[0] = 0.1; 
np[1] = 0.2; 
np[2] = 0.3; 
np[3] = 0.1; 
np[4] = 0.4; 

p[0] = 0.01; 
p[1] = 0.02; 
p[2] = 0.03; 
p[3] = 0.01; 
p[4] = 0.04; 

c[0] = '#3d90c4';
c[1] = '#1279bb';
c[2] = '#68a6cd';
c[3] = '#94bed7';
c[4] = '#c0d3e1';

r[0] = '20';
r[1] = '150';
r[2] = 'Bevareges';

r[3] = '150';
r[4] = '150';
r[5] = 'Cars';

r[6] = '280';
r[7] = '150';
r[8] = 'Nothing';

r[9] = '20';
r[10] = '180';
r[11] = 'TextTitle';

r[12] = '150';
r[13] = '180';
r[14] = 'Something';

renderChart(40,21,65,90,p,np,c,r,"2012");
renderChart(40,21,185,90,p,np,c,r,"2013");
renderChart(40,21,305,90,p,np,c,r,"2014");

function renderChart(rectSize,strokeWidth,startFrom,endTo,p,np,c,r,innerText){
	var canvas = document.getElementById("Newcanvas");
	var ctx = canvas.getContext("2d");
	ctx.save();
	ctx.font="22px Roboto";
	ctx.fillStyle="#555555";
	ctx.fillText("Bussiness in Georgia",10,25);
	var percentage = new Array();
	var degrees = new Array();
	var radians = new Array();
	percentage[0] = p[0]; // no specific length
	degrees[0] = percentage[0] * 360.0;
	radians[0] = degrees[0] * (Math.PI / 180);

	percentage[1] = p[1]; // no specific length
	degrees[1] = percentage[1] * 360.0;
	radians[1] = (degrees[1] * (Math.PI / 180)) + radians[0];

	percentage[2] = p[2]; // no specific length
	degrees[2] = percentage[2] * 360.0;
	radians[2] = (degrees[2] * (Math.PI / 180)) + (degrees[0] * (Math.PI / 180)) + (degrees[1] * (Math.PI / 180));

	percentage[3] = p[3]; // no specific length
	degrees[3] = percentage[3] * 360.0;
	radians[3] = (degrees[3] * (Math.PI / 180)) + (degrees[0] * (Math.PI / 180)) + (degrees[1] * (Math.PI / 180)) + (degrees[2] * (Math.PI / 180)); 

	percentage[4] = p[4]; // no specific length
	degrees[4] = percentage[4] * 360.0;
	radians[4] = (degrees[4] * (Math.PI / 180)) + (degrees[0] * (Math.PI / 180)) + (degrees[1] * (Math.PI / 180)) + (degrees[2] * (Math.PI / 180)) + (degrees[3] * (Math.PI / 180));


	ctx.font="16px Roboto";
	ctx.fillStyle="#555555";
	ctx.fillText(innerText,startFrom -18,endTo + 8);
	
	
	
	// little boxes with text
	ctx.fillStyle = c[0];
	ctx.beginPath();
	ctx.rect(r[0], r[1], 15, 15);
	ctx.closePath();
	ctx.fill();
	ctx.font="14px Roboto";
	ctx.fillStyle = '#686868';
	ctx.beginPath();
	ctx.fillText(r[2],(parseInt(r[0])+20),(parseInt(r[1])+12));
	ctx.closePath();
	
	ctx.fillStyle = c[1];
	ctx.beginPath();
	ctx.rect(r[3], r[4], 15, 15);
	ctx.closePath();
	ctx.fill();
	ctx.font="14px Roboto";
	ctx.fillStyle = '#686868';
	ctx.beginPath();
	ctx.fillText(r[5],(parseInt(r[3])+20),(parseInt(r[4])+12));
	ctx.closePath();
	
	
	
	ctx.fillStyle = c[2];
	ctx.beginPath();
	ctx.rect(r[6], r[7], 15, 15);
	ctx.closePath();
	ctx.fill();
	ctx.font="14px Roboto";
	ctx.fillStyle = '#686868';
	ctx.beginPath();
	ctx.fillText(r[8],(parseInt(r[6])+20),(parseInt(r[7])+12));
	ctx.closePath();
	
	
	ctx.fillStyle = c[3];
	ctx.beginPath();
	ctx.rect(r[9], r[10], 15, 15);
	ctx.closePath();
	ctx.fill();
	ctx.font="14px Roboto";
	ctx.fillStyle = '#686868';
	ctx.beginPath();
	ctx.fillText(r[11],(parseInt(r[9])+20),(parseInt(r[10])+12));
	ctx.closePath();
	
	
	ctx.fillStyle = c[4];
	ctx.beginPath();
	ctx.rect(r[12], r[13], 15, 15);
	ctx.closePath();
	ctx.fill();
	ctx.font="14px Roboto";
	ctx.fillStyle = '#686868';
	ctx.beginPath();
	ctx.fillText(r[14],(parseInt(r[12])+20),(parseInt(r[13])+12));
	ctx.closePath();
	
	
	ctx.restore();

	ctx.font="22px Roboto";
	ctx.fillStyle="#555555";
	ctx.fillText("Bussiness in Georgia",10,25);
	
	ctx.font="16px Roboto";
	ctx.fillStyle="#555555";
	ctx.fillText(innerText,startFrom -18,endTo + 8);

	ctx.font="14px Roboto";
	ctx.fillStyle = '#686868';
	ctx.beginPath();
	ctx.fillText(r[2],(parseInt(r[0])+20),(parseInt(r[1])+12));
	ctx.closePath();

	ctx.font="14px Roboto";
	ctx.fillStyle = '#686868';
	ctx.beginPath();
	ctx.fillText(r[5],(parseInt(r[3])+20),(parseInt(r[4])+12));
	ctx.closePath();

	ctx.font="14px Roboto";
	ctx.fillStyle = '#686868';
	ctx.beginPath();
	ctx.fillText(r[8],(parseInt(r[6])+20),(parseInt(r[7])+12));
	ctx.closePath();
	
	ctx.font="14px Roboto";
	ctx.fillStyle = '#686868';
	ctx.beginPath();
	ctx.fillText(r[11],(parseInt(r[9])+20),(parseInt(r[10])+12));
	ctx.closePath();
	
	ctx.font="14px Roboto";
	ctx.fillStyle = '#686868';
	ctx.beginPath();
	ctx.fillText(r[14],(parseInt(r[12])+20),(parseInt(r[13])+12));
	ctx.closePath();

	var i = 1;                     //  set your counter to 1

	function myLoop () {           //  create a loop function
	   setTimeout(function () {    //  call a 3s setTimeout when the loop is called
	      redraw(canvas,ctx,rectSize,strokeWidth,startFrom,endTo,p,np,c,r,innerText,i);         //  your code here
	      i++;                     //  increment the counter
	      if (i < 7) {            //  if the counter < 10, call the loop function
	         myLoop();             //  ..  again which will trigger another 
	      }                        //  ..  setTimeout()
	   }, 200);
	}

	myLoop(); 

}

function redraw(canvas,ctx,rectSize,strokeWidth,startFrom,endTo,p,np,c,r,innerText,i){
	// console.log(i);
	// if(i>=6){
	// 	ctx.clearRect(strokeWidth,endTo,0,0); 
	// }
	if(p[0]<=np[0]){
		p[0]= p[0]+=0.02;
	}
	if(p[1]<=np[1]){
		p[1]= p[1]+=0.02;
	}
	if(p[2]<=np[2]){
		p[2]= p[2]+=0.02;
	}
	if(p[3]<=np[3]){
		p[3]= p[3]+=0.02;
	}
	if(p[4]<=np[4]){
		p[4]= p[4]+=0.02;
	}
	ctx.save();
	
	var percentage = new Array();
	var degrees = new Array();
	var radians = new Array();
	percentage[0] = p[0]; // no specific length
	degrees[0] = percentage[0] * 360.0;
	radians[0] = degrees[0] * (Math.PI / 180);

	percentage[1] = p[1]; // no specific length
	degrees[1] = percentage[1] * 360.0;
	radians[1] = (degrees[1] * (Math.PI / 180)) + radians[0];

	percentage[2] = p[2]; // no specific length
	degrees[2] = percentage[2] * 360.0;
	radians[2] = (degrees[2] * (Math.PI / 180)) + (degrees[0] * (Math.PI / 180)) + (degrees[1] * (Math.PI / 180));

	percentage[3] = p[3]; // no specific length
	degrees[3] = percentage[3] * 360.0;
	radians[3] = (degrees[3] * (Math.PI / 180)) + (degrees[0] * (Math.PI / 180)) + (degrees[1] * (Math.PI / 180)) + (degrees[2] * (Math.PI / 180)); 

	percentage[4] = p[4]; // no specific length
	degrees[4] = percentage[4] * 360.0;
	radians[4] = (degrees[4] * (Math.PI / 180)) + (degrees[0] * (Math.PI / 180)) + (degrees[1] * (Math.PI / 180)) + (degrees[2] * (Math.PI / 180)) + (degrees[3] * (Math.PI / 180));


	
	
	
	
	// little boxes with text
	ctx.fillStyle = c[0];
	ctx.beginPath();
	ctx.rect(r[0], r[1], 15, 15);
	ctx.closePath();
	ctx.fill();
	
	
	
	
	ctx.fillStyle = c[1];
	ctx.beginPath();
	ctx.rect(r[3], r[4], 15, 15);
	ctx.closePath();
	ctx.fill();
	
	
	
	
	ctx.fillStyle = c[2];
	ctx.beginPath();
	ctx.rect(r[6], r[7], 15, 15);
	ctx.closePath();
	ctx.fill();

	
	
	
	ctx.fillStyle = c[3];
	ctx.beginPath();
	ctx.rect(r[9], r[10], 15, 15);
	ctx.closePath();
	ctx.fill();



	
	
	ctx.fillStyle = c[4];
	ctx.beginPath();
	ctx.rect(r[12], r[13], 15, 15);
	ctx.closePath();
	ctx.fill();
	
	
	ctx.beginPath();
	ctx.strokeStyle = c[4];
	ctx.lineWidth = strokeWidth; 
	ctx.arc(startFrom,endTo,rectSize,0,radians[4],false); 
	ctx.stroke();
	ctx.closePath();

	ctx.beginPath();
	ctx.strokeStyle = c[3];
	ctx.lineWidth = strokeWidth; 
	ctx.arc(startFrom,endTo,rectSize,0,radians[3],false); 
	ctx.stroke();
	ctx.closePath();

	ctx.beginPath();
	ctx.strokeStyle = c[2];
	ctx.lineWidth = strokeWidth; 
	ctx.arc(startFrom,endTo,rectSize,0,radians[2],false); 
	ctx.stroke();
	ctx.closePath();

	ctx.beginPath();
	ctx.strokeStyle = c[1];
	ctx.lineWidth = strokeWidth; 
	ctx.arc(startFrom,endTo,rectSize,0,radians[1],false); 
	ctx.stroke();
	ctx.closePath();

	ctx.beginPath();
	ctx.strokeStyle = c[0];
	ctx.lineWidth = strokeWidth; 
	ctx.arc(startFrom,endTo,rectSize,0,radians[0],false); 
	ctx.stroke();
	ctx.closePath();
	
	ctx.restore();
}

//demensions




