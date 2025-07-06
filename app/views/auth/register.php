<?php
// app/views/auth/register.php
$title = 'Inscription - BloodBank';
ob_start();
?>

<div class="auth-container">
    <div class="container-fluid">
        <div class="row min-vh-100">
            <!-- Left side - Form -->
            <div class="col-lg-8 d-flex align-items-center">
                <div class="w-100 p-5">
                    <div class="auth-form-container">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold text-dark mb-2">Rejoignez BloodBank</h2>
                            <p class="text-muted">Créez votre compte pour sauver des vies</p>
                        </div>

                        <!-- Role Selection -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <label class="form-label">
                                    <i class="fas fa-user-tag me-2"></i>Je suis un(e) :
                                </label>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="radio" class="btn-check" name="role" id="role_donor" value="donor" checked>
                                        <label class="btn btn-outline-success w-100 h-100 p-3" for="role_donor">
                                            <div class="text-center">
                                                <i class="fas fa-heart fa-2x mb-2"></i>
                                                <h5 class="mb-1">Donneur</h5>
                                                <small class="text-muted">Je veux donner mon sang</small>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="radio" class="btn-check" name="role" id="role_hospital" value="hospital">
                                        <label class="btn btn-outline-primary w-100 h-100 p-3" for="role_hospital">
                                            <div class="text-center">
                                                <i class="fas fa-hospital fa-2x mb-2"></i>
                                                <h5 class="mb-1">Hôpital</h5>
                                                <small class="text-muted">Je représente un hôpital</small>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form method="POST" action="/register" class="auth-form">
                            <input type="hidden" name="role" id="selected_role" value="donor">
                            
                            <!-- Personal Information -->
                            <div class="form-section mb-4">
                                <h5 class="section-title mb-3">
                                    <i class="fas fa-user me-2"></i>Informations personnelles
                                </h5>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="first_name" class="form-label">Prénom *</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" 
                                               value="<?= htmlspecialchars($_POST['first_name'] ?? '') ?>" required>
                                        <?php if (isset($errors['first_name'])): ?>
                                            <div class="text-danger mt-1 small">
                                                <i class="fas fa-exclamation-circle me-1"></i>
                                                <?= htmlspecialchars($errors['first_name']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last_name" class="form-label">Nom *</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" 
                                               value="<?= htmlspecialchars($_POST['last_name'] ?? '') ?>" required>
                                        <?php if (isset($errors['last_name'])): ?>
                                            <div class="text-danger mt-1 small">
                                                <i class="fas fa-exclamation-circle me-1"></i>
                                                <?= htmlspecialchars($errors['last_name']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email *</label>
                                        <input type="email" class="form-control" id="email" name="email" 
                                               value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                                        <?php if (isset($errors['email'])): ?>
                                            <div class="text-danger mt-1 small">
                                                <i class="fas fa-exclamation-circle me-1"></i>
                                                <?= htmlspecialchars($errors['email']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">Téléphone *</label>
                                        <input type="tel" class="form-control" id="phone" name="phone" 
                                               value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>" 
                                               placeholder="6XXXXXXXX" required>
                                        <?php if (isset($errors['phone'])): ?>
                                            <div class="text-danger mt-1 small">
                                                <i class="fas fa-exclamation-circle me-1"></i>
                                                <?= htmlspecialchars($errors['phone']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="age" class="form-label">Âge *</label>
                                        <input type="number" class="form-control" id="age" name="age" 
                                               value="<?= htmlspecialchars($_POST['age'] ?? '') ?>" 
                                               min="18" max="65" required>
                                        <?php if (isset($errors['age'])): ?>
                                            <div class="text-danger mt-1 small">
                                                <i class="fas fa-exclamation-circle me-1"></i>
                                                <?= htmlspecialchars($errors['age']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="gender" class="form-label">Genre *</label>
                                        <select class="form-select" id="gender" name="gender" required>
                                            <option value="">Sélectionnez...</option>
                                            <option value="male" <?= ($_POST['gender'] ?? '') === 'male' ? 'selected' : '' ?>>Masculin</option>
                                            <option value="female" <?= ($_POST['gender'] ?? '') === 'female' ? 'selected' : '' ?>>Féminin</option>
                                        </select>
                                        <?php if (isset($errors['gender'])): ?>
                                            <div class="text-danger mt-1 small">
                                                <i class="fas fa-exclamation-circle me-1"></i>
                                                <?= htmlspecialchars($errors['gender']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Blood Information (for donors) -->
                            <div class="form-section mb-4" id="blood_info_section">
                                <h5 class="section-title mb-3">
                                    <i class="fas fa-tint me-2"></i>Informations sanguines
                                </h5>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="blood_type" class="form-label">Groupe sanguin *</label>
                                        <select class="form-select" id="blood_type" name="blood_type" required>
                                            <option value="">Sélectionnez votre groupe</option>
                                            <option value="A+" <?= ($_POST['blood_type'] ?? '') === 'A+' ? 'selected' : '' ?>>A+</option>
                                            <option value="A-" <?= ($_POST['blood_type'] ?? '') === 'A-' ? 'selected' : '' ?>>A-</option>
                                            <option value="B+" <?= ($_POST['blood_type'] ?? '') === 'B+' ? 'selected' : '' ?>>B+</option>
                                            <option value="B-" <?= ($_POST['blood_type'] ?? '') === 'B-' ? 'selected' : '' ?>>B-</option>
                                            <option value="AB+" <?= ($_POST['blood_type'] ?? '') === 'AB+' ? 'selected' : '' ?>>AB+</option>
                                            <option value="AB-" <?= ($_POST['blood_type'] ?? '') === 'AB-' ? 'selected' : '' ?>>AB-</option>
                                            <option value="O+" <?= ($_POST['blood_type'] ?? '') === 'O+' ? 'selected' : '' ?>>O+</option>
                                            <option value="O-" <?= ($_POST['blood_type'] ?? '') === 'O-' ? 'selected' : '' ?>>O-</option>
                                        </select>
                                        <?php if (isset($errors['blood_type'])): ?>
                                            <div class="text-danger mt-1 small">
                                                <i class="fas fa-exclamation-circle me-1"></i>
                                                <?= htmlspecialchars($errors['blood_type']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="weight" class="form-label">Poids (kg) *</label>
                                        <input type="number" class="form-control" id="weight" name="weight" 
                                               value="<?= htmlspecialchars($_POST['weight'] ?? '') ?>" 
                                               min="50" max="150" required>
                                        <small class="text-muted">Minimum 50kg pour donner</small>
                                        <?php if (isset($errors['weight'])): ?>
                                            <div class="text-danger mt-1 small">
                                                <i class="fas fa-exclamation-circle me-1"></i>
                                                <?= htmlspecialchars($errors['weight']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Hospital Information -->
                            <div class="form-section mb-4 d-none" id="hospital_info_section">
                                <h5 class="section-title mb-3">
                                    <i class="fas fa-hospital me-2"></i>Informations hôpital
                                </h5>
                                
                                <div class="mb-3">
                                    <label for="hospital_name" class="form-label">Nom de l'hôpital *</label>
                                    <input type="text" class="form-control" id="hospital_name" name="hospital_name" 
                                           value="<?= htmlspecialchars($_POST['hospital_name'] ?? '') ?>">
                                    <?php if (isset($errors['hospital_name'])): ?>
                                        <div class="text-danger mt-1 small">
                                            <i class="fas fa-exclamation-circle me-1"></i>
                                            <?= htmlspecialchars($errors['hospital_name']) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="license_number" class="form-label">Numéro de licence *</label>
                                        <input type="text" class="form-control" id="license_number" name="license_number" 
                                               value="<?= htmlspecialchars($_POST['license_number'] ?? '') ?>">
                                        <?php if (isset($errors['license_number'])): ?>
                                            <div class="text-danger mt-1 small">
                                                <i class="fas fa-exclamation-circle me-1"></i>
                                                <?= htmlspecialchars($errors['license_number']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="department" class="form-label">Département *</label>
                                        <input type="text" class="form-control" id="department" name="department" 
                                               value="<?= htmlspecialchars($_POST['department'] ?? '') ?>" 
                                               placeholder="ex: Urgences, Cardiologie">
                                        <?php if (isset($errors['department'])): ?>
                                            <div class="text-danger mt-1 small">
                                                <i class="fas fa-exclamation-circle me-1"></i>
                                                <?= htmlspecialchars($errors['department']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Location -->
                            <div class="form-section mb-4">
                                <h5 class="section-title mb-3">
                                    <i class="fas fa-map-marker-alt me-2"></i>Localisation
                                </h5>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="city" class="form-label">Ville *</label>
                                        <input type="text" class="form-control" id="city" name="city" 
                                               value="<?= htmlspecialchars($_POST['city'] ?? '') ?>" required>
                                        <?php if (isset($errors['city'])): ?>
                                            <div class="text-danger mt-1 small">
                                                <i class="fas fa-exclamation-circle me-1"></i>
                                                <?= htmlspecialchars($errors['city']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="district" class="form-label">Quartier *</label>
                                        <input type="text" class="form-control" id="district" name="district" 
                                               value="<?= htmlspecialchars($_POST['district'] ?? '') ?>" required>
                                        <?php if (isset($errors['district'])): ?>
                                            <div class="text-danger mt-1 small">
                                                <i class="fas fa-exclamation-circle me-1"></i>
                                                <?= htmlspecialchars($errors['district']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Password Section -->
                            <div class="form-section mb-4">
                                <h5 class="section-title mb-3">
                                    <i class="fas fa-lock me-2"></i>Sécurité
                                </h5>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="password" class="form-label">Mot de passe *</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password" name="password" required>
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        <small class="text-muted">Minimum 8 caractères, avec majuscules et chiffres</small>
                                        <?php if (isset($errors['password'])): ?>
                                            <div class="text-danger mt-1 small">
                                                <i class="fas fa-exclamation-circle me-1"></i>
                                                <?= htmlspecialchars($errors['password']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="confirm_password" class="form-label">Confirmer le mot de passe *</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                            <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        <?php if (isset($errors['confirm_password'])): ?>
                                            <div class="text-danger mt-1 small">
                                                <i class="fas fa-exclamation-circle me-1"></i>
                                                <?= htmlspecialchars($errors['confirm_password']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Terms and Conditions -->
                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                                    <label class="form-check-label" for="terms">
                                        J'accepte les <a href="/terms" target="_blank" class="text-blood-primary">conditions d'utilisation</a> 
                                        et la <a href="/privacy" target="_blank" class="text-blood-primary">politique de confidentialité</a>
                                    </label>
                                </div>
                                <?php if (isset($errors['terms'])): ?>
                                    <div class="text-danger mt-1 small">
                                        <i class="fas fa-exclamation-circle me-1"></i>
                                        <?= htmlspecialchars($errors['terms']) ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <button type="submit" class="btn btn-blood-primary btn-lg w-100 mb-3">
                                <i class="fas fa-user-plus me-2"></i>
                                Créer mon compte
                            </button>

                            <div class="text-center">
                                <p class="text-muted mb-0">
                                    Déjà un compte ?
                                    <a href="/login" class="text-blood-primary text-decoration-none fw-bold">
                                        Connectez-vous
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right side - Info -->
            <div class="col-lg-4 d-none d-lg-flex bg-gradient-blood text-white">
                <div class="d-flex flex-column justify-content-center align-items-center w-100 p-4">
                    <div class="text-center">
                        <img src="/assets/images/blood-drop.svg" alt="BloodBank" class="mb-4" style="width: 100px; height: 100px; filter: brightness(0) invert(1);">
                        <h3 class="fw-bold mb-3">Pourquoi nous rejoindre ?</h3>
                        
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-heart fa-2x me-3"></i>
                                <div class="text-start">
                                    <h6 class="mb-1">Sauvez des vies</h6>
                                    <small>Chaque don peut sauver jusqu'à 3 vies</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-map-marker-alt fa-2x me-3"></i>
                                <div class="text-start">
                                    <h6 class="mb-1">Géolocalisation</h6>
                                    <small>Trouvez les donneurs les plus proches</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="fab fa-whatsapp fa-2x me-3"></i>
                                <div class="text-start">
                                    <h6 class="mb-1">Contact direct</h6>
                                    <small>Communiquez via WhatsApp</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-shield-alt fa-2x me-3"></i>
                                <div class="text-start">
                                    <h6 class="mb-1">Sécurisé</h6>
                                    <small>Vos données sont protégées</small>
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
    const roleInputs = document.querySelectorAll('input[name="role"]');
    const selectedRoleInput = document.getElementById('selected_role');
    const bloodInfoSection = document.getElementById('blood_info_section');
    const hospitalInfoSection = document.getElementById('hospital_info_section');
    
    // Toggle sections based on role
    roleInputs.forEach(input => {
        input.addEventListener('change', function() {
            selectedRoleInput.value = this.value;
            
            if (this.value === 'donor') {
                bloodInfoSection.classList.remove('d-none');
                hospitalInfoSection.classList.add('d-none');
                
                // Make blood info fields required
                document.getElementById('blood_type').required = true;
                document.getElementById('weight').required = true;
                
                // Remove hospital fields requirements
                document.getElementById('hospital_name').required = false;
                document.getElementById('license_number').required = false;
                document.getElementById('department').required = false;
            } else {
                bloodInfoSection.classList.add('d-none');
                hospitalInfoSection.classList.remove('d-none');
                
                // Remove blood info fields requirements
                document.getElementById('blood_type').required = false;
                document.getElementById('weight').required = false;
                
                // Make hospital fields required
                document.getElementById('hospital_name').required = true;
                document.getElementById('license_number').required = true;
                document.getElementById('department').required = true;
            }
        });
    });
    
    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const confirmPassword = document.getElementById('confirm_password');
    
    togglePassword.addEventListener('click', function() {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        
        const icon = this.querySelector('i');
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    });
    
    toggleConfirmPassword.addEventListener('click', function() {
        const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPassword.setAttribute('type', type);
        
        const icon = this.querySelector('i');
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    });
    
    // Password strength validation
    password.addEventListener('input', function() {
        const value = this.value;
        const strength = document.getElementById('password-strength');
        
        if (value.length >= 8 && /[A-Z]/.test(value) && /[0-9]/.test(value)) {
            this.classList.remove('is-invalid');
            this.classList.add('is-valid');
        } else {
            this.classList.remove('is-valid');
            this.classList.add('is-invalid');
        }
    });
    
    // Confirm password validation
    confirmPassword.addEventListener('input', function() {
        if (this.value === password.value) {
            this.classList.remove('is-invalid');
            this.classList.add('is-valid');
        } else {
            this.classList.remove('is-valid');
            this.classList.add('is-invalid');
        }
    });
    
    // Form validation
    const form = document.querySelector('.auth-form');
    form.addEventListener('submit', function(e) {
        if (password.value !== confirmPassword.value) {
            e.preventDefault();
            alert('Les mots de passe ne correspondent pas');
        }
    });
});
</script>

<style>
.auth-form-container {
    max-width: 800px;
    margin: 0 auto;
}

.form-section {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 1.5rem;
    background-color: #f8f9fa;
}

.section-title {
    color: #8B0000;
    border-bottom: 2px solid #8B0000;
    padding-bottom: 0.5rem;
}

.btn-check:checked + .btn-outline-success {
    background-color: #198754;
    border-color: #198754;
}

.btn-check:checked + .btn-outline-primary {
    background-color: #0d6efd;
    border-color: #0d6efd;
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

.form-control, .form-select {
    border-radius: 6px;
    border: 1px solid #ddd;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-control:focus, .form-select:focus {
    border-color: #8B0000;
    box-shadow: 0 0 0 0.2rem rgba(139, 0, 0, 0.25);
}

.is-valid {
    border-color: #198754;
}

.is-invalid {
    border-color: #dc3545;
}

@media (max-width: 991.98px) {
    .auth-container .col-lg-8 {
        padding: 2rem 1rem;
    }
}
</style>