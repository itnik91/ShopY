$(function(){
	$(".inscription").click(function(){
		pass1 = $("input[name=pass]").val();
		pass2 = $("input[name=pass2]").val();
		if(pass1!=pass2){
			$("#confirm_pass").append("   Les mots de passe ne correspondent pas.");
			return false;
		}
	});
});