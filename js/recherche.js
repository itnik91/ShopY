$(function(){
	tri_date = $("#date_ajout table");
	tri_date.hide();
	$("#tri_titre_date").click(function(){
		if(tri_date.is(":hidden")){
			tri_date.fadeIn();
		}else{
			tri_date.fadeOut();
		}
	});

	tri_prix = $("#tri_prix table");
	tri_prix.hide();
	$("#tri_titre_prix").click(function(){
		if(tri_prix.is(":hidden")){
			tri_prix.fadeIn();
		}else{
			tri_prix.fadeOut();
		}
	});

	tri_nom = $("#tri_nom table");
	tri_nom.hide();
	$("#tri_titre_nom").click(function(){
		if(tri_nom.is(":hidden")){
			tri_nom.fadeIn();
		}else{
			tri_nom.fadeOut();
		}
	});
});