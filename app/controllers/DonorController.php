<?php
class DonorController extends Controller {
    public function dashboard() {
        $donorModel = new DonorModel();
        $userId = AuthHelper::userId();
        
        $donor = $donorModel->getDonorByUserId($userId);
        $requests = $donorModel->getBloodRequestsForDonor($donor['id']);
        
        View::render('donor/dashboard', [
            'donor' => $donor,
            'requests' => $requests
        ]);
    }
    
    public function profile() {
        $donorModel = new DonorModel();
        $userId = AuthHelper::userId();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'blood_type' => trim($_POST['blood_type']),
                'phone' => trim($_POST['phone']),
                'address' => trim($_POST['address']),
                'city' => trim($_POST['city']),
                'country' => trim($_POST['country'])
            ];
            
            if ($donorModel->updateDonorProfile($userId, $data)) {
                FlashHelper::setFlash('success', 'Profil mis à jour avec succès');
                header('Location: ' . APP_URL . '/donor/profile');
                exit;
            } else {
                FlashHelper::setFlash('error', 'Erreur lors de la mise à jour du profil');
            }
        }
        
        $donor = $donorModel->getDonorByUserId($userId);
        
        View::render('donor/profile', [
            'donor' => $donor,
            'bloodTypes' => ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']
        ]);
    }
    
    // ... autres méthodes
}