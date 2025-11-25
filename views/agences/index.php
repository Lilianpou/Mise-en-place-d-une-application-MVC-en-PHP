<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title'] ?? 'Gestion des agences'; ?></title>
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
                        <a href="<?= WEBROOT ?>" class="btn btn-secondary">Trajets</a>
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

        <!-- Titre et bouton Créer -->
        <div class="d-flex justify-content-between align-items-center my-4">
            <h2>Gestion des agences</h2>
            <a href="<?= WEBROOT ?>agences/create" class="btn btn-primary">Ajouter une agence</a>
        </div>

        <!-- Tableau -->
        <div class="table-responsive">
            <table class="table table-striped table-hover table-custom text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom de l'agence</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data['agences'])): ?>
                        <?php foreach ($data['agences'] as $agence): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($agence['id']); ?></td>
                                <td><?php echo htmlspecialchars($agence['nom']); ?></td>
                                <td>
                                    <a href="<?= WEBROOT ?>agences/edit/<?php echo $agence['id']; ?>" class="action-icon" title="Modifier"><i class="fas fa-edit"></i></a>
                                    <a href="<?= WEBROOT ?>agences/delete/<?php echo $agence['id']; ?>" class="action-icon" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette agence ?');"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">Aucune agence trouvée.</td>
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