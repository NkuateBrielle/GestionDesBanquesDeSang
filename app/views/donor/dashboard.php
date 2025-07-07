<?php require_once VIEW_PATH . '/layouts/header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <!-- Profil du donneur -->
            <div class="card mb-4">
                <div class="card-header bg-blood-red text-white">
                    <h5>Mon Profil</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="blood-type-circle mx-auto mb-2">
                            <?= $donor['blood_type'] ?>
                        </div>
                        <h4><?= htmlspecialchars($donor['first_name'] . ' ' . $donor['last_name']) ?></h4>
                        <p class="text-muted"><?= htmlspecialchars($donor['city']) ?></p>
                    </div>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <i class="fas fa-envelope mr-2"></i> <?= htmlspecialchars($donor['email']) ?>
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-phone mr-2"></i> <?= htmlspecialchars($donor['phone']) ?>
                        <!-- </li>
                        <li class="list-group-item">
                            <i class="fas fa-map-marker-alt mr-2"></i> 
                            <?= htmlspecialchars($donor['address'] . ', ' . $donor['city']) ?>
                        </li> -->
                    </ul>
                </div>
            </div>

            <!-- Disponibilité -->
            <div class="card">
                <div class="card-header bg-blood-red text-white">
                    <h5>Disponibilité</h5>
                </div>
                <div class="card-body">
                    <form action="<?= View::url('donor/availability') ?>" method="post">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="is_available" 
                                   name="is_available" <?= $donor['is_available'] ? 'checked' : '' ?>>
                            <label class="form-check-label" for="is_available">
                                Je suis disponible pour donner du sang
                            </label>
                        </div>
                        <button type="submit" class="btn btn-blood-red btn-block">
                            Mettre à jour
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <!-- Demandes récentes -->
            <div class="card mb-4">
                <div class="card-header bg-blood-red text-white">
                    <h5>Demandes récentes</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($requests)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Hôpital</th>
                                        <th>Groupe</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($requests as $request): ?>
                                        <tr>
                                            <td><?= date('d/m/Y', strtotime($request['request_date'])) ?></td>
                                            <td><?= htmlspecialchars($request['hospital_name'] ?? 'Inconnu') ?></td>
                                            <td><?= $request['blood_type'] ?></td>
                                            <td>
                                                <?php if ($request['status'] === 'pending'): ?>
                                                    <span class="badge badge-warning">En attente</span>
                                                <?php elseif ($request['status'] === 'accepted'): ?>
                                                    <span class="badge badge-success">Acceptée</span>
                                                <?php else: ?>
                                                    <span class="badge badge-danger">Rejetée</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="<?= View::url('donor/request/' . $request['id']) ?>" 
                                                   class="btn btn-sm btn-outline-blood-red">
                                                    Détails
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            Aucune demande récente.
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Historique des dons -->
            <div class="card">
                <div class="card-header bg-blood-red text-white">
                    <h5>Historique des dons</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($donations)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Hôpital</th>
                                        <th>Quantité (ml)</th>
                                        <th>Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($donations as $donation): ?>
                                        <tr>
                                            <td><?= date('d/m/Y', strtotime($donation['donation_date'])) ?></td>
                                            <td><?= htmlspecialchars($donation['hospital_name'] ?? 'Inconnu') ?></td>
                                            <td><?= $donation['quantity'] ?></td>
                                            <td><?= $donation['donation_type'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            Aucun don enregistré.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once VIEW_PATH . '/layouts/footer.php'; ?>