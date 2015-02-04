<?php 

if(!isset($id)){
	header("Location: $racine");
}

if(isset($_GET['id'])){
	$id_panier = $_GET['id'];
	$deletePanier = $bdd->prepare("DELETE FROM panier WHERE id = :id");
	$deletePanier->execute(array('id' => $id_panier));
	header("Location: ".$racine."panier/");
}else{
	header("Location: $racine");
}

?>