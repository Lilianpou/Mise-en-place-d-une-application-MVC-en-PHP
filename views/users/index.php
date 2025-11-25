<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title'] ?? 'Liste des utilisateurs'; ?></title>
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

        <!-- Titre -->
        <h2>Liste des utilisateurs</h2>

        <!-- Tableau -->
        <div class="table-responsive">
            <table class="table table-striped table-hover table-custom text-center">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Rôle</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data['users'])): ?>
                        <?php foreach ($data['users'] as $user): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user['nom']); ?></td>
                                <td><?php echo htmlspecialchars($user['prenom']); ?></td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td><?php echo htmlspecialchars($user['telephone'] ?? ''); ?></td>
                                <td>
                                    <?php if ($user['role'] === 'admin'): ?>
                                        <span class="badge bg-danger">Admin</span>
                                    <?php else: ?>
                                        <span class="badge bg-primary">User</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">Aucun utilisateur trouvé.</td>
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