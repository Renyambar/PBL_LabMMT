<?php

class LabProfile
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Get lab profile
    public function getProfile()
    {
        $query = "SELECT * FROM lab_profile ORDER BY id DESC LIMIT 1";
        return $this->db->fetch($query);
    }

    // Update lab profile
    public function update($data)
    {
        $query = "UPDATE lab_profile SET 
                  description = :description,
                  vision = :vision,
                  mission = :mission,
                  updated_at = CURRENT_TIMESTAMP
                  WHERE id = :id";
        
        $params = [
            'id' => $data['id'],
            'description' => $data['description'],
            'vision' => $data['vision'],
            'mission' => $data['mission'] // JSON string
        ];
        
        return $this->db->execute($query, $params);
    }

    // Get all team members
    public function getTeamMembers()
    {
        $query = "SELECT * FROM lab_team_members ORDER BY is_head DESC, display_order ASC";
        return $this->db->fetchAll($query);
    }

    // Get team member by ID
    public function getTeamMemberById($id)
    {
        $query = "SELECT * FROM lab_team_members WHERE id = :id";
        return $this->db->fetch($query, ['id' => $id]);
    }

    // Add team member
    public function addTeamMember($data)
    {
        $query = "INSERT INTO lab_team_members (name, position, photo, is_head, display_order) 
                  VALUES (:name, :position, :photo, :is_head::boolean, :display_order)";
        
        $params = [
            'name' => $data['name'],
            'position' => $data['position'],
            'photo' => $data['photo'] ?? null,
            'is_head' => $data['is_head'] ? 'true' : 'false',
            'display_order' => $data['display_order'] ?? 0
        ];
        
        return $this->db->execute($query, $params);
    }

    // Update team member
    public function updateTeamMember($id, $data)
    {
        $query = "UPDATE lab_team_members SET 
                  name = :name,
                  position = :position,
                  photo = :photo,
                  is_head = :is_head::boolean,
                  display_order = :display_order
                  WHERE id = :id";
        
        $params = [
            'id' => $id,
            'name' => $data['name'],
            'position' => $data['position'],
            'photo' => $data['photo'],
            'is_head' => $data['is_head'] ? 'true' : 'false',
            'display_order' => $data['display_order'] ?? 0
        ];
        
        return $this->db->execute($query, $params);
    }

    // Delete team member
    public function deleteTeamMember($id)
    {
        $query = "DELETE FROM lab_team_members WHERE id = :id";
        return $this->db->execute($query, ['id' => $id]);
    }
}
