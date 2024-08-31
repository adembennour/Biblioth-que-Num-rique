<?php
require_once '../config.php';

class Emprunt {
    // Properties
    private int $id_emprunt;
    private int $id_document;
    private string $emprunteur;
    private DateTime $date_emprunt;
    private DateTime $date_retour_prevue;
    private string $statut;
    private PDO $pdo;

    // Constructor with dependency injection for PDO
    public function __construct(int $id_document,  string $emprunteur, DateTime $date_emprunt, DateTime $date_retour_prevue, string $statut, PDO $pdo) {
        $this->id_document = $id_document;
        $this->emprunteur = $emprunteur;
        $this->date_emprunt = $date_emprunt;
        $this->date_retour_prevue = $date_retour_prevue;
        $this->statut = $statut;
        $this->pdo = $pdo;  // Inject the PDO connection
    }
    /**
     * Get the value of id_emprunt
     */ 
    public function getId_emprunt()
    {
        return $this->id_emprunt;
    }

    /**
     * Set the value of id_emprunt
     *
     * @return  self
     */ 
    public function setId_emprunt($id_emprunt)
    {
        $this->id_emprunt = $id_emprunt;

        return $this;
    }

    /**
     * Get the value of id_document
     */ 
    public function getId_document()
    {
        return $this->id_document;
    }

    /**
     * Set the value of id_document
     *
     * @return  self
     */ 
    public function setId_document($id_document)
    {
        $this->id_document = $id_document;

        return $this;
    }

    /**
     * Get the value of emprunteur
     */ 
    public function getEmprunteur()
    {
        return $this->emprunteur;
    }

    /**
     * Set the value of emprunteur
     *
     * @return  self
     */ 
    public function setEmprunteur($emprunteur)
    {
        $this->emprunteur = $emprunteur;

        return $this;
    }

    /**
     * Get the value of date_emprunt
     */ 
    public function getDate_emprunt()
    {
        return $this->date_emprunt;
    }

    /**
     * Set the value of date_emprunt
     *
     * @return  self
     */ 
    public function setDate_emprunt($date_emprunt)
    {
        $this->date_emprunt = $date_emprunt;

        return $this;
    }

    /**
     * Get the value of date_retour
     */ 
    public function getDate_retour_prevue()
    {
        return $this->date_retour_prevue;
    }

    /**
     * Set the value of date_retour
     *
     * @return  self
     */ 
    public function setDate_retour_prevue($date_retour_prevue)
    {
        $this->date_retour_prevue = $date_retour_prevue;

        return $this;
    }

    /**
     * Get the value of statut
     */ 
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set the value of statut
     *
     * @return  self
     */ 
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    // Static method to list all documents
    public static function listEmprunts(PDO $pdo): array {
        $sql = "SELECT * FROM emprunt";
        try {
            $query = $pdo->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception('Error listing emprunts: ' . $e->getMessage());
        }
    }

    // Method to add a new emprunt to the database
    public function addEmprunt(): bool {
        $sql = "INSERT INTO emprunt (id_document, emprunteur, date_emprunt,date_retour_prevue, statut) VALUES (:id_document,  :emprunteur, :date_emprunt, :date_retour_prevue, :statut)";
        try {
            $query = $this->pdo->prepare($sql);
            $query->bindParam(':id_document', $this->id_document);
            $query->bindParam(':emprunteur', $this->emprunteur);
            $query->bindParam(':date_emprunt', $this->date_emprunt->format('Y-m-d'));
            $query->bindParam(':date_retour_prevue', $this->date_retour_prevue->format('Y-m-d'));
            $query->bindParam(':statut', $this->statut);
            return $query->execute();
        } catch (Exception $e) {
            throw new Exception('Error adding emprunt: ' . $e->getMessage());
        }
}
    // Method to delete a emprunt from the database
    public function deleteEmprunt(int $id_emprunt): bool {
        $sql = "DELETE FROM emprunt WHERE id_emprunt = :id_emprunt";
        try {
            $query = $this->pdo->prepare($sql);
            $query->bindParam(':id_emprunt', $id_emprunt);
            return $query->execute();
        } catch (PDOException $e) {
            throw new Exception('Error deleting emprunt: ' . $e->getMessage());
        }
    }

    // Method to search for a emprunt by ID
    public static function searchEmprunt(PDO $pdo, int $id_emprunt ): array {
        $sql = "SELECT * FROM emprunt  WHERE id_emprunt=:id_emprunt";
        try {
            $query = $pdo->prepare($sql);
            $query->bindParam(':id_emprunt',$id_emprunt,PDO::PARAM_INT);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);  // Ensure it returns an associative array
        } catch (PDOException $e) {
            throw new Exception('Error searching for emprunt : ' . $e->getMessage());
        }
    }
    // Method to update an existing emprunt
    public function updateEmprunt(int $id_emprunt): bool {
        $sql = "UPDATE emprunt SET id_document=:id_document,emprunteur=:emprunteur,date_emprunt=:date_emprunt,date_retour_prevue=:date_retour_prevue,statut=:statut WHERE id_emprunt=:id_emprunt";
        try {
            $query = $this->pdo->prepare($sql);
            $query->bindParam(':id_document', $this->id_document);
            $query->bindParam(':id_emprunt', $id_emprunt);
            $query->bindParam(':emprunteur', $this->emprunteur);
            $query->bindParam(':date_emprunt', $this->date_emprunt->format('Y-m-d'));
            $query->bindParam(':date_retour_prevue', $this->date_retour_prevue->format('Y-m-d'));
            $query->bindParam(':statut', $this->statut);
            
            return $query->execute();
        } catch (PDOException $e) {
            throw new Exception('Error updating emprunt: ' . $e->getMessage());
        }
    }
}   
