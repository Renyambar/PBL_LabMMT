<?php

class Article
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Get all articles with author info
    public function getAll()
    {
        $query = "SELECT a.*, u.name as author_name FROM articles a 
                  LEFT JOIN users u ON a.author_id = u.id 
                  ORDER BY a.created_at DESC";
        return $this->db->fetchAll($query);
    }

    // Get article by ID
    public function getById($id)
    {
        $query = "SELECT a.*, u.name as author_name FROM articles a 
                  LEFT JOIN users u ON a.author_id = u.id 
                  WHERE a.id = :id";
        return $this->db->fetch($query, ['id' => $id]);
    }

    // Get article by slug
    public function getBySlug($slug)
    {
        $query = "SELECT a.*, u.name as author_name FROM articles a 
                  LEFT JOIN users u ON a.author_id = u.id 
                  WHERE a.slug = :slug";
        return $this->db->fetch($query, ['slug' => $slug]);
    }

    // Get recent articles
    public function getRecent($limit = 5)
    {
        $query = "SELECT a.*, u.name as author_name FROM articles a 
                  LEFT JOIN users u ON a.author_id = u.id 
                  ORDER BY a.created_at DESC LIMIT :limit";
        return $this->db->fetchAll($query, ['limit' => $limit]);
    }

    // Search articles
    public function search($keyword)
    {
        $query = "SELECT a.*, u.name as author_name FROM articles a 
                  LEFT JOIN users u ON a.author_id = u.id 
                  WHERE a.title ILIKE :keyword OR a.content ILIKE :keyword 
                  ORDER BY a.created_at DESC";
        return $this->db->fetchAll($query, ['keyword' => "%$keyword%"]);
    }

    // Create new article
    public function create($data)
    {
        $query = "INSERT INTO articles (title, slug, content, author_id, thumbnail) 
                  VALUES (:title, :slug, :content, :author_id, :thumbnail)";
        $params = [
            'title' => $data['title'],
            'slug' => $this->generateSlug($data['title']),
            'content' => $data['content'],
            'author_id' => $data['author_id'],
            'thumbnail' => $data['thumbnail'] ?? null
        ];
        return $this->db->execute($query, $params);
    }

    // Update article
    public function update($id, $data)
    {
        $query = "UPDATE articles SET title = :title, slug = :slug, content = :content, 
                  thumbnail = :thumbnail, updated_at = CURRENT_TIMESTAMP WHERE id = :id";
        $params = [
            'id' => $id,
            'title' => $data['title'],
            'slug' => $this->generateSlug($data['title']),
            'content' => $data['content'],
            'thumbnail' => $data['thumbnail']
        ];
        return $this->db->execute($query, $params);
    }

    // Delete article
    public function delete($id)
    {
        $query = "DELETE FROM articles WHERE id = :id";
        return $this->db->execute($query, ['id' => $id]);
    }

    // Generate slug from title
    private function generateSlug($title)
    {
        $slug = strtolower($title);
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', '-', $slug);
        $slug = trim($slug, '-');
        return $slug;
    }
}
