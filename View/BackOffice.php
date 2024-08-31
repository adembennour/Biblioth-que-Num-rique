<?php
require_once '../Model/Document.php';
require_once '../Model/Emprunt.php';

// Initialize PDO connection (adjust path as needed)
$pdo = config::getConnexion();

// Retrieve all documents
$documents = Document::listDocuments($pdo);
$emprunt = Emprunt::listEmprunts($pdo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="../View/stylee.css"> <!-- Your existing styles -->
</head>
<body>

        <h3 class="main--title">List of Documents</h3>
            <div class="table-container">
            <div class="byn">
                    <form action="addDocument.php">  <!-- Link to your add document page -->
                        <button type="submit" class="an anc">Ajouter Document</button>
                    </form>
                </div>
                <table border>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Publication Date</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Delete</th>
                            <th>Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($documents)): ?>
                            <?php foreach ($documents as $document): ?>
                                <tr>
                                    <td><?= htmlspecialchars($document['id_document']); ?></td>
                                    <td><?= htmlspecialchars($document['titre']); ?></td>
                                    <td><?= htmlspecialchars($document['auteur']); ?></td>
                                    <td><?= htmlspecialchars($document['date_publication']); ?></td>
                                    <td><?= htmlspecialchars($document['categorie']); ?></td>
                                    <td><?= htmlspecialchars($document['description']); ?></td>
                                    <td>
                                        <button class="btn btn-danger btn-delete" onclick="deleteDocument(<?= $document['id_document']; ?>)">
                                            <img src="../imgs/delete.png" alt="delete">
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-update" onclick="redirectToUpdateForm(<?= $document['id_document']; ?>)">
                                            <img src="../imgs/edit.png" alt="edit">
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="8">No documents found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>



            <h3 class="main--title">List of Emprunts</h3>
            <div class="table-container">
            <div class="byn">
                    <form action="addEmprunt.php">  <!-- Link to your add emprunt page -->
                        <button type="submit" class="an anc">Ajouter Emprunt </button>
                    </form>
                </div>
                <table border>
                    <thead>
                        <tr>
                            <th>id_emprunt</th>
                            <th>id_document</th>
                            <th>emprunteur</th>
                            <th>date_emprunt</th>
                            <th>date_retour_prevue</th>
                            <th>statut</th>
                            <th>Delete</th>
                            <th>Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($emprunt)): ?>
                            <?php foreach ($emprunt as $emprunt): ?>
                                <tr>
                                    <td><?= htmlspecialchars($emprunt['id_emprunt']); ?></td>
                                    <td><?= htmlspecialchars($emprunt['id_document']); ?></td>
                                    <td><?= htmlspecialchars($emprunt['emprunteur']); ?></td>
                                    <td><?= htmlspecialchars($emprunt['date_emprunt']); ?></td>
                                    <td><?= htmlspecialchars($emprunt['date_retour_prevue']); ?></td>
                                    <td><?= htmlspecialchars($emprunt['statut']); ?></td>
                                    <td>
                                        <button class="btn btn-danger btn-delete" onclick="deleteEmprunt(<?= $emprunt['id_emprunt']; ?>)">
                                            <img src="../imgs/delete.png" alt="delete">
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-update" onclick="redirectToUpdateFormEmprunt(<?= $emprunt['id_emprunt']; ?>)">
                                            <img src="../imgs/edit.png" alt="edit">
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="8">No Emprunts found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>


    <script>

function deleteDocument(id_document) {
            if (confirm('Are you sure you want to delete this document?')) {
            window.location.href = '../Controller/DocumentController.php?action=deleteDocument&id_document=' + id_document;
            }
    }
    
    function redirectToUpdateForm(id_document) {
        window.location.href = '../Controller/DocumentController.php?action=editDocument&id_document=' + id_document;
    }
    function deleteEmprunt(id_emprunt) {
        if (confirm('Are you sure you want to delete this emprunt?')) {
            window.location.href = '../Controller/EmpruntController.php?action=deleteEmprunt&id_emprunt=' + id_emprunt;
        }
    }
    
    function redirectToUpdateFormEmprunt(id_emprunt) {
        window.location.href = '../Controller/EmpruntController.php?action=editEmprunt&id_emprunt=' + id_emprunt;
    }
    </script>
</body>
</html>
