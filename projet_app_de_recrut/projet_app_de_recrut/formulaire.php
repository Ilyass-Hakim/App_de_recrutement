<?php
// Informations de connexion à la base de données
$dsn = 'mysql:host=localhost;dbname=projet';
$username = 'root';
$password = '';

try {
    // Créer une connexion à la base de données
    $db = new PDO($dsn, $username, $password);

    // Définir le mode d'erreur PDO sur exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // En cas d'erreur de connexion à la base de données
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
}

    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données soumises
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $date_of_birth = $_POST['date_of_birth'];
        $gender = $_POST['gender'];
        $marital_status = $_POST['marital_status'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $degree = $_POST['degree'];
        $university_college = $_POST['university_college'];
        $level = $_POST['level'];
        $additional_information = $_POST['additional_information'];
        $company_name = $_POST['company_name'];
        $job_position = $_POST['job_position'];
        $location = $_POST['location'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $additional_information_exp = $_POST['additional_information_exp'];
        $langue = $_POST['langue'];
        $competences_interpersonnelles = $_POST['competences_interpersonnelles'];
        $competences_techniques = $_POST['competences_techniques'];
        $additional_information_skill = $_POST['additional_information_skill'];

        try{ // Requête SQL pour insérer les données dans la base de données
        $sql = "INSERT INTO infocandidat (first_name, last_name, date_of_birth, gender, marital_status, city, country, phone, email, address, degree, university_college, level, additional_information, company_name, job_position, location, start_date, end_date, additional_information_exp, langue, competences_interpersonnelles, competences_techniques, additional_information_skill) 
        VALUES (:first_name, :last_name, :date_of_birth, :gender, :marital_status, :city, :country, :phone, :email, :address, :degree, :university_college, :level, :additional_information, :company_name, :job_position, :location, :start_date, :end_date, :additional_information_exp, :langue, :competences_interpersonnelles, :competences_techniques, :additional_information_skill)";

        // Préparer la requête pour éviter les injections SQL
        $stmt = $db->prepare($sql);

        // Liaison des paramètres
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':date_of_birth', $date_of_birth);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':marital_status', $marital_status);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':degree', $degree);
        $stmt->bindParam(':university_college', $university_college);
        $stmt->bindParam(':level', $level);
        $stmt->bindParam(':additional_information', $additional_information);
        $stmt->bindParam(':company_name', $company_name);
        $stmt->bindParam(':job_position', $job_position);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':start_date', $start_date);
        $stmt->bindParam(':end_date', $end_date);
        $stmt->bindParam(':additional_information_exp', $additional_information_exp);
        $stmt->bindParam(':langue', $langue);
        $stmt->bindParam(':competences_interpersonnelles', $competences_interpersonnelles);
        $stmt->bindParam(':competences_techniques', $competences_techniques);
        $stmt->bindParam(':additional_information_skill', $additional_information_skill);
    
        // Exécuter la requête avec les données fournies par l'utilisateur
        $stmt->execute();

    }catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    } 
    } 

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Formulaire</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link href="formulaire.css" rel="stylesheet">
    <link href="sidebar_candidat.css" rel="stylesheet">
</head>


