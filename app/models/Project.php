<?php

class Project
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Get all projects
    public function getAll()
    {
        $query = "SELECT * FROM projects ORDER BY created_at DESC";
        return $this->db->fetchAll($query);
    }

    // Get project by ID
    public function getById($id)
    {
        $query = "SELECT * FROM projects WHERE id = :id";
        return $this->db->fetch($query, ['id' => $id]);
    }

    // Get project by slug
    public function getBySlug($slug)
    {
        $query = "SELECT * FROM projects WHERE slug = :slug";
        return $this->db->fetch($query, ['slug' => $slug]);
    }

    // Get projects by category
    public function getByCategory($category)
    {
        $query = "SELECT * FROM projects WHERE category = :category ORDER BY created_at DESC";
        return $this->db->fetchAll($query, ['category' => $category]);
    }

    // Search projects
    public function search($keyword)
    {
        $query = "SELECT * FROM projects WHERE title ILIKE :keyword OR description ILIKE :keyword OR tags ILIKE :keyword ORDER BY created_at DESC";
        return $this->db->fetchAll($query, ['keyword' => "%$keyword%"]);
    }

    // Create new project
    public function create($data)
    {
        $query = "INSERT INTO projects (title, slug, description, category, tags, thumbnail, video_url, 
                  team_name, team_members, supervisor, client, technologies, github_url, demo_url) 
                  VALUES (:title, :slug, :description, :category, :tags, :thumbnail, :video_url, 
                  :team_name, :team_members, :supervisor, :client, :technologies, :github_url, :demo_url)";
        $params = [
            'title' => $data['title'],
            'slug' => $this->generateSlug($data['title']),
            'description' => $data['description'],
            'category' => $data['category'],
            'tags' => $data['tags'] ?? null,
            'thumbnail' => $data['thumbnail'] ?? null,
            'video_url' => $data['video_url'] ?? null,
            'team_name' => $data['team_name'] ?? null,
            'team_members' => $data['team_members'] ?? null,
            'supervisor' => $data['supervisor'] ?? null,
            'client' => $data['client'] ?? null,
            'technologies' => $data['technologies'] ?? null,
            'github_url' => $data['github_url'] ?? null,
            'demo_url' => $data['demo_url'] ?? null
        ];
        return $this->db->execute($query, $params);
    }

    // Update project
    public function update($id, $data)
    {
        $query = "UPDATE projects SET title = :title, slug = :slug, description = :description, 
                  category = :category, tags = :tags, thumbnail = :thumbnail, video_url = :video_url, 
                  team_name = :team_name, team_members = :team_members, supervisor = :supervisor, 
                  client = :client, technologies = :technologies, github_url = :github_url, 
                  demo_url = :demo_url, updated_at = CURRENT_TIMESTAMP WHERE id = :id";
        $params = [
            'id' => $id,
            'title' => $data['title'],
            'slug' => $this->generateSlug($data['title']),
            'description' => $data['description'],
            'category' => $data['category'],
            'tags' => $data['tags'] ?? null,
            'thumbnail' => $data['thumbnail'],
            'video_url' => $data['video_url'] ?? null,
            'team_name' => $data['team_name'] ?? null,
            'team_members' => $data['team_members'] ?? null,
            'supervisor' => $data['supervisor'] ?? null,
            'client' => $data['client'] ?? null,
            'technologies' => $data['technologies'] ?? null,
            'github_url' => $data['github_url'] ?? null,
            'demo_url' => $data['demo_url'] ?? null
        ];
        return $this->db->execute($query, $params);
    }

    // Delete project
    public function delete($id)
    {
        $query = "DELETE FROM projects WHERE id = :id";
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

    // Get featured projects (limit 6)
    public function getFeatured($limit = 6)
    {
        $query = "SELECT * FROM projects ORDER BY created_at DESC LIMIT :limit";
        return $this->db->fetchAll($query, ['limit' => $limit]);
    }

    // Get all categories
    public function getCategories()
    {
        $query = "SELECT DISTINCT category FROM projects WHERE category IS NOT NULL ORDER BY category";
        return $this->db->fetchAll($query);
    }
}
