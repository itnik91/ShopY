<?php 

$membre = $bdd->query("SELECT * FROM membre ORDER BY pseudo");

?>
<div id="small" class="panier">
<table>
	<?php while($d_membre = $membre->fetch()): ?>
	<tr>
		<td><?= $d_membre['pseudo']; ?></td>
		<td><?= $d_membre['date_inscription']; ?></td>
		<td><a href="<?= $racine; ?>profil/<?= $d_membre['id']; ?>">Profil</a></td>
	</tr>
	<?php endwhile; ?>
</table>
</div>