<?php
// Paramètres de connexion à la base de données
$dsn = "mysql:host=localhost;dbname=projet";
$username = "root";
$password = "";

// Création d'une nouvelle connexion PDO
try {
    $conn = new PDO($dsn, $username, $password);
    // Configuration pour afficher les exceptions en cas d'erreur
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    
}

// Traitement du formulaire d'inscription
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username2']) && isset($_POST['email']) && isset($_POST['password2']) && isset($_POST['employment'])) {
    $username = $_POST['username2'];
    $email = $_POST['email'];
    $password = $_POST['password2'];
    $employment = $_POST['employment'] == 'Candidat' ? 1 : 0; 

    try {
        // Préparation de la requête SQL d'insertion
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, employment)
		 VALUES (:username, :email, :password, :employment)");

        // Liaison des valeurs des paramètres
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':employment', $employment, PDO::PARAM_BOOL); // Spécification du type de paramètre

        // Exécution de la requête préparée
        $stmt->execute();

        echo "Inscription réussie!";
    } catch (PDOException $e) {
        
    }
}

// Traitement du formulaire de connexion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username1']) && isset($_POST['password1'])) {
    $username = $_POST['username1'];
    $password = $_POST['password1'];

    try {
        // Préparation de la requête SQL de sélection
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=:username AND password=:password");
        
        // Liaison des valeurs des paramètres
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        
        // Exécution de la requête préparée
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
			// Récupérer le type d'utilisateur à partir de la base de données
			$user = $stmt->fetch(PDO::FETCH_ASSOC);
			$employment = $user['employment'];
			
			// Redirection en fonction du type d'emploi
			if ($employment == 1) {
				header("Location: acceuil_candidat.php"); // Rediriger vers la page des candidats
				exit();
			} elseif ($employment == 0) {
				header("Location: acceuil_recruteur.php"); // Rediriger vers la page des recruteurs
				exit();
			}
		} else {
			
		}
		
    } catch (PDOException $e) {
        
    }
}

// Fermeture de la connexion à la base de données
$conn = null;
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="signup.css" />
	<title>Sign in & Sign up Form</title>
</head>

<body>
	<div class="container">

		<div class="forms-container">

			<div class="signin-signup">

				<form action="signup.php" method="post" class="sign-in-form">
					<h2 class="title">Connectez-vous</h2>

					<div class="input-field">
						<i class="fas fa-user"></i>
						<input type="text" placeholder="Username" name="username1" required />
					</div>

					<div class="input-field">
						<i class="fas fa-lock"></i>
						<input type="password" placeholder="Password" name="password1" required />
					</div>

					<input type="submit" value="Connectez-vous" class="btn solid" />
				</form>

				<form action="signup.php" method="post" class="sign-up-form">

				<h2 class="title">Inscrivez-vous</h2>

				<div class="input-field">
					<i class="fas fa-user"></i>
					<input type="text" placeholder="Username" name="username2" required />
				</div>

				<div class="input-field">
					<i class="fas fa-envelope"></i>
					<input type="email" placeholder="Email" name="email" required />
				</div>

				<div class="input-field">
					<i class="fas fa-lock"></i>
					<input type="password" placeholder="Password" name="password2" required />
				</div>

				<div class="radio-field">
					<input type="radio" id="candidat" name="employment" value="Candidat" required>
					<label for="candidat">Candidat</label>

					<input type="radio" id="recruteur" name="employment" value="Recruteur" required>
					<label for="recruteur">Recruteur</label>
				</div>

				<input type="submit" class="btn" value="Inscrivez-vous" />
			</form>


			</div>
			
		</div>

		<div class="panels-container">
			<div class="panel left-panel">
				<div class="content">
					<h3>Nouveau dans notre communauté ?</h3>
					<p>
						Libérez votre potentiel professionnel ! Rejoignez notre communauté et commencez votre parcours en créant un nouveau compte
					</p>
					<button class="btn transparent" id="sign-up-btn">
						Inscrivez-vous
					</button>
				</div>
				<img  src="signing_img/illustration-2.png" class="image" alt="" />
			</div>
			<div class="panel right-panel">
				<div class="content">
					<h3>Un de nos membres précieux</h3>
					<p>
						Bon retour ! Prêt à vous connecter aux opportunités ? Connectez-vous à votre compte
					</p>
					<button class="btn transparent" id="sign-in-btn">
						Connectez-vous
					</button>
				</div>
				<img src="https://i.ibb.co/nP8H853/Mobile-login-rafiki.png"  class="image" alt="" />
			</div>
		</div>
	</div>

	<script src="signup.js"></script>
</body>

</html>