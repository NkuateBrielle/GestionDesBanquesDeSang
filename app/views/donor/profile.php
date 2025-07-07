<?php require_once VIEW_PATH . '/layouts/header.php'; ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-blood-red text-white">
                    <h3 class="mb-0">Profil Donneur</h3>
                </div>
                <div class="card-body">
                    <?php FlashHelper::display(); ?>
                    
                    <form method="post" action="<?= APP_URL ?>/donor/profile">
                        <div class="form-group">
                            <label for="blood_type">Groupe sanguin</label>
                            <select class="form-control" id="blood_type" name="blood_type" required>
                                <option value="">Sélectionnez votre groupe sanguin</option>
                                <?php foreach ($bloodTypes as $type): ?>
                                    <option value="<?= $type ?>" <?= $donor['blood_type'] === $type ? 'selected' : '' ?>>
                                        <?= $type ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Téléphone</label>
                            <input type="tel" class="form-control" id="phone" name="phone" 
                                   value="<?= htmlspecialchars($donor['phone']) ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="address">Adresse</label>
                            <input type="text" class="form-control" id="address" name="address" 
                                   value="<?= htmlspecialchars($donor['address']) ?>" required>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="city">Ville</label>
                                    <input type="text" class="form-control" id="city" name="city" 
                                           value="<?= htmlspecialchars($donor['city']) ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country">Pays</label>
                                    <input type="text" class="form-control" id="country" name="country" 
                                           value="<?= htmlspecialchars($donor['country']) ?>" required>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-blood-red">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once VIEW_PATH . '/layouts/footer.php'; ?>