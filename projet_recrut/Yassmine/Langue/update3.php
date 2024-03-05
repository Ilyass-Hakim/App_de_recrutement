<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['nomLangue'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $nomLangue = isset($_POST['nomLangue']) ? $_POST['nomLangue'] : '';
        $niveau = isset($_POST['niveau']) ? $_POST['niveau'] : '';

        // Update the record
        $stmt = $pdo->prepare('UPDATE langue SET  nomLangue = ?, niveau = ? WHERE nomLangue = ?');
        $stmt->execute([$nomLangue, $niveau, $_GET['nomLangue']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the utilisateur table
    $stmt = $pdo->prepare('SELECT * FROM langue WHERE nomLangue = ?');
    $stmt->execute([$_GET['nomLangue']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Read')?>



    <main>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="job-detail mt-2 p-4">
                        <div class="custom-form">
                            <h2>Update competence #<?=$contact['nomLangue']?></h2>
                            <form action="update2.php?nomLangue=<?=$contact['nomLangue']?>" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="nomLangue" class="text-muted">Nom de la langue</label>
                                            <input name="nomLangue" id="nomLangue" type="text" class="form-control resume" placeholder="ma langue" value="<?=$contact['nomLangue']?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="niveau" class="text-muted">niveau</label>
                                            <input name="niveau" id="niveau" type="text" class="form-control resume" placeholder="mon niveau" value="<?=$contact['niveau']?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="text-center">
                                            <input type="submit" id="submit" name="send" class="submitBnt btn btn-secondary mt-5" value="Update langue">
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

<?=template_footer()?>