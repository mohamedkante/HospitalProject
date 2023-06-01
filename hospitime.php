
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
                // session_start();
                
                // // Vérifier si l'utilisateur est déjà connecté
                // if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                //     // Rediriger vers la page de profil
                //     header("Location: profile.twig");
                //     exit;
                // } 
                // // Vérifier si le formulaire de connexion a été soumis
                // if ($_SERVER["REQUEST_METHOD"] == "POST") {
                //     // Vérifier les informations d'identification de l'utilisateur
                //     $username = $_POST['email'];
                //     $password = $_POST['mot_de_passe'];
                
                //     // Vérifier les informations d'identification dans votre base de données
                //     // Remplacez cette vérification avec votre propre logique d'authentification
                // }

                // // Préparer la requête pour vérifier les informations d'identification
                // $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE username = ?");
                // $stmt->bind_param("s", $username);
                // $stmt->execute();
                // $result = $stmt->get_result();
            
                // // Vérifier si l'utilisateur existe et si le mot de passe est correct
                // if ($result->num_rows === 1) {
                //     $row = $result->fetch_assoc();
                //     if (password_verify($password, $row['password'])) {
                //         // Authentification réussie
                //         $_SESSION['logged_in'] = true;
                //         $_SESSION['username'] = $row['username'];

                //         // Rediriger vers la page de profil
                //         header("Location: profile.php");
                //         exit;
                //     }
                // }
            
                // // Authentification échouée
                // $error_message = "Identifiant ou mot de passe incorrect.";
                   


            // Code de connexion à la base de données et autres configurations...
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['patients'])) {

                // Traitement des données du formulaire des patients
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $dateNaissance = $_POST['date_naissance'];
                $telephone = $_POST['telephone_portable'];
                $email = $_POST['email'];
                $motDepasse = $_POST['mot_de_passe'];

                // Préparation de la requête SQL pour les patients
                $sql = "INSERT INTO patients (nom, prenom, date_naissance, telephone, email, mot_de_passe)
                        VALUES ('$nom', '$prenom', '$dateNaissance', '$telephone', '$email', '$motDepasse')";

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
            
                // Vérifier si une photo a été téléchargée
                if ($_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                    $photoName = $_FILES['photo']['name'];
                    $photoTmpName = $_FILES['photo']['tmp_name'];
                    $photoType = $_FILES['photo']['type'];
                    $photoSize = $_FILES['photo']['size'];
            
                    // Définir le répertoire de destination
                    $destinationFolder = '/Users/mohamed/Documents/photosHospitime';
                    $photoDestination = $destinationFolder . $photoName;
            
                    // Déplacer le fichier vers le répertoire de destination
                    if (move_uploaded_file($photoTmpName, $photoDestination)) {
                        // Préparation de la requête SQL pour les médecins avec la photo
                        $sql = "INSERT INTO medecin (nom, prenom, genre, telephone, email, etablissement, specialite, photo)
                                VALUES ('$nom', '$prenom', '$genre', '$telephone', '$email', '$etablissement', '$specialite', '$photoDestination')";
            
                        // Exécution de la requête pour les médecins
                        if ($conn->query($sql) === TRUE) {
                            echo "Les données des médecins ont été ajoutées avec succès.";
                        } else {
                            echo "Erreur lors de l'ajout des données des médecins : " . $conn->error;
                        }
                    } else {
                        echo "Erreur lors du téléchargement de la photo : impossible de déplacer le fichier.";
                    }
                } else {
                    // Préparation de la requête SQL pour les médecins sans la photo
                    $sql = "INSERT INTO medecin (nom, prenom, genre, telephone, email, etablissement, specialite)
                            VALUES ('$nom', '$prenom', '$genre', '$telephone', '$email', '$etablissement', '$specialite')";
            
                    // Exécution de la requête pour les médecins
                    if ($conn->query($sql) === TRUE) {
                        echo "Les données des médecins ont été ajoutées avec succès.";
                    } else {
                        echo "Erreur lors de l'ajout des données des médecins : " . $conn->error;
                    }
                }
            
                // Récupérer le chemin de la photo de profil du médecin
                $medecinId = $conn->insert_id;
               
                $sql = "SELECT medecin FROM medecin WHERE id = $medecinId";
                $result = $conn->query($sql);
            
                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $photoPath = $row['photo'];
                } else {
                    $photoPath = "/Users/mohamed/Documents/drMed.jpeg/";
                }
            }
           }
        
            ?>
        <!-- Affichage de la photo de profil -->
        
        


    <?php
        $searchResults = []; // Tableau pour stocker les résultats de recherche

        if (isset($_GET['query'])) {
            $searchTerm = $_GET['query'];

            // Requête SQL pour récupérer les données correspondant au terme de recherche
            $sql = "SELECT nom, prenom, genre, email, telephone, etablissement, specialite FROM medecin WHERE nom LIKE '%$searchTerm%' OR prenom LIKE '%$searchTerm%' OR etablissement LIKE '%$searchTerm%' OR specialite LIKE '%$searchTerm%'";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $searchResults[] = $row;
                }
            } else {
                $searchResults = [];
            }
        }

        // Charger le template et passer les variables
        echo $twig->render('index.twig', ['searchResults' => $searchResults, 'searchTerm']);
        $conn->close();
    ?>

    <!-- Pied de page -->
    <footer>
        <!-- Votre contenu de footer ici -->
        <p>© 2023 HospiTime. Tous droits réservés.</p>
    </footer>
</body>
</html>
