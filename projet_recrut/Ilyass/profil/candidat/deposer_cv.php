<?php

// Include the TesseractOCR class
use thiagoalessio\TesseractOCR\TesseractOCR;

// Include Composer autoloader
require 'vendor/autoload.php';

// Check if the form has been submitted using the POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the 'submit' button is set in the form
    if (isset($_POST['submit'])) {

        // Get the name and temporary location of the uploaded file
        $file_name = $_FILES['file']['name'];
        $tmp_file = $_FILES['file']['tmp_name'];

        // Start a session and generate a unique session ID if not already started
        if (!session_id()) {
            session_start();
            $unq = session_id();
        }

        // Generate a unique file name using the current timestamp and replacing certain characters
        $file_name = uniqid() . '_' . time() . '_' . str_replace(
            array('!', "@", '#', '$', '%', '^', '&', ' ', '*', '(', ')', ':', ';', ',', '?', '/' . '\\', '~', '`', '-'),
            '_',
            strtolower($file_name)
        );

        // Move the uploaded file to the 'uploads' directory with the unique file name
        if (move_uploaded_file($tmp_file, 'uploads/' . $file_name)) {
            try {
                // Use TesseractOCR to read text from the uploaded image file
                $fileRead = (new TesseractOCR('uploads/' . $file_name))
                    ->setLanguage('eng')
                    ->run();
            } catch (Exception $e) {
                // Handle exceptions (e.g., TesseractOCR library not installed or configured)
                echo $e->getMessage();
            }
        } else {
            // Display an error message if the file fails to upload
            echo "<p class='alert alert-danger'>File failed to upload.</p>";
        }

        //mon propre code 
        
        
        
        // Les mots spécifiques que vous voulez rechercher
        $mots_specifiques = array("unique", "candy", "Table","Mr","december");
        
        // Initialiser le tableau pour stocker les mots trouvés
        $mots_trouves = array();
        
        // Rechercher les mots spécifiques dans le texte
        foreach ($mots_specifiques as $mot) {
            // Utiliser une expression régulière pour rechercher le mot dans le texte (insensible à la casse)
            if (preg_match_all("/\b$mot\b/i", $fileRead, $matches)) {
                // Ajouter les mots trouvés au tableau
                $mots_trouves = array_merge($mots_trouves, $matches[0]);
            }
        }
        
        // Afficher le tableau des mots trouvés
        
        
        

    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="deposer_cv.css">
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
            <!--sidebar-->
            <div class="side-bar">
                <a class="Logo" href="#">
                    <img src="img_candidat/logo.png" alt="logo"> <br>
                   <h1> <span class="text-warning">Hire</span>wave</h1>
                </a>
                 <ul>
                    
                     <a href="acceuil_candidat.html">
                        <li class="Acceuil" >
                            <i class="fa-solid fa-door-open" ></i>
                            <h4>Acceuil</h4>
                        </li>
                     </a>
                    
                     <a href="#">
                        <li class="Formul">
                            <i class="fa-regular fa-address-card"></i>
                            <h4>Formulaire</h4>
                        </li>
                     </a> 


                     <a href="#">
                        <li class="offre-emploi">
                            <i class="fas fa-list"></i>
                            <h4>Offre d'emploi</h4>
                        </li>
                     </a>  
                    
                     <a href="deposer_cv.html" >
                         <li class="deposer-cv">
                            <i class="far fa-file"></i>
                            <h4>Déposer CV</h4>
                        </li>
                     </a>

                     <a href="#" >
                        <li class="messages">
                            <i class="fa-regular fa-message"></i>
                           <h4>Messages</h4>
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
        <!--profile side -->
               <div class="cv-side">

                        <div class="header-cv">
                                <h1 id="attractive-question">
                                    Deposer votre Cv 
                                </h1>  
                                <p class="lead">


                        <?php if ($_POST) : ?>
                            <pre>
                                <?= print_r($mots_trouves); ?>
                            </pre>
                        <?php endif; ?>


                </p>
                        </div>
                        
                        <div class="cv-img">
                            <img src="img_candidat/Sans titre-1.png" alt="un homme creer un cv">
                        </div>
                            <div class="variants">
                              
                              

                              <form action="" method="post" enctype="multipart/form-data">
                                   <div class="form-group">
                                      <div class='file'>
                                        <label for="filechoose">
                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                        Choose file
                                        </label>
                                        <input id="filechoose" type="file" name ="file" />
                                      </div>      
                                      <button class="btn btn-success mt-3" type="submit" name="submit">Upload</button>

                                    </div>
                             </form>
                             
                            </div>
                          
                        
                 
               </div>
        </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
