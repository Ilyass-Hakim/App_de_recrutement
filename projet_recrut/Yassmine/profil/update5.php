<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['description'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $description = isset($_POST['description']) ? $_POST['description'] : '';

        // Update the record
        $stmt = $pdo->prepare('UPDATE profil SET  description = ?, niveau = ? WHERE description = ?');
        $stmt->execute([$description, $_GET['description']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the utilisateur table
    $stmt = $pdo->prepare('SELECT * FROM profil WHERE description = ?');
    $stmt->execute([$_GET['description']]);
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
                            <h2>Update profil #<?=$contact['description']?></h2>
                            <form action="update5.php?description=<?=$contact['description']?>" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="description" class="text-muted">Description</label>
                                            <input name="description" id="description" type="text" class="form-control resume" placeholder="ma competence" value="<?=$contact['description']?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="text-center">
                                            <input type="submit" id="submit" name="send" class="submitBnt btn btn-secondary mt-5" value="Update profil">
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