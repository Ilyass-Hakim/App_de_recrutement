<?php 
session_start(); 

include 'score.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit(); 
}

$dsn = 'mysql:host=localhost;dbname=formulaire';
$username = 'root';
$password = '';
try {
    // Créer une connexion à la base de données
    $bdd = new PDO($dsn, $username, $password);

    // Définir le mode d'erreur PDO sur exception
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // En cas d'erreur de connexion à la base de données
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
    exit(); // Arrêtez l'exécution du script en cas d'erreur de connexion à la base de données
}

// Requête pour récupérer les informations du candidat à partir de son ID utilisateur
$req = $bdd->prepare('SELECT first_name, last_name, date_of_birth, city FROM infocandidat WHERE id = ?');
$req->execute(array($_SESSION['user_id']));
$candidat = $req->fetch(PDO::FETCH_ASSOC);

// Requête pour compter les compétences interpersonnelles du candidat
$ec = $bdd->prepare('SELECT COUNT(competences_interpersonnelles) AS nbr FROM infocandidat WHERE id = ?');
$ec->execute(array($_SESSION['user_id']));
$competences = $ec->fetch(PDO::FETCH_ASSOC);
$competences_count = $competences['nbr'];

// Requête pour compter les loisirs du candidat
$ef = $bdd->prepare('SELECT COUNT(additional_information_skill) AS lis FROM infocandidat WHERE id = ?');
$ef->execute(array($_SESSION['user_id']));
$loisirs = $ef->fetch(PDO::FETCH_ASSOC);
$loisirs_count = $loisirs['lis'];

// Requête pour compter les langues du candidat
$lg = $bdd->prepare('SELECT COUNT(langue) AS lgg FROM infocandidat WHERE id = ?');
$lg->execute(array($_SESSION['user_id']));
$langues = $lg->fetch(PDO::FETCH_ASSOC);
$langues_count = $langues['lgg'];

// Requête pour compter les expériences professionnelles du candidat
$e = $bdd->prepare('SELECT COUNT(additional_information_exp) AS prc FROM infocandidat WHERE id = ?');
$e->execute(array($_SESSION['user_id']));
$experience = $e->fetch(PDO::FETCH_ASSOC);
$experience_count = $experience['prc'];

// Calcul du score du candidat
$score = score($competences_count, $loisirs_count, $experience_count, $langues_count, $experience_count);

