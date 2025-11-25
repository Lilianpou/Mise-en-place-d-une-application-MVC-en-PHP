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
    public $password;
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

    // Créer un utilisateur
    public function create($nom, $prenom, $telephone, $email, $password)
    {
        $query = "INSERT INTO " . $this->table . " SET nom=:nom, prenom=:prenom, telephone=:telephone, email=:email, password=:password";
        $stmt = $this->conn->prepare($query);

        // Nettoyage des données
        $nom = htmlspecialchars(strip_tags($nom));
        $prenom = htmlspecialchars(strip_tags($prenom));
        $telephone = htmlspecialchars(strip_tags($telephone));
        $email = htmlspecialchars(strip_tags($email));
        // Le mot de passe doit être haché avant d'être envoyé ici ou haché ici
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Liaison des paramètres
        $stmt->bindParam(":nom", $nom);
        $stmt->bindParam(":prenom", $prenom);
        $stmt->bindParam(":telephone", $telephone);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password_hash);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Récupérer un utilisateur par son email
    public function getByEmail($email)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
