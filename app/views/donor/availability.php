<?php
// app/views/donor/availability.php
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
                        <a class="nav-link" href="<?= url('/donor/profile') ?>">
                            <i class="fas fa-user"></i> Mon profil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= url('/donor/availability') ?>">
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
                    <i class="fas fa-calendar-check text-blood-red"></i> Gestion de la disponibilité
                </h1>
            </div>

            <div class="row">
                <!-- Statut actuel -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5><i class="fas fa-info-circle text-blood-red"></i> Statut actuel</h5>
                        </div>
                        <div class="card-body">
                            <div class="current-status">
                                <?php if($donor->is_available): ?>
                                    <div class="alert alert-success">
                                        <i class="fas fa-check-circle fa-2x mb-2"></i>
                                        <h6>Vous êtes disponible</h6>
                                        <p class="mb-0">Les patients peuvent vous contacter pour une demande de don.</p>
                                    </div>
                                    <div class="status-info">
                                        <p><strong>Disponible depuis :</strong> <?= date('d/m/Y H:i', strtotime($donor->availability_updated_at)) ?></p>
                                        <?php if($donor->availability_notes): ?>
                                            <p><strong>Notes :</strong> <?= $donor->availability_notes ?></p>
                                        <?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                                        <h6>Vous n'êtes pas disponible</h6>
                                        <p class="mb-0">Activez votre disponibilité pour recevoir des demandes de don.</p>
                                    </div>
                                    <?php if($donor->next_available_date): ?>
                                        <div class="status-info">
                                            <p><strong>Prochaine disponibilité :</strong> <?= date('d/m/Y', strtotime($donor->next_available_date)) ?></p>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dernière donation -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5><i class="fas fa-heart text-blood-red"></i> Dernière donation</h5>
                        </div>
                        <div class="card-body">
                            <?php if($donor->last_donation_date): ?>
                                <div class="donation-info">
                                    <p><strong>Date :</strong> <?= date('d/m/Y', strtotime($donor->last_donation_date)) ?></p>
                                    <p><strong>Il y a :</strong> <?= $days_since_last_donation ?> jours</p>
                                    
                                    <?php if($days_since_last_donation < 56): ?>
                                        <div class="alert alert-warning">
                                            <i class="fas fa-clock"></i> Vous devez attendre <?= 56 - $days_since_last_donation ?> jours de plus avant de pouvoir donner à nouveau.
                                        </div>
                                    <?php else: ?>
                                        <div class="alert alert-success">
                                            <i class="fas fa-check"></i> Vous êtes éligible pour un nouveau don.
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i> Aucune donation enregistrée. Vous pouvez effectuer votre premier don !
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulaire de mise à jour -->
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="fas fa-edit text-blood-red"></i> Modifier ma disponibilité</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="<?= url('/donor/availability/update') ?>">
                                <div class="mb-4">
                                    <label class="form-label">Statut de disponibilité</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="is_available" id="available_yes" 
                                               value="1" <?= $donor->is_available ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="available_yes">
                                            <i class="fas fa-check-circle text-success"></i> Disponible pour donner
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="is_available" id="available_no" 
                                               value="0" <?= !$donor->is_available ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="available_no">
                                            <i class="fas fa-times-circle text-danger"></i> Non disponible actuellement
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-3" id="next_available_section" style="display: <?= !$donor->is_available ? 'block' : 'none' ?>;">
                                    <label for="next_available_date" class="form-label">Prochaine date de disponibilité</label>
                                    <input type="date" class="form-control" id="next_available_date" name="next_available_date" 
                                           value="<?= $donor->next_available_date ?>" min="<?= date('Y-m-d') ?>">
                                    <small class="form-text text-muted">Quand serez-vous disponible pour donner ?</small>
                                </div>

                                <div class="mb-3">
                                    <label for="availability_notes" class="form-label">Notes ou commentaires</label>
                                    <textarea class="form-control" id="availability_notes" name="availability_notes" rows="3"><?= $donor->availability_notes ?></textarea>
                                    <small class="form-text text-muted">Informations supplémentaires pour les demandeurs</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Préférences de contact</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="contact_phone" name="contact_preferences[]" 
                                               value="phone" <?= in_array('phone', $donor->contact_preferences ?? []) ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="contact_phone">
                                            <i class="fas fa-phone"></i> Appel téléphonique
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="contact_sms" name="contact_preferences[]" 
                                               value="sms" <?= in_array('sms', $donor->contact_preferences ?? []) ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="contact_sms">
                                            <i class="fas fa-sms"></i> SMS
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="contact_whatsapp" name="contact_preferences[]" 
                                               value="whatsapp" <?= in_array('whatsapp', $donor->contact_preferences ?? []) ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="contact_whatsapp">
                                            <i class="fab fa-whatsapp"></i> WhatsApp
                                        </label>
                                    </div>
                                                                    </div>

                                <!-- Ajout de la section pour les horaires de disponibilité -->
                                <div class="mb-3">
                                    <label class="form-label">Plages horaires préférées</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="preferred_time_morning" class="form-check-label">
                                                <input type="checkbox" id="preferred_time_morning" name="preferred_times[]" 
                                                       value="morning" <?= in_array('morning', $donor->preferred_times ?? []) ? 'checked' : '' ?>>
                                                <i class="fas fa-sun"></i> Matin (8h-12h)
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="preferred_time_afternoon" class="form-check-label">
                                                <input type="checkbox" id="preferred_time_afternoon" name="preferred_times[]" 
                                                       value="afternoon" <?= in_array('afternoon', $donor->preferred_times ?? []) ? 'checked' : '' ?>>
                                                <i class="fas fa-cloud-sun"></i> Après-midi (13h-18h)
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="preferred_time_evening" class="form-check-label">
                                                <input type="checkbox" id="preferred_time_evening" name="preferred_times[]" 
                                                       value="evening" <?= in_array('evening', $donor->preferred_times ?? []) ? 'checked' : '' ?>>
                                                <i class="fas fa-moon"></i> Soirée (18h-21h)
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Bouton de soumission -->
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="submit" class="btn btn-blood-red">
                                        <i class="fas fa-save"></i> Enregistrer les modifications
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Section d'information -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-blood-red text-white">
                            <h5><i class="fas fa-info-circle"></i> Informations importantes</h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info">
                                <h6><i class="fas fa-clock"></i> Délai entre dons</h6>
                                <p>Vous devez attendre 8 semaines (56 jours) entre deux dons de sang.</p>
                            </div>
                            <div class="alert alert-light">
                                <h6><i class="fas fa-map-marker-alt"></i> Centres de don à proximité</h6>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-hospital text-blood-red"></i> Centre Hospitalier Régional - 5km</li>
                                    <li><i class="fas fa-clinic-medical text-blood-red"></i> Maison du Don - 3km</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Script JavaScript pour la gestion dynamique -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Afficher/masquer la section de date de disponibilité
    const availableYes = document.getElementById('available_yes');
    const availableNo = document.getElementById('available_no');
    const nextAvailableSection = document.getElementById('next_available_section');
    
    function toggleNextAvailable() {
        nextAvailableSection.style.display = availableNo.checked ? 'block' : 'none';
    }
    
    availableYes.addEventListener('change', toggleNextAvailable);
    availableNo.addEventListener('change', toggleNextAvailable);
    
    // Validation de la date minimum
    const nextAvailableDate = document.getElementById('next_available_date');
    if (nextAvailableDate) {
        const today = new Date().toISOString().split('T')[0];
        nextAvailableDate.min = today;
    }
});
</script>
<style>
/* Sidebar amélioré */
.sidebar {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    z-index: 100;
    padding: 70px 0 0;
    box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
    background: #f8f9fa;
    width: 250px;
    transition: all 0.3s;
}

