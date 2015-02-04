<?php 

if(!isset($id)){
	header("Location: ".$racine."connexion/");
}

$total = 0;
$id_panier = $bdd->prepare("SELECT DISTINCT id_produit FROM panier WHERE id_membre = :id");
$id_panier->execute(array('id' => $id));

?>
<div id="small" class="panier">
<table>
	<tr>
		<th>Image</th>
		<th>Nom</th>
		<th>Prix</th>
		<th>Quantité</th>
		<th>Supprimer</th>
	</tr>
<?php 
	while($data_id = $id_panier->fetch()): 

		$produit = $bdd->prepare("SELECT id,nom,prix,image FROM produit WHERE id = :id");
		$produit->execute(array('id' => $data_id['id_produit']));

		while($data_produit = $produit->fetch()):
			$quantity = $bdd->prepare("SELECT id,COUNT(id_produit) AS quant FROM panier WHERE id_produit = :idp AND id_membre = :idm");
			$quantity->execute(array(
				'idp' => $data_produit['id'],
				'idm' => $id
				));
			$result_quant = $quantity->fetch();

			$total = $total + $data_produit['prix'] * $result_quant['quant'];
?>
<tr>
	<td class="shorter"><img src="<?php echo $racine; ?>img/<?php echo $data_produit['image']; ?>" alt="produit"></td>
	<td><p><?php echo $data_produit['nom']; ?></p></td>
	<td><p><?php echo $data_produit['prix']; ?> €</p></td>
	<td><p><?php echo $result_quant['quant']; ?></p></td>
	<td><a href="<?php echo $racine; ?>index.php?page=deleteproduit&id=<?php echo $result_quant['id']; ?>"><img src="<?php echo $racine; ?>img/delete.png"></a></td>
</tr>
<?php 
		endwhile;
	endwhile;
 ?>
 </table>
 <p>Total à payer : <strong><?php echo $total ?> €</strong></p>
 </div>