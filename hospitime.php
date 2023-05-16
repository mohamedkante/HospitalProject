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
		
		$query = "SELECT * FROM medecin";
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
