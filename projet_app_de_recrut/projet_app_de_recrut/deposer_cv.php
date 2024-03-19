<?php
error_reporting(0); // Désactiver l'affichage des erreurs
 $dsn = 'mysql:host=localhost;dbname=projet';
 $username = 'root';
 $password = '';
 
 try {
     $db = new PDO($dsn, $username, $password);
 
   
     
 } catch(PDOException $e) {
    
   
 }


// Include la TesseractOCR classe
use thiagoalessio\TesseractOCR\TesseractOCR;

// Include le Composer autoloader
require 'vendor/autoload.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['submit'])) {

       
        $file_name = $_FILES['file']['name'];
        $tmp_file = $_FILES['file']['tmp_name'];

       
        if (!session_id()) {
            session_start();
            $unq = session_id();
        }

       
        $file_name = uniqid() . '_' . time() . '_' . str_replace(
            array('!', "@", '#', '$', '%', '^', '&', ' ', '*', '(', ')', ':', ';', ',', '?', '/' . '\\', '~', '`', '-'),
            '_',
            strtolower($file_name)
        );

       
        if (move_uploaded_file($tmp_file, 'uploads/' . $file_name)) {
            try {
                
                $fileRead = (new TesseractOCR('uploads/' . $file_name))
                    ->setLanguage('eng')
                    ->run();
            } catch (Exception $e) {
            }
        } else {
           
            echo "<p class='alert alert-danger'>File failed to upload.</p>";
        }

       
        $mots_trouves = array();
        
        // Rechercher les mots spécifiques dans le texte
       
        
        /**les tableaux de references :**/

        /*les informations personnelles*/

        //les noms
        $names = array(

            "Mohammed", "Fatima", "Ahmed", "Khadija", "Youssef", 
            "Amina", "Omar", "Zineb", "Hicham", "Salma", 
            "Hassan", "Soukaina", "Rachid", "Malika", "Abdelilah", 
            "Sanaa", "Said", "Naima", "Abdelali", "Hind", 
            "Abdelaziz", "Samira", "Mustapha", "Imane", "Abdelhak", 
            "Rania", "Amine", "Asma", "Khalid", "Meryem", 
            "Hamza", "Najat", "Jamal", "Oumaima", "Nabil","Hakim" ,
            "Ines", "Reda", "Siham", "Brahim", "Lamia", 
            "Zakaria", "Karima", "Adil", "Khadijah", "Abdelkarim", 
            "Safia", "Abderrahmane", "Hanane", "Anas", "Latifa"
        );
        //les prenoms
        $surnames = array(
            "El Amrani", "El Mansouri", "Ben Salah", "Belhaj", "El Alaoui", 
            "El Bouazzaoui", "Benbrahim", "El Fassi", "El Khatib", "Benhaddou", 
            "El Hamdi", "El Haddad", "El Ouafi", "El Malki", "El Moutawakil", 
            "El Moussaoui", "El Harrak", "El Mokhtari", "El Mernissi", "Benjelloun", 
            "El Khadir", "El Alami", "El Bakkali", "Benabdeljalil", "El Guerrouj", 
            "El Haouari", "El Gourch", "El Khayari", "Benkiran", "El Marroun", 
            "El Bouzidi", "El Morabit", "El Fadili", "Benyoub", "El Arbi", "Ilyass",
            "El Idrissi", "El Khalfi", "El Mazouzi", "El Mahdaoui", "Benmoussa", 
            "El Hafidi", "El Khouzai", "El Moutaqi", "El Moutaouakil", "El Housni", 
            "El Wafi", "El Omari", "El Maslouhi", "El Maghraoui", "El Ghaouti"
        );
        // le sexe
        $sexe =array( "homme","femme");

       // la date de naisssance:
         $pattern = '/(\d{2}\/\d{2}\/\d{4})/';

          
            if (preg_match($pattern, $fileRead, $matches)) {
                $date_of_birth = $matches[0];
            } 
       //status 
       $status=array("Mariée","Marié","Célibataire");
    

       //les villes 
       $cities = array(
        "Casablanca", "Rabat", "Fes", "Marrakech", "Agadir", "Tangier", "Meknes", "Oujda", "Kenitra", "Tetouan",
        "Safi", "Sale", "Mohammedia", "El Jadida", "Nador", "Settat", "Taza", "Khouribga", "Ouarzazate", "Beni Mellal",
        "Fquih Ben Salah", "Taroudant", "Guelmim", "Berkane", "Khemisset", "Taourirt", "Bouskoura", "Skhirat", "Tiflet",
        "Dakhla", "Erfoud", "Larache", "Tiznit", "Khenifra", "Sidi Kacem", "Essaouira", "Tan-Tan", "Sidi Slimane", "Tata",
        "Sefrou", "Ksar El Kebir", "Berrechid", "Youssoufia", "Chefchaouen", "Sidi Bennour", "Midelt", "Azrou", "Tiznit",
        "Al Hoceima"
         );
        
        //les pays
        $countries=array("Maroc");

        //tel
        $pattern = '/\b(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})\b/';
            
            preg_match_all($pattern, $fileRead, $matches);

            
            $phone = $matches[0];

        //email
        $pattern = '/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/';
        
        preg_match_all($pattern, $fileRead, $matches);

        
        $email = $matches[0];

        //adresse

        $pattern = '/\b\d+\s[A-z\s]+\,\s[A-z]+\,\s[A-z]+\b/';
            
            preg_match_all($pattern, $fileRead, $correspondances);

            
            $adresses = $correspondances[0];

        /*formation*/

        //Diplome 
        $diplomas = array(
            "Baccalauréat",
            "Diplôme Universitaire de Technologie ",
            "Licence",
            "Master",
            "Diplôme d'Ingénieur",
            "Doctorat",
            "Brevet de Technicien Supérieur",
            "Certificat de Qualification Professionnelle",
            "Diplôme des Métiers d'Art ",
            "Certificat d'Aptitude Professionnelle "
        );
        //universites
        
            $universities = array(
                "Université Hassan II de Casablanca",
                "Université Mohammed V de Rabat",
                "Université Cadi Ayyad de Marrakech",
                "Université Ibn Tofail de Kénitra",
                "Université Sultan Moulay Slimane de Béni Mellal",
                "Université Mohammed Premier d'Oujda",
                "Université Sidi Mohamed Ben Abdellah de Fès",
                "Université Abdelmalek Essaâdi de Tanger",
                "Université Ibn Zohr d'Agadir",
                "Université Al Akhawayn d'Ifrane"
            );

        /*Experiences*/

        //Entreprises

           $companies = array(
            "Attijariwafa Bank", "Banque Centrale Populaire (BCP)", "BMCE Bank of Africa", "Royal Air Maroc (RAM)",
            "Maroc Telecom", "OCP Group", "Société Générale Maroc", "Groupe ONA",
            "LafargeHolcim Maroc", "Managem", "Société Nationale de Radiodiffusion et de Télévision (SNRT)",
            "Société Nationale des Autoroutes du Maroc (ADM)", "Société Nationale des Transports et de la Logistique (SNTL)",
            "Société Marocaine des Industries de Raffinage (SAMIR)", "Société Nationale de l'Electricité et de l'Eau Potable (ONEE)",
            "Crédit Agricole du Maroc", "Total Maroc", "Lydec", "Renault Maroc",
            "Société des Eaux Minérales d'Oulmès (SEMO)", "Société de Fabrication des Boissons de Tunisie (SFBT)", "Inwi", "Ciments du Maroc",
            "Wafa Assurance", "Société Marocaine des Tabacs (SMT)", "Attijari Invest", "Ynna Holding",
            "Dell Maroc", "Schneider Electric Maroc", "Maroc Export", "Danone Maroc",
            "Marjane", "Dell Technologies Maroc", "Banque Populaire", "Société Générale",
            "Capgemini Maroc", "Microsoft Maroc", "Coca-Cola Maroc", "Société Générale d'Entreprises de Construction (SGEC)",
            "Amendis", "Afriquia Gaz", "Shell Maroc", "Holmarcom",
            "Société de Transport au Maroc (STAM)", "Risma", "Société des Brasseries du Maroc (SBM)", "Yamed Capital",
            "Procter & Gamble Maroc", "Axa Assurance Maroc", "Société Générale Marocaine de Banques (SGMB)"
            );

        
          
        //skill proficiency
        $level = array(
            "Passable",
            "Assez-bien",
            "Bien",
            "Tres-bien"
           );
        //langues
        $langues=array(
            "Arabe",
            "Francais",
            "Anglais",
            "Espagnol"
        );
        /** end **/

        /**parcourir les tableau **/
        
        $term_arrays = [$names, $surnames, $date_of_birth, $phone, $email, $sexe, $status, $cities, $countries,
                        $diplomas, $universities,$level,$companies, $langues];

        $found_elements = [];

        foreach ($term_arrays as $term_array) {
            foreach ($term_array as $element) {
                if (strpos($fileRead, $element) !== false && !in_array($element, $found_elements)) {
                    $found_elements[] = $element;
                }
            }
        }

        $ocr=array();

            foreach ($found_elements as $elmt) {
                if (in_array($elmt,$names)) {
                    $ocr['first_name']=$elmt;
                }elseif(in_array($elmt,$surnames)){
                    $ocr['last_name']=$elmt;
                }elseif(in_array($elmt,$sexe)){
                    $ocr['gender']=$elmt;
                }elseif(in_array($elmt,$status)){
                    $ocr['marital_status']=$elmt;
                }elseif(in_array($elmt,$cities)){
                    $ocr['city']=$elmt;
                }elseif(in_array($elmt,$countries)){
                    $ocr['country']=$elmt;
                }elseif(in_array($elmt,$diplomas)){
                    $ocr['degree']=$elmt;
                }elseif(in_array($elmt,$universities)){
                    $ocr['university_college']=$elmt;
                }elseif(in_array($elmt,$companies)){
                    $ocr['company_name']=$elmt;
                }elseif(in_array($elmt,$langues)){
                    $ocr['langue']=$elmt;
                }elseif(in_array($elmt,$level)){
                    $ocr['level']=$elmt;
                }
            }
            $ocr['phone']=$phone[0];
            $ocr['email']=$email[0];
            $ocr['date_of_birth']=$date_of_birth;
            $ocr['address']=$adresses[0];


        try{ // Requête SQL pour insérer les données dans la base de données
            $sql = "INSERT INTO ocr_candidat (first_name, last_name, date_of_birth, gender, marital_status, city, country, phone, email, address, degree, university_college, level, company_name, langue) 
            VALUES (:first_name, :last_name, :date_of_birth, :gender, :marital_status, :city, :country, :phone, :email, :address, :degree, :university_college, :level, :company_name, :langue)";
            // Préparer la requête pour éviter les injections SQL
            $stmt = $db->prepare($sql);

            // Liaison des paramètres
            $stmt->bindParam(':first_name', $ocr['first_name']);
            $stmt->bindParam(':last_name', $ocr['last_name']);
            $stmt->bindParam(':date_of_birth', $ocr['date_of_birth']);
            $stmt->bindParam(':gender', $ocr['gender']);
            $stmt->bindParam(':marital_status', $ocr['marital_status']);
            $stmt->bindParam(':city', $ocr['city']);
            $stmt->bindParam(':country', $ocr['country']);
            $stmt->bindParam(':phone', $ocr['phone']);
            $stmt->bindParam(':email', $ocr['email']);
            $stmt->bindParam(':address', $ocr['address']);
            $stmt->bindParam(':degree', $ocr['degree']);
            $stmt->bindParam(':university_college', $ocr['university_college']);
            $stmt->bindParam(':level', $ocr['level']);
            $stmt->bindParam(':company_name', $ocr['company_name']);
            $stmt->bindParam(':langue', $ocr['langue']);

        
            // Exécuter la requête avec les données fournies par l'utilisateur
            $stmt->execute();
            echo "<p class='alert alert-success text-center'>Le formulaire a été rempli avec succès.</p>";

        }catch (PDOException $e) {
           
        } 
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="deposer_cv.css">
    <link rel="stylesheet" href="sidebar_candidat.css">
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


                     <a href="offre-emploi_candidat.php">
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
        <!--profile side -->
               <div class="cv-side">

                        <div class="header-cv">
                                <h1 id="attractive-question">
                                    Deposer votre Cv 
                                </h1>  
                                
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

                                      <button id="boutton" class="btn btn-success mt-3" type="submit" name="submit">Upload</button>

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
