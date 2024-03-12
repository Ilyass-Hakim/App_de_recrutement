<?php
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;
// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM experience ORDER BY poste LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_contacts = $pdo->query('SELECT COUNT(*) FROM experience')->fetchColumn();
?>
<?=template_header('Read')?>

    <main>
        <div class="container">
            <table class="table">
                <caption>Liste des experiences</caption>
                <thead>
                    <tr>
                        <th scope="col">poste</th>
                        <th scope="col">date_debut</th>
                        <th scope="col">date_fin</th>
                        <th scope="col">description</th>
                        <th scope="col">nom_entreprise</th>
                        <th scope="col">actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php foreach ($users as $user): ?>
                            <th scope="row"><?=$user['poste']?></th>
                            <td><?=$user['date_debut']?></td>
                            <td><?=$user['date_fin']?></td>
                            <td><?=$user['description']?></td>
                            <td><?=$user['nom_entreprise']?></td>
                            <td class="actions">
                                <a href="update7.php?poste=<?=$user['poste']?>" class="edit" style="padding: 20px;"><i class="bi bi-pencil-fill"></i></a>
                                <a href="delete7.php?poste=<?=$user['poste']?>" class="trash" style="padding: 20px;"><i class="bi bi-trash"></i></a>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                </tbody>
                <div class="pagination">
                    <?php if ($page > 1): ?>
                    <a href="read7.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
                    <?php endif; ?>
                    <?php if ($page*$records_per_page < $num_contacts): ?>
                    <a href="read7.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
                    <?php endif; ?>
                </div>
            </table>
        </div>
    </main>

<!--
<div class="content read">
	<h2>Read Contacts</h2>
	<a href="create.php" class="create-contact">Create Contact</a>
	<table>
        <thead>
            <tr>
                <td>nomFormation</td>
                <td>date_debut</td>
                <td>date_fin</td>
                <td>diplome</td>
                <td>pays</td>
                <td>ville</td>
                <td>etablissement</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php // foreach ($users as $user): ?>
            <tr>
                <td><?php //$user['nomFormation']?></td>
                <td><?php //$user['date_debut']?></td>
                <td><?php //$user['date_fin']?></td>
                <td><?php //$user['diplome']?></td>
                <td><?php //$user['pays']?></td>
                <td><?php //$user['ville']?></td>
                <td><?php //['etablissement']?></td>
                <td class="actions">
                    <a href="update.php?id=<?php // user['nomFormation']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?php //$user['nomFormation']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php //endforeach; ?>
        </tbody>
    </table>
	
</div>
            -->

<?=template_footer()?>