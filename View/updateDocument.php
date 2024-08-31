<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Document</title>
    <script src="../View/script.js" defer ></script>
    <link rel="stylesheet" href="../View/style.css">
</head>
<body>
    <h1>Update Document</h1>
    <form action="../Controller/DocumentController.php?action=updateDocument" method="POST">
        <input type="hidden" name="id_document" value="<?= htmlspecialchars($document['id_document'] ?? ''); ?>" />
        <div>
            <label for="titre">Title:</label>
            <input type="text" name="titre" id="titre" value="<?= htmlspecialchars($document['titre'] ?? ''); ?>" >
        </div>
        <div>
            <label for="auteur">Author:</label>
            <input type="text" name="auteur" id="auteur" value="<?= htmlspecialchars($document['auteur'] ?? ''); ?>" >
        </div>
        <div>
            <label for="date_publication">Publication Date:</label>
            <input type="date" name="date_publication" id="date_publication" value="<?= htmlspecialchars($document['date_publication'] ?? ''); ?>" >
        </div>
        <div>
            <label for="categorie">Category:</label>
            <input type="text" name="categorie" id="categorie" value="<?= htmlspecialchars($document['categorie'] ?? ''); ?>" >
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description" required><?= htmlspecialchars($document['description'] ?? ''); ?></textarea>
        </div>
        <div>
            <button type="submit">Update Document</button>
        </div>
    </form>
</body>
</html>
