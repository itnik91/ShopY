<?php 

$produit = $bdd->query("SELECT id,nom,prix,image FROM produit");

?>
<table id="centrer">
			<tr class="produit">
				<?php while($data = $produit->fetch()): ?>
					<td>
						<div class="produit-img">
							<a class="img-link" href="produit/<?php echo $data['id'] ?>">
								<span class="description">Voir les commentaires sur ce produit</span>
								<img src="img/<?php echo $data['image'] ?>" alt="Produit">
							</a>
							<div class="produit_info">
								<div class="nom_prix">
									<p><strong>Nom :</strong> <?php echo $data['nom'] ?></p>
									<hr/>
									<p><strong>Prix : <span><?php echo $data['prix'] ?> €</span></strong></p>
								</div>
								<a href="index.php?page=addpanier&id=<?php echo $data['id'] ?>" class="info_bulle"><div class="acheter"><p class="icon-plus"></p></div></a>
							</div>
						</div>
					</td>
				<?php endwhile; ?>
			</tr>
</table>
<script type="text/javascript" src="<?php echo $racine; ?>js/accueil.js"></script>