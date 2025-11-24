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
}
