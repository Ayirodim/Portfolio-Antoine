<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>Bibliothèque de mangas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles_formulaire.css">
    <link rel="stylesheet" href="css/styles_formulairesupr.css">
    <link rel="stylesheet" href="css/styles_liste.css">
    <link rel="stylesheet" href="css/styles.css">
  </head>
  <body>
    <header>
      <h1>Bibliothèque de mangas</h1>

      <div class="button-container">
        <a href="index.php?action=liste" class="button">Liste des mangas</a>
        <a href="index.php?action=insert" class="button">Ajout d'un manga </a>
      </div>
    </header>

    <main>
      <?php
      if (key_exists('action', $_GET)) {echo $zonePrincipale;} //si nous avons choisie une autre page que la page d'accueil
      else {$zonePrincipale = "<h2>Bienvenue sur la bibliothèque de mangas</h2><br><p>Vous devez cliquer sur ces boutons au-dessus pour choisir ce que vous voulez faire</p>"; echo $zonePrincipale;} //si on est sur la page d'accueil
      ?>
    </main>

    <footer>
      <p>Devoir maison de TW3 réalisé par <strong>Antoine Lenoir</strong> / <u>code étudiant:</u> 22108106</p> 
      <a class="info" href="html/a_propos.html">cliquez ici pour "A propos"</a>
    </footer>
  </body>
</html>