<?php

function upload($avatar_tmp){
	if(file_exists($avatar_tmp)){
		$image_size = getimagesize($avatar_tmp);
		if($image_size['mime']=="image/jpeg"){
			$image_src = imagecreatefromjpeg($avatar_tmp);
		}
		else if($image_size['mime']=="image/png"){
			$image_src = imagecreatefrompng($avatar_tmp);
		}
		else if($image_size['mime']=="image/gif"){
			$image_src = imagecreatefromgif($avatar_tmp);
		}else{
			echo "Votre image n'est pas valide";
			$image_src = false;
		}
		if($image_src !== false){
			$image_width = 300;
			if($image_size[0] <= $image_width){
				$image_finale = $image_src;
			}else{
				$new_width[0] = $image_width;
				$new_height[1] = $image_size[1]/$image_size[0]*$image_width;
				$image_finale = imagecreatetruecolor($new_width[0], $new_height[1]);
				imagecopyresampled($image_finale, $image_src, 0, 0, 0, 0, $new_width[0], $new_height[1], $image_size[0], $image_size[1]);
			}
			imagejpeg($image_finale,'img/avatar/25.jpg');
			echo "ça marche";
		}
	}
}

if(isset($_POST['test'])){
	$avatar = $_FILES['fichier']['name'];
	$avatar_tmp = $_FILES['fichier']['tmp_name'];
	$errorImg = "";
	if(!empty($avatar_tmp)){
		$image = explode('.', $avatar);
		$image_ext = end($image);
		if(in_array(strtolower($image_ext), array('png','jpeg','jpg','gif')) === false){
			$errorImg = "Veuillez choisir une image";
		}
	}
	if(empty($errorImg)){
		upload($avatar_tmp);
	}else{
		echo $errorImg;
	}
}	

?>

<div id="small">
	<form action="<?= $racine; ?>test/" method="post" enctype="multipart/form-data">
	<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
	<input type="file" name="fichier">
	<input type="submit" value="envoi" name="test">
	</form>
</div>