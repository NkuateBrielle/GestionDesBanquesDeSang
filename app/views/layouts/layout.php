<?php
// app/views/layouts/layout.php
$title = $title ?? 'BloodBank - Sauvons des vies';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <link rel="icon" href="/assets/images/favicon.ico" type="image/x-icon">
    
    <!-- Bootstrap CSS -->
    <link href="/assets/vendor/bootstrap/bootstrap.min.css" rel="stylesheet">
    
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="/assets/vendor/leaflet/leaflet.css">
    
    <!-- Custom CSS -->
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/css/responsive.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header class="navbar navbar-expand-lg navbar-dark bg-blood-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="/assets/images/blood-drop.svg" alt="BloodBank" width="30" height="30" class="me-2">
                <span class="fw-bold">BloodBank</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/search">Rechercher</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">À propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Contact</a>
                    </li>
                </ul>
                
                <ul class="navbar-nav">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user me-1"></i>
                                <?= htmlspecialchars($_SESSION['user_name'] ?? 'Utilisateur') ?>
                            </a>
                            <ul class="dropdown-menu">
                                <?php if ($_SESSION['user_role'] === 'donor'): ?>
                                    <li><a class="dropdown-item" href="/donor/dashboard"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                                    <li><a class="dropdown-item" href="/donor/profile"><i class="fas fa-user me-2"></i>Profil</a></li>
                                <?php elseif ($_SESSION['user_role'] === 'hospital'): ?>
                                    <li><a class="dropdown-item" href="/hospital/dashboard"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                                    <li><a class="dropdown-item" href="/hospital/profile"><i class="fas fa-building me-2"></i>Profil</a></li>
                                <?php elseif ($_SESSION['user_role'] === 'admin'): ?>
                                    <li><a class="dropdown-item" href="/admin/dashboard"><i class="fas fa-cog me-2"></i>Administration</a></li>
                                <?php endif; ?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt me-2"></i>Déconnexion</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/login">
                                <i class="fas fa-sign-in-alt me-1"></i>Connexion
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-light ms-2" href="/register">
                                <i class="fas fa-user-plus me-1"></i>Inscription
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </header>

    <!-- Flash Messages -->
    <?php if (isset($_SESSION['flash'])): ?>
        <div class="container mt-3">
            <?php foreach ($_SESSION['flash'] as $type => $message): ?>
                <div class="alert alert-<?= $type === 'error' ? 'danger' : $type ?> alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($message) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endforeach; ?>
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <!-- Main Content -->
    <main class="main-content">
        <?= $content ?>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-light py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5 class="text-blood-primary mb-3">BloodBank</h5>
                    <p class="mb-2">Connecter les donneurs et les hôpitaux pour sauver des vies.</p>
                    <p class="small text-muted">© 2025 BloodBank. Tous droits réservés.</p>
                </div>
                <div class="col-md-4">
                    <h6 class="mb-3">Liens rapides</h6>
                    <ul class="list-unstyled">
                        <li><a href="/" class="text-decoration-none text-light">Accueil</a></li>
                        <li><a href="/search" class="text-decoration-none text-light">Rechercher</a></li>
                        <li><a href="/about" class="text-decoration-none text-light">À propos</a></li>
                        <li><a href="/contact" class="text-decoration-none text-light">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6 class="mb-3">Urgence</h6>
                    <p class="mb-2">
                        <i class="fas fa-phone text-blood-primary me-2"></i>
                        <strong>+237 6XX XXX XXX</strong>
                    </p>
                    <p class="mb-2">
                        <i class="fas fa-envelope text-blood-primary me-2"></i>
                        urgence@bloodbank.cm
                    </p>
                    <div class="mt-3">
                        <a href="#" class="text-light me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-light"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="/assets/vendor/bootstrap/bootstrap.min.js"></script>
    
    <!-- Leaflet JS -->
    <script src="/assets/vendor/leaflet/leaflet.js"></script>
    
    <!-- Custom JS -->
    <script src="/assets/js/main.js"></script>
    
    <!-- Page specific JS -->
    <?php if (isset($pageScript)): ?>
        <script src="<?= $pageScript ?>"></script>
    <?php endif; ?>
</body>
</html>