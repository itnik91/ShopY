<?php 

if(isset($_GET['id']) && $_GET['id']=1){
	$req_recu = $bdd->prepare("SELECT id_auteur,message,id_receveur,date_envoi,pseudo FROM message,membre WHERE id_auteur = :id AND membre.id = id_receveur ORDER BY message.id DESC");
	$req_recu->execute(array('id' => $id));
}
else if(isset($id)){
	$req_msg = $bdd->prepare("SELECT membre.id AS id_envoi,pseudo,message,date_envoi FROM membre,message WHERE membre.id = id_auteur AND id_receveur = :id ORDER BY message.id DESC");
	$req_msg->execute(array('id' => $id));

	$vu = $bdd->prepare("UPDATE message SET msg_vu = 1 WHERE id_receveur = :id");
	$vu->execute(array('id' => $id));
}else{
	header("Location: ".$racine."connexion/");
}

?>
<div id="small">
	<?php if(isset($_GET['id']) && $_GET['id']=1): ?>
	<div class="link_msg">
	<a href="<?= $racine; ?>message/">Messages reçus</a><a class="activ" href="<?= $racine; ?>message/1">Messages envoyés</a>
	</div>
	<h3>Messages envoyés :</h3>
	<?php while($data_recu = $req_recu->fetch()): ?>
	<div id="titre_com"><p>Envoyé à <strong><a href="<?= $racine; ?>profil/<?= $data_recu['id_receveur']; ?>"><?= $data_recu['pseudo']; ?></a></strong> le <strong><?= $data_recu['date_envoi']; ?></strong></p></div>
	<div id="msg_com"><p><?= $data_recu['message']; ?></p></div>
	<?php endwhile; ?>
	<?php else: ?>
	<div class="link_msg">
	<a class="activ" href="<?= $racine; ?>message/">Messages reçus</a><a href="<?= $racine; ?>message/1">Messages envoyés</a>
	</div>
	<h3>Messages reçus :</h3>
	<?php while($data_msg = $req_msg->fetch()): ?>
	<div id="titre_com"><p>Envoyé par <strong><a href="<?= $racine; ?>profil/<?= $data_msg['id_envoi']; ?>"><?= $data_msg['pseudo']; ?></a></strong> le <strong><?= $data_msg['date_envoi']; ?></strong></p></div>
	<div id="msg_com"><p><?= $data_msg['message']; ?></p></div>
	<?php endwhile; ?>
	<?php endif; ?>
</div>