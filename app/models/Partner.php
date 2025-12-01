<?php

class Partner
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Get all partners
    public function getAll()
    {
        $query = "SELECT * FROM partners ORDER BY created_at DESC";
        return $this->db->fetchAll($query);
    }

    // Get partner by ID
    public function getById($id)
    {
        $query = "SELECT * FROM partners WHERE id = :id";
        return $this->db->fetch($query, ['id' => $id]);
    }

    // Create new partner
    public function create($data)
    {
        $query = "INSERT INTO partners (name, logo, description, website) 
                  VALUES (:name, :logo, :description, :website)";
        $params = [
            'name' => $data['name'],
            'logo' => $data['logo'] ?? null,
            'description' => $data['description'] ?? null,
            'website' => $data['website'] ?? null
        ];
        return $this->db->execute($query, $params);
    }

    // Update partner
    public function update($id, $data)
    {
        $query = "UPDATE partners SET name = :name, logo = :logo, description = :description, 
                  website = :website WHERE id = :id";
        $params = [
            'id' => $id,
            'name' => $data['name'],
            'logo' => $data['logo'],
            'description' => $data['description'] ?? null,
            'website' => $data['website'] ?? null
        ];
        return $this->db->execute($query, $params);
    }

    // Delete partner
    public function delete($id)
    {
        $query = "DELETE FROM partners WHERE id = :id";
        return $this->db->execute($query, ['id' => $id]);
    }
}
