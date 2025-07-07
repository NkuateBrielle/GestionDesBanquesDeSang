<div class="container">
    <h2 class="my-4">Gestion des stocks</h2>
    
    <div class="card mb-4">
        <div class="card-header bg-blood-red text-white">
            <h5 class="mb-0">Mise à jour des stocks</h5>
        </div>
        <div class="card-body">
            <form action="<?= View::url('hospital/stocks') ?>" method="post">
                <input type="hidden" name="_csrf" value="<?= $this->generateCSRFToken() ?>">
                
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Groupe sanguin</th>
                                <th>Quantité disponible</th>
                                <th>Mise à jour</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bloodTypes as $type): ?>
                                <tr>
                                    <td><?= $type ?></td>
                                    <td><?= $stocks[$type] ?? 0 ?></td>
                                    <td>
                                        <input type="number" name="stocks[<?= $type ?>]" 
                                               class="form-control" min="0" 
                                               value="<?= $stocks[$type] ?? 0 ?>">
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <button type="submit" class="btn btn-blood-red">
                    <i class="fas fa-save"></i> Enregistrer les modifications
                </button>
            </form>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header bg-blood-red text-white">
            <h5 class="mb-0">Historique des stocks</h5>
        </div>
        <div class="card-body">
            <canvas id="stockHistoryChart" height="150"></canvas>
        </div>
    </div>
</div>

<script src="<?= View::asset('js/chart.js') ?>"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('stockHistoryChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= json_encode(array_column($stockHistory, 'date')) ?>,
            datasets: [
                {
                    label: 'Stock total',
                    data: <?= json_encode(array_column($stockHistory, 'total')) ?>,
                    borderColor: '#8B0000',
                    backgroundColor: 'rgba(139, 0, 0, 0.1)',
                    tension: 0.1
                }
            ]
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