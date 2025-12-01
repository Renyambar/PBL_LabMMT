<?php

class ProjectComment
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Get all approved comments for a project
    public function getByProject($project_id, $approved_only = true)
    {
        if ($approved_only) {
            $query = "SELECT * FROM project_comments WHERE project_id = :project_id AND is_approved = TRUE ORDER BY created_at DESC";
        } else {
            $query = "SELECT * FROM project_comments WHERE project_id = :project_id ORDER BY created_at DESC";
        }
        return $this->db->fetchAll($query, ['project_id' => $project_id]);
    }

    // Get all comments (admin only)
    public function getAll()
    {
        $query = "SELECT pc.*, p.title as project_title 
                  FROM project_comments pc
                  LEFT JOIN projects p ON pc.project_id = p.id
                  ORDER BY pc.created_at DESC";
        return $this->db->fetchAll($query);
    }

    // Get pending comments
    public function getPending()
    {
        $query = "SELECT pc.*, p.title as project_title 
                  FROM project_comments pc
                  LEFT JOIN projects p ON pc.project_id = p.id
                  WHERE pc.is_approved = FALSE
                  ORDER BY pc.created_at DESC";
        return $this->db->fetchAll($query);
    }

    // Get comment by ID
    public function getById($id)
    {
        $query = "SELECT * FROM project_comments WHERE id = :id";
        return $this->db->fetch($query, ['id' => $id]);
    }

    // Get comment count for a project
    public function getCommentCount($project_id)
    {
        $query = "SELECT get_project_comment_count(:project_id) as count";
        $result = $this->db->fetch($query, ['project_id' => $project_id]);
        return $result['count'] ?? 0;
    }

    // Add new comment
    public function create($data)
    {
        // Set default values for optional fields
        $contributor_name = !empty($data['contributor_name']) ? $data['contributor_name'] : 'Anonymous';
        $contributor_email = !empty($data['contributor_email']) ? $data['contributor_email'] : null;

        $query = "INSERT INTO project_comments (project_id, user_id, contributor_name, contributor_email, comment, is_approved) 
                  VALUES (:project_id, :user_id, :contributor_name, :contributor_email, :comment, :is_approved)";
        $params = [
            'project_id' => $data['project_id'],
            'user_id' => $data['user_id'] ?? null,
            'contributor_name' => $contributor_name,
            'contributor_email' => $contributor_email,
            'comment' => $data['comment'],
            'is_approved' => $data['is_approved'] ?? false
        ];
        return $this->db->execute($query, $params);
    }

    // Approve comment
    public function approve($id)
    {
        $query = "UPDATE project_comments SET is_approved = TRUE WHERE id = :id";
        return $this->db->execute($query, ['id' => $id]);
    }

    // Reject/unapprove comment
    public function unapprove($id)
    {
        $query = "UPDATE project_comments SET is_approved = FALSE WHERE id = :id";
        return $this->db->execute($query, ['id' => $id]);
    }

    // Delete comment
    public function delete($id)
    {
        $query = "DELETE FROM project_comments WHERE id = :id";
        return $this->db->execute($query, ['id' => $id]);
    }
}
