<?php
// Include configuration
require_once 'includes/config.php';

try {
    // Read the schema file from the correct path
    $schema = file_get_contents(__DIR__ . '/database/schema.sql');
    
    // Split schema into individual statements
    $statements = array_filter(
        array_map('trim', 
            explode(';', $schema)
        )
    );
    
    // Execute each statement
    foreach ($statements as $statement) {
        if (!empty($statement)) {
            $conn->exec($statement);
        }
    }
    
    echo "Database schema executed successfully!\n";
    
} catch(PDOException $e) {
    echo "Error executing schema: " . $e->getMessage() . "\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
