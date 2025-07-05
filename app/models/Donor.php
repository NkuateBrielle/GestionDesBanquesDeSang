<?php
class Donor {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function register($data) {
        $sql = "INSERT INTO donors (full_name, email, password, blood_type, phone, location, is_available) 
                VALUES (:full_name, :email, :password, :blood_type, :phone, :location, :is_available)";
        
        $this->db->query($sql);
        $this->db->bind(':full_name', $data['full_name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->bind(':blood_type', $data['blood_type']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':location', $data['location']);
        $this->db->bind(':is_available', $data['is_available'] ?? 0);

        return $this->db->execute();
    }

    public function findByEmail($email) {
        $sql = "SELECT * FROM donors WHERE email = :email";
        $this->db->query($sql);
        $this->db->bind(':email', $email);
        
        return $this->db->single();
    }

    public function findById($id) {
        $sql = "SELECT * FROM donors WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind(':id', $id);
        
        return $this->db->single();
    }

    public function searchByBloodType($bloodType) {
        $sql = "SELECT * FROM donors WHERE blood_type = :blood_type AND is_available = 1";
        $this->db->query($sql);
        $this->db->bind(':blood_type', $bloodType);
        
        return $this->db->resultSet();
    }
}