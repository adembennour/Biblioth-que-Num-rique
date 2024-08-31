<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Document</title>
    <script src="../View/script.js" defer></script>
    <link rel="stylesheet" href="../View/style.css">
</head>
<body>
    <h1>Add a New Document</h1>
    <form action="../Controller/DocumentController.php?action=addDocument" method="POST">
       
        <div>
            <label for="titre">Title:</label>
            <input type="text" name="titre" id="titre" >
        </div>
        <div>
            <label for="auteur">Author:</label>
            <input type="text" name="auteur" id="auteur" >
        </div>
        <div>
            <label for="date_publication">Publication Date:</label>
            <input type="date" name="date_publication" id="date_publication" >
        </div>
        <div>
            <label for="categorie">Category:</label>
            <input type="text" name="categorie" id="categorie" >
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description" ></textarea>
        </div>
        <div>
            <button type="submit">Add Document</button>
        </div>
    </form>
</body>
</html>
