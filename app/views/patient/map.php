<?php require_once VIEW_PATH . '/layouts/header.php'; ?>

<div class="container-fluid px-0">
    <div class="row no-gutters">
        <div class="col-md-12">
            <div id="map"></div>
        </div>
    </div>
</div>

<!-- Modal pour les détails -->
<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalBody"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <a id="whatsappBtn" class="btn btn-success" target="_blank">
                    <i class="fab fa-whatsapp"></i> Contacter
                </a>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="<?= APP_URL ?>/assets/vendor/leaflet/leaflet.css">
<script src="<?= APP_URL ?>/assets/vendor/leaflet/leaflet.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const map = L.map('map').setView([48.8566, 2.3522], 12); // Paris par défaut
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    // Marqueurs pour les donneurs
    <?php foreach ($donors as $donor): ?>
        <?php if ($donor['latitude'] && $donor['longitude']): ?>
            const donorMarker = L.marker([<?= $donor['latitude'] ?>, <?= $donor['longitude'] ?>])
                .addTo(map)
                .bindPopup(`
                    <h5>Donneur ${<?= json_encode($donor['blood_type']) ?>}</h5>
                    <p>Disponible: ${<?= $donor['is_available'] ? 'Oui' : 'Non' ?>}</p>
                    <button onclick="showDonorDetails(${<?= json_encode($donor) ?>})" 
                            class="btn btn-sm btn-blood-red">
                        Détails
                    </button>
                `);
        <?php endif; ?>
    <?php endforeach; ?>

    // Marqueurs pour les hôpitaux
    <?php foreach ($hospitals as $hospital): ?>
        <?php if ($hospital['latitude'] && $hospital['longitude']): ?>
            const hospitalMarker = L.marker([<?= $hospital['latitude'] ?>, <?= $hospital['longitude'] ?>], {
                icon: L.icon({
                    iconUrl: '<?= APP_URL ?>/assets/images/hospital-icon.png',
                    iconSize: [32, 32]
                })
            }).addTo(map)
            .bindPopup(`
                <h5>${<?= json_encode($hospital['name']) ?>}</h5>
                <p>${<?= json_encode($hospital['address']) ?></p>
                <button onclick="showHospitalDetails(${<?= json_encode($hospital) ?>})" 
                        class="btn btn-sm btn-blood-red">
                    Stocks
                </button>
            `);
        <?php endif; ?>
    <?php endforeach; ?>

    // Géolocalisation de l'utilisateur
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            map.setView([position.coords.latitude, position.coords.longitude], 13);
        });
    }
});

function showDonorDetails(donor) {
    $('#modalTitle').html(`Donneur ${donor.blood_type}`);
    $('#modalBody').html(`
        <p><strong>Nom:</strong> ${donor.first_name} ${donor.last_name}</p>
        <p><strong>Téléphone:</strong> ${donor.phone}</p>
        <p><strong>Adresse:</strong> ${donor.address}, ${donor.city}</p>
        <p><strong>Dernier don:</strong> ${donor.last_donation_date || 'Non renseigné'}</p>
    `);
    $('#whatsappBtn').attr('href', `https://wa.me/${donor.phone.replace(/\D/g, '')}`);
    $('#detailsModal').modal('show');
}

function showHospitalDetails(hospital) {
    $('#modalTitle').html(hospital.name);
    $('#modalBody').html(`
        <p><strong>Adresse:</strong> ${hospital.address}, ${hospital.city}</p>
        <p><strong>Téléphone:</strong> ${hospital.phone}</p>
        <h6 class="mt-3">Stocks disponibles:</h6>
        <ul>
            ${hospital.stocks ? Object.entries(hospital.stocks).map(([type, qty]) => 
                `<li>${type}: ${qty} unités</li>`).join('') : 
                '<li>Informations non disponibles</li>'}
        </ul>
    `);
    $('#whatsappBtn').attr('href', `https://wa.me/${hospital.phone.replace(/\D/g, '')}`);
    $('#detailsModal').modal('show');
}
</script>

<?php require_once VIEW_PATH . '/layouts/footer.php'; ?>