<?php include_once('config.php'); ?>

<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	<link rel="shortcut icon" type="image/jpeg" href="<?php echo $racine; ?>img/shorticon.png" />
	<link rel="stylesheet" href="<?php echo $racine; ?>css/style.css" />
	<link rel="stylesheet" href="<?php echo $racine; ?>css/icomoon.css" />
	<meta name="keywords" content=""/>
	<meta name="description" content="Système de panier, membres, commentaires"/>
	<title>ShopY</title>
	<script type="text/javascript" src="<?php echo $racine; ?>js/jquery.js"></script>
</head>
<body>
	<div id="conteneur">
		<header>
			<div id="haut">
				<div id="titre_slogan_panier">
					<div id="titre"><a href="<?php echo $racine; ?>"><h1>ShopY</h1></a></div>
					<div id="slogan"><span id="slogan">Le meilleurs site d'e-commerce !</span></div>
					<div id="panier">
						<a href="<?php echo $racine; ?>panier/"><p class="icon-cart"></p>
						<h2>Mon panier</h2></a>
					</div>
				</div>
			</div>
			<div id="bas">
				<div id="bienvenu">
					<?php if(isset($id)): ?>
						<span><p>Bonjour <?php echo "<a href='".$racine."profil/'>$pseudo</a>"; ?>, vous avez <?= $non_vu['nb_vu']; ?> <a href="<?php echo $racine; ?>message/">nouveau(x) message(s)</a></p></span>
					<?php else: ?>
						<span><p>Bienvenu visiteur, vous pouvez vous <a href="<?php echo $racine; ?>connexion/">connecter</a> ou vous <a href="<?php echo $racine; ?>inscription/">inscrire</a></p></span>
					<?php endif; ?>
				</div>
			</div>
			<nav>
				<?php if(isset($id)): ?>
					<ul>
						<li><a href="<?php echo $racine; ?>">Accueil</a></li>
						<li><a href="<?php echo $racine; ?>profil/">Profil</a></li>
						<li><a href="<?php echo $racine; ?>membre/">Membres</a></li>
						<li><a href="<?php echo $racine; ?>recherche/">Recherche</a></li>
						<li><a href="<?php echo $racine; ?>deconnexion/">Deconnexion</a></li>
					</ul>
				<?php else: ?>
					<ul>
						<li><a href="<?php echo $racine; ?>">Accueil</a></li>
						<li><a href="<?php echo $racine; ?>membre/">Membres</a></li>
						<li><a href="<?php echo $racine; ?>recherche/">Recherche</a></li>
						<li><a href="<?php echo $racine; ?>connexion/">Connexion</a></li>
						<li><a href="<?php echo $racine; ?>inscription/">Inscription</a></li>
					</ul>
				<?php endif; ?>
			</nav>
		</header>
		<section>
			<div id="contenu">
				<?php 
					if(isset($_GET['page']) && file_exists('page/'.$_GET['page'].'.php')){
						include_once('page/'.$_GET['page'].'.php');
					}else{
						include_once('page/accueil.php');
					}
				?>
			</div>
		</section>
		<footer>
			<div id="footer">
				<div id="divers">
					<h2>Divers</h2>
					<hr/>
					<p>Membres inscrits : <?= $d_membre['nbm'] ?></p>
					<p>Produits en ligne : <?= $d_produit['nbp'] ?></p>
					<p>Commentaires postés : <?= $d_com['nbc'] ?></p>
					<p>Dernier produits :</p>
					<ul>
					<?php while($data_produit = $list_produit->fetch()): ?>
						<li><a href="<?php echo $racine; ?>produit/<?php echo $data_produit['id']; ?>"><?= $data_produit['nom']; ?> : <?= $data_produit['prix']; ?> €</a></li>
					<?php endwhile; ?>
					</ul>
				</div>
				<div id="contact_rs">
					<h2>Nous contacter</h2>
					<hr/>
					<div id="contact">
						<form method="post" action="<?php echo $racine; ?>contact/" >
		                    <p>
		                    <label for="nom" >Nom :</label>
		                	<input type="text" name="nom" id="nom" pattern="^[a-zA-Z0-9._-]+$" required /><br/>
		                    
		                    <label for="email" >E-mail :</label>
		                    <input type="text" name="email" id="email" pattern="^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-z]{2,4}$" required /><br/>
		                    
		                    <textarea name="message" required ></textarea><br/>
		                    <input type="submit" name="envoyer" value="Envoyer le message" />
		                	</p>
	                	</form>
                	</div>
                	<div id="rs">
                		<h2>Nous suivre</h2>
                		<hr/>
                		<a href="#"><p class="icon-facebook">Facebook</p></a>
                		<a href="#"><p class="icon-twitter">Twitter</p></a>
                		<a href="#" title="Retourner en haut"><div id="fleche"></div></a>
                	</div>
				</div>
			</div>
		</footer>
	</div>
</body>
</html>