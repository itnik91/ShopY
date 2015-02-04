$(function(){
	$(".info_bulle").mouseover(function(){
		$("body").append('<span class="bulle icon-cart">Ajouter au panier</span>');
		var bulle = $(".bulle:last");
		var postTop = $(this).offset().top - 70;
		var postLeft = $(this).offset().left - 45;
		bulle.css({
			left: postLeft,
			top: postTop - 10,
			opacity: 0
		});
		bulle.animate({
			top: postTop,
			opacity: 0.99
		});
	});
	$(".info_bulle").mouseout(function(){
		var bulle = $(".bulle:last");
		bulle.animate({
			opacity: 0
		},500,"linear",
		function(){
			bulle.remove();
		});
	});

	var desc = null;
	$(".img-link").mouseover(function(){
		$(this).find("span.description").hide().stop().slideDown();
		desc = $(this);
	});
	$(".img-link").mouseout(function(){
		desc.find("span.description").fadeOut();
	});
	
});