<div class="container">
    <h2 class="my-4">Tableau de bord - <?= htmlspecialchars($hospital['name']) ?></h2>
    
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-blood-red mb-4">
                <div class="card-body">
                    <h5 class="card-title">Stocks totaux</h5>
                    <p class="display-4"><?= array_sum(array_column($stocks, 'quantity')) ?></p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card text-white bg-dark mb-4">
                <div class="card-body">
                    <h5 class="card-title">Demandes ce mois</h5>
                    <p class="display-4"><?= $stats['requests_this_month'] ?></p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card text-white bg-secondary mb-4">
                <div class="card-body">
                    <h5 class="card-title">Donneurs proches</h5>
                    <p class="display-4"><?= $stats['nearby_donors'] ?></p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card mb-4">
        <div class="card-header bg-blood-red text-white">
            <h5 class="mb-0">Stocks par groupe sanguin</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Groupe sanguin</th>
                            <th>Quantité</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($stocks as $stock): ?>
                            <tr>
                                <td><?= $stock['blood_type'] ?></td>
                                <td><?= $stock['quantity'] ?></td>
                                <td>
                                    <?php if ($stock['quantity'] < 5): ?>
                                        <span class="badge badge-danger">Critique</span>
                                    <?php elseif ($stock['quantity'] < 10): ?>
                                        <span class="badge badge-warning">Faible</span>
                                    <?php else: ?>
                                        <span class="badge badge-success">Bon</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header bg-blood-red text-white">
            <h5 class="mb-0">Dernières demandes</h5>
        </div>
        <div class="card-body">
            <?php if (!empty($recentRequests)): ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Patient</th>
                                <th>Groupe</th>
                                <th>Quantité</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentRequests as $request): ?>
                                <tr>
                                    <td><?= date('d/m/Y', strtotime($request['request_date'])) ?></td>
                                    <td><?= htmlspecialchars($request['patient_name']) ?></td>
                                    <td><?= $request['blood_type'] ?></td>
                                    <td><?= $request['quantity'] ?></td>
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
                                        <a href="<?= View::url('hospital/request/' . $request['id']) ?>" 
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
</div>