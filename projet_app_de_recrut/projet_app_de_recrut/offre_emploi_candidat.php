<?php
// Informations de connexion à la base de données
$dsn = 'mysql:host=localhost;dbname=projet';
$username = 'root';
$password = '';

try {
    // Créer une connexion à la base de données
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Préparer et exécuter la requête SQL
    $req = $db->query('SELECT o.titre, u.username, o.lieu, o.date_offre, o.description
                  FROM offre_emploi o
                  INNER JOIN users u ON o.id_recruteur = u.id
                  where u.employment=0');
    
         
} catch(PDOException $e) {
    // En cas d'erreur de connexion à la base de données
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
    exit; // Arrête l'exécution du script en cas d'erreur de connexion
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="sidebar_candidat.css">
    <link rel="stylesheet" href="offre_emploi.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <title>Candidat</title>

    
</head>
<body>
<div class="full-container">
    <!--sidebar_ candidat-->
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
            <h4>Déconnexion</h4>
        </li>
     </a>

</ul>
</div>
    <!--offre-emploi side -->

    <div class="offres">
        <div class="head">
            <h1>Recherche d'emploi</h1>
            
        <!-- ------------------------------------------------------------------------------------------->
        <div class="main">
            <section class="offres-recentes">
                <h2>Offres à la une</h2>
                <ul id="offres-list">
                    <?php
                    if(isset($req)) {
                        while ($donnees = $req->fetch()) {
                            echo '<li class="offre">
                                    <div class="offre-frame">
                                        <h3 class=title>' . $donnees['titre'] . '</h3>
                                        <p><span class=st>RH</span>:   ' . $donnees['username'] . '</p>
                                        <p><span class=st>Lieu</span>:   ' . $donnees['lieu'] . '</p>
                                        <p><span class=st>Date</span>:    ' . $donnees['date_offre'] . '</p>
                                        <p><strong><span class=st>Description</span>:</strong>    ' . $donnees['description'] . '</p>
                                        <button  id="submit-btn">Postuler</button>
                                    </div>
                                </li>';
                        }
                    } else {
                        echo "Aucune offre d'emploi disponible.";
                    }
                    ?>
                    <!-- Ajoutez d'autres offres d'emploi ici -->
                </ul>
            </section>
            
        </div>
        <br><br><br>
          
        
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="index.js"></script>
</body>
</html>
