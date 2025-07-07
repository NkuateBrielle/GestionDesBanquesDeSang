<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-blood-red mb-4">Résultats pour le groupe <?= $bloodType ?></h2>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header bg-blood-red text-white">
                            <h4 class="mb-0">Donneurs disponibles</h4>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($donors)): ?>
                                <div class="list-group">
                                    <?php foreach ($donors as $donor): ?>
                                        <div class="list-group-item">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h5><?= htmlspecialchars($donor['first_name'] . ' ' . $donor['last_name']) ?></h5>
                                                    <span class="blood-type-badge"><?= $donor['blood_type'] ?></span>
                                                    <p class="mb-1"><?= htmlspecialchars($donor['city']) ?></p>
                                                </div>
                                                <a href="https://wa.me/<?= preg_replace('/\D/', '', $donor['phone']) ?>" 
                                                   class="btn btn-success" target="_blank">
                                                    <i class="fab fa-whatsapp"></i> Contacter
                                                </a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-info">
                                    Aucun donneur trouvé pour ce groupe sanguin.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-blood-red text-white">
                            <h4 class="mb-0">Hôpitaux avec stock</h4>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($hospitals)): ?>
                                <div class="list-group">
                                    <?php foreach ($hospitals as $hospital): ?>
                                        <div class="list-group-item">
                                            <h5><?= htmlspecialchars($hospital['name']) ?></h5>
                                            <p>
                                                <span class="blood-type-badge"><?= $bloodType ?>: <?= $hospital['quantity'] ?> unités</span>
                                            </p>
                                            <p class="mb-1">
                                                <i class="fas fa-map-marker-alt"></i> 
                                                <?= htmlspecialchars($hospital['address']) ?>, <?= htmlspecialchars($hospital['city']) ?>
                                            </p>
                                            <p class="mb-1">
                                                <i class="fas fa-phone"></i> <?= htmlspecialchars($hospital['phone']) ?>
                                            </p>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-info">
                                    Aucun hôpital avec stock trouvé pour ce groupe sanguin.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <a href="<?= View::url('patient/search') ?>" class="btn btn-blood-red">
                    <i class="fas fa-arrow-left"></i> Nouvelle recherche
                </a>
            </div>
        </div>
    </div>
</div>