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

    // Créer un utilisateur
    public function create($nom, $prenom, $telephone, $email)
    {
        $query = "INSERT INTO " . $this->table . " SET nom=:nom, prenom=:prenom, telephone=:telephone, email=:email";
        $stmt = $this->conn->prepare($query);

        // Nettoyage des données
        $nom = htmlspecialchars(strip_tags($nom));
        $prenom = htmlspecialchars(strip_tags($prenom));
        $telephone = htmlspecialchars(strip_tags($telephone));
        $email = htmlspecialchars(strip_tags($email));

        // Liaison des paramètres
        $stmt->bindParam(":nom", $nom);
        $stmt->bindParam(":prenom", $prenom);
        $stmt->bindParam(":telephone", $telephone);
        $stmt->bindParam(":email", $email);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
