<header class="bg-blood-red text-white shadow">
    <nav class="navbar navbar-expand-lg navbar-dark container">
        <a class="navbar-brand" href="<?= View::url() ?>">
            <img src="<?= View::asset('images/blood-drop.svg') ?>" width="30" height="30" class="d-inline-block align-top" alt="">
            <?= APP_NAME ?>
        </a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= View::url() ?>">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= View::url('about') ?>">À propos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= View::url('patient/search') ?>">Recherche</a>
                </li>
            </ul>
            
            <ul class="navbar-nav">
                <?php if (AuthHelper::isLoggedIn()): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                            <i class="fas fa-user-circle"></i> Mon compte
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="<?= View::url(AuthHelper::userRole() . '/dashboard') ?>">
                                Tableau de bord
                            </a>
                            <a class="dropdown-item" href="<?= View::url(AuthHelper::userRole() . '/profile') ?>">
                                Mon profil
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= View::url('logout') ?>">
                                <i class="fas fa-sign-out-alt"></i> Déconnexion
                            </a>
                        </div>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= View::url('login') ?>">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= View::url('register/donor') ?>">S'inscrire</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>