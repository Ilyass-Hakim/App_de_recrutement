<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des candidats</title>
    <style>
        .candidate {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }
        .candidate h2 {
            margin-top: 0;
        }
    </style>
</head>

<body>
                   <div class="full-container">
                                <header>
                                        <!--sidebar-->
                                            <div class="side-bar">

                                                <a class="Logo" href="Home.html">
                                                    <img src="img_candidat/logo.png" alt="logo"> <br>
                                                <h1> <span class="text-warning">Hire</span>wave</h1>
                                                </a>
                                                
                                                <ul>

                                                    <a href="acceuil_candidat.php">
                                                        <li class="Acceuil" >
                                                            <i class="fa-solid fa-door-open" ></i>
                                                            <h4>Acceuil</h4>
                                                        </li>
                                                    </a>
                                                    
                                                    <a href="formulaire.php">
                                                        <li class="Formul">
                                                            <i class="fa-regular fa-address-card"></i>
                                                            <h4>Formulaire</h4>
                                                        </li>
                                                    </a> 


                                                    <a href="offre-emploi.php">
                                                        <li class="offre-emploi">
                                                            <i class="fas fa-list"></i>
                                                            <h4>Offre d'emploi</h4>
                                                        </li>
                                                    </a>  
                                                    
                                                    <a href="deposer_cv.php" >
                                                        <li class="deposer-cv">
                                                            <i class="far fa-file"></i>
                                                            <h4>Déposer CV</h4>
                                                        </li>
                                                    </a>

                                                    <a href="messages.php" >
                                                        <li class="messages">
                                                            <i class="fa-regular fa-message"></i>
                                                        <h4>Messages</h4>
                                                    </li>
                                                    </a>

                                                    <a href="Home.html">
                                                        <li class="sign-out">
                                                            <i class="fas fa-arrow-right-from-bracket"></i>
                                                            <h4>Sign out</h4>
                                                        </li>
                                                    </a>

                                                </ul>
                                            </div>
                                    <!--fin sidebar-->
                                </header>
   <div class="profile-side">
    <h1>Liste des candidats</h1>

    <div class="candidates">
     
        <?php
        // Connexion à la base de données
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=projet", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }

        // Requête pour sélectionner les candidats
        $query = $pdo->prepare("SELECT id,first_name, last_name, email FROM infocandidat");
        $query->execute();

        // Affichage des données sous forme de div
        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='candidate'>";
            echo "<h2>" . htmlspecialchars($row['id'] . ' ' . $row['first_name']) . "</h2>";
            echo "<p><strong>Email:</strong> " . htmlspecialchars($row['email']) . "</p>";
            echo "</div>";
        }

        // Fermeture de la connexion
        $pdo = null;
        ?>

    </div>
   </div>
</div>
</body>

</html>
