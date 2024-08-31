<?php
require_once '../config.php';
require_once '../Model/Document.php';

$pdo = config::getConnexion();

$documents = Document::listDocuments($pdo);
;?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Emprunt</title>
    <script src="../View/script.js" defer></script>
    <link rel="stylesheet" href="../View/style.css">
</head>
<body>
    <h1>Add a New Emprunt</h1>
    <form action="../Controller/EmpruntController.php?action=addEmprunt" method="POST">
       
        <div>
            <label for="id_document">Document :</label>
            <select name="id_document" id="id_document">
                <option value="">select a Document : </option>
                <?php foreach($documents as $document) :?>
                    <option value="<?= htmlspecialchars($document['id_document'] ); ?>"><?= htmlspecialchars($document['titre']); ?></option>
                <?php endforeach;?>    
            </select>
        </div>
        <div>
            <label for="emprunteur">Emprunteur:</label>
            <input type="text" name="emprunteur" id="emprunteur" >
        </div>
        <div>
            <label for="date_emprunt">Emprunt Date:</label>
            <input type="date" name="date_emprunt" id="date_emprunt" >
        </div>
        <div>
            <label for="date_retour_prevue">Retour Date:</label>
            <input type="date" name="date_retour_prevue" id="date_retour_prevue" >
        </div>
        <div>
            <label for="statut">Statut:</label><select name="statut" id="statut">
                <option value="pending">pending</option>
            </select>
        </div>
        <div>
            <button type="submit">Add Emprunt</button>
        </div>
    </form>
</body>
<script>
    
</script>
</html>
