<?php
// app/views/donor/profile.php
?>

<div class="container-fluid py-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
            <div class="position-sticky pt-3">
                <div class="user-info mb-4">
                    <div class="profile-avatar">
                        <img src="<?= $donor->avatar ? asset('uploads/profiles/' . $donor->avatar) : asset('images/default-avatar.png') ?>" 
                             alt="Avatar" class="rounded-circle" width="60" height="60">
                    </div>
                    <h6 class="mt-2"><?= $donor->first_name . ' ' . $donor->last_name ?></h6>
                    <small class="text-muted">Donneur <?= $donor->blood_type ?></small>
                </div>
                
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url('/donor/dashboard') ?>">
                            <i class="fas fa-tachometer-alt"></i> Tableau de bord
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= url('/donor/profile') ?>">
                            <i class="fas fa-user"></i> Mon profil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url('/donor/availability') ?>">
                            <i class="fas fa-calendar-check"></i> Disponibilité
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url('/donor/requests') ?>">
                            <i class="fas fa-bell"></i> Demandes
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Contenu principal -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">
                    <i class="fas fa-user text-blood-red"></i> Mon profil
                </h1>
            </div>

            <div class="row">
                <!-- Informations personnelles -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="fas fa-user-edit text-blood-red"></i> Informations personnelles</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="<?= url('/donor/profile/update') ?>" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="first_name" class="form-label">Prénom *</label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" 
                                                   value="<?= $donor->first_name ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="last_name" class="form-label">Nom *</label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" 
                                                   value="<?= $donor->last_name ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email *</label>
                                            <input type="email" class="form-control" id="email" name="email" 
                                                   value="<?= $donor->email ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Téléphone *</label>
                                            <input type="tel" class="form-control" id="phone" name="phone" 
                                                   value="<?= $donor->phone ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="birth_date" class="form-label">Date de naissance *</label>
                                            <input type="date" class="form-control" id="birth_date" name="birth_date" 
                                                   value="<?= $donor->birth_date ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="gender" class="form-label">Genre *</label>
                                            <select class="form-select" id="gender" name="gender" required>
                                                <option value="">Sélectionner...</option>
                                                <option value="male" <?= $donor->gender === 'male' ? 'selected' : '' ?>>Homme</option>
                                                <option value="female" <?= $donor->gender === 'female' ? 'selected' : '' ?>>Femme</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="blood_type" class="form-label">Groupe sanguin *</label>
                                            <select class="form-select" id="blood_type" name="blood_type" required>
                                                <option value="">Sélectionner...</option>
                                                <option value="A+" <?= $donor->blood_type === 'A+' ? 'selected' : '' ?>>A+</option>
                                                <option value="A-" <?= $donor->blood_type === 'A-' ? 'selected' : '' ?>>A-</option>
                                                <option value="B+" <?= $donor->blood_type === 'B+' ? 'selected' : '' ?>>B+</option>
                                                <option value="B-" <?= $donor->blood_type === 'B-' ? 'selected' : '' ?>>B-</option>
                                                <option value="AB+" <?= $donor->blood_type === 'AB+' ? 'selected' : '' ?>>AB+</option>
                                                <option value="AB-" <?= $donor->blood_type === 'AB-' ? 'selected' : '' ?>>AB-</option>
                                                <option value="O+" <?= $donor->blood_type === 'O+' ? 'selected' : '' ?>>O+</option>
                                                <option value="O-" <?= $donor->blood_type === 'O-' ? 'selected' : '' ?>>O-</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="weight" class="form-label">Poids (kg) *</label>
                                            <input type="number" class="form-control" id="weight" name="weight" 
                                                   value="<?= $donor->weight ?>" min="50" max="150" required>
                                            <small class="form-text text-muted">Poids minimum : 50 kg</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="avatar" class="form-label">Photo de profil</label>
                                    <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
                                    <small class="form-text text-muted">Formats acceptés : JPG, PNG, GIF. Taille max : 2MB</small>
                                </div>

                                <h6 class="mt-4 mb-3">Localisation</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="city" class="form-label">Ville *</label>
                                            <input type="text" class="form-control" id="city" name="city" 
                                                   value="<?= $donor->city ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="district" class="form-label">Quartier *</label>
                                            <input type="text" class="form-control" id="district" name="district" 
                                                   value="<?= $donor->district ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="address" class="form-label">Adresse complète</label>
                                    <textarea class="form-control" id="address" name="address" rows="2"><?= $donor->address ?></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="latitude" class="form-label">Latitude</label>
                                            <input type="number" class="form-control" id="latitude" name="latitude" 
                                                   value="<?= $donor->latitude ?>" step="0.000001" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="longitude" class="form-label">Longitude</label>
                                            <input type="number" class="form-control" id="longitude" name="longitude" 
                                                   value="<?= $donor->longitude ?>" step="0.000001" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <button type="button" class="btn btn-outline-primary" id="getLocationBtn">
                                        <i class="fas fa-map-marker-alt"></i> Obtenir ma position actuelle
                                    </button>
                                    <small class="form-text text-muted d-block mt-2">
                                        Cliquez pour détecter automatiquement votre position GPS
                                    </small>
                                </div>

                                <div class="mb-3">
                                    <div id="map" style="height: 300px; border-radius: 8px;"></div>
                                </div>

                                <h6 class="mt-4 mb-3">Informations médicales</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="last_donation_date" class="form-label">Dernière donation</label>
                                            <input type="date" class="form-control" id="last_donation_date" name="last_donation_date" 
                                                   value="<?= $donor->last_donation_date ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="medical_conditions" class="form-label">Conditions médicales</label>
                                            <textarea class="form-control" id="medical_conditions" name="medical_conditions" rows="2"><?= $donor->medical_conditions ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_eligible" name="is_eligible" 
                                               value="1" <?= $donor->is_eligible ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="is_eligible">
                                            Je certifie être éligible au don de sang
                                        </label>
                                    </div>
                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Sauvegarder les modifications
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Informations de compte -->
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5><i class="fas fa-shield-alt text-blood-red"></i> Sécurité du compte</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <strong>Statut du compte :</strong>
                                <?php if($donor->is_verified): ?>
                                    <span class="badge bg-success">Vérifié</span>
                                <?php else: ?>
                                    <span class="badge bg-warning">Non vérifié</span>
                                <?php endif; ?>
                            </div>
                            
                            <div class="mb-3">
                                <strong>Dernière connexion :</strong><br>
                                <small class="text-muted">
                                    <?= date('d/m/Y H:i', strtotime($donor->last_login)) ?>
                                </small>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                    <i class="fas fa-key"></i> Changer le mot de passe
                                </button>
                                
                                <?php if(!$donor->is_verified): ?>
                                    <button type="button" class="btn btn-outline-success">
                                        <i class="fas fa-envelope"></i> Vérifier l'email
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <h5><i class="fas fa-chart-line text-blood-red"></i> Statistiques</h5>
                        </div>
                        <div class="card-body">
                            <div class="stats-item">
                                <div class="d-flex justify-content-between">
                                    <span>Dons effectués :</span>
                                    <strong><?= $donor->total_donations ?></strong>
                                </div>
                            </div>
                            <div class="stats-item">
                                <div class="d-flex justify-content-between">
                                    <span>Vies sauvées :</span>
                                    <strong><?= $donor->lives_saved ?></strong>
                                </div>
                            </div>
                            <div class="stats-item">
                                <div class="d-flex justify-content-between">
                                    <span>Membre depuis :</span>
                                    <strong><?= date('m/Y', strtotime($donor->created_at)) ?></strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5><i class="fas fa-bell text-blood-red"></i> Notifications</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="<?= url('/donor/notifications/update') ?>">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="email_notifications" 
                                           name="email_notifications" value="1" <?= $donor->email_notifications ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="email_notifications">
                                        Notifications par email
                                    </label>
                                </div>
                                
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="sms_notifications" 
                                           name="sms_notifications" value="1" <?= $donor->sms_notifications ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="sms_notifications">
                                        Notifications par SMS
                                    </label>
                                </div>
                                
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="urgent_only" 
                                           name="urgent_only" value="1" <?= $donor->urgent_only ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="urgent_only">
                                        Urgences uniquement
                                    </label>
                                </div>
                                
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="fas fa-save"></i> Sauvegarder
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Modal de changement de mot de passe -->
<div class="modal fade" id="changePasswordModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Changer le mot de passe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="<?= url('/donor/password/update') ?>">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Mot de passe actuel</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Nouveau mot de passe</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                        <small class="form-text text-muted">Minimum 8 caractères</small>
                    </div>
                    
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirmer le mot de passe</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Changer le mot de passe</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Initialisation de la carte
let map;
let marker;

