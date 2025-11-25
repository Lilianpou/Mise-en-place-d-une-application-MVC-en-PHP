<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title'] ?? 'Modifier une agence'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= WEBROOT ?>assets/css/style.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-dark text-white">
                        <h3 class="mb-0">Modifier l'agence</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($data['error'])): ?>
                            <div class="alert alert-danger">
                                <?php echo $data['error']; ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= WEBROOT ?>agences/edit/<?php echo $data['agence']['id']; ?>" method="POST">
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom de l'agence</label>
                                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars($data['agence']['nom']); ?>" required>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="<?= WEBROOT ?>agences" class="btn btn-secondary me-md-2">Annuler</a>
                                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>