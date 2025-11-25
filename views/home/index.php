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
    <link rel="stylesheet" href="<?= WEBROOT ?>assets/css/style.css">
</head>

<body>
    <div class="container">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-custom d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="<?= WEBROOT ?>">Touche pas au klaxon</a>

            <div class="d-flex align-items-center gap-3">
                <?php if (isset($_SESSION['user'])): ?>
                    <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                        <a href="<?= WEBROOT ?>users" class="btn btn-secondary">Utilisateurs</a>
                        <a href="<?= WEBROOT ?>agences" class="btn btn-secondary">Agences</a>
                        <a href="<?= WEBROOT ?>trajets" class="btn btn-secondary">Trajets</a>
                    <?php else: ?>
                        <a href="<?= WEBROOT ?>trajet/create" class="btn btn-custom-dark">Créer un trajet</a>
                    <?php endif; ?>

                    <span class="fw-bold">Bonjour <?php echo htmlspecialchars($_SESSION['user']['prenom'] . ' ' . $_SESSION['user']['nom']); ?></span>
                    <a href="<?= WEBROOT ?>logout" class="btn btn-custom-dark">Déconnexion</a>
                <?php else: ?>
                    <a href="<?= WEBROOT ?>login" class="btn btn-custom-dark">Connexion</a>
                <?php endif; ?>
            </div>
        </nav>

        <!-- Titre -->
        <?php if (isset($_SESSION['user'])): ?>
            <h2>Trajets proposés</h2>
        <?php else: ?>
            <h2>Pour obtenir plus d'informations sur un trajet, veuillez vous connecter</h2>
        <?php endif; ?>

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
                        <?php if (isset($_SESSION['user'])): ?>
                            <th>Actions</th>
                        <?php endif; ?>
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
                                <?php if (isset($_SESSION['user'])): ?>
                                    <td>
                                        <button type="button" class="btn btn-link action-icon p-0 border-0" data-bs-toggle="modal" data-bs-target="#modalTrajet<?php echo $trajet['id']; ?>" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <?php if ($_SESSION['user']['role'] === 'admin' || $_SESSION['user']['id'] == $trajet['contact_id']): ?>
                                            <a href="<?= WEBROOT ?>trajet/edit/<?php echo $trajet['id']; ?>" class="action-icon" title="Modifier"><i class="fas fa-edit"></i></a>
                                            <a href="<?= WEBROOT ?>trajet/delete/<?php echo $trajet['id']; ?>" class="action-icon" title="Supprimer"><i class="fas fa-trash-alt"></i></a>
                                        <?php endif; ?>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modalTrajet<?php echo $trajet['id']; ?>" tabindex="-1" aria-labelledby="modalLabel<?php echo $trajet['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalLabel<?php echo $trajet['id']; ?>">Détails du trajet</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-start">
                                                        <p><strong>Identité :</strong> <?php echo htmlspecialchars(($trajet['contact_nom'] ?? '') . ' ' . ($trajet['contact_prenom'] ?? '')); ?></p>
                                                        <p><strong>Téléphone :</strong> <?php echo htmlspecialchars($trajet['contact_telephone'] ?? ''); ?></p>
                                                        <p><strong>Email :</strong> <?php echo htmlspecialchars($trajet['contact_email'] ?? ''); ?></p>
                                                        <p><strong>Nombre de places total :</strong> <?php echo htmlspecialchars($trajet['places_totales']); ?></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="<?php echo isset($_SESSION['user']) ? '8' : '7'; ?>">Aucun trajet disponible pour le moment.</td>
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