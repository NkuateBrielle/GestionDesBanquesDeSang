<?php
// app/views/auth/login.php
$title = 'Connexion - BloodBank';
ob_start();
?>

<div class="auth-container">
    <div class="container-fluid">
        <div class="row min-vh-100">
            <!-- Left side - Image and branding -->
            <div class="col-lg-6 d-none d-lg-flex bg-gradient-blood text-white">
                <div class="d-flex flex-column justify-content-center align-items-center w-100 p-5">
                    <div class="text-center">
                        <img src="/assets/images/blood-drop.svg" alt="BloodBank" class="mb-4" style="width: 120px; height: 120px; filter: brightness(0) invert(1);">
                        <h1 class="display-4 fw-bold mb-3">BloodBank</h1>
                        <p class="lead mb-4">
                            Connectez-vous pour accéder à votre espace personnel et continuer à sauver des vies.
                        </p>
                        <div class="row text-center">
                            <div class="col-4">
                                <h4 class="fw-bold">500+</h4>
                                <small>Donneurs</small>
                            </div>
                            <div class="col-4">
                                <h4 class="fw-bold">50+</h4>
                                <small>Hôpitaux</small>
                            </div>
                            <div class="col-4">
                                <h4 class="fw-bold">1000+</h4>
                                <small>Vies sauvées</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right side - Login form -->
            <div class="col-lg-6 d-flex align-items-center">
                <div class="w-100 p-5">
                    <div class="auth-form-container">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold text-dark mb-2">Bon retour !</h2>
                            <p class="text-muted">Connectez-vous à votre compte</p>
                        </div>

                        <form method="POST" action="/login" class="auth-form">
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope me-2"></i>Email
                                </label>
                                <input type="email" class="form-control form-control-lg" id="email" name="email" 
                                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                                <?php if (isset($errors['email'])): ?>
                                    <div class="text-danger mt-1 small">
                                        <i class="fas fa-exclamation-circle me-1"></i>
                                        <?= htmlspecialchars($errors['email']) ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock me-2"></i>Mot de passe
                                </label>
                                <div class="input-group">
                                    <input type="password" class="form-control form-control-lg" id="password" name="password" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <?php if (isset($errors['password'])): ?>
                                    <div class="text-danger mt-1 small">
                                        <i class="fas fa-exclamation-circle me-1"></i>
                                        <?= htmlspecialchars($errors['password']) ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">
                                        Se souvenir de moi
                                    </label>
                                </div>
                                <a href="/forgot-password" class="text-blood-primary text-decoration-none">
                                    Mot de passe oublié ?
                                </a>
                            </div>

                            <button type="submit" class="btn btn-blood-primary btn-lg w-100 mb-3">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                Se connecter
                            </button>

                            <div class="text-center">
                                <p class="text-muted mb-0">
                                    Pas encore de compte ?
                                    <a href="/register" class="text-blood-primary text-decoration-none fw-bold">
                                        Inscrivez-vous
                                    </a>
                                </p>
                            </div>
                        </form>

                        <!-- Role-specific login hints -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="card bg-light border-0">
                                    <div class="card-body p-3">
                                        <h6 class="card-title mb-2">
                                            <i class="fas fa-info-circle text-blood-primary me-2"></i>
                                            Accès par rôle
                                        </h6>
                                        <div class="row text-center">
                                            <div class="col-4">
                                                <div class="text-success mb-1">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                                <small class="text-muted">Donneur</small>
                                            </div>
                                            <div class="col-4">
                                                <div class="text-primary mb-1">
                                                    <i class="fas fa-hospital"></i>
                                                </div>
                                                <small class="text-muted">Hôpital</small>
                                            </div>
                                            <div class="col-4">
                                                <div class="text-warning mb-1">
                                                    <i class="fas fa-user-shield"></i>
                                                </div>
                                                <small class="text-muted">Admin</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    
    togglePassword.addEventListener('click', function() {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        
        const icon = this.querySelector('i');
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    });
    
    // Form validation
    const form = document.querySelector('.auth-form');
    form.addEventListener('submit', function(e) {
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        
        if (!email || !password) {
            e.preventDefault();
            alert('Veuillez remplir tous les champs');
        }
    });
});
</script>

<style>
.auth-container {
    min-height: 100vh;
}

.bg-gradient-blood {
    background: linear-gradient(135deg, #8B0000 0%, #A52A2A 100%);
    position: relative;
}

.bg-gradient-blood::before {
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

.bg-gradient-blood > div {
    position: relative;
    z-index: 2;
}

.auth-form-container {
    max-width: 450px;
    margin: 0 auto;
}

.form-control-lg {
    border-radius: 8px;
    padding: 12px 16px;
    border: 2px solid #e9ecef;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-control-lg:focus {
    border-color: #8B0000;
    box-shadow: 0 0 0 0.2rem rgba(139, 0, 0, 0.25);
}

.btn-blood-primary {
    background-color: #8B0000;
    border-color: #8B0000;
    color: white;
    border-radius: 8px;
    padding: 12px 24px;
    font-weight: 600;
    transition: all 0.15s ease-in-out;
}

.btn-blood-primary:hover {
    background-color: #A52A2A;
    border-color: #A52A2A;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(139, 0, 0, 0.3);
}

.text-blood-primary {
    color: #8B0000 !important;
}

.text-blood-primary:hover {
    color: #A52A2A !important;
}

@media (max-width: 991.98px) {
    .auth-container .col-lg-6 {
        padding: 2rem 1rem;
    }
}
</style>