.user-info {
    text-align: center;
    padding: 20px;
    margin: 15px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.profile-avatar img {
    border: 3px solid #8B0000;
    object-fit: cover;
    transition: all 0.3s;
}

.profile-avatar img:hover {
    transform: scale(1.05);
}

.nav-link {
    color: #495057;
    padding: 12px 20px;
    margin: 5px 15px;
    border-radius: 5px;
    transition: all 0.3s;
}

.nav-link:hover {
    background: rgba(139, 0, 0, 0.1);
    color: #8B0000;
}

.nav-link.active {
    background: #8B0000;
    color: white !important;
    font-weight: 500;
}

.nav-link i {
    width: 20px;
    margin-right: 10px;
    text-align: center;
}

/* Contenu principal */
main {
    margin-left: 250px;
    padding: 20px;
    transition: all 0.3s;
}

.card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    margin-bottom: 20px;
    transition: all 0.3s;
}

.card:hover {
    box-shadow: 0 10px 15px rgba(0,0,0,0.1);
}

.card-header {
    background: white;
    border-bottom: 1px solid rgba(0,0,0,0.05);
    font-weight: 600;
    padding: 15px 20px;
    border-radius: 10px 10px 0 0 !important;
}

.btn-blood-red {
    background-color: #8B0000;
    color: white;
    border: none;
    padding: 8px 20px;
    border-radius: 5px;
    transition: all 0.3s;
}

.btn-blood-red:hover {
    background-color: #6d0000;
    color: white;
    transform: translateY(-2px);
}

/* Alertes personnalisées */
.alert {
    border-radius: 8px;
    border-left: 4px solid;
}

.alert-success {
    border-left-color: #28a745;
}

.alert-warning {
    border-left-color: #ffc107;
}

.alert-info {
    border-left-color: #17a2b8;
}

/* Formulaire */
.form-control, .form-select {
    border-radius: 5px;
    padding: 10px 15px;
    border: 1px solid #e0e0e0;
}

.form-control:focus {
    border-color: #8B0000;
    box-shadow: 0 0 0 0.25rem rgba(139, 0, 0, 0.25);
}

.form-check-input:checked {
    background-color: #8B0000;
    border-color: #8B0000;
}

/* Responsive */
@media (max-width: 991.98px) {
    .sidebar {
        margin-left: -250px;
    }
    .sidebar.active {
        margin-left: 0;
    }
    main {
        margin-left: 0;
    }
}

@media (max-width: 767.98px) {
    .sidebar {
        width: 100%;
        height: auto;
        position: relative;
        padding: 20px 0;
    }
    main {
        margin-left: 0;
        padding: 15px;
    }
    
    .user-info {
        margin: 0 15px 15px;
    }
}

/* Animation */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.card {
    animation: fadeIn 0.5s ease-out;
}
</style>