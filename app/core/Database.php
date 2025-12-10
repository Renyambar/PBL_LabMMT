<?php

class Database
{
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $port;
    private $conn;

    public function __construct()
    {
        $this->host = DB_HOST;
        $this->db_name = DB_NAME;
        $this->username = DB_USER;
        $this->password = DB_PASS;
        $this->port = DB_PORT;

        // Connect SEKALI saja
        $this->connect();
    }

    public function connect()
    {
        if ($this->conn === null) {
            try {
                $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->db_name}";
                $this->conn = new PDO($dsn, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("Connection Error: " . $e->getMessage());
            }
        }

        return $this->conn;
    }

    public function query($query, $params = [])
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }

    public function fetchAll($query, $params = [])
    {
        return $this->query($query, $params)->fetchAll();
    }

    public function fetch($query, $params = [])
    {
        return $this->query($query, $params)->fetch();
    }

    public function execute($query, $params = [])
    {
        try {
            $stmt = $this->conn->prepare($query);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            // Log error dengan detail lengkap
            error_log("Database Execute Error: " . $e->getMessage());
            error_log("Query: " . $query);
            error_log("Params: " . print_r($params, true));
            
            // Tampilkan error ke user jika development mode
            if (defined('APP_ENV') && APP_ENV === 'development') {
                echo "<div style='background:#f8d7da;color:#721c24;padding:15px;margin:10px;border:1px solid #f5c6cb;border-radius:5px;'>";
                echo "<strong>Database Error:</strong> " . htmlspecialchars($e->getMessage()) . "<br>";
                echo "<strong>Query:</strong> " . htmlspecialchars($query) . "<br>";
                echo "<strong>Params:</strong> <pre>" . htmlspecialchars(print_r($params, true)) . "</pre>";
                echo "</div>";
            }
            
            return false;
        }
    }
}
