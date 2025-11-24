<?php
require_once(ROOT . 'config/database.php');

class User
{
    private $conn;
    private $table = "users";

    public $id;
    public $nom;
    public $prenom;
    public $telephone;
    public $email;
    public $role;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Récupérer tous les utilisateurs
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer un utilisateur par son ID
    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
