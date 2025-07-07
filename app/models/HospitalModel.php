<?php
class HospitalModel extends Model {
    public function getHospitalByUserId($userId) {
        $sql = "SELECT h.*, u.email 
                FROM hospitals h 
                JOIN users u ON h.user_id = u.id 
                WHERE u.id = :user_id";
                
        $stmt = Database::query($sql, ['user_id' => $userId]);
        return $stmt->fetch();
    }

    public function getBloodStocks($hospitalId) {
        $sql = "SELECT blood_type, quantity FROM blood_stocks 
                WHERE hospital_id = :hospital_id";
                
        $stmt = Database::query($sql, ['hospital_id' => $hospitalId]);
        $stocks = $stmt->fetchAll();
        
        // Format pour affichage facile
        $result = [];
        foreach ($stocks as $stock) {
            $result[$stock['blood_type']] = $stock['quantity'];
        }
        
        return $result;
    }

    public function updateBloodStocks($hospitalId, $stocks) {
        try {
            Database::getInstance()->getConnection()->beginTransaction();
            
            foreach ($stocks as $stock) {
                $sql = "INSERT INTO blood_stocks (hospital_id, blood_type, quantity)
                        VALUES (:hospital_id, :blood_type, :quantity)
                        ON DUPLICATE KEY UPDATE quantity = :quantity";
                        
                Database::query($sql, [
                    'hospital_id' => $hospitalId,
                    'blood_type' => $stock['blood_type'],
                    'quantity' => $stock['quantity']
                ]);
            }
            
            Database::getInstance()->getConnection()->commit();
            return true;
        } catch (PDOException $e) {
            Database::getInstance()->getConnection()->rollBack();
            return false;
        }
    }

    public function findByBloodType($bloodType) {
        $sql = "SELECT h.name, h.address, h.city, h.country, h.phone, 
                       bs.quantity, h.latitude, h.longitude
                FROM hospitals h
                JOIN blood_stocks bs ON h.id = bs.hospital_id
                WHERE bs.blood_type = :blood_type AND bs.quantity > 0";
                
        $stmt = Database::query($sql, ['blood_type' => $bloodType]);
        return $stmt->fetchAll();
    }
}