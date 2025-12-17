<?php

class ProjectRating
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Get all ratings for a project
    public function getByProject($project_id)
    {
        $query = "SELECT * FROM project_ratings WHERE project_id = :project_id ORDER BY created_at DESC";
        return $this->db->fetchAll($query, ['project_id' => $project_id]);
    }

    // Get average rating for a project
    public function getAverageRating($project_id)
    {
        $query = "SELECT get_project_avg_rating($1) as avg_rating";
        $result = $this->db->fetch($query, [$project_id]);
        return $result['avg_rating'] ?? 0;
    }

    // Get rating count for a project
    public function getRatingCount($project_id)
    {
        $query = "SELECT get_project_rating_count($1) as count";
        $result = $this->db->fetch($query, [$project_id]);
        return $result['count'] ?? 0;
    }

    // Add new rating
    public function create($data)
    {
        // Set default values for optional fields
        $contributor_name = !empty($data['contributor_name']) ? $data['contributor_name'] : 'Anonymous';
        $contributor_email = !empty($data['contributor_email']) ? $data['contributor_email'] : null;

        $query = "INSERT INTO project_ratings (project_id, user_id, contributor_name, contributor_email, rating) 
                  VALUES (:project_id, :user_id, :contributor_name, :contributor_email, :rating)";
        $params = [
            'project_id' => $data['project_id'],
            'user_id' => $data['user_id'] ?? null,
            'contributor_name' => $contributor_name,
            'contributor_email' => $contributor_email,
            'rating' => $data['rating']
        ];
        return $this->db->execute($query, $params);
    }

    // Delete rating
    public function delete($id)
    {
        $query = "DELETE FROM project_ratings WHERE id = :id";
        return $this->db->execute($query, ['id' => $id]);
    }

    // Get rating statistics
    public function getStatistics($project_id)
    {
        $query = "SELECT 
                    COUNT(*) as total_ratings,
                    ROUND(AVG(rating)::numeric, 1) as avg_rating,
                    COUNT(CASE WHEN rating = 5 THEN 1 END) as five_star,
                    COUNT(CASE WHEN rating = 4 THEN 1 END) as four_star,
                    COUNT(CASE WHEN rating = 3 THEN 1 END) as three_star,
                    COUNT(CASE WHEN rating = 2 THEN 1 END) as two_star,
                    COUNT(CASE WHEN rating = 1 THEN 1 END) as one_star
                  FROM project_ratings 
                  WHERE project_id = :project_id";
        return $this->db->fetch($query, ['project_id' => $project_id]);
    }
}
