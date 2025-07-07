<?php
class HospitalController extends Controller {
    public function stocks() {
        $hospitalModel = new HospitalModel();
        $userId = AuthHelper::userId();
        
        $hospital = $hospitalModel->getHospitalByUserId($userId);
        $stocks = $hospitalModel->getBloodStocks($hospital['id']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $updates = [];
            foreach ($_POST['stocks'] as $bloodType => $quantity) {
                $updates[] = [
                    'blood_type' => $bloodType,
                    'quantity' => (int)$quantity
                ];
            }

            if ($hospitalModel->updateBloodStocks($hospital['id'], $updates)) {
                FlashHelper::setFlash('success', 'Stocks mis à jour avec succès');
                header('Location: ' . APP_URL . '/hospital/stocks');
                exit;
            } else {
                FlashHelper::setFlash('error', 'Erreur lors de la mise à jour des stocks');
            }
        }

        View::render('hospital/stocks', [
            'hospital' => $hospital,
            'stocks' => $stocks,
            'bloodTypes' => ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']
        ]);
    }

    public function location() {
        $hospitalModel = new HospitalModel();
        $userId = AuthHelper::userId();
        
        $hospital = $hospitalModel->getHospitalByUserId($userId);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'latitude' => (float)$_POST['latitude'],
                'longitude' => (float)$_POST['longitude']
            ];

            if ($hospitalModel->updateLocation($hospital['id'], $data)) {
                FlashHelper::setFlash('success', 'Localisation mise à jour avec succès');
                header('Location: ' . APP_URL . '/hospital/location');
                exit;
            } else {
                FlashHelper::setFlash('error', 'Erreur lors de la mise à jour de la localisation');
            }
        }

        View::render('hospital/location', [
            'hospital' => $hospital
        ]);
    }
}