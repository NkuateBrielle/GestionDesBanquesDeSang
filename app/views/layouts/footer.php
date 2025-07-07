<footer class="bg-dark text-white py-4 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5><?= APP_NAME ?></h5>
                <p>Système de gestion des dons de sang.</p>
            </div>
            <div class="col-md-4">
                <h5>Liens rapides</h5>
                <ul class="list-unstyled">
                    <li><a href="<?= View::url() ?>" class="text-white">Accueil</a></li>
                    <li><a href="<?= View::url('about') ?>" class="text-white">À propos</a></li>
                    <li><a href="<?= View::url('contact') ?>" class="text-white">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Contact</h5>
                <address>
                    <i class="fas fa-map-marker-alt"></i> 123 Rue de la Santé, Ville<br>
                    <i class="fas fa-phone"></i> +123 456 7890<br>
                    <i class="fas fa-envelope"></i> contact@bloodbank.org
                </address>
            </div>
        </div>
        <hr class="bg-light">
        <div class="text-center">
            <small>&copy; <?= date('Y') ?> <?= APP_NAME ?>. Tous droits réservés.</small>
        </div>
    </div>
</footer>