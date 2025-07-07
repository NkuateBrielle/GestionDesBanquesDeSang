<?php
class UserModel extends Model {
    protected $table = 'users';
    
    public function findByEmail($email) {
        $stmt = Database::query(
            "SELECT * FROM users WHERE email = :email LIMIT 1",
            ['email' => $email]
        );
        return $stmt->fetch();
    }
    
    public function updateLastLogin($userId) {
        $sql = "UPDATE users SET last_login = NOW() WHERE id = :id";
        return Database::query($sql, ['id' => $userId]);
    }
    
    public function createUser($data) {
        $sql = "INSERT INTO users (email, password, first_name, last_name, role) 
                VALUES (:email, :password, :first_name, :last_name, :role)";
                
        return Database::query($sql, [
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_BCRYPT),
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'role' => $data['role']
        ]);
    }
}