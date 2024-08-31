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
    <title>LibraPlus</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <h1>LibraPlus</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Search</a></li>
                    <li><a href="#">History</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <h2>Welcome to LibraPlus</h2>
            <p>Explore, borrow, and enjoy a vast collection of digital literature.</p>
            <a href="#search-section" class="cta-button">Start Exploring</a>
        </div>
    </section>

    <section class="search-bar" id="search-section">
        <div class="container">
            <input type="text" placeholder="Title" id="title">
            <input type="text" placeholder="Author" id="author">
            <input type="text" placeholder="Category" id="category">
            <input type="date" placeholder="jj/mm/aaaa" id="date">
            <button>Search</button>
        </div>
    </section>

    <section class="content">
        <div class="container">
            <div class="available-documents">
                <h2>Available Documents</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Publication Date</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($documents)): ?>
                            <?php foreach ($documents as $document): ?>
                                <tr>
                                    <td><?= htmlspecialchars($document['titre']); ?></td>
                                    <td><?= htmlspecialchars($document['auteur']); ?></td>
                                    <td><?= htmlspecialchars($document['date_publication']); ?></td>
                                    <td><?= htmlspecialchars($document['categorie']); ?></td>
                                    <td><?= htmlspecialchars($document['description']); ?></td>
                                    <td>
                                        <form action="addEmprunt.php">  
                                            <button type="submit" class="an anc">Borrow </button>
                                        </form>
                                    </td>
                                  
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="8">No documents found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="borrowing-history">
                <h2>Your Borrowing History</h2>
                <h1>Borrowing History for </h1>
    
                <?php if (!empty($(emprunts))): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Date Borrowed</th>
                                <th>Due Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($emprunts as $emprunt): ?>
                                <tr>
                                    <td><?= htmlspecialchars($emprunt['titre']); ?></td>
                                    <td><?= htmlspecialchars($emprunt['date_emprunt']); ?></td>
                                    <td><?= htmlspecialchars($emprunt['date_retour_prevue']); ?></td>
                                    <td><?= htmlspecialchars($emprunt['statut']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No borrowing history found for this user.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>© 2024 LibraPlus. All rights reserved.</p>
            <div class="social-icons">
                <a href="#"><img src="../imgs/fb.png" alt="Facebook"></a>
                <a href="#"><img src="../imgs/tw.png" alt="Twitter"></a>
                <a href="#"><img src="../imgs/ins.png" alt="Instagram"></a>
            </div>
        </div>
    </footer>

    <script src="script2.js"></script>
</body>
</html>
