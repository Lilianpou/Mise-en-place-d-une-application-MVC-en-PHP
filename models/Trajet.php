<?php
require_once(ROOT . 'config/database.php');

class Trajet
{
    private $conn;
    private $table = "trajets";

    public $id;
    public $agence_depart_id;
    public $agence_arrivee_id;
    public $date_heure_depart;
    public $date_heure_arrivee;
    public $places_totales;
    public $places_prises;
    public $contact_id;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Récupérer tous les trajets avec les noms des agences et du contact
    public function getAll()
    {
        $query = "SELECT t.*, 
                         ad.nom as agence_depart_nom, 
                         aa.nom as agence_arrivee_nom,
                         u.nom as contact_nom, u.prenom as contact_prenom, u.telephone as contact_telephone
                  FROM " . $this->table . " t
                  LEFT JOIN agences ad ON t.agence_depart_id = ad.id
                  LEFT JOIN agences aa ON t.agence_arrivee_id = aa.id
                  LEFT JOIN users u ON t.contact_id = u.id
                  ORDER BY t.date_heure_depart ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer un trajet par ID
    public function getById($id)
    {
        $query = "SELECT t.*, 
                         ad.nom as agence_depart_nom, 
                         aa.nom as agence_arrivee_nom,
                         u.nom as contact_nom, u.prenom as contact_prenom
                  FROM " . $this->table . " t
                  LEFT JOIN agences ad ON t.agence_depart_id = ad.id
                  LEFT JOIN agences aa ON t.agence_arrivee_id = aa.id
                  LEFT JOIN users u ON t.contact_id = u.id
                  WHERE t.id = :id LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Créer un trajet
    public function create($data)
    {
        $query = "INSERT INTO " . $this->table . " 
                  SET agence_depart_id=:agence_depart_id, 
                      agence_arrivee_id=:agence_arrivee_id, 
                      date_heure_depart=:date_heure_depart, 
                      date_heure_arrivee=:date_heure_arrivee, 
                      places_totales=:places_totales, 
                      places_prises=:places_prises, 
                      contact_id=:contact_id";

        $stmt = $this->conn->prepare($query);

        // Nettoyage et liaison
        $stmt->bindParam(":agence_depart_id", $data['agence_depart_id']);
        $stmt->bindParam(":agence_arrivee_id", $data['agence_arrivee_id']);
        $stmt->bindParam(":date_heure_depart", $data['date_heure_depart']);
        $stmt->bindParam(":date_heure_arrivee", $data['date_heure_arrivee']);
        $stmt->bindParam(":places_totales", $data['places_totales']);
        $stmt->bindParam(":places_prises", $data['places_prises']);
        $stmt->bindParam(":contact_id", $data['contact_id']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Supprimer un trajet
    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Modifier un trajet
    public function update($id, $data)
    {
        $query = "UPDATE " . $this->table . " 
                  SET agence_depart_id=:agence_depart_id, 
                      agence_arrivee_id=:agence_arrivee_id, 
                      date_heure_depart=:date_heure_depart, 
                      date_heure_arrivee=:date_heure_arrivee, 
                      places_totales=:places_totales, 
                      places_prises=:places_prises, 
                      contact_id=:contact_id
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Nettoyage et liaison
        $stmt->bindParam(":agence_depart_id", $data['agence_depart_id']);
        $stmt->bindParam(":agence_arrivee_id", $data['agence_arrivee_id']);
        $stmt->bindParam(":date_heure_depart", $data['date_heure_depart']);
        $stmt->bindParam(":date_heure_arrivee", $data['date_heure_arrivee']);
        $stmt->bindParam(":places_totales", $data['places_totales']);
        $stmt->bindParam(":places_prises", $data['places_prises']);
        $stmt->bindParam(":contact_id", $data['contact_id']);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Vérifier si un utilisateur est l'auteur du trajet
    public function isAuthor($trajetId, $userId)
    {
        $query = "SELECT id FROM " . $this->table . " WHERE id = :id AND contact_id = :contact_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $trajetId);
        $stmt->bindParam(':contact_id', $userId);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    // Récupérer les trajets disponibles (futurs et avec places)
    public function getAvailableTrajets()
    {
        $query = "SELECT t.*, 
                         ad.nom as agence_depart_nom, 
                         aa.nom as agence_arrivee_nom,
                         u.nom as contact_nom, 
                         u.prenom as contact_prenom, 
                         u.telephone as contact_telephone, 
                         u.email as contact_email
                  FROM " . $this->table . " t
                  LEFT JOIN agences ad ON t.agence_depart_id = ad.id
                  LEFT JOIN agences aa ON t.agence_arrivee_id = aa.id
                  LEFT JOIN users u ON t.contact_id = u.id
                  WHERE t.date_heure_depart > NOW() 
                  AND t.places_prises < t.places_totales
                  ORDER BY t.date_heure_depart ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
