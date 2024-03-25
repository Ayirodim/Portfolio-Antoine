<?php

//fonctions pour ce connecter à ma base de donnée
function connecter()
{
    try {
        $dns = "mysql:host=mysql.info.unicaen.fr;port=3306;dbname=lenoir211_bd;charset=utf8";
        $utilisateur = "lenoir211";
        $motDePasse = "EoKahph1uVienoi5";
        
        // Options de connection
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                        );
        $connection = new PDO($dns, $utilisateur, $motDePasse, $options);
        return($connection);
    
    
    } catch ( Exception $e ) {
        echo "Connection à MySQL impossible : ", $e->getMessage();
        die();
    }
}

class Manga //classe Manga pour pouvoir afficher tous les éléments du manga
{
    private $idM;
    private $auteur;
    private $date_sortie;
    private $theme;
    private $histoire;

    public function __construct($idM,$nom,$auteur,$date_sortie="0000-00-00",$theme,$histoire)
    {
        $this->idM=$idM;
        $this->nom=$nom;
        $this->auteur=$auteur;
        $this->date_sortie=$date_sortie;
        $this->theme=$theme;
        $this->histoire=$histoire;
    }

    public function __toString()
    {
        $txt= "(".$this->idM.", ".$this->nom.", ". $this->auteur.", ". $this->date_sortie.", ". $this->theme.", ".$this->histoire.")<br>";
        return $txt;
    }
}

$idM=null;$nom = null;$auteur = null;$date_sortie = null;$theme = null;$histoire = null;		
$erreur=array("nom"=>null,"auteur"=>null,"date_sortie"=>null,"theme"=>null,"histoire"=>null);
?>
