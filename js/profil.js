$(function(){	
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
});