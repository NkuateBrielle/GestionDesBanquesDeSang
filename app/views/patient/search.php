<?php require_once VIEW_PATH . '/layouts/header.php'; ?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-blood-red text-white">
                    <h3 class="mb-0">Recherche de sang</h3>
                </div>
                <div class="card-body">
                    <form action="<?= APP_URL ?>/patient/search" method="post">
                        <div class="form-group">
                            <label for="blood_type">Groupe sanguin recherché</label>
                            <select class="form-control" id="blood_type" name="blood_type" required>
                                <option value="">Sélectionnez un groupe sanguin</option>
                                <?php foreach ($bloodTypes as $type): ?>
                                    <option value="<?= $type ?>"><?= $type ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="location">Localisation (ville, adresse)</label>
                            <input type="text" class="form-control" id="location" name="location">
                        </div>
                        
                        <div class="form-group">
                            <label for="radius">Rayon de recherche (km)</label>
                            <select class="form-control" id="radius" name="radius">
                                <option value="5">5 km</option>
                                <option value="10" selected>10 km</option>
                                <option value="20">20 km</option>
                                <option value="50">50 km</option>
                                <option value="100">100 km</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-blood-red btn-block">
                            <i class="fas fa-search"></i> Rechercher
                        </button>
                    </form>
                    
                    <div class="mt-4 text-center">
                        <a href="<?= APP_URL ?>/patient/map" class="btn btn-outline-blood-red">
                            <i class="fas fa-map-marked-alt"></i> Voir sur la carte
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once VIEW_PATH . '/layouts/footer.php'; ?>