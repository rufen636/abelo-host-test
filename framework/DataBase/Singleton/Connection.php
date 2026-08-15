<?php

class Connection
{
    protected static ?Connection $instance = null;
    private ?PDO $connection = null;
    private string $host;
    private string $dbname;
    private string $username;
    private string $password;
    private string $charset = 'utf8mb4';

    /**
     * @param $host
     * @param $port
     * @param $dbname
     * @param $username
     * @param $password
     * @param $database
     */
    public function __construct()
    {
        $this->host = $_ENV['DB_HOST'];
        $this->dbname = $_ENV['DB_DATABASE'];
        $this->username = $_ENV['DB_USERNAME'];
        $this->password = $_ENV['DB_PASSWORD'];
        $this->connect();
    }

    private function connect(): void
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}";

            $this->connection = new PDO(
                $dsn,
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        } catch (PDOException $e) {
            throw new RuntimeException('Database connection failed: ' . $e->getMessage());
        }
        }

    public function getInstance(): Connection
    {
        if (self::$instance == null){
            self::$instance = new Connection();
        }
        return self::$instance;
    }
    public function getConnection(): PDO
    {
        return $this->connection;
    }
    public function query(string $sql, array $params = []): PDOStatement
    {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
    public function fetchAll(string $sql, array $params = []): array
    {
        return $this->query($sql, $params)->fetchAll();
    }

    public function fetchOne(string $sql, array $params = []): ?array
    {
        $result = $this->query($sql, $params)->fetch();
        return $result ?: null;
    }

}