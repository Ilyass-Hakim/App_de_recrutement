<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $pays = isset($_POST['pays']) ? $_POST['pays'] : '';
    $ville = isset($_POST['ville']) ? $_POST['ville'] : '';
    $age = isset($_POST['age']) ? $_POST['age'] : '';
    $sexe = isset($_POST['sexe']) ? $_POST['sexe'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $login = isset($_POST['login']) ? $_POST['login'] : '';
    $mdp = isset($_POST['mdp']) ? $_POST['mdp'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO utilisateur VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([null, $prenom, $nom, $pays, $ville, $age, $sexe, $email, $login, $mdp]);

    var_dump($stmt);


    
    // Output message
    $msg = 'Created Successfully!';
}
?>
<?=template_header('Create')?>

    <main>
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="job-detail mt-2 p-4">
                        <div class="custom-form">
                            <form action="create.php" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="prenom" class="text-muted">prenom</label>
                                            <input name="prenom" id="prenom" type="text" class="form-control resume" placeholder="mon prenom">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="nom" class="text-muted">nom</label>
                                            <input name="nom" id="nom" type="text" class="form-control resume" placeholder="mon nom">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="pays" class="text-muted">pays</label>
                                            <select name="pays" id="pays" class="form-control resume">
                                                <option value="France">France</option>
                                                <option value="Maroc">Maroc</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="ville" class="text-muted">ville</label>
                                            <select name="ville" id="ville" class="form-control resume">
                                                <option value="Casablanca">Casablanca</option>
                                                <option value="Marrakech">Marrakech</option>
                                                <option value="Rabat">Rabat</option>
                                                <option value="Tanger">Tanger</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="age" class="text-muted">age</label>
                                            <input name="age" id="age" type="number" class="form-control resume" placeholder="mon age">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="sexe" class="text-muted">sexe</label>
                                            <select name="sexe" id="sexe" class="form-control resume">
                                                <option value="Homme">Homme</option>
                                                <option value="Femme">Femme</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="email" class="text-muted">email</label>
                                            <input name="email" id="email" type="text" class="form-control resume" placeholder="mon email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="login" class="text-muted">nom d'utilisateur</label>
                                            <input name="login" id="login" type="text" class="form-control resume" placeholder="nom_d'utilisateur">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="mdp" class="text-muted">mot de passe</label>
                                            <input name="mdp" id="mdp" type="password" class="form-control resume" placeholder="votre mot de passe">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="text-center">
                                            <input type="submit" id="submit" name="send" class="submitBnt btn btn-secondary mt-5" value="Create User">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?php if ($msg): ?>
                            <p><?=$msg?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>




<!--
<div class="content update">
	<h2>Create Contact</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <label for="name">Name</label>
        <input type="text" name="id" placeholder="26" value="auto" id="id">
        <input type="text" name="name" placeholder="John Doe" id="name">
        <label for="email">Email</label>
        <label for="phone">Phone</label>
        <input type="text" name="email" placeholder="johndoe@example.com" id="email">
        <input type="text" name="phone" placeholder="2025550143" id="phone">
        <label for="title">Title</label>
        <label for="created">Created</label>
        <input type="text" name="title" placeholder="Employee" id="title">
        <input type="datetime-local" name="created" value="<?php//date('Y-m-d\TH:i')?>" id="created">
        <input type="submit" value="Create">
    </form>
                            -->
    <?php //if ($msg): ?>
    <p><?php//$msg?></p>
    <?php //endif; ?>
<!--</div>-->

<?=template_footer()?>