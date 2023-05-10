<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Titre de la page</title>
    <!-- Liens vers les fichiers CSS et JS -->
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
 </head>
   
<body>
 <header> 
    
    <div class="navbar">
       <!-- <a href="/" title="Accueil" aria-label="Accueil" class="flex"><div class="logo-doctolib logo-doctolib-white"></div> </a>

        <a href="#">À propos</a> -->
        <!-- <a href="#">Services</a> -->
        <a href="formulaire.php#"> 👤 Se connecter </a>
        <div class="logo">
        <img src="doc.png" alt=" ">
    </div>
    </div> 

 </header>
  <?php 
  // Inclusion du fichier connexion_bdd.php pour établir la connexion à la base de données
       include("includes.php");
      ?>
        
	 
    <!-- Pied de page -->
 <footer>
        <!-- <p>Copyright © 2023</p> -->
  </footer>
</body>
</html>
