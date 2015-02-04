$(function(){
	$("header nav a").click(function(){
		//alert("ça marche");
		string = $(this).attr("href");
		//alert(string);
		page = string.split("/");
		page = page[3];
		//alert(page);
		//return false;
		$.ajax({
			url: "page/"+page+".php",
			cache: false,
			success: function(html){
				afficher(html);
			},
			error: function(XMLHttpRequest, textStatus, errorThrown){
				alert(textStatus);
			}
		})
		return false;
	});
});

function afficher(data){
	$("section").fadeOut(0,function(){
		$("section").empty();
		$("section").append(data);
		$("section").fadeIn(500);
	})
}