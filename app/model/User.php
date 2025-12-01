<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Get all users
    public function getAll()
    {
        $query = "SELECT id, name, email, role, created_at FROM users ORDER BY created_at DESC";
        return $this->db->fetchAll($query);
    }

    // Get user by ID
    public function getById($id)
    {
        $query = "SELECT id, name, email, role, created_at FROM users WHERE id = :id";
        return $this->db->fetch($query, ['id' => $id]);
    }

    // Get user by email
    public function getByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email = :email";
        return $this->db->fetch($query, ['email' => $email]);
    }

    // Create new user
    public function create($data)
    {
        $query = "INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)";
        $params = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'role' => $data['role'] ?? 'editor'
        ];
        return $this->db->execute($query, $params);
    }

    // Update user
    public function update($id, $data)
    {
        if (isset($data['password']) && !empty($data['password'])) {
            $query = "UPDATE users SET name = :name, email = :email, password = :password, role = :role WHERE id = :id";
            $params = [
                'id' => $id,
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => password_hash($data['password'], PASSWORD_DEFAULT),
                'role' => $data['role']
            ];
        } else {
            $query = "UPDATE users SET name = :name, email = :email, role = :role WHERE id = :id";
            $params = [
                'id' => $id,
                'name' => $data['name'],
                'email' => $data['email'],
                'role' => $data['role']
            ];
        }
        return $this->db->execute($query, $params);
    }

    // Delete user
    public function delete($id)
    {
        $query = "DELETE FROM users WHERE id = :id";
        return $this->db->execute($query, ['id' => $id]);
    }

    // Login
    public function login($email, $password)
    {
        $user = $this->getByEmail($email);
        
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        
        return false;
    }
}
