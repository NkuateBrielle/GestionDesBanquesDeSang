<div class="container">
    <div class="jumbotron c-blood-red text-white">
        <h1 class="display-4">Bienvenue sur <?= APP_NAME ?></h1>
        <p class="lead">Plateforme de gestion des dons de sang</p>
        <hr class="my-4 bg-white">
        <p>Trouvez des donneurs ou des stocks de sang près de chez vous.</p>
        <a class="btn btn-light btn-lg" href="<?= View::url('patient/search') ?>" role="button">Rechercher</a>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Donneurs</h5>
                    <p class="card-text">Inscrivez-vous comme donneur et sauvez des vies.</p>
                    <a href="<?= View::url('register/donor') ?>" class="btn btn-blood-red">Devenir donneur</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Hôpitaux</h5>
                    <p class="card-text">Gérez vos stocks de sang et trouvez des donneurs.</p>
                    <a href="<?= View::url('register/hospital') ?>" class="btn btn-blood-red">Enregistrer hôpital</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Patients</h5>
                    <p class="card-text">Trouvez rapidement le sang dont vous avez besoin.</p>
                    <a href="<?= View::url('patient/search') ?>" class="btn btn-blood-red">Rechercher du sang</a>
                </div>
            </div>
        </div>
    </div>
</div>