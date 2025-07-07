<div class="container">
    <h2 class="my-4">Tableau de bord Administrateur</h2>
    
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-blood-red mb-4">
                <div class="card-body">
                    <h5 class="card-title">Hôpitaux</h5>
                    <p class="display-4"><?= $stats['hospitals'] ?></p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card text-white bg-dark mb-4">
                <div class="card-body">
                    <h5 class="card-title">Donneurs</h5>
                    <p class="display-4"><?= $stats['donors'] ?></p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card text-white bg-secondary mb-4">
                <div class="card-body">
                    <h5 class="card-title">Demandes ce mois</h5>
                    <p class="display-4"><?= $stats['requests'] ?></p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card text-white bg-info mb-4">
                <div class="card-body">
                    <h5 class="card-title">Stocks totaux</h5>
                    <p class="display-4"><?= $stats['stocks'] ?></p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-blood-red text-white">
                    <h5 class="mb-0">Derniers hôpitaux inscrits</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($recentHospitals)): ?>
                        <div class="list-group">
                            <?php foreach ($recentHospitals as $hospital): ?>
                                <a href="<?= View::url('admin/hospitals/' . $hospital['id']) ?>" 
                                   class="list-group-item list-group-item-action">
                                    <div class="d-flex justify-content-between">
                                        <h6><?= htmlspecialchars($hospital['name']) ?></h6>
                                        <small><?= date('d/m/Y', strtotime($hospital['created_at'])) ?></small>
                                    </div>
                                    <small><?= htmlspecialchars($hospital['city']) ?></small>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            Aucun hôpital récent.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-blood-red text-white">
                    <h5 class="mb-0">Statistiques des dons</h5>
                </div>
                <div class="card-body">
                    <canvas id="donationsChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= View::asset('js/chart.js') ?>"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('donationsChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_keys($donationStats)) ?>,
            datasets: [{
                label: 'Dons par groupe sanguin',
                data: <?= json_encode(array_values($donationStats)) ?>,
                backgroundColor: '#8B0000'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>