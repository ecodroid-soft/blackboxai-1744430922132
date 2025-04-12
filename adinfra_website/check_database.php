<?php
// Include configuration
require_once 'includes/config.php';

try {
    // Check if the connection is established
    if ($conn) {
        echo "Database connection successful.\n";
        
        // Check for existing tables
        $tables = $conn->query("SELECT name FROM sqlite_master WHERE type='table'");
        echo "Existing tables:\n";
        $tableExists = false;
        while ($table = $tables->fetch(PDO::FETCH_ASSOC)) {
            echo "- " . $table['name'] . "\n";
            $tableExists = true;
        }
        
        if (!$tableExists) {
            echo "No tables found in the database.\n";
        }
    }
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage() . "\n";
}
