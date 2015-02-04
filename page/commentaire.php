<?php 

if(isset($_GET['id'])){
	$req_com = $bdd->prepare("SELECT nom,message,date_message,id_produit FROM commentaire,produit WhERE id_auteur = :id AND id_produit = produit.id ORDER BY commentaire.id DESC");
	$req_com->execute(array('id' => $_GET['id']));
}
else if(isset($id)){
	$req_com = $bdd->prepare("SELECT nom,message,date_message,id_produit FROM commentaire,produit WhERE id_auteur = :id AND id_produit = produit.id ORDER BY commentaire.id DESC");
	$req_com->execute(array('id' => $id));
}else{
	header("Location: ".$racine."connexion/");
}

?>

<div id="small">
	<?php if(isset($_GET['id'])): ?>
	<h3>Commentaires postés par cet utilisateur</h3>
	<?php while($data_com = $req_com->fetch()): ?>
	<div id="titre_com"><p>Posté sur <strong><a href="<?= $racine; ?>produit/<?= $data_com['id_produit']; ?>"><?= $data_com['nom']; ?></a></strong> le <strong><?= $data_com['date_message']; ?></strong></p></div>
	<div id="msg_com"><p><?= $data_com['message']; ?></p></div>
	<?php endwhile; ?>
	<?php else: ?>
	<h3>Commentaires postés</h3>
	<?php while($data_com = $req_com->fetch()): ?>
	<div id="titre_com"><p>Posté sur <strong><a href="<?= $racine; ?>produit/<?= $data_com['id_produit']; ?>"><?= $data_com['nom']; ?></a></strong> le <strong><?= $data_com['date_message']; ?></strong></p></div>
	<div id="msg_com"><p><?= $data_com['message']; ?></p></div>
	<?php endwhile; ?>
	<?php endif; ?>
</div>