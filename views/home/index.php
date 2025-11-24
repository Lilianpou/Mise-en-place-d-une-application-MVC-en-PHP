<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title'] ?? 'Touche pas au klaxon'; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome pour les icônes -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <div class="container">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-custom d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="/">Touche pas au klaxon</a>

            <div class="d-flex align-items-center gap-3">
                <a href="/trajet/create" class="btn btn-custom-dark">Créer un trajet</a>
                <span class="fw-bold">Bonjour Xxxxxxx Xxxxxx</span>
                <a href="/logout" class="btn btn-custom-dark">Déconnexion</a>
            </div>
        </nav>

        <!-- Titre -->
        <h2>Trajets proposés</h2>

        <!-- Tableau -->
        <div class="table-responsive">
            <table class="table table-striped table-hover table-custom text-center">
                <thead>
                    <tr>
                        <th>Départ</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Destination</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Places</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data['trajets'])): ?>
                        <?php foreach ($data['trajets'] as $trajet): ?>
                            <?php
                            $dateDepart = new DateTime($trajet['date_heure_depart']);
                            $dateArrivee = new DateTime($trajet['date_heure_arrivee']);
                            $placesDispo = $trajet['places_totales'] - $trajet['places_prises'];
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($trajet['agence_depart_nom']); ?></td>
                                <td><?php echo $dateDepart->format('d/m/y'); ?></td>
                                <td><?php echo $dateDepart->format('H:i'); ?></td>
                                <td><?php echo htmlspecialchars($trajet['agence_arrivee_nom']); ?></td>
                                <td><?php echo $dateArrivee->format('d/m/y'); ?></td>
                                <td><?php echo $dateArrivee->format('H:i'); ?></td>
                                <td><?php echo $placesDispo; ?></td>
                                <td>
                                    <a href="/trajet/view/<?php echo $trajet['id']; ?>" class="action-icon" title="Voir"><i class="fas fa-eye"></i></a>
                                    <!-- Ces actions devraient être conditionnées par les droits de l'utilisateur -->
                                    <a href="/trajet/edit/<?php echo $trajet['id']; ?>" class="action-icon" title="Modifier"><i class="fas fa-edit"></i></a>
                                    <a href="/trajet/delete/<?php echo $trajet['id']; ?>" class="action-icon" title="Supprimer"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8">Aucun trajet disponible pour le moment.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <footer>
            &copy; 2024 - CENEF - MVC PHP
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>