document.addEventListener('DOMContentLoaded', function() {
    // Initialiser la carte
    const lat = <?= $donor->latitude ?: 'null' ?>;
    const lng = <?= $donor->longitude ?: 'null' ?>;
    
    if (lat && lng) {
        initMap(lat, lng);
    } else {
        // Coordonnées par défaut (Douala)
        initMap(4.0483, 9.7043);
    }
    
    // Géolocalisation
    document.getElementById('getLocationBtn').addEventListener('click', function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;
                
                updateMap(lat, lng);
            }, function() {
                alert('Impossible d\'obtenir votre position.');
            });
        } else {
            alert('La géolocalisation n\'est pas supportée par ce navigateur.');
        }
    });
});

function initMap(lat, lng) {
    map = L.map('map').setView([lat, lng], 13);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);
    
    marker = L.marker([lat, lng], {draggable: true}).addTo(map);
    
    marker.on('dragend', function(e) {
        const position = marker.getLatLng();
        document.getElementById('latitude').value = position.lat;
        document.getElementById('longitude').value = position.lng;
    });
}

function updateMap(lat, lng) {
    if (map) {
        map.setView([lat, lng], 13);
        marker.setLatLng([lat, lng]);
    }
}
</script>

<style>
.sidebar {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    z-index: 100;
    padding: 70px 0 0;
    box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
}

.user-info {
    text-align: center;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 10px;
}

.profile-avatar img {
    border: 3px solid #8B0000;
}

.text-blood-red {
    color: #8B0000 !important;
}

.stats-item {
    padding: 8px 0;
    border-bottom: 1px solid #eee;
}

.stats-item:last-child {
    border-bottom: none;
}

@media (max-width: 767.98px) {
    .sidebar {
        top: 5rem;
        position: relative;
        height: auto;
    }
}
