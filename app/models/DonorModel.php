<?php
class DonorModel extends Model {
    public function getDonorByUserId($userId) {
        $sql = "SELECT d.*, u.email, u.first_name, u.last_name, u.blood_type as blood_type, u.city as city, u.phone as phone
                FROM donors d 
                JOIN users u ON d.user_id = u.id 
                WHERE u.id = :user_id";
                
        $stmt = Database::query($sql, ['user_id' => $userId]);
        return $stmt->fetch();
    }
    
    public function updateDonorProfile($userId, $data) {
        $sql = "UPDATE donors d
                JOIN users u ON d.user_id = u.id
                SET d.blood_type = :blood_type,
                    d.phone = :phone,
                    d.address = :address,
                    d.city = :city,
                    d.country = :country,
                    u.updated_at = NOW()
                WHERE u.id = :user_id";
                
        return Database::query($sql, [
            'blood_type' => $data['blood_type'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'city' => $data['city'],
            'country' => $data['country'],
            'user_id' => $userId
        ])->rowCount() > 0;
    }
    
    public function getBloodRequestsForDonor($donorId) {
        $sql = "SELECT br.* 
                FROM blood_requests br 
                WHERE br.donor_id = :donor_id";
                
        $stmt = Database::query($sql, ['donor_id' => $donorId]);
        return $stmt->fetchAll();
    }
}