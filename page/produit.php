<?php 

if(isset($_POST['poster'])){
	$com = htmlentities(stripslashes($_POST['commentaire']));

	$add_com = $bdd->prepare("INSERT INTO commentaire (message,date_message,id_produit,id_auteur) VALUES (:message,NOW(),:id_produit,:id_auteur)");
	$add_com->execute(array(
		'message' => $com,
		'id_produit' => $_GET['id'],
		'id_auteur' => $id
		));
}

if(isset($_GET['id'])){
	$id_produit = $_GET['id'];

	$produit = $bdd->prepare("SELECT id,nom,prix,image FROM produit WHERE id = :id");
	$produit->execute(array('id' => $id_produit));
	$data = $produit->fetch();
	if(!$data){
		header("Location: $racine");
	}

	$req_com = $bdd->prepare("SELECT commentaire.id,pseudo,message,date_message,id_produit,membre.id AS id_user FROM commentaire,membre WHERE id_produit = :id AND id_auteur = membre.id ORDER BY commentaire.id DESC");
	$req_com->execute(array('id' => $id_produit));
}else{
	header("Location: $racine");
}

?>

<div id="small">
	<div id="img_info">
		<div id="img"><img src="<?php echo $racine; ?>img/<?php echo $data['image']; ?>"></div>
		<div id="info">
			<h3>Information :</h3>
			<p>Non : <?php echo $data['nom']; ?></p>
			<p>Prix : <?php echo $data['prix']; ?> €</p>
			<p><a class="icon-cart" href="<?php echo $racine; ?>addpanier/<?php echo $data['id']; ?>">Ajouter au panier</a></p>
		</div>
	</div>
	<div id="com">
	<?php if(isset($id)): ?>
		<form action="<?php echo $racine; ?>produit/<?php echo $data['id'] ?>" method="post">
			<p>
				<label>Laissez un commentaire</label><br/>
				<textarea name="commentaire" required ></textarea><br/>
		        <input type="submit" name="poster" value="Poster" />
			</p>
		</form>
	<?php endif; ?>
		
		<?php while($data_com = $req_com->fetch()): ?>
		
			<div id="titre_com"><p>Posté par <strong><a href="<?= $racine; ?>profil/<?= $data_com['id_user']; ?>"><?= $data_com['pseudo']; ?></a></strong> le <strong><?= $data_com['date_message']; ?></strong></p></div>
			<div id="msg_com"><p><?= $data_com['message']; ?></p></div>
		
		<?php endwhile; ?>
		
	</div>
</div>
<script type="text/javascript" src="<?php echo $racine; ?>js/test.js"></script>