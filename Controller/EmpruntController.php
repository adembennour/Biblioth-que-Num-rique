<?php
require_once '../Model/Emprunt.php';
require_once '../Model/Document.php';
require_once '../config.php';

class EmpruntController {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = config::getConnexion();
    }
    // Method to handle adding a new Emprunt
    public function addEmprunt() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_document = (int)$_POST['id_document'];
            $emprunteur = $_POST['emprunteur'];
            $date_emprunt = new DateTime($_POST['date_emprunt']);
            $date_retour_prevue = new DateTime($_POST['date_retour_prevue']);
            $statut = $_POST['statut'];

            $Emprunt = new Emprunt($id_document, $emprunteur, $date_emprunt, $date_retour_prevue, $statut, $this->pdo);

            if ($Emprunt->addEmprunt() == true ) {
                header('Location: ../View/BackOffice.php?success=true');
                exit;
            } else {
                header('Location: ../View/BackOffice.php?error=true');
                exit;
            }
        }
    }

    // Method to handle deleting a emprunt
    public function deleteEmprunt() {
        if (isset($_GET['id_emprunt'])) {
            $id_emprunt = (int)$_GET['id_emprunt'];
            $emprunt = new Emprunt(0,'',  new DateTime(),new DateTime(),'', $this->pdo);

            if ($emprunt->deleteEmprunt($id_emprunt)) {
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
        $Emprunts = Emprunt::listEmprunts($this->pdo);
        require '../View/BackOffice.php';
    }
    // Method to handle updating a emprunt
    public function updateEmprunt() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_emprunt = (int)$_POST['id_emprunt'];
            $id_document = (int)$_POST['id_document'];
            $emprunteur = $_POST['emprunteur'];
            $date_emprunt = new DateTime($_POST['date_emprunt']);
            $date_retour_prevue = new DateTime($_POST['date_retour_prevue']);
            $statut = $_POST['statut'];

    
            $emprunt = new Emprunt($id_document, $emprunteur, $date_emprunt,$date_retour_prevue, $statut, $this->pdo);
    
            if ($emprunt->updateEmprunt($id_emprunt)) {
                header('Location: ../View/BackOffice.php?update_success=true');
                exit;
            } else {
                header('Location: ../View/BackOffice.php?update_error=true');
                exit;
            }
        }
    }
    
    // Method to handle editing a emprunt
    public function editEmprunt() {
        if (isset($_GET['id_emprunt'])) {
            $id_emprunt = (int)$_GET['id_emprunt'];
            $emprunt = Emprunt::searchEmprunt($this->pdo, $id_emprunt);
    
            if ($emprunt && count($emprunt) > 0) {
                $emprunt = $emprunt[0];  // Get the first (and only)emprunt
                $documents = Document::listDocuments($this->pdo);
                require '../View/updateEmprunt.php';  // Pass the emprunt to the view
            } else {
                echo "Emprunt not found!";
                exit;
            }
        } else {
            echo "Invalid Emprunt ID!";
            exit;
        }
    }
    
}
// Instantiate the controller
$controller = new EmpruntController();

// Determine the action to take based on the URL parameter 'action'
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'addEmprunt':
            $controller->addEmprunt();
            break;
        case 'editEmprunt':  // Handle editing
            $controller->editEmprunt();
            break;
        case 'updateEmprunt':
            $controller->updateEmprunt();
            break;
        case 'deleteEmprunt':
            $controller->deleteEmprunt();
            break;
        case 'listEmprunts':
        default:
            $controller->listEmprunts();
            break;
    }
} else {
    $controller->listDocuments(); // Default action
}