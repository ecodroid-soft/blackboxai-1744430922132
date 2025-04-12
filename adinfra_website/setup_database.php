<?php
// Include configuration
require_once 'includes/config.php';

try {
    // Create database directory if it doesn't exist
    $dbDir = dirname(DB_FILE);
    if (!is_dir($dbDir)) {
        mkdir($dbDir, 0755, true);
    }

    // Create new SQLite database
    if (!file_exists(DB_FILE)) {
        // Read schema file
        $schema = file_get_contents('database/schema.sql');
        
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
        
        echo "Database created and initialized successfully!\n";
    } else {
        echo "Database already exists.\n";
    }
    
    // Verify tables were created
    $tables = $conn->query("SELECT name FROM sqlite_master WHERE type='table'");
    echo "\nCreated tables:\n";
    while ($table = $tables->fetch(PDO::FETCH_ASSOC)) {
        echo "- " . $table['name'] . "\n";
    }
    
    echo "\nDatabase setup completed successfully!\n";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
