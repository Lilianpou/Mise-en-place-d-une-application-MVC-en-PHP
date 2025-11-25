<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= WEBROOT ?>assets/css/style.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-dark text-white">
                        <h3 class="mb-0">Créer un nouveau trajet</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($data['error'])): ?>
                            <div class="alert alert-danger">
                                <?php echo $data['error']; ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= WEBROOT ?>trajet/create" method="POST">
                            <h5 class="mb-3">Informations du conducteur</h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nom</label>
                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($data['user']['nom']); ?>" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Prénom</label>
                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($data['user']['prenom']); ?>" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" value="<?php echo htmlspecialchars($data['user']['email']); ?>" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Téléphone</label>
                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($data['user']['telephone'] ?? ''); ?>" disabled>
                                </div>
                            </div>

                            <hr>

                            <h5 class="mb-3">Détails du trajet</h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="agence_depart_id" class="form-label">Agence de départ</label>
                                    <select class="form-select" id="agence_depart_id" name="agence_depart_id" required>
                                        <option value="">Choisir une agence...</option>
                                        <?php foreach ($data['agences'] as $agence): ?>
                                            <option value="<?php echo $agence['id']; ?>"><?php echo htmlspecialchars($agence['nom']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="agence_arrivee_id" class="form-label">Agence d'arrivée</label>
                                    <select class="form-select" id="agence_arrivee_id" name="agence_arrivee_id" required>
                                        <option value="">Choisir une agence...</option>
                                        <?php foreach ($data['agences'] as $agence): ?>
                                            <option value="<?php echo $agence['id']; ?>"><?php echo htmlspecialchars($agence['nom']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="date_heure_depart" class="form-label">Date et heure de départ</label>
                                    <input type="datetime-local" class="form-control" id="date_heure_depart" name="date_heure_depart" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="date_heure_arrivee" class="form-label">Date et heure d'arrivée</label>
                                    <input type="datetime-local" class="form-control" id="date_heure_arrivee" name="date_heure_arrivee" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="places_totales" class="form-label">Nombre de places proposées</label>
                                <input type="number" class="form-control" id="places_totales" name="places_totales" min="1" required>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="<?= WEBROOT ?>" class="btn btn-secondary me-md-2">Annuler</a>
                                <button type="submit" class="btn btn-primary">Publier le trajet</button>
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
