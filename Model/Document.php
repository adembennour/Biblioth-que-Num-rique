<?php
require_once '../config.php';

class Document {
    // Properties
    private int $id_document;
    private string $titre;
    private string $auteur;
    private DateTime $date_publication;
    private string $categorie;
    private string $description;
    private PDO $pdo;

    // Constructor with dependency injection for PDO
    public function __construct(int $id_document, string $titre, string $auteur, DateTime $date_publication, string $categorie, string $description, PDO $pdo) {
        $this->id_document = $id_document;
        $this->titre = $titre;
        $this->auteur = $auteur;
        $this->date_publication = $date_publication;
        $this->categorie = $categorie;
        $this->description = $description;
        $this->pdo = $pdo;  // Inject the PDO connection
    }

    // Getters and Setters
    public function getIdDocument(): int {
        return $this->id_document;
    }

    public function setIdDocument(int $id_document): void {
        $this->id_document = $id_document;
    }

    public function getTitre(): string {
        return $this->titre;
    }

    public function setTitre(string $titre): void {
        $this->titre = $titre;
    }

    public function getAuteur(): string {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): void {
        $this->auteur = $auteur;
    }

    public function getDatePublication(): DateTime {
        return $this->date_publication;
    }

    public function setDatePublication(DateTime $date_publication): void {
        $this->date_publication = $date_publication;
    }

    public function getCategorie(): string {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): void {
        $this->categorie = $categorie;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    // Static method to list all documents
    public static function listDocuments(PDO $pdo): array {
        $sql = "SELECT * FROM document";
        try {
            $query = $pdo->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception('Error listing documents: ' . $e->getMessage());
        }
    }

    // Method to add a new document to the database
    public function addDocument(): bool {
        $sql = "INSERT INTO document (id_document, titre, auteur, date_publication, categorie, description) VALUES (:id_document, :titre, :auteur, :date_publication, :categorie, :description)";
        try {
            $query = $this->pdo->prepare($sql);
            $query->bindParam(':id_document', $this->id_document);
            $query->bindParam(':titre', $this->titre);
            $query->bindParam(':auteur', $this->auteur);
            $query->bindParam(':date_publication', $this->date_publication->format('Y-m-d'));
            $query->bindParam(':categorie', $this->categorie);
            $query->bindParam(':description', $this->description);
            return $query->execute();
        } catch (Exception $e) {
            throw new Exception('Error adding document: ' . $e->getMessage());
        }
    }

    // Method to delete a document from the database
    public function deleteDocument(int $id_document): bool {
        $sql = "DELETE FROM document WHERE id_document = :id_document";
        try {
            $query = $this->pdo->prepare($sql);
            $query->bindParam(':id_document', $id_document);
            return $query->execute();
        } catch (PDOException $e) {
            throw new Exception('Error deleting document: ' . $e->getMessage());
        }
    }

    // Method to search for a document by ID
    public static function searchDocument(PDO $pdo, int $id_document): array {
        $sql = "SELECT * FROM document WHERE id_document = :id_document";
        try {
            $query = $pdo->prepare($sql);
            $query->bindParam(':id_document', $id_document, PDO::PARAM_INT);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);  // Ensure it returns an associative array
        } catch (PDOException $e) {
            throw new Exception('Error searching for document: ' . $e->getMessage());
        }
    }
    
    
    

    // Method to update an existing document
    public function updateDocument(): bool {
        $sql = "UPDATE document SET titre = :titre, auteur = :auteur, date_publication = :date_publication, categorie = :categorie, description = :description WHERE id_document = :id_document";
        try {
            $query = $this->pdo->prepare($sql);
            $query->bindParam(':id_document', $this->id_document);
            $query->bindParam(':titre', $this->titre);
            $query->bindParam(':auteur', $this->auteur);
            $query->bindParam(':date_publication', $this->date_publication->format('Y-m-d'));
            $query->bindParam(':categorie', $this->categorie);
            $query->bindParam(':description', $this->description);
            return $query->execute();
        } catch (PDOException $e) {
            throw new Exception('Error updating document: ' . $e->getMessage());
        }
    }
}
?>
