<?php
require_once(ROOT . 'config/database.php');

class Agence
{
    private $conn;
    private $table = "agences";

    public $id;
    public $nom;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Récupérer toutes les agences
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer une agence par son ID
    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Créer une nouvelle agence
    public function create($nom)
    {
        $query = "INSERT INTO " . $this->table . " SET nom=:nom";
        $stmt = $this->conn->prepare($query);

        $nom = htmlspecialchars(strip_tags($nom));
        $stmt->bindParam(":nom", $nom);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Modifier une agence existante
    public function update($id, $nom)
    {
        $query = "UPDATE " . $this->table . " SET nom = :nom WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $nom = htmlspecialchars(strip_tags($nom));
        $id = htmlspecialchars(strip_tags($id));

        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Supprimer une agence
    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $id = htmlspecialchars(strip_tags($id));
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
