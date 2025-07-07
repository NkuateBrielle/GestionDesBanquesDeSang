<div class="auth-container">
    <div class="auth-header">
        <img src="<?= View::asset('images/logo.png') ?>" alt="<?= APP_NAME ?>">
        <h2>Connexion</h2>
    </div>
    
    <?php FlashHelper::display(); ?>
    
    <form action="<?= View::url('login') ?>" method="post">
        <input type="hidden" name="_csrf" value="<?= CSRFHelper::generateToken() ?>">
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember">Se souvenir de moi</label>
        </div>
        
        <button type="submit" class="btn btn-blood-red btn-block">Se connecter</button>
        
        <div class="auth-footer">
            <a href="<?= View::url('register/donor') ?>">Créer un compte</a> | 
            <a href="<?= View::url('forgot-password') ?>">Mot de passe oublié ?</a>
        </div>
    </form>
</div>