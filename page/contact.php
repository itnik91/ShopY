<?php
$url = $_SERVER['HTTP_REFERER'];
header("Refresh: 10;URL=$url");

if(isset($_POST['envoyer'])){
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $header = "From: $nom <$email>";
    $mail = "guillaume.torres91@gmail.com";
    $message = stripslashes($message);
    if(mail($message, "Contact", $message, $header)){
    	$msg = "Votre message a bien été envoyé";
    }else{
    	$msg = "Erreur lors de l'envoi du message";
    }
}else{
	header("Location: $racine");
}

?>
<div id="centrer">
<p><?php echo $msg; ?></p>
<p>Si vous n'êtes pas redirigé dans 5 secondes, <a href="$url">cliquez ici</a></p>
</div>