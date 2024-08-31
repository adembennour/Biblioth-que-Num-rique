
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Emprunt</title>
    <script src="../View/script.js" defer ></script>
    <link rel="stylesheet" href="../View/style.css">
</head>
<body>
    <h1>Update Emprunt</h1>
    <form action="../Controller/EmpruntController.php?action=updateEmprunt" method="POST">
        <input type="hidden" name="id_emprunt" value="<?= htmlspecialchars($emprunt['id_emprunt'] ?? ''); ?>" />
        <div>
            <label for="id_document">Document:</label>
            <select name="id_document" id="id_document">
                <option value="">select a Document : </option>
                <?php foreach($documents as $document) :?>
                    <option value="<?= htmlspecialchars($document['id_document'] ); ?>" <?=$document['id_document'] == $emprunt['id_document'] ? 'selected' : ''; ?> ><?= htmlspecialchars($document['titre']); ?></option>
                <?php endforeach;?>    
            </select>
        </div>
        <div>
            <label for="emprunteur">Emprunteur:</label>
            <input type="text" name="emprunteur" id="emprunteur" value="<?= htmlspecialchars($emprunt['emprunteur'] ?? ''); ?>" >
        </div>
        <div>
            <label for="date_emprunt">Date emprunt:</label>
            <input type="date" name="date_emprunt" id="date_emprunt" value="<?= htmlspecialchars($emprunt['date_emprunt'] ?? ''); ?>" >
        </div>
        <div>
            <label for="date_retour_prevue">Date retour prévue:</label>
            <input type="date" name="date_retour_prevue" id="date_retour_prevue" value="<?= htmlspecialchars($emprunt['date_retour_prevue'] ?? ''); ?>" >
        </div>
        <div>
            <label for="statut">Statut:</label>
            <select name="statut" id="statut">
                
                <option value="pending">pending</option>
                <option value="returned">returned</option>
            </select>
        </div>
        <div>
            <button type="submit">Update Emprunt</button>
        </div>
    </form>
</body>
</html>
