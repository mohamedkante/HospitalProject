<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma page </title>
</head>
<body>
    <!DOCTYPE html>
<html>
<head>
	<title> Hospitime </title>
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
		
		// while ($row = mysqli_fetch_assoc($result)) {
		// 	echo '<p>' . $row['consultation'] . ' ' . $row['patients '] . '</p>';
		// }
		
		mysqli_close($conn);
	?>
</body>
</html>

</body>
</html>