<?php 

$p_date = $bdd->query("SELECT id,nom,prix,image FROM produit ORDER BY id DESC");
$p_prix = $bdd->query("SELECT id,nom,prix,image FROM produit ORDER BY prix");
$p_nom = $bdd->query("SELECT id,nom,prix,image FROM produit ORDER BY nom");

?>
<div id="tri_recherche">
	<h1>Trier par :</h1>
	<div id="date_ajout">
		<div id="tri_titre_date"><h3>Date d'ajout</h3></div>
		<table>
		<?php while($d_date = $p_date->fetch()): ?>
		<tr>
			<td class="more_shorter"><img src="<?= $racine; ?>img/<?= $d_date['image']; ?>"></td>
			<td><a href="<?= $racine; ?>produit/<?= $d_date['id']; ?>"><?= $d_date['nom']; ?></a></td>
			<td><?= $d_date['prix']; ?> €</td>
		</tr>
		<?php endwhile; ?>
		</table>
	</div>
	<div id="tri_prix">
		<div id="tri_titre_prix"><h3>Prix</h3></div>
		<table>
		<?php while($d_prix = $p_prix->fetch()): ?>
		<tr>
			<td class="more_shorter"><img src="<?= $racine; ?>img/<?= $d_prix['image']; ?>"></td>
			<td><a href="<?= $racine; ?>produit/<?= $d_prix['id']; ?>"><?= $d_prix['nom']; ?></a></td>
			<td><?= $d_prix['prix']; ?> €</td>
		</tr>
		<?php endwhile; ?>
		</table>
	</div>
	<div id="tri_nom">
		<div id="tri_titre_nom"><h3>Nom</h3></div>
		<table>
		<?php while($d_nom = $p_nom->fetch()): ?>
		<tr>
			<td class="more_shorter"><img src="<?= $racine; ?>img/<?= $d_nom['image']; ?>"></td>
			<td><a href="<?= $racine; ?>produit/<?= $d_nom['id']; ?>"><?= $d_nom['nom']; ?></a></td>
			<td><?= $d_nom['prix']; ?> €</td>
		</tr>
		<?php endwhile; ?>
		</table>
	</div>
</div>
<script type="text/javascript" src="<?php echo $racine; ?>js/recherche.js"></script>