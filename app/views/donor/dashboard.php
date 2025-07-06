<?php
// app/views/donor/dashboard.php
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
                        <a class="nav-link active" href="<?= url('/donor/dashboard') ?>">
                            <i class="fas fa-tachometer-alt"></i> Tableau de bord
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url('/donor/profile') ?>">
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
                            <?php if($stats['pending_requests'] > 0): ?>
                                <span class="badge bg-danger ms-2"><?= $stats['pending_requests'] ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Contenu principal -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">
                    <i class="fas fa-tachometer-alt text-blood-red"></i> Tableau de bord
                </h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-download"></i> Exporter
                        </button>
                    </div>
                </div>
            </div>

            <!-- Cartes de statistiques -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card stat-card bg-primary text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Dons effectués</h6>
                                    <h3 class="mb-0"><?= $stats['total_donations'] ?></h3>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-heart fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card stat-card bg-success text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Vies sauvées</h6>
                                    <h3 class="mb-0"><?= $stats['lives_saved'] ?></h3>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-users fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card stat-card bg-warning text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Demandes en attente</h6>
                                    <h3 class="mb-0"><?= $stats['pending_requests'] ?></h3>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-bell fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card stat-card bg-info text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Groupe sanguin</h6>
                                    <h3 class="mb-0"><?= $donor->blood_type ?></h3>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-tint fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statut de disponibilité -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="fas fa-calendar-check text-blood-red"></i> Statut de disponibilité</h5>
                        </div>
                        <div class="card-body">
                            <div class="availability-status">
                                <?php if($donor->is_available): ?>
                                    <div class="alert alert-success">
                                        <i class="fas fa-check-circle"></i> Vous êtes actuellement disponible pour un don
                                    </div>
                                    <p>Dernière mise à jour : <?= date('d/m/Y H:i', strtotime($donor->availability_updated_at)) ?></p>
                                <?php else: ?>
                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-triangle"></i> Vous n'êtes pas disponible actuellement
                                    </div>
                                    <?php if($donor->next_available_date): ?>
                                        <p>Prochaine disponibilité : <?= date('d/m/Y', strtotime($donor->next_available_date)) ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
                                
                                <a href="<?= url('/donor/availability') ?>" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> Modifier ma disponibilité
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="fas fa-map-marker-alt text-blood-red"></i> Localisation</h5>
                        </div>
                        <div class="card-body">
                            <?php if($donor->latitude && $donor->longitude): ?>
                                <div class="alert alert-info">
                                    <i class="fas fa-map-pin"></i> Votre position est configurée
                                </div>
                                <p><strong>Ville :</strong> <?= $donor->city ?></p>
                                <p><strong>Quartier :</strong> <?= $donor->district ?></p>
                                <small class="text-muted">
                                    Lat: <?= $donor->latitude ?>, Long: <?= $donor->longitude ?>
                                </small>
                            <?php else: ?>
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle"></i> Votre position n'est pas configurée
                                </div>
                                <p>Configurez votre localisation pour que les patients puissent vous trouver facilement.</p>
                            <?php endif; ?>
                            
                            <a href="<?= url('/donor/profile') ?>" class="btn btn-outline-primary">
                                <i class="fas fa-map"></i> Configurer ma position
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Demandes récentes -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h5><i class="fas fa-bell text-blood-red"></i> Demandes récentes</h5>
                            <a href="<?= url('/donor/requests') ?>" class="btn btn-sm btn-outline-primary">
                                Voir toutes les demandes
                            </a>
                        </div>
                        <div class="card-body">
                            <?php if(empty($recent_requests)): ?>
                                <div class="text-center py-4">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Aucune demande récente</p>
                                </div>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Hôpital/Patient</th>
                                                <th>Urgence</th>
                                                <th>Message</th>
                                                <th>Statut</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($recent_requests as $request): ?>
                                                <tr>
                                                    <td><?= date('d/m/Y', strtotime($request->created_at)) ?></td>
                                                    <td>
                                                        <strong><?= $request->requester_name ?></strong><br>
                                                        <small class="text-muted"><?= $request->requester_type ?></small>
                                                    </td>
                                                    <td>
                                                        <?php if($request->urgency === 'urgent'): ?>
                                                            <span class="badge bg-danger">Urgent</span>
                                                        <?php elseif($request->urgency === 'high'): ?>
                                                            <span class="badge bg-warning">Élevé</span>
                                                        <?php else: ?>
                                                            <span class="badge bg-info">Normal</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?= substr($request->message, 0, 50) . (strlen($request->message) > 50 ? '...' : '') ?>
                                                    </td>
                                                    <td>
                                                        <?php if($request->status === 'pending'): ?>
                                                            <span class="badge bg-secondary">En attente</span>
                                                        <?php elseif($request->status === 'accepted'): ?>
                                                            <span class="badge bg-success">Accepté</span>
                                                        <?php elseif($request->status === 'declined'): ?>
                                                            <span class="badge bg-danger">Refusé</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php if($request->status === 'pending'): ?>
                                                            <div class="btn-group" role="group">
                                                                <a href="<?= url('/donor/requests/accept/' . $request->id) ?>" 
                                                                   class="btn btn-sm btn-success">
                                                                    <i class="fas fa-check"></i>
                                                                </a>
                                                                <a href="<?= url('/donor/requests/decline/' . $request->id) ?>" 
                                                                   class="btn btn-sm btn-danger">
                                                                    <i class="fas fa-times"></i>
                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Historique des dons -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="fas fa-history text-blood-red"></i> Historique des dons</h5>
                        </div>
                        <div class="card-body">
                            <?php if(empty($donation_history)): ?>
                                <div class="text-center py-4">
                                    <i class="fas fa-heart fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Aucun don enregistré</p>
                                    <p>Votre premier don sera un grand pas vers sauver des vies !</p>
                                </div>
                            <?php else: ?>
                                <div class="timeline">
                                    <?php foreach($donation_history as $donation): ?>
                                        <div class="timeline-item">
                                            <div class="timeline-marker bg-blood-red"></div>
                                            <div class="timeline-content">
                                                <h6 class="timeline-title"><?= $donation->hospital_name ?></h6>
                                                <p class="timeline-date">
                                                    <i class="fas fa-calendar"></i> <?= date('d/m/Y', strtotime($donation->donation_date)) ?>
                                                </p>
                                                <p class="timeline-description">
                                                    Don de sang <?= $donation->blood_type ?> - <?= $donation->quantity ?>ml
                                                </p>
                                                <?php if($donation->notes): ?>
                                                    <small class="text-muted"><?= $donation->notes ?></small>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

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

.stat-card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

.stat-icon {
    opacity: 0.8;
}

.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #8B0000;
}

.timeline-item {
    position: relative;
    margin-bottom: 30px;
}

.timeline-marker {
    position: absolute;
    left: -8px;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    border: 2px solid #fff;
    box-shadow: 0 0 0 2px #8B0000;
}

.timeline-content {
    margin-left: 20px;
}

.timeline-title {
    margin-bottom: 5px;
    color: #8B0000;
    font-weight: bold;
}

.timeline-date {
    color: #666;
    font-size: 0.9em;
    margin-bottom: 5px;
}

.timeline-description {
    margin-bottom: 5px;
}

.availability-status .alert {
    margin-bottom: 15px;
}

.text-blood-red {
    color: #8B0000 !important;
}

.bg-blood-red {
    background-color: #8B0000 !important;
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

@media (max-width: 767.98px) {
    .sidebar {
        top: 5rem;
        position: relative;
        height: auto;
    }
}
</style>