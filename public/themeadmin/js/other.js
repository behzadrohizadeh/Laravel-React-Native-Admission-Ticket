$(function() {
	
	$("img").addClass("img-responsive");
	
	$('ul').find('li:has(ul)').children('a').removeAttr('href');
	
	$( ".sidebar-ul > li" ).has("ul").click(function() {
		$(this).children("ul").slideToggle();
		$(this).children("a").children("i").toggleClass("arrow-rotate");
	});
	
	$( "#overlay" ).click(function() {
		$(this).fadeOut();
		$(".sidebar").removeClass("show-menu");
	});
	
	$( ".fa-bars" ).click(function() {
		$(".sidebar").addClass("show-menu");
		$("#overlay").fadeIn();
	});
  
});