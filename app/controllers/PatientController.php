<?php
class PatientController extends Controller {
    public function search() {
        $bloodTypes = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
        
        View::render('patient/search', [
            'bloodTypes' => $bloodTypes
        ]);
    }

    public function findDonors() {
        $bloodType = $_POST['blood_type'] ?? '';
        $location = $_POST['location'] ?? '';
        $radius = $_POST['radius'] ?? 10; // en km

        $donorModel = new DonorModel();
        $hospitalModel = new HospitalModel();

        // Recherche basique (à améliorer avec géolocalisation)
        $donors = $donorModel->findByBloodType($bloodType);
        $hospitals = $hospitalModel->findByBloodType($bloodType);

        View::render('patient/results', [
            'donors' => $donors,
            'hospitals' => $hospitals,
            'bloodType' => $bloodType,
            'location' => $location
        ]);
    }

    public function map() {
        $donorModel = new DonorModel();
        $hospitalModel = new HospitalModel();

        // Récupérer tous les donneurs et hôpitaux pour la carte
        $donors = $donorModel->getAllWithLocation();
        $hospitals = $hospitalModel->getAllWithLocation();

        View::render('patient/map', [
            'donors' => $donors,
            'hospitals' => $hospitals
        ]);
    }
}