<?php
require_once("Lib.php");
$action = key_exists('action', $_GET)? trim($_GET['action']): null;
$sauvegarde = key_exists('sauvegarde', $_GET)? trim($_GET['sauvegarde']): null;
switch ($action) {
	// pour lister tout les mangas
	case "liste": 
		$corps="<h1>Liste des mangas</h1>";
		$connection =connecter();
		$sql="SELECT * FROM Manga"; // requéte pour selectionner tous les éléments de la base de donnée
		
		//on envois la requète
		$query  = $connection->query($sql);
		$query->setFetchMode(PDO::FETCH_OBJ);

		while($enregistrement = $query->fetch())
		{	
			$idM = $enregistrement->idM; //id dans la base du manga
			$nom = $enregistrement->nom; //nom du manga
			$auteur = $enregistrement->auteur; //auteur du manga
			$date_sortie = $enregistrement->date_sortie; //date de sortie du manga
			$theme = $enregistrement->theme; //theme du manga
			//pour afficher un objet par un objet (plusieurs bloques pour faire plus propre) et avoir le titre / l'auteur / la date de sortie / le thème / un oeil (pour selectionner le manga et avoir plus d'info)
 			$corps .= "<div class='manga'>";
			$corps .= "<div class='manga-titre'><u><b>$nom</b></u></div>";
			$corps .= "<div class='manga-info'>";
			$corps .= "<div><span class='label'><u>Auteur:</u></span> $auteur</div>";
			$corps .= "<div><span class='label'><u>Date de sortie:</u></span>$date_sortie</div>";
  			$corps .= "<div><span class='label'><u>Thème:</u></span> $theme</div>";
  			$corps .= "</div>";
  			$corps .= "<div class='manga-actions'>";
  			$corps .= "<a href='index.php?action=select&idM=$idM'><span class='glyphicon glyphicon-eye-open'></span></a>";
  			$corps .= "</div>";
  			$corps .= "</div>";
		}

		$zonePrincipale=$corps ;
		$query = null;
		$connection = null;
		break;

	//-----------------------------------------------------------------------------------------------------------------------------------
	//quand on selectionne un objet
	case "select":
		$corps="<h1>Détail du manga</h1>";
		$connection =connecter();
		$idM = $_GET["idM"];
		$sql="SELECT * FROM Manga WHERE idM = '$idM'"; //requéte pour supprimer le manga choisie dans la base 

		$query = $connection->query($sql);
		$query->setFetchMode(PDO::FETCH_OBJ);
		while($enregistrement = $query->fetch())
		{
			$idM = $enregistrement->idM; //idM dans la base du manga
			$nom = $enregistrement->nom; //nom du manga
			$auteur = $enregistrement->auteur; //auteur du manga
			$date_sortie = $enregistrement->date_sortie; //date de sortie du manga
			$theme = $enregistrement->theme; //theme du manga
			$histoire = $enregistrement->histoire; //description de l'histoire du manga mais sans mettre " ' " 
			//pour afficher tous les éléments d'un objet avec en plus sa description
 			$corps .= "<div class='manga'>";
			$corps .= "<div class='manga-titre'><u><b>$nom</b></u></div>";
			$corps .= "<div class='manga-info'>";
			$corps .= "<div><span class='label'><u>Auteur:</u></span> $auteur</div>";
			$corps .= "<div><span class='label'><u>Date de sortie:</u></span>$date_sortie</div>";
  			$corps .= "<div><span class='label'><u>Thème:</u></span> $theme</div>";
			$corps .= "<div class='manga-descript'><span class='label'><u>Description:</u></span> $histoire</div>";
  			$corps .= "</div>";
  			$corps .= "<div class='manga-actions'>";
			$corps.=  "<a href='index.php?action=update&idM=$idM'><span class='glyphicon glyphicon-pencil'></span></a>"; //pour pouvoir modifier le manga
			$corps.=  "<a href='index.php?action=delete&idM=$idM'><span class='glyphicon glyphicon-trash'></span></a>"; //pour pouvoir supprimer de la base le manga
  			$corps .= "</div>";
  			$corps .= "</div>";
		}
		$zonePrincipale=$corps ;
		$query = null;
		$connection = null;
		break;	

	//-----------------------------------------------------------------------------------------------------------------------------------
	//pour supprimer un objet
	case "delete":
		$idM = $_GET["idM"];
    	$connection =connecter();
		$sql = "DELETE FROM Manga WHERE idM = $idM"; //requéte pour supprimer le manga choisie dans la base 
		include("html/formulaireMangaSupr.html");
		break;	

	//-----------------------------------------------------------------------------------------------------------------------------------
	//pour exécuter les requéttes préparé de "delete" et "update" objet
	case "sauvegarde":
		$connection = connecter();
		$type = key_exists('type',$_POST)? $_POST['type']: null;
		$idM = key_exists('idM',$_POST)? $_POST['idM']: null;
		$sql = key_exists('sql',$_POST)? $_POST['sql']: null;
		$req=$connection->prepare($sql);
		$req->execute();

		if ($type =='confirm_update'){	
			$corps = "<h1> Modification du manga numéro '". $idM ."' réalisé avec succés </h1>";

		}
		else{
			$corps="<h1> Suppression du manga numéro '". $idM ."' bien effectué </h1>" ;
		}
			
	$zonePrincipale=$corps;
	$connection = null;
	break;

	//-----------------------------------------------------------------------------------------------------------------------------------
	//pour modifier un objet
	case "update":
		$cible = 'update';
        $idM = $_GET["idM"];
        $connection = connecter();
		$sql = "SELECT * FROM Manga WHERE idM = '$idM'"; //requéte pour séléctionner toutes les colonnes de l'objet avec le bon id
		$query = $connection->query($sql);
        $query->setFetchMode(PDO::FETCH_OBJ);
    	while($enregistrement = $query->fetch()){
			$idM = $enregistrement->idM;
			$nom = $enregistrement->nom;
			$auteur = $enregistrement->auteur;
			$date_sortie = $enregistrement->date_sortie;
			$theme = $enregistrement->theme;
			$histoire = $enregistrement->histoire;
        }

		if (!isset($_POST["nom"]) && !isset($_POST["auteur"]) && !isset($_POST["date_sortie"]) && !isset($_POST["theme"]) && !isset($_POST["histoire"]))
		{
  			include("html/formulaireManga.html");
		}
		else{
			$nom = key_exists('nom', $_POST)? trim($_POST['nom']): null;
			$auteur = key_exists('auteur', $_POST)? trim($_POST['auteur']): null;
			$date_sortie = key_exists('date_sortie', $_POST)? trim($_POST['date_sortie']): null;
			$theme = key_exists('theme', $_POST)? trim($_POST['theme']): null;
			$histoire = key_exists('histoire', $_POST)? trim($_POST['histoire']): null;
			if ($nom=="") $erreur["nom"] ="il manque le nom du manga"; 
			if ($auteur=="") $erreur["auteur"] ="il manque l'auteur du manga";
			if ($date_sortie=="") $erreur["date_sortie"] ="il manque la date de sortie du manga";
			if ($theme=="") $erreur["theme"] ="il manque le theme du manga"; 
			if ($histoire=="") $erreur["histoire"] ="il manque la description du manga";    
  			$compteur_erreur=count($erreur);
  			foreach ($erreur as $cle=>$valeur){
    			if ($valeur==null) {$compteur_erreur=$compteur_erreur-1;}
  			}

  			if($compteur_erreur == 0){
				$sql="UPDATE Manga SET nom='$nom', auteur='$auteur', date_sortie='$date_sortie', theme='$theme', histoire='$histoire' WHERE idM='$idM'"; //requéte pour modifier le manga choisie dans la base 
				$tab='<form action="index.php?action=sauvegarde" method="post">
				<input type="hidden" name="type" value="confirm_update"/>
				<input type="hidden" name="idM" value="'. $idM .'"/>
				<input type="hidden" name="sql" value="'. $sql .'"/>
				<p>Etes vous sûr de vouloir mettre à jour ce manga ?</p>
				<p>
					<input type="submit" value="Enregistrer">
					<a href="index.php" class="btn btn-secondary">Annuler</a>
				</p>
			  	</form>';
				$corps = $tab;
				$zonePrincipale = $corps;
			}
			else{
				include("html/formulaireManga.html");
			}
		}		

	$connection = null;
	break;	

	//-----------------------------------------------------------------------------------------------------------------------------------
	//pour insérer dans la base
	case "insert": 
		$cible='insert';
		if (!isset($_POST["nom"]) && !isset($_POST["auteur"]) && !isset($_POST["date_sortie"]) && !isset($_POST["theme"]) && !isset($_POST["histoire"]))
		{
			include("html/formulaireManga.html");//formulaire html pour créer/ajouter son manga
		}
		else{
			$nom = key_exists('nom', $_POST)? trim($_POST['nom']): null;
			$auteur = key_exists('auteur', $_POST)? trim($_POST['auteur']): null;
			$date_sortie = key_exists('date_sortie', $_POST)? trim($_POST['date_sortie']): null;
			$theme = key_exists('theme', $_POST)? trim($_POST['theme']): null;
			$histoire = key_exists('histoire', $_POST)? trim($_POST['histoire']): null;
			if ($nom=="") $erreur["nom"] ="il manque le nom du manga"; 
			if ($auteur=="") $erreur["auteur"] ="il manque l'auteur du manga";
			if ($date_sortie=="") $erreur["date_sortie"] ="il manque la date de sortie du manga";
			if ($theme=="") $erreur["theme"] ="il manque le theme du manga"; 
			if ($histoire=="") $erreur["histoire"] ="il manque la description du manga"; 
			$compteur_erreur=count($erreur);
			foreach ($erreur as $cle=>$valeur){
				if ($valeur==null) $compteur_erreur=$compteur_erreur-1;
			}

			if ($compteur_erreur == 0) {
				$connection =connecter();
				$preparation = $connection->prepare("INSERT INTO Manga(nom,auteur,date_sortie,theme,histoire) VALUES (:nom,:auteur,:date_sortie,:theme,:histoire)"); //requéte pour ajouter/insérer son manga dans la base 

				$preparation->bindValue(':nom', $nom);
				$preparation->bindValue(':auteur', $auteur);
				$preparation->bindValue(':date_sortie', $date_sortie);
				$preparation->bindValue(':theme', $theme);
				$preparation->bindValue(':histoire', $histoire);
				$preparation->execute();

				$idM = $connection->lastInsertId();
				$corps = "Le manga a bien été ajouté à la base de donnée <br>";
				//---------------------------------------------------------------------------------------------------
				$manga = new Manga($idM,$nom,$auteur,$date_sortie,$theme,$histoire);
				$corps .= "Voila les informations que vous venez d'ajouté à la base: ". $manga; //pour afficher après l'ajout dans la base toutes les données que l'utilisateur a mis
				
				$zonePrincipale=$corps;
				$connection = null;
			}
			else {
				include("html/formulaireManga.html");
			}
		}
		break;
		$connection = null;
		break;

	
	default:
	$zonePrincipale="";
	break;
   
}
include("squelette.php");

?>
