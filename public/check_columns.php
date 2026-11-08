<?php
require_once '../config/config.php';

try {
    $db = new PDO(
        "pgsql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS
    );
    
    $query = "SELECT column_name, data_type 
              FROM information_schema.columns 
              WHERE table_name = 'projects' 
              ORDER BY ordinal_position";
    
    $stmt = $db->query($query);
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h2>Kolom di tabel projects:</h2>";
    echo "<table border='1' style='border-collapse: collapse;'>";
    echo "<tr><th>Nama Kolom</th><th>Tipe Data</th></tr>";
    foreach ($columns as $col) {
        echo "<tr><td>{$col['column_name']}</td><td>{$col['data_type']}</td></tr>";
    }
    echo "</table>";
    
    // Check if project_url and github_url exist
    echo "<br><h3>Cek kolom penting:</h3>";
    $important_cols = ['project_url', 'github_url', 'tags', 'team_name', 'team_members'];
    foreach ($important_cols as $col_name) {
        $exists = false;
        foreach ($columns as $col) {
            if ($col['column_name'] === $col_name) {
                $exists = true;
                break;
            }
        }
        echo "<p style='color: " . ($exists ? 'green' : 'red') . "'>";
        echo $col_name . ": " . ($exists ? "✓ ADA" : "✗ TIDAK ADA");
        echo "</p>";
    }
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
