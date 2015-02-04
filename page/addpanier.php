<?php 

if(isset($_GET['id'])){
	$id_produit = $_GET['id'];
	$addPanier = $bdd->prepare("INSERT INTO panier (id_produit,id_membre) VALUES (:id_produit,:id_membre)");
	$addPanier->execute(array(
		'id_produit' => $id_produit,
		'id_membre' => $id
		));
	header("Location: ".$racine."panier/");
}

?>