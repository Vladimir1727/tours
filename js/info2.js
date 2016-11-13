(function($){$(function(){

$('#gallery').gallery({
count: 1,
title: false,
color: 'light',
scroll: 'auto',
lightbox: false
})

var smax=screen.width;
var bmax=1440;
	
$('body').mousemove(function(event){
var e=event;
var x=(-e.screenX/bmax*(bmax-smax))+"px";
$('body').css("background-position-x",x);
});

$('#rew').click(function(){
	$('.panel').toggle();
	return false;
})

})})(jQuery)