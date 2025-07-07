<div class="container">
    <h2 class="my-4">Gestion des hôpitaux</h2>
    
    <div class="card mb-4">
        <div class="card-header bg-blood-red text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Liste des hôpitaux</h5>
            <a href="<?= View::url('admin/hospitals/create') ?>" class="btn btn-light btn-sm">
                <i class="fas fa-plus"></i> Ajouter
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Ville</th>
                            <th>Contact</th>
                            <th>Inscrit le</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($hospitals as $hospital): ?>
                            <tr>
                                <td><?= htmlspecialchars($hospital['name']) ?></td>
                                <td><?= htmlspecialchars($hospital['city']) ?></td>
                                <td><?= htmlspecialchars($hospital['email']) ?></td>
                                <td><?= date('d/m/Y', strtotime($hospital['created_at'])) ?></td>
                                <td>
                                    <?php if ($hospital['is_active']): ?>
                                        <span class="badge badge-success">Actif</span>
                                    <?php else: ?>
                                        <span class="badge badge-secondary">Inactif</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= View::url('admin/hospitals/' . $hospital['id']) ?>" 
                                           class="btn btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?= View::url('admin/hospitals/edit/' . $hospital['id']) ?>" 
                                           class="btn btn-outline-secondary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-outline-danger toggle-hospital" 
                                                data-id="<?= $hospital['id'] ?>"
                                                data-status="<?= $hospital['is_active'] ? '1' : '0' ?>">
                                            <i class="fas <?= $hospital['is_active'] ? 'fa-ban' : 'fa-check' ?>"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= $currentPage === $i ? 'active' : '' ?>">
                            <a class="page-link" href="<?= View::url('admin/hospitals?page=' . $i) ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestion de l'activation/désactivation des hôpitaux
    document.querySelectorAll('.toggle-hospital').forEach(btn => {
        btn.addEventListener('click', function() {
            const hospitalId = this.dataset.id;
            const newStatus = this.dataset.status === '1' ? '0' : '1';
            
            fetch('<?= View::url("admin/api/hospitals/toggle") ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?= $this->generateCSRFToken() ?>'
                },
                body: JSON.stringify({
                    id: hospitalId,
                    status: newStatus
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        });
    });
});
</script>