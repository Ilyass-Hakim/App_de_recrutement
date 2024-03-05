<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $nomFormation = isset($_POST['nomFormation']) ? $_POST['nomFormation'] : '';
    $date_debut = isset($_POST['date_debut']) ? $_POST['date_debut'] : '';
    $date_fin = isset($_POST['date_fin']) ? $_POST['date_fin'] : '';
    $diplome = isset($_POST['diplome']) ? $_POST['diplome'] : '';
    $pays = isset($_POST['pays']) ? $_POST['pays'] : '';
    $ville = isset($_POST['ville']) ? $_POST['ville'] : '';
    $etablissement = isset($_POST['etablissement']) ? $_POST['etablissement'] : '';
    

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO formation VALUES (?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$nomFormation, $date_debut, $date_fin, $diplome, $pays, $ville, $etablissement]);

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
                            <form action="create1.php" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="nomFormation" class="text-muted">Nom de la formation</label>
                                            <input name="nomFormation" id="nomFormation" type="text" class="form-control resume" placeholder="ma formation">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="date_debut" class="text-muted">date de debut</label>
                                            <input name="date_debut" id="date_debut" type="date" class="form-control resume" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="date_fin" class="text-muted">date de fin</label>
                                            <input name="date_fin" id="date_fin" type="date" class="form-control resume" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="diplome" class="text-muted">Diplome</label>
                                            <input name="diplome" id="diplome" type="text" class="form-control resume" placeholder="mon diplome">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="pays" class="text-muted">Pays</label>
                                            <select name="pays" id="pays" class="form-control resume">
                                                <option value="France">France</option>
                                                <option value="Maroc">Maroc</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="ville" class="text-muted">Ville</label>
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
                                            <label for="etablissement" class="text-muted">Nom de l'établissement</label>
                                            <input name="etablissement" id="etablissement" type="text" class="form-control resume" placeholder="etablissement">
                                        </div>
                                    </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="text-center">
                                            <input type="submit" id="submit" name="send" class="submitBnt btn btn-secondary mt-5" value="créer formation">
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