<?php

class Gallery
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Get all galleries
    public function getAll()
    {
        $query = "SELECT * FROM galleries ORDER BY created_at DESC";
        return $this->db->fetchAll($query);
    }

    // Get gallery by ID
    public function getById($id)
    {
        $query = "SELECT * FROM galleries WHERE id = :id";
        return $this->db->fetch($query, ['id' => $id]);
    }

    // Get galleries by media type
    public function getByType($media_type)
    {
        $query = "SELECT * FROM galleries WHERE media_type = :media_type ORDER BY created_at DESC";
        return $this->db->fetchAll($query, ['media_type' => $media_type]);
    }

    // Get recent galleries
    public function getRecent($limit = 12)
    {
        $query = "SELECT * FROM galleries ORDER BY created_at DESC LIMIT :limit";
        return $this->db->fetchAll($query, ['limit' => $limit]);
    }

    // Create new gallery item
    public function create($data)
    {
        $query = "INSERT INTO galleries (title, media_type, file_path, description) 
                  VALUES (:title, :media_type, :file_path, :description)";
        $params = [
            'title' => $data['title'],
            'media_type' => $data['media_type'],
            'file_path' => $data['file_path'],
            'description' => $data['description'] ?? null
        ];
        return $this->db->execute($query, $params);
    }

    // Update gallery item
    public function update($id, $data)
    {
        $query = "UPDATE galleries SET title = :title, media_type = :media_type, 
                  file_path = :file_path, description = :description WHERE id = :id";
        $params = [
            'id' => $id,
            'title' => $data['title'],
            'media_type' => $data['media_type'],
            'file_path' => $data['file_path'],
            'description' => $data['description'] ?? null
        ];
        return $this->db->execute($query, $params);
    }

    // Delete gallery item
    public function delete($id)
    {
        $query = "DELETE FROM galleries WHERE id = :id";
        return $this->db->execute($query, ['id' => $id]);
    }

    // Search galleries
    public function search($keyword)
    {
        $query = "SELECT * FROM galleries 
                  WHERE title LIKE :keyword OR description LIKE :keyword 
                  ORDER BY created_at DESC";
        return $this->db->fetchAll($query, ['keyword' => '%' . $keyword . '%']);
    }

    // Search galleries by type and keyword
    public function searchByTypeAndKeyword($media_type, $keyword)
    {
        $query = "SELECT * FROM galleries 
                  WHERE media_type = :media_type 
                  AND (title LIKE :keyword OR description LIKE :keyword) 
                  ORDER BY created_at DESC";
        return $this->db->fetchAll($query, [
            'media_type' => $media_type,
            'keyword' => '%' . $keyword . '%'
        ]);
    }
}
