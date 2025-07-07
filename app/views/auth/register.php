<?php
$userType = $userType ?? 'donor'; // valeur par défaut
$bloodTypes = $bloodTypes ?? ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']; // fallback
?>

<div class="auth-container">
    <div class="auth-header">
        <img src="<?= View::asset('images/logo.png') ?>" alt="<?= APP_NAME ?>">
        <h2>Inscription Donneur</h2>
    </div>
    
    <?php FlashHelper::display(); ?>
    
    <form action="<?= View::url('register/' . $userType) ?>" method="post">
        <input type="hidden" name="_csrf" value="<?= CSRFHelper::generateToken() ?>">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name">Prénom</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="last_name">Nom</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                </div>
            </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="phone">Téléphone</label>
            <input type="tel" class="form-control" id="phone" name="phone" required>
        </div>
        
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required>
            <small class="form-text text-muted">Minimum 8 caractères</small>
        </div>
        
        <div class="form-group">
            <label for="confirm_password">Confirmer le mot de passe</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        
        <?php if ($userType === 'donor'): ?>
            <div class="form-group">
                <label for="blood_type">Groupe sanguin</label>
                <select class="form-control" id="blood_type" name="blood_type" required>
                    <option value="">Sélectionnez votre groupe</option>
                    <?php foreach ($bloodTypes as $type): ?>
                        <option value="<?= htmlspecialchars($type) ?>"><?= htmlspecialchars($type) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php endif; ?>
        
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
            <label class="form-check-label" for="terms">
                J'accepte les <a href="<?= View::url('terms') ?>">conditions d'utilisation</a>
            </label>
        </div>
        
        <button type="submit" class="btn btn-blood-red btn-block">S'inscrire</button>
        
        <div class="auth-footer">
            Déjà inscrit ? <a href="<?= View::url('login') ?>">Connectez-vous</a>
        </div>
    </form>
</div>