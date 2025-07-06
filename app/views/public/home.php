<?php
// app/views/home/index.php
$title = 'BloodBank - Sauvons des vies ensemble';
// ob_start();
?>

<!-- Hero Section -->
<section class="hero-section bg-gradient-blood text-white py-5">
    <div class="container">
        <div class="row align-items-center min-vh-50">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">
                    Sauvons des vies <br>
                    <span class="text-accent">ensemble</span>
                </h1>
                <p class="lead mb-4">
                    BloodBank connecte les donneurs de sang aux hôpitaux pour des interventions d'urgence.
                    Chaque don compte, chaque vie compte.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="/register" class="btn btn-light btn-lg px-4">
                        <i class="fas fa-heart me-2"></i>Devenir donneur
                    </a>
                    <a href="/search" class="btn btn-outline-light btn-lg px-4">
                        <i class="fas fa-search me-2"></i>Rechercher du sang
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="hero-image">
                    <img src="/assets/images/blood-drop.svg" alt="Goutte de sang" class="img-fluid hero-blood-drop">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="display-4 text-blood-primary mb-2">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="fw-bold"><?= $stats['donors'] ?? 0 ?></h3>
                        <p class="text-muted">Donneurs actifs</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="display-4 text-blood-primary mb-2">
                            <i class="fas fa-hospital"></i>
                        </div>
                        <h3 class="fw-bold"><?= $stats['hospitals'] ?? 0 ?></h3>
                        <p class="text-muted">Hôpitaux partenaires</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="display-4 text-blood-primary mb-2">
                            <i class="fas fa-tint"></i>
                        </div>
                        <h3 class="fw-bold"><?= $stats['donations'] ?? 0 ?></h3>
                        <p class="text-muted">Dons réalisés</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="display-4 text-blood-primary mb-2">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                        <h3 class="fw-bold"><?= $stats['lives_saved'] ?? 0 ?></h3>
                        <p class="text-muted">Vies sauvées</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How it works Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5">
                <h2 class="fw-bold mb-3">Comment ça marche ?</h2>
                <p class="lead text-muted">
                    Un processus simple et efficace pour connecter les donneurs aux personnes dans le besoin.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="text-center">
                    <div class="rounded-circle bg-blood-primary text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-user-plus fa-2x"></i>
                    </div>
                    <h4 class="fw-bold">1. Inscription</h4>
                    <p class="text-muted">
                        Créez votre profil en tant que donneur ou hôpital. 
                        Renseignez vos informations et votre groupe sanguin.
                    </p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="text-center">
                    <div class="rounded-circle bg-blood-primary text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-search fa-2x"></i>
                    </div>
                    <h4 class="fw-bold">2. Recherche</h4>
                    <p class="text-muted">
                        Recherchez des donneurs ou des hôpitaux par groupe sanguin 
                        et localisez-les sur une carte interactive.
                    </p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="text-center">
                    <div class="rounded-circle bg-blood-primary text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fab fa-whatsapp fa-2x"></i>
                    </div>
                    <h4 class="fw-bold">3. Contact</h4>
                    <p class="text-muted">
                        Contactez directement les donneurs via WhatsApp 
                        pour organiser rapidement le don.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Blood Types Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5">
                <h2 class="fw-bold mb-3">Groupes sanguins</h2>
                <p class="lead text-muted">
                    Connaissez votre groupe sanguin et découvrez avec qui vous êtes compatible.
                </p>
            </div>
        </div>
        <div class="row">
            <?php 
            $bloodTypes = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
            foreach ($bloodTypes as $type): 
            ?>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card border-0 shadow-sm text-center h-100">
                        <div class="card-body">
                            <div class="display-4 text-blood-primary mb-2">
                                <i class="fas fa-tint"></i>
                            </div>
                            <h4 class="fw-bold"><?= $type ?></h4>
                            <p class="text-muted small">
                                <?= ($bloodGroups[$type]['donors'] ?? 0) ?> donneurs disponibles
                            </p>
                            <a href="/search?blood_type=<?= urlencode($type) ?>" class="btn btn-outline-primary btn-sm">
                                Rechercher
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Emergency Section -->
<section class="py-5 bg-danger text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h2 class="fw-bold mb-3">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Urgence médicale ?
                </h2>
                <p class="lead mb-0">
                    Contactez immédiatement notre ligne d'urgence 24h/24 et 7j/7.
                    Nous vous mettrons en relation avec les donneurs les plus proches.
                </p>
            </div>
            <div class="col-lg-4 text-center">
                <a href="tel:+237XXXXXXXXX" class="btn btn-light btn-lg">
                    <i class="fas fa-phone me-2"></i>
                    Appeler maintenant
                </a>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="fw-bold mb-4">Prêt à sauver des vies ?</h2>
                <p class="lead text-muted mb-4">
                    Rejoignez notre communauté de donneurs et faites la différence dès aujourd'hui.
                </p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="/register" class="btn btn-blood-primary btn-lg px-4">
                        <i class="fas fa-heart me-2"></i>
                        Devenir donneur
                    </a>
                    <a href="/hospital/register" class="btn btn-outline-primary btn-lg px-4">
                        <i class="fas fa-hospital me-2"></i>
                        Partenaire hôpital
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<style>
.hero-section {
    background: linear-gradient(135deg, #8B0000 0%, #A52A2A 100%);
    position: relative;
    overflow: hidden;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('/assets/images/blood-pattern.png') no-repeat center center;
    background-size: cover;
    opacity: 0.1;
    z-index: 1;
}

.hero-section .container {
    position: relative;
    z-index: 2;
}

.hero-blood-drop {
    animation: float 3s ease-in-out infinite;
    filter: drop-shadow(0 10px 20px rgba(0,0,0,0.3));
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

.min-vh-50 {
    min-height: 50vh;
}

.text-accent {
    color: #FFD700;
}

.bg-gradient-blood {
    background: linear-gradient(135deg, #8B0000 0%, #A52A2A 100%);
}

.btn-blood-primary {
    background-color: #8B0000;
    border-color: #8B0000;
    color: white;
}

.btn-blood-primary:hover {
    background-color: #A52A2A;
    border-color: #A52A2A;
}

.text-blood-primary {
    color: #8B0000 !important;
}

.bg-blood-primary {
    background-color: #8B0000 !important;
}

.card {
    transition: transform 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-5px);
}
</style>