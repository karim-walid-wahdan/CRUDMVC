<?php

namespace App\Config;

use PDO;
use PDOException;

class DBConfig
{
    static function executeQuery($query)
    {
        // Database credentials
        $host = 'localhost';
        $database = 'test';
        $username = 'root';
        $password = '';

        // Establishing a database connection using PDO
        $dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $pdo = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            // Prepare the error message
            $errorMessage = "Query execution failed: " . $e->getMessage();

            // Display error message as an alert
            echo '<script>alert("' . $errorMessage . '");</script>';

            // Redirect to a error page
            header("Location: ../Views/Error404.php");
            die(); // Terminate the script
        }

        // Checking for syntax problems in the query
        try {

            // Executing the query
            $result = $pdo->prepare($query);
            $result = $pdo->query($query);

        } catch (PDOException $e) {
            // Prepare the error message
            $errorMessage = "Query execution failed: " . $e->getMessage();

            // Display error message as an alert
            echo '<script>alert("' . $errorMessage . '");</script>';

            // Redirect to a specific page
            header("Location: error_page.php");
            die(); // Terminate the script
        }

        // Closing the database connection
        $pdo = null;
        // Returning the result
        return $result;

    }
}