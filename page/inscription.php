<?php

if(isset($id)){
	header("Location: $racine");
}

if(isset($_POST['envoyer'])){
	$pseudo = $_POST['pseudo'];
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$pass2 = $_POST['pass2'];
	$valid = true;

	if($pass!=$pass2){
		return false;
		echo "Les mots de passe de ne correspondent pas";
		$valid = false;
	}
	$verifPseuso = $bdd->prepare("SELECT id FROM membre WHERE pseudo = :pseudo");
	$verifPseuso->execute(array('pseudo' => $pseudo));
	$resultPseudo = $verifPseuso->fetch();
	if($resultPseudo){
		$erreurPseudo = "Ce pseudo existe déjà";
		$valid = false;
	}

	$verifEmail = $bdd->prepare("SELECT id FROM membre WHERE email = :email");
	$verifEmail->execute(array('email' => $email));
	$resultEmail = $verifEmail->fetch();
	if($resultEmail){
		$erreurEmail = "Cette adresse mail existe déjà";
		$valid = false;
	}

	if($valid){
		$pass = sha1('shopy'.$pass);
		$req = $bdd->prepare('INSERT INTO membre (pseudo,email,pass,date_inscription) VALUES (:pseudo,:email,:pass,NOW())');
		$req->execute(array(
				'pseudo' => $pseudo,
				'email' => $email,
				'pass' => $pass
			));
		unset($pseudo);
		unset($email);
		$inscription = "Inscription validé, vous pouvez vous connecter";
	}else{
		$inscription = "Inscription non validé";
	}
}

?>

<div id="small">
	<form method="post" action="<?= $racine ?>inscription/">
		<p>
			<label for="pseudo" >Pseudo :</label><br/>
			<input type="text" name="pseudo" id="pseudo" pattern="^[a-zA-Z0-9._-]+$" value="<?php if(isset($pseudo)) echo $pseudo; ?>" required />
			<span class="red"><?php if(isset($erreurPseudo)) echo $erreurPseudo; ?></span>
		</p>
		<p>
			<label for="email" >E-mail :</label><br/>
			<input type="text" name="email" id="email" pattern="^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-z]{2,4}$" value="<?php if(isset($email)) echo $email; ?>" required /> 
			<span class="red"><?php if(isset($erreurEmail)) echo $erreurEmail; ?></span>                   
		</p>
		<p>
			<label for="pass" >Mot de passe :</label><br/>
			<input type="password" name="pass" id="pass" required /><br/>	                    
		</p>
		<p>
			<label for="pass" >Confirmation mot de passe :</label><br/>
			<input type="password" name="pass2" id="pass" required /><span id="confirm_pass"></span>	                    
		</p>
		<p><input class="inscription" type="submit" name="envoyer" value="S'inscrire" />
			<span><?php if(isset($inscription)) echo $inscription; ?></span>
		</p>
	</form>
</div>
<script type="text/javascript" src="<?php echo $racine; ?>js/inscription.js"></script>