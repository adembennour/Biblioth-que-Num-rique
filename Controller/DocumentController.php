<?php
require_once '../Model/Document.php';
require_once '../config.php';

class DocumentController {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = config::getConnexion();
    }

    // Method to handle adding a new document
    public function addDocument() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_document = (int)$_POST['id_document'];
            $titre = $_POST['titre'];
            $auteur = $_POST['auteur'];
            $date_publication = new DateTime($_POST['date_publication']);
            $categorie = $_POST['categorie'];
            $description = $_POST['description'];

            $document = new Document($id_document, $titre, $auteur, $date_publication, $categorie, $description, $this->pdo);

            if ($document->addDocument() == true ) {
                header('Location: ../View/BackOffice.php?success=true');
                exit;
            } else {
                header('Location: ../View/BackOffice.php?error=true');
                exit;
            }
        }
    }

    // Method to handle editing a document
    public function editDocument() {
        if (isset($_GET['id_document'])) {
            $id_document = (int)$_GET['id_document'];
            $document = Document::searchDocument($this->pdo, $id_document);
    
            if ($document && count($document) > 0) {
                $document = $document[0];  // Get the first (and only) document
                require '../View/updateDocument.php';  // Pass the document to the view
            } else {
                echo "Document not found!";
                exit;
            }
        } else {
            echo "Invalid document ID!";
            exit;
        }
    }
    
    

    // Method to handle updating a document
    public function updateDocument() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_document = (int)$_POST['id_document'];
            $titre = $_POST['titre'];
            $auteur = $_POST['auteur'];
            $date_publication = new DateTime($_POST['date_publication']);
            $categorie = $_POST['categorie'];
            $description = $_POST['description'];
    
            $document = new Document($id_document, $titre, $auteur, $date_publication, $categorie, $description, $this->pdo);
    
            if ($document->updateDocument()) {
                header('Location: ../View/BackOffice.php?update_success=true');
                exit;
            } else {
                header('Location: ../View/BackOffice.php?update_error=true');
                exit;
            }
        }
    }
    
    


    // Method to handle deleting a document
    public function deleteDocument() {
        if (isset($_GET['id_document'])) {
            $id_document = (int)$_GET['id_document'];
            $document = new Document($id_document, '', '', new DateTime(), '', '', $this->pdo);

            if ($document->deleteDocument($id_document)) {
                header('Location: ../View/BackOffice.php?delete_success=true');
                exit;
            } else {
                header('Location: ../View/BackOffice.php?delete_error=true');
                exit;
            }
        }
    }

    // Method to list all emprunts
    public function listEmprunts() {
        $emprunts = Emprunt::listEmprunts($this->pdo);
        require '../View/BackOffice.php';
    }
}

// Instantiate the controller
$controller = new DocumentController();

// Determine the action to take based on the URL parameter 'action'
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'addDocument':
            $controller->addDocument();
            break;
        case 'editDocument':  // Handle editing
            $controller->editDocument();
            break;
        case 'updateDocument':
            $controller->updateDocument();
            break;
        case 'deleteDocument':
            $controller->deleteDocument();
            break;
        case 'listDocuments':
        default:
            $controller->listDocuments();
            break;
    }
} else {
    $controller->listDocuments(); // Default action
}
?>
