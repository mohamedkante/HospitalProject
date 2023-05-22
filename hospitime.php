<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>HospiTime le spécialiste des rendez-vous</title>
    <!-- Liens vers les fichiers CSS et JS -->
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
        <?php
		$host = 'localhost';
		$user = 'root';
		$password = 'root';
		$dbname = 'hopital';
		
		
		$conn = mysqli_connect($host, $user, $password, $dbname);
		if (!$conn) {
			die('La connexion à la base de données a échoué : ' . mysqli_connect_error());
		}
		
		$query = "SELECT * FROM patients";
		$result = mysqli_query($conn, $query);
		if (!$result) {
			die('La requête a échoué : ' . mysqli_error($conn));
		}
		
	    ?>  

        <?php
        require_once 'vendor/autoload.php';
        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $twig = new \Twig\Environment($loader);
        ?>

        <?php
        $template = $twig->load('formulaire.twig');
        $template = $twig->load('index.twig');


        // Rendre le template avec les données du formulaire
        echo $template->render([
            'connectButtonUrl' => 'formulaire.twig',
            'showForm' => isset($_GET['connect']) // Vérifiez si le paramètre "connect" est présent dans l'URL
        ]);
        //  
        ?>
            
            <?php
    // Code de connexion à la base de données et autres configurations...
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['patients'])) {
            
            // Traitement des données du formulaire des patients
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $dateNaissance = $_POST['date_naissance'];
            $telephone = $_POST['telephone_portable'];
            $email = $_POST['email'];

            // Préparation de la requête SQL pour les patients
            $sql = "INSERT INTO patients (nom, prenom, date_naissance, telephone, email) 
                    VALUES ('$nom', '$prenom', '$dateNaissance', '$telephone', '$email')";
            
            // Exécution de la requête pour les patients
            if ($conn->query($sql) === TRUE) {
                echo "Les données des patients ont été ajoutées avec succès.";
            } else {
                echo "Erreur lors de l'ajout des données des patients : " . $conn->error;
            }
            
        } elseif (isset($_POST['medecin'])) {
            // Traitement des données du formulaire des médecins
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $genre = $_POST['genre'];
            $telephone = $_POST['telephone_portable'];
            $email = $_POST['email'];
            $etablissement = $_POST['etablissement'];
            $specialite = $_POST['specialite'];

            // Préparation de la requête SQL pour les médecins
            $sql= "INSERT INTO medecin (nom, prenom, genre, telephone, email, etablissement, specialite) 
                    VALUES ('$nom', '$prenom', '$genre', '$telephone', '$email', '$etablissement', '$specialite')";

            // Exécution de la requête pour les médecins
            if ($conn->query($sql) === TRUE) {
                echo "Les données des médecins ont été ajoutées avec succès.";
            } else {
                echo "Erreur lors de l'ajout des données des médecins : " . $conn->error;
            }
        }
    }
    // Code pour fermer la connexion à la base de données et autres actions supplémentaires...
   
        ?> 
        <?php
       $searchResults = ""; // Chaîne de caractères pour stocker les résultats de recherche

if (isset($_GET['query'])) {
    $searchTerm = $_GET['query'];

    // Requête SQL pour récupérer les données correspondant au terme de recherche
    $sql = "SELECT nom, prenom, genre, email, telephone, etablissement, specialite FROM medecin WHERE nom LIKE '%$searchTerm%' OR prenom LIKE '%$searchTerm%' OR etablissement LIKE '%$searchTerm%' OR specialite LIKE '%$searchTerm%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $searchResults .= "Nom: " . $row["nom"] . "<br>";
            $searchResults .= "Prénom: " . $row["prenom"] . "<br>";
            $searchResults .= "Genre: " . $row["genre"] . "<br>";
            $searchResults .= "Email: " . $row["email"] . "<br>";
            $searchResults .= "Téléphone: " . $row["telephone"] . "<br>";
            $searchResults .= "Etablissement: " . $row["etablissement"] . "<br>";
            $searchResults .= "Spécialité: " . $row["specialite"] . "<br><br>";
        }
    } else {
        $searchResults = "Aucun résultat trouvé pour la recherche : " . $searchTerm;
    }
}

$conn->close();
       echo $searchResults;
       ?>
      
       


    </main>

    <!-- Pied de page -->
    <footer>
        <!-- Votre contenu de footer ici -->

        <!--
        <div class="download-section">
            <a href="https://www.apple.com/app-store/" target="_blank">
                <img class="image1" src="applApps.png" title="Application mobile dans l'App Store d'Apple" alt="Application mobile dans l'App Store d'Apple" alt="Télécharger sur App Store">
            </a>
            <a href="https://play.google.com/store" target="_blank">
                <img class="image2" src="androidAp.png" alt="Disponible sur Android">
            </a>
        </div>
        <a href="https://play.google.com/store" target="_blank">
            <img src="androidApps.png" alt="Disponible sur Android">
        </a>
        <p>Copyright © 2023</p>
        -->
    </footer>
</body>
</html>
