<?php

namespace App\controllers;

use App\core\Controller;
use App\models\Donor;
use App\models\Hospital;

class PublicController extends Controller {
    public function index() {
        $this->view('public/home');
    }

    public function search() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bloodType = $_POST['blood_type'] ?? '';
            $location = $_POST['location'] ?? '';
            
            $donorModel = new Donor();
            $donors = $donorModel->searchByBloodType($bloodType);
            
            $hospitalModel = new Hospital();
            $hospitals = $hospitalModel->searchByBloodType($bloodType);
            
            $this->view('public/search-results', [
                'donors' => $donors,
                'hospitals' => $hospitals,
                'bloodType' => $bloodType
            ]);
        } else {
            $this->view('public/search');
        }
    }

    public function contactDonor($params) {
        $donorId = $params['id'] ?? 0;
        
        $donorModel = new Donor();
        $donor = $donorModel->findById($donorId);
        
        if ($donor) {
            $this->view('public/contact-donor', ['donor' => $donor]);
        } else {
            $this->redirect('/');
        }
    }
}