// Calcul du niveau de diplôme du candidat
$formation = $bdd->prepare('SELECT start_date, end_date FROM infocandidat WHERE id = ?');
$formation->execute(array($_SESSION['user_id']));
$s = -1;
while ($donne = $formation->fetch(PDO::FETCH_ASSOC)) {
    $s = $donne['end_date'] - $donne['start_date'] + $s;
}
if ($s == -1) {
    $niveau_diplome = 'niveau bac';
} else {
    $niveau_diplome = 'bac+' . ($s + 1);
}
$score_diplome = ($s + 1) * 10;
?>  
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- Material icon -->
        
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="frontstyle/acceuil_recruteur.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
     <link
            href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"
            rel="stylesheet"
        />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link rel="stylesheet" href="frontstyle/styles.css" />
      
        <title>Dashboard</title>
    </head>

    <body>
        <div class="dashboard-container">
            <!-- Sidebar -->

            <aside class="main-sidebar">
                <header class="aside-header">
                    <div class="close" id="closeSidebar">
                        <span class="material-icons-sharp"> close </span>
                    </div>
                    <div class="side-bar">
                        <a class="Logo" href="#">
                            <img src="img_recruteur/logo.png" alt="logo"> <br>
                           <h1 class="b"> <span class="text-warning">Hire</span>wave</h1>
                        </a>
                        <ul>
        
                             <a href="acceuil_recruteur.html">
                                <li class="Acceuil" >
                                    <i class="fa-solid fa-door-open" ></i>
                                    <h4>Acceuil</h4>
                                </li>
                             </a>
                            
                             <a href="#">
                                <li class="Gerer-candidats">
                                    <i class="fa-regular fa-rectangle-list"></i>
                                    <h4>Gerer candidats</h4>
                                </li>
                             </a> 
        
        
                             <a href="#">
                                <li class="offre-emploi">
                                    <i class="fas fa-list"></i>
                                    <h4>Offre d'emploi</h4>
                                </li>
                             </a>  
                            
                             <a href="#" >
                                <li class="messages">
                                    <i class="fa-regular fa-message"></i>
                                   <h4>Messages</h4>
                               </li>
                            </a>
        
                            <a href="#" >
                                <li class="dashboard">
                                    <i class="fa-solid fa-chart-line"></i>
                                   <h4>Dashboard</h4>
                               </li>
                            </a>
        
        
                             <a href="#">
                                <li class="sign-out">
                                    <i class="fas fa-arrow-right-from-bracket"></i>
                                    <h4>Sign out</h4>
                                </li>
                             </a>
        
                        </ul>
                    </div>
                </header>
            </aside>
             

            <!-- Main -->
            <main class="main-container">
                <h1 class="main-title">Dashboard</h1>
                <!-- CARD -->
                <div class="insights">
                    <div class="card">
                        <div class="card-container">
                            <div class="card-header">
                                <span class="material-icons-sharp">
                                    bar_chart
                                </span>
                            </div>
                            <div class="card-body">
                                <div class="card-info">
                                    <h1>le score</h1>
                                </div>

                                <div class="card-progress">
                                    <svg width="96" height="96">
                                        <circle
                                            id="circle1"
                                            cx="38"
                                            cy="38"
                                            r="36"
                                            class="stroke-yellow"
                                        ></circle>
                                    </svg>
                                    <div class="percentage">
                                    <p><?php echo $score; ?></p>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-container">
                            <div class="card-header">
                                <span class="material-symbols-outlined">
                                     school
                                 </span>
                            </div>
                            <div class="card-body">
                                <div class="card-info">
                                    <h3>Niveau de diplôme</h3>
                                    <h1> <?php echo $niveau_diplome; ?> </h1>
                                </div>

                                <div class="card-progress">
                                    <svg width="96" height="96">
                                        <circle
                                            id="circle2"
                                            cx="38"
                                            cy="38"
                                            r="36"
                                            class="stroke-fuscha"
                                        ></circle>
                                    </svg>
                                    <div class="percentage">
                                           <p><?php echo  $score_diplome?></p>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-container">
                            <div class="card-header">
                                <span class="material-symbols-outlined">
                              work
                             </span>
                            </div>
                            <div class="card-body">
                                <div class="card-info">
                                    <h3>experience professionnel</h3>
                    
                                </div>

                                <div class="card-progress">
                                    <svg
                                        width="90"
                                        height="96"
                                        class="stroke-cyan"
                                    >
                                        <circle
                                            id="circle3"
                                            cx="38"
                                            cy="38"
                                            r="36"
                                        ></circle>
                                    </svg>
                                    <div class="percentage">
                                             <p><?php echo $p ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <div class="recent-updates">
        <h2>les exprences </h2>
        <div class="updates-container">
        <?php
           while ($donnes = $exx->fetch()) {
                echo '<div class="update">
                <div class="message">
                <p><strong>' . $donnes['date_debut'] . '_' . $donnes['date_fin'] . '</strong> <br>
                ' . $donnes['description'] . '</p>
                   </div>
                </div>';
                 }
                 $exx->closeCursor();
                ?>
            </div>
            </div>
           </section>
            </main>

            <!-- Sidebar droite -->
            <aside class="extrabar">
                <header class="header-right">
                    <button class="toggle-menu-btn" id="openSidebar">
                        <span class="material-icons-sharp"> menu </span>
                    </button>

                    <div class="toggle-theme">
                        <span class="material-icons-sharp active">
                            tungsten
                        </span>
                        <span class="material-icons-sharp"> dark_mode </span>
                    </div>
                    <div class="profile">
                        <div class="profile-info">
                            <p>Salut, <strong>
                            <?php echo $candidat['first_name'] . ' ' . $candidat['last_name']; ?>
                            ?></strong></p>
                            <small>condidat</small>
                        </div>
                        <div class="profile-image">
                            <img src="team-4.jpg" alt="" width="100%" />
                        </div>
                    </div>
                </header>

                <!--  profil  -->
                <div class="recent-updates">
                    <h2> About me </h2>
                    <div class="updates-container">
                        <div class="update">
                            <div class="message">
                                <p>
                                    <?php
                               echo "Je m'appelle".$m.'né le'.$candidat['date_of_birth'].', résidant à '.$candidat['city'].' En tant que candidat passionné et ambitieux, je cherche activement de nouvelles opportunités professionnelles pour mettre à profit mes compétences et mon expérience.';
                                ?>
                                </p>
                            </div>
                        </div>

                <!-- Stat -->
                <div class="analytics">
                    <h2>Niveau de langue</h2>
                    
                  <div class="order-details">
                      <div class="card-head">
                            <h2>Arabe</h2>
                      </div>
                        <div class="card-progress">
                         <div class="card-indicator">
                <div class="indicator three" style="width: 100%"></div>
            </div>
    </div>
</div>
                
               
                      
                <div class="order-details">
                <div class="info">
              
                <div class="card-head">
                <h2>English</h2>
                </div>
                <div class="card-progress">
                <div class="card-indicator">
                <div class="indicator two" style="width: 70%"></div>
                </div>
                </div>
                </div>
                </div>

                <div class="order-details">
                <div class="info">
                
                <div class="card-head">
                <h2>francais</h2>
                </div>
                <div class="card-progress">
                <div class="card-indicator">
                <div class="indicator four" style="width: 55%"></div>
                </div>
                </div>
                </div>
                </div>
                </div>
                 
                </div>
            </aside>
        </div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="scriptborder/script.js"></script>
    </body>
</html>
