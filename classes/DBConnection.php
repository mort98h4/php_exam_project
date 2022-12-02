<?php

class DB {
    public function connect() {
        $host = 'localhost';
        $dbName = 'anarkist';
        $dbUser = 'root';
        $dbPassword = 'root';
        $dbConn = 'mysql:host=' . $host . '; dbname=' . $dbName . '; charsetutf8mb4';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        try {
            $db = new PDO($dbConn, $dbUser, $dbPassword, $options);
        } catch(PDOException $ex) {
            echo $ex;
            exit();
        }

        return $db;
    }

    public function disconnect($pcnDB) {
        $pcnDB = null;
    }
}