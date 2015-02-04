<?php 

if(isset($id)){
	header("Location: $racine");
}

if(isset($_POST['connexion'])){
	$pseudo = $_POST['pseudo'];
	$pass = $_POST['pass'];
	$pass = sha1('shopy'.$pass);

	$req = $bdd->prepare("SELECT id,pseudo,email FROM membre WHERE pseudo = :pseudo AND pass = :pass");
	$req->execute(array(
		'pseudo' => $pseudo,
		'pass' => $pass
		));
	$result = $req->fetch();
	/*if(isset($_POST['remember'])){
		setcookie('auth', $result[0].'-'.sha1($pseudo.$result[2]), time()+3600*24*3, '/');
	}*/
	if(!$result){
		$msg = "Pseudo ou mot de passe invalide";
	}else{
		$_SESSION['id'] = $result[0];
		$_SESSION['pseudo'] = $result[1];
		header("Location: $racine");
	}
}

if(isset($_POST['connexion'])){
	$_SESSION['id'] = 8;
	$_SESSION['pseudo'] = "Utilisateur";
	header("Location: $racine");
}

?>

<div id="small">
	<p><?php if(isset($msg)) echo $msg; ?></p>
	<form method="post" action="<?php echo $racine; ?>connexion/">
		<p>
			<label for="pseudo" >Pseudo :</label><br/>
			<input type="text" name="pseudo" id="pseudo" pattern="^[a-zA-Z0-9._-]+$" required />
		</p>
		<p>
			<label for="pass" >Mot de passe :</label><br/>
			<input type="password" name="pass" id="pass" required /><br/>	                    
		</p>
		<!-- <p>
			<label><input type="checkbox" name="remember" />Se souvenir de moi</label>
		</p> -->
		<p><input type="submit" name="connexion" value="Se connecter" /></p>
		<p>Connexion invité : Utilisateur/test</p>
	</form>
</div>