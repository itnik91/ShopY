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

	$(".inscription").click(function(){
		pass1 = $("input[name=pass]").val();
		pass2 = $("input[name=pass2]").val();
		if(pass1!=pass2){
			$("#confirm_pass").append("   Les mots de passe ne correspondent pas.");
			return false;
		}
	});
	$(".modifierpass").click(function(){
		pass1 = $("input[name=pass1]").val();
		pass2 = $("input[name=pass2]").val();
		if(pass1!=pass2){
			$("#confirm_pass").append("   Les mots de passe ne correspondent pas.");
			return false;
		}
	});
	$(".modifierMail").click(function(){
		mail1 = $("input[name=email1]").val();
		mail2 = $("input[name=email2]").val();
		if(mail1!=mail2){
			$("#confirm_mail").append("   Les adresses mail ne correspondent pas.");
			return false;
		}
	});

	$(".tabs").each(function(){
		var current = null;
		current = $(this).find("a:first").attr("href");
		$(this).find('a[href="'+current+'"]').addClass("active");
		$(current).siblings().hide();
		$(this).find("a").click(function(){
			var link = $(this).attr("href");
			if(link == current){
				return false;
			}else{
				$(this).siblings().removeClass("active");
				$(this).addClass("active");
				$(link).show().siblings().hide();
				current = link;
			}
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

	// $("#filtre").keyup(function(event){
	// 	var input = $(this);
	// 	var val = input.val();
	// 	var regepx = '\\b(.*)(a)(.*)(s)(.*)\\b';
	// 	$("#filter").find("a").each(function(){
	// 		var a = $(this);
	// 		var result = a.text().match(new RegExp(regepx, 'i'));
	// 		if(result){
	// 			var string = "";
	// 			for (var i in result) {
	// 				if(i > 0){
	// 					if(i%2==0){
	// 						string += '<span class="surligne">'+result[i]+ '</span>';
	// 					}else{
	// 						string += result[i];
	// 					}
	// 					alert(string);
	// 				}
	// 				alert("nope");
	// 			}
	// 			a.empty().append(string);
	// 		}
	// 		alert("a pas");
	// 	})
	// });

});