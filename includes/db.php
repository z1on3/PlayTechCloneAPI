<?php

    class Database {
        private $host = "localhost"; // Database host
        private $username = "root"; // Database username
        private $password = ""; // Database password (leave empty for root)
        private $database = "playtech_db"; // Database name
        private $connection;

        public function __construct() {
            try {
                $this->connection = new PDO("mysql:host=$this->host;dbname=$this->database;charset=utf8", $this->username, $this->password);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }

        public function getConnection() {
            return $this->connection;
        }
        // Execute a query and return a PDOStatement object
        public function query($sql) {
            return $this->connection->query($sql);
        }

        // Execute a query and return an associative array of results
        public function fetchAll($sql) {
            $stmt = $this->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Insert data into a table
        public function insert($table, $data) {
            $columns = implode(', ', array_keys($data));
            $values = ':' . implode(', :', array_keys($data));

            $sql = "INSERT INTO $table ($columns) VALUES ($values)";
            $stmt = $this->connection->prepare($sql);

            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            return $stmt->execute();
        }

        // Delete data from a table
        public function delete($table, $whereClause) {
            $sql = "DELETE FROM $table WHERE $whereClause";
            return $this->connection->exec($sql);
        }
    }
    