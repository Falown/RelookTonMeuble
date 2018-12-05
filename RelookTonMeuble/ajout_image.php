<?php
  if(isset($_POST['validation'])) {
 
	 //Indique si le fichier a �t� t�l�charg�
	 if(!is_uploaded_file($_FILES['image']['tmp_name']))
		echo 'Un probl�me est survenu durant l op�ration. Veuillez r�essayer !';
	 else {
		//liste des extensions possibles    
		$extensions = array('/png', '/gif', '/jpg', '/jpeg');
 
		//r�cup�re la cha�ne � partir du dernier / pour conna�tre l'extension
		$extension = strrchr($_FILES['image']['type'], '/');
 
		//v�rifie si l'extension est dans notre tableau            
		if(!in_array($extension, $extensions))
			echo 'Vous devez uploader un fichier de type png, gif, jpg, jpeg.';
		else {         
 
			//on d�finit la taille maximale
			define('MAXSIZE', 300000);        
			if($_FILES['image']['size'] > MAXSIZE)
			   echo 'Votre image est sup�rieure � la taille maximale de '.MAXSIZE.' octets';
			else {
				//connexion � la base de donn�es
				try {
					$utilisateur='user_17007005';
					$mdp='7&n4v,4V';
					$bdd = new PDO('mysql:host=mysql.istic.univ-rennes1.fr;dbname=base_17007005', $utilisateur, $mdp);
				} catch (Exception $e) {
					exit('Erreur : ' . $e->getMessage());
				}
 
				//Lecture du fichier
				$image = file_get_contents($_FILES['image']['tmp_name']);
 
				$req = $bdd->prepare("INSERT INTO images(nom, description, img, extension, taille,design,type) VALUES(:nom, :description, :image, :type, :taille, :design, :type)");
				$req->execute(array(
					'nom' => $_POST['nom'],
					'description' => $_POST['description'],
					'image' => $image,
					'type' => $_FILES['image']['type'],
					'taille' => $_FILES['image']['size'],
					'design' => $_POST['design'],
					'type' => $_POST['type']
					));
 
				echo 'L\'insertion s est bien d�roul�e !';
			 }
		  }
	  }
  }
?>