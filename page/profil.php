<?php 

if(isset($_GET['id'])){
	$id_user = $_GET['id'];

	$req_user = $bdd->prepare("SELECT id_auteur,COUNT(id_auteur) AS nb_com,pseudo,email,date_inscription FROM commentaire,membre WHERE id_auteur = :id AND membre.id = :id");
	$req_user->execute(array('id' => $id_user));
	$d_user = $req_user->fetch();

	if(isset($_POST['send_msg'])){
		if(!isset($id)){
			header("Location: ".$racine."connexion/");
		}
		$msg = htmlentities(stripslashes($_POST['private_msg']));

		$priv_msg = $bdd->prepare("INSERT INTO message (message,id_auteur,id_receveur,date_envoi) VALUES (:message,:id_auteur,:id_receveur,NOW())");
		$priv_msg->execute(array(
			'message' => $msg,
			'id_auteur' => $id,
			'id_receveur' => $id_user
			));
		$msgSend = "Méssage envoyé";
	}
}
else if(isset($id)){
	$req = $bdd->prepare("SELECT COUNT(id_auteur) AS nb_com,email,date_inscription FROM commentaire,membre WHERE id_auteur = :id AND membre.id = :id");
	$req->execute(array('id' => $id));
	$result = $req->fetch();
}else{
	header("Location: ".$racine."connexion/");
}

if(isset($_POST['modifierMail'])){
	$email1 = $_POST['email1'];
	$email2 = $_POST['email2'];
	$pass = $_POST['password'];
	$pass = sha1('shopy'.$pass);

	if($email1!=$email2){
		echo "Les adresses mails ne correspondent pas";
	}else{
		$verif_pass = $bdd->prepare("SELECT pass FROM membre WHERE id = :id");
		$verif_pass->execute(array('id' => $id));
		$pass_user = $verif_pass->fetch();
		if($pass != $pass_user[0]){
			$msgModif = "Mauvais mot de passe";
		}else{
			$verifMail = $bdd->prepare("SELECT id FROM membre WHERE email = :email");
			$verifMail->execute(array('email' => $email1));
			$checkMail = $verifMail->fetch();
			if($checkMail){
				$msgModif = "Cette adresse mail existe déjà";
			}else{
				$newMail = $bdd->prepare("UPDATE membre SET email = :email WHERE id = :id");
				$newMail->execute(array(
					'email' => $email1,
					'id' => $id
					));
				$msgModif = "Modification validée";
				header ("Refresh: 3;URL='".$racine."profil/'");
			}
		}
	}
}

if(isset($_POST['modifierPass'])){
	$pass1 = $_POST['pass1'];
	$pass2 = $_POST['pass2'];
	$pass = $_POST['old_pass'];
	$pass = sha1('shopy'.$pass);

	if($pass1!=$pass2){
		echo "Les adresses mails ne correspondent pas";
	}else{
		$pass1 = sha1('shopy'.$pass1);
		$verif_pass = $bdd->prepare("SELECT pass FROM membre WHERE id = :id");
		$verif_pass->execute(array('id' => $id));
		$pass_user = $verif_pass->fetch();
		if($pass != $pass_user[0]){
			$msgModif = "Mauvais mot de passe";
		}else{
			$newPass = $bdd->prepare("UPDATE membre SET pass = :pass WHERE id = :id");
			$newPass->execute(array(
				'pass' => $pass1,
				'id' => $id
				));
			$msgModif = "Modification validée";
			header ("Refresh: 3;URL='".$racine."profil/'");
		}
	}
}

?>

<div id="small">
	<?php if(isset($_GET['id'])): ?>
	<div id="onglet" class="tabs">
		<a href="#user">Profil</a>
		<?php if(isset($id)): ?>
		<a href="#send_message">Envoyer un message</a>
		<?php endif; ?>
	</div>
	<div id="content">
		<div id="user">
			<h3>Informations :</h3>
			<hr/>
			<p class="red"><?php if(isset($msgSend)) echo $msgSend; ?></p>
			<p>Pseudo : <?php echo $d_user['pseudo']; ?></p>
			<p>Date d'inscription : <?php echo $d_user['date_inscription']; ?></p>
			<p>Commentaire posté : <a href="<?= $racine; ?>commentaire/<?= $id_user; ?>"> <?php echo $d_user['nb_com']; ?></a></p>
		</div>
		<?php if(isset($id)): ?>
		<div id="send_message">
			<form method="post" action="<?= $racine; ?>profil/<?= $id_user; ?>">
				<p>
				Envoyez lui un message privé:<br/>
				<textarea name="private_msg"></textarea><br/>
				<input type="submit" name="send_msg" value="Envoyer" />
				</p>
			</form>
		</div>
		<?php endif; ?>
	</div>

	<?php else: ?>
	<div id="onglet" class="tabs">
		<a href="#profil">Profil</a>
		Modifier votre :
		<a href="#mail">E-mail</a>
		<a href="#pass">Mot de passe</a>
	</div>
	<div id="content">
		<div id="profil">
			<h3>Vos informations :</h3>
			<hr/>
			<p class="red"><?php if(isset($msgModif)) echo $msgModif; ?></p>
			<p>Votre pseudo : <?php echo $pseudo; ?></p>
			<p>Votre E-mail : <?php echo $result['email']; ?></p>
			<p>Votre date d'inscription : <?php echo $result['date_inscription']; ?></p>
			<p>Commenaire posté : <a href="<?= $racine; ?>commentaire/"><?= $result['nb_com']; ?></a></p>
		</div>
		<div id="mail">
			<form method="post" action="<?php echo $racine; ?>profil/">
				<p>
					<label for="password" >Votre mot de passe :</label><br/>
					<input type="password" name="password" id="password" required /><br/>             
				</p>
				<hr/>
				<p>
					<label for="email1" >Nouvel E-mail :</label><br/>
					<input type="text" name="email1" id="email1" pattern="^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-z]{2,4}$" value="<?php if(isset($email1)) echo $email1; ?>" required />   
				</p>
				<p>
					<label for="email2" >Confirmer E-mail :</label><br/>
					<input type="text" name="email2" id="email2" pattern="^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-z]{2,4}$" required />
					<span class="red" id="confirm_mail"></span>   
				</p>
				<p><input type="submit" class="modifierMail" name="modifierMail" value="Modifier" /></p>	
			</form>
		</div>
		<div id="pass">
			<form method="post" action="<?php echo $racine; ?>profil/">
				<p>
					<label for="password" >Mot de passe actuel :</label><br/>
					<input type="password" name="old_pass" id="password" required /><br/>             
				</p>
				<hr/>
				<p>
					<label for="pass1" >Nouveau mot de passe :</label><br/>
					<input type="password" name="pass1" id="pass1" required /><br/>             
				</p>
				<p>
					<label for="pass2" >Confirmation mot de passe :</label><br/>
					<input type="password" name="pass2" id="pass2" required /><span id="confirm_pass"></span>             
				</p>
				<p><input type="submit" class="modifierpass" name="modifierPass" value="Modifier" /></p>
			</form>	
		</div>
	</div>
	<?php endif; ?>
</div>
<script type="text/javascript" src="<?php echo $racine; ?>js/profil.js"></script>