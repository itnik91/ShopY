<?php 
session_start();
$racine = "/";

// Connexion base de donnée
try
{
	$bdd = new PDO('mysql:host=mysql.hostinger.fr;dbname=u805405336_shopy', 'u805405336_shop', '942332trolle');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

// Vérification des sessions
if(isset($_SESSION['id'])){
	$id = $_SESSION['id'];
	$pseudo = $_SESSION['pseudo'];

	$set_vu = $bdd->prepare("SELECT COUNT(id) AS nb_vu FROM message WHERE id_receveur = :id AND msg_vu = 0");
	$set_vu->execute(array('id' => $id));
	$non_vu = $set_vu->fetch();
}

$nb_membre = $bdd->query("SELECT COUNT(id) AS nbm FROM membre");
$d_membre = $nb_membre->fetch();

$nb_produit = $bdd->query("SELECT COUNT(id) AS nbp FROM produit");
$d_produit = $nb_produit->fetch();

$nb_com = $bdd->query("SELECT COUNT(id) AS nbc FROM commentaire");
$d_com = $nb_com->fetch();

$list_produit = $bdd->query("SELECT id,nom,prix FROM produit ORDER BY id DESC LIMIT 3");

/* Vérification des cookies
if(isset($_COOKIE['auth']) && $_COOKIE['auth']!="deco"){
	$auth = $_COOKIE['auth'];
	$auth = explode('-', $auth);
	$req_email = $bdd->prepare("SELECT pseudo,email FROM membre WHERE id = :id");
	$req_email->execute(array('id' => $auth[0]));
	$pseudo_email = $req_email->fetch();
	$key = sha1($pseudo_email[0].$pseudo_email[1]);
	if($key==$auth[1]){
		//echo $_COOKIE['auth'];
		$_SESSION['id'] = $auth[0];
		$_SESSION['pseudo'] = $pseudo_email[0];
		setcookie('auth', $auth[0].'-'.$key, time()+3600*24*3);
		//header("Location: $racine");
	}else{
		setcookie('auth', '', time()-3600);
	}
}*/

?>