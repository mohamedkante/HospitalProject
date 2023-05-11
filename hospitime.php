<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>HospiTime le specialiste des rendez-vous</title>
    <!-- Liens vers les fichiers CSS et JS -->
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
 </head>
   
<body>

 <header> 
    <div class="navbar">
     <ul>
        <a href="#" class="register-link"> S'inscrire</a>
        <a href="formulaire.php#"> 👤 Se connecter </a>
        <a href="#"> Hopitaux</a> 
    <!-- </div> -->
    </ul>
    <div class="logo">
        <img src="doc.png" alt=" ">
     </div>
 </header>

  <main> 
    <div class="search-bar">
        <input type="text" class="search-input" placeholder=" 🔍 Nom, établissement, spécialisté...">
        <button class="search-button"> ▷</button>
    </div> 
 </main>

     <?php 
  // Inclusion du fichier connexion_bdd.php pour établir la connexion à la base de données
       include("includes.php");
      ?>
      <? $terme = $_GET['recherche'];
         $sql = "SELECT * FROM medecin WHERE colonne LIKE '%$terme%'";
         $result = mysqli_query($conn, $sql);
      ?>
    <!-- Pied de page -->
  <footer> 
     <!-- Votre contenu de footer ici -->

     <div class="download-section">
       <a href="https://www.apple.com/app-store/" target="_blank">
       <img src="applApps.png" title="Application mobile dans l'App Store d'Apple" alt="Application mobile dans l'App Store d'Apple" alt="Télécharger sur App Store">
       </a>
       <a href="https://play.google.com/store" target="_blank">
         <img src="androidApps.png" alt="Disponible sur Android">
      </a>
   </div>       <!-- <a href="https://play.google.com/store" target="_blank">
         <img src="androidApps.png" alt="Disponible sur Android">
       </a>  -->
        <!-- <p>Copyright © 2023</p> -->
  </footer>
</body>
</html>
