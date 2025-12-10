<?php

class Publication
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Get all publications
    public function getAll()
    {
        $query = "SELECT p.*, u.name as creator_name 
                  FROM publications p 
                  LEFT JOIN users u ON p.created_by = u.id 
                  ORDER BY p.publication_date DESC, p.created_at DESC";
        return $this->db->fetchAll($query);
    }

    // Get publication by ID
    public function getById($id)
    {
        $query = "SELECT p.*, u.name as creator_name 
                  FROM publications p 
                  LEFT JOIN users u ON p.created_by = u.id 
                  WHERE p.id = :id";
        return $this->db->fetch($query, ['id' => $id]);
    }

    // Get publication by slug
    public function getBySlug($slug)
    {
        $query = "SELECT p.*, u.name as creator_name 
                  FROM publications p 
                  LEFT JOIN users u ON p.created_by = u.id 
                  WHERE p.slug = :slug";
        return $this->db->fetch($query, ['slug' => $slug]);
    }

    // Get recent publications
    public function getRecent($limit = 6)
    {
        $query = "SELECT p.*, u.name as creator_name 
                  FROM publications p 
                  LEFT JOIN users u ON p.created_by = u.id 
                  ORDER BY p.publication_date DESC, p.created_at DESC 
                  LIMIT :limit";
        return $this->db->fetchAll($query, ['limit' => $limit]);
    }

    // Search publications
    public function search($keyword)
    {
        $query = "SELECT p.*, u.name as creator_name 
                  FROM publications p 
                  LEFT JOIN users u ON p.created_by = u.id 
                  WHERE p.title ILIKE :keyword 
                  OR p.authors ILIKE :keyword 
                  OR p.keywords ILIKE :keyword 
                  ORDER BY p.publication_date DESC";
        return $this->db->fetchAll($query, ['keyword' => "%$keyword%"]);
    }

    // Filter by type
    public function getByType($type)
    {
        $query = "SELECT p.*, u.name as creator_name 
                  FROM publications p 
                  LEFT JOIN users u ON p.created_by = u.id 
                  WHERE p.publication_type = :type 
                  ORDER BY p.publication_date DESC";
        return $this->db->fetchAll($query, ['type' => $type]);
    }

    // Create publication
    public function create($data)
    {
        $query = "INSERT INTO publications (
            title, slug, authors, abstract, publication_type,
            journal_name, conference_name, publisher, publication_date,
            volume, issue, pages, doi, isbn, issn, url, pdf_file,
            keywords, citation_count, created_by
        ) VALUES (
            :title, :slug, :authors, :abstract, :publication_type,
            :journal_name, :conference_name, :publisher, :publication_date,
            :volume, :issue, :pages, :doi, :isbn, :issn, :url, :pdf_file,
            :keywords, :citation_count, :created_by
        )";

        return $this->db->execute($query, [
            'title' => $data['title'],
            'slug' => $data['slug'],
            'authors' => $data['authors'],
            'abstract' => $data['abstract'],
            'publication_type' => $data['publication_type'],
            'journal_name' => $data['journal_name'] ?? null,
            'conference_name' => $data['conference_name'] ?? null,
            'publisher' => $data['publisher'] ?? null,
            'publication_date' => $data['publication_date'] ?? null,
            'volume' => $data['volume'] ?? null,
            'issue' => $data['issue'] ?? null,
            'pages' => $data['pages'] ?? null,
            'doi' => $data['doi'] ?? null,
            'isbn' => $data['isbn'] ?? null,
            'issn' => $data['issn'] ?? null,
            'url' => $data['url'] ?? null,
            'pdf_file' => $data['pdf_file'] ?? null,
            'keywords' => $data['keywords'] ?? null,
            'citation_count' => $data['citation_count'] ?? 0,
            'created_by' => $data['created_by']
        ]);
    }

    // Update publication
    public function update($id, $data)
    {
        $query = "UPDATE publications SET
            title = :title,
            slug = :slug,
            authors = :authors,
            abstract = :abstract,
            publication_type = :publication_type,
            journal_name = :journal_name,
            conference_name = :conference_name,
            publisher = :publisher,
            publication_date = :publication_date,
            volume = :volume,
            issue = :issue,
            pages = :pages,
            doi = :doi,
            isbn = :isbn,
            issn = :issn,
            url = :url,
            pdf_file = :pdf_file,
            keywords = :keywords,
            citation_count = :citation_count,
            updated_at = NOW()
            WHERE id = :id";

        return $this->db->execute($query, [
            'id' => $id,
            'title' => $data['title'],
            'slug' => $data['slug'],
            'authors' => $data['authors'],
            'abstract' => $data['abstract'],
            'publication_type' => $data['publication_type'],
            'journal_name' => $data['journal_name'] ?? null,
            'conference_name' => $data['conference_name'] ?? null,
            'publisher' => $data['publisher'] ?? null,
            'publication_date' => $data['publication_date'] ?? null,
            'volume' => $data['volume'] ?? null,
            'issue' => $data['issue'] ?? null,
            'pages' => $data['pages'] ?? null,
            'doi' => $data['doi'] ?? null,
            'isbn' => $data['isbn'] ?? null,
            'issn' => $data['issn'] ?? null,
            'url' => $data['url'] ?? null,
            'pdf_file' => $data['pdf_file'] ?? null,
            'keywords' => $data['keywords'] ?? null,
            'citation_count' => $data['citation_count'] ?? 0
        ]);
    }

    // Delete publication
    public function delete($id)
    {
        $query = "DELETE FROM publications WHERE id = :id";
        return $this->db->execute($query, ['id' => $id]);
    }

    // Generate slug from title
    public function generateSlug($title)
    {
        $slug = strtolower(trim($title));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', '-', $slug);
        return trim($slug, '-');
    }

    // Check if slug exists
    public function slugExists($slug, $excludeId = null)
    {
        if ($excludeId) {
            $query = "SELECT id FROM publications WHERE slug = :slug AND id != :id";
            $result = $this->db->fetch($query, ['slug' => $slug, 'id' => $excludeId]);
        } else {
            $query = "SELECT id FROM publications WHERE slug = :slug";
            $result = $this->db->fetch($query, ['slug' => $slug]);
        }
        return $result !== false && $result !== null;
    }

    // Get publication types
    public function getTypes()
    {
        return ['Jurnal', 'Konferensi', 'Book Chapter', 'Prosiding', 'Lainnya'];
    }

    // Get statistics
    public function getStats()
    {
        $query = "SELECT 
            COUNT(*) as total,
            SUM(citation_count) as total_citations,
            COUNT(CASE WHEN publication_type = 'Jurnal' THEN 1 END) as total_journals,
            COUNT(CASE WHEN publication_type = 'Konferensi' THEN 1 END) as total_conferences
            FROM publications";
        return $this->db->fetch($query);
    }
}