<body>
  
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


                    <a href="offre_emploi_candidat.php">
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
                            <h4>Deconnexion</h4>
                        </li>
                    </a>

                </ul>
            </div>
     <!--fin sidebar-->
   </header>

   <main>
    
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="text-dark">General Information</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="job-detail mt-2 p-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="resume-user mb-5">
                                <i class="mdi mdi-account text-white"></i>
                                <i class="fa-regular fa-user"></i>
                            </div>
                        </div>
                    </div>

                    <div class="custom-form">
                        <form action="formulaire.php" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label for="frist-name" class="text-muted">Prénom</label>
                                        <input id="frist-name" name="first_name" type="text" class="form-control resume" placeholder="mon prenom">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label for="surname-name" class="text-muted">Nom</label>
                                        <input id="surname-name" name="last_name" type="text" class="form-control resume" placeholder="mon nom">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label for="date-of-birth" class="text-muted">Date de naissance</label>
                                        <input id="date-of-birth" name="date_of_birth" type="date" class="form-control resume" placeholder="13-02-1999">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label for="General" class="text-muted">Sexe</label>
                                        <div class="form-button">
                                            <select class="nice-select" name="gender">
                                                <option data-display="General">Sexe</option>
                                                <option value="homme">homme</option>
                                                <option value="femme">Femme</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label for="marital-status" class="text-muted">État Civil</label>
                                        <div class="form-button">
                                            <select class="nice-select" name="marital_status">
                                                <option data-display="Status">Status</option>
                                                <option value="célibataire">célibataire</option>
                                                <option value="marié">marié</option>
                                                <option value="mariée">mariée</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h3 class="text-dark mt-5">Contact Information</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="job-detail mt-2 p-4">
                    <div class="custom-form">
                        
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group app-label">
                                        <label for="ville" class="text-muted">Ville</label>
                                        <input id="ville" name="city" type="text" class="form-control resume" placeholder="Rabat">
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group app-label">
                                        <label for="pays" class="text-muted">Pays</label>
                                        <input id="pays" name="country" type="text" class="form-control resume" placeholder="Maroc">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group app-label">
                                        <label for="phone" class="text-muted">Phone</label>
                                        <input id="phone" name="phone" type="tel" class="form-control resume" placeholder="">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group app-label">
                                        <label for="e-mail" class="text-muted">E-mail</label>
                                        <input id="e-mail" name="email" type="email" class="form-control resume" placeholder="mon_email@gmail.com">
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="form-group app-label">
                                        <label for="address">Address</label>
                                        <textarea id="address" name="address" rows="4" class="form-control resume" placeholder=""></textarea>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <!----formation--> 
        <div class="row">
            <div class="col-lg-12">
                <h3 class="text-dark mt-5">Formation</h3>
            </div>
        </div>

        <div class="row" id="container">
            <div class="col-lg-12">
                <div class="job-detail mt-2 p-4" id="originalContent">
                    <div class="custom-form">
                        
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label for="graduation" class="text-muted">Diplôme</label>
                                        <input id="graduation" name="degree" type="text" class="form-control resume" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label for="university/college" class="text-muted">université/collège</label>
                                        <input id="university/college" name="university_college" type="text" class="form-control resume" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group app-label">
                                                <label for="level" class="text-muted"></label>
                                                <div class="form-button">
                                                    <select class="nice-select" name="level">
                                                        <option data-display="Select">Mention</option>
                                                        <option value="Level-1">Passable</option>
                                                        <option value="Level-2">Assez-bien</option>
                                                        <option value="Level-3">Bien</option>
                                                        <option value="Level-4">Tres-bien</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group app-label">
                                        <label for="addition-information">Addition Information</label>
                                        <textarea id="addition-information" name="additional_information" rows="4" class="form-control resume" placeholder=""></textarea>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <input type="button" id="duplicateButton"  class="submitBnt btn btn-secondary mt-5" value="Ajouter Formation">
                </div>
            </div>
        </div>
        <!--Experience-->
        <div class="row" >
            <div class="col-lg-12">
                <h3 class="text-dark mt-5">Experience</h3>
            </div>
        </div>

        <div class="row" id="container_exp">
            <div class="col-lg-12">
                <div class="job-detail mt-2 p-4" id="originalContent_exp">
                    <div class="custom-form">
                        
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label for="company-name" class="text-muted">Nom de l'entreprise</label>
                                        <input id="company-name" name="company_name" type="text" class="form-control resume" placeholder="">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label for="job-position" class="text-muted">poste de travail</label>
                                        <input id="job-position" name="job_position" type="text" class="form-control resume" placeholder="">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group app-label">
                                        <label for="job-position" class="text-muted">Lieu</label>
                                        <input id="job-position" name="location" type="text" class="form-control resume" placeholder="">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group app-label">
                                                <label for="date-from" class="text-muted">Date de début</label>
                                                <input id="date-from" name="start_date" type="date" class="form-control resume" placeholder="01-Jan-2018">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group app-label">
                                                <label for="date-to" class="text-muted">Date de fin</label>
                                                <input id="date-to" name="end_date" type="date" class="form-control resume" placeholder="31-March-2019">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group app-label">
                                        <label for="addition-information-1">Addition Information</label>
                                        <textarea id="addition-information-1" name="additional_information_exp" rows="4" class="form-control resume" placeholder=""></textarea>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <input type="button" id="duplicateButton_exp"  class="submitBnt btn btn-secondary mt-5" value="Ajouter Experience">
                </div>
            </div>
        </div>
        <!--skills-->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="text-dark mt-5">Compétences</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="job-detail mt-2 p-4">
                    <div class="custom-form">
                        
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group app-label">
                                        <label for="level" class="text-muted"></label>
                                        <div class="form-button">
                                            <select class="nice-select" name="langue">
                                                <option data-display="Select">Langue</option>
                                                <option value="Level-1">Arabe</option>
                                                <option value="Level-2">Francais</option>
                                                <option value="Level-3">Anglais</option>
                                                <option value="Level-4">Espagnol</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group app-label">
                                        <label for="skills" class="text-muted">Compétences interpersonnelles</label>
                                        <input id="skills" name="competences_interpersonnelles" type="text" class="form-control resume" placeholder="Travail d'équipe-Empathie-...">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group app-label">
                                        <label for="skill proficiency" class="text-muted">Compétences techniques</label>
                                        <input id="skill proficiency" name="competences_techniques" type="text" class="form-control resume" placeholder=" langages de programmation-logiciels-outils-...">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group app-label">
                                        <label for="addition-information-1">Addition Information</label>
                                        <textarea id="addition-information-1" name="additional_information_skill" rows="4" class="form-control resume" placeholder=""></textarea>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                        <input type="submit" id="submit" name="send" class="submitBnt btn btn-secondary mt-5" value="Submit Resume">
                    
                </div>
            </div>
        </div>
</form>
    </div>
</main>

    <script>
        document.getElementById('duplicateButton').addEventListener('click', function() {
            // Sélectionnez le contenu que vous souhaitez dupliquer
            var originalContent = document.getElementById('originalContent').outerHTML;
    
            // Créez un nouvel élément pour contenir le contenu dupliqué
            var duplicatedElement = document.createElement('div');
            duplicatedElement.innerHTML = originalContent;
    
            // Insérez le contenu dupliqué après l'élément original
            var container = document.getElementById('container');
            container.appendChild(duplicatedElement.firstChild); // Ajoutez seulement le premier enfant pour éviter l'ajout de l'élément parent
        });



        document.getElementById('duplicateButton_exp').addEventListener('click', function() {
            // Sélectionnez le contenu que vous souhaitez dupliquer
            var originalContent = document.getElementById('originalContent_exp').outerHTML;
    
            // Créez un nouvel élément pour contenir le contenu dupliqué
            var duplicatedElement = document.createElement('div');
            duplicatedElement.innerHTML = originalContent;
    
            // Insérez le contenu dupliqué après l'élément original
            var container = document.getElementById('container_exp');
            container.appendChild(duplicatedElement.firstChild); // Ajoutez seulement le premier enfant pour éviter l'ajout de l'élément parent
        });
    </script>
</body>
</html>
