<?php
define('BASEPATH', '.');
define('ENVIRONMENT', 'development');

// Load database config
include('application/config/database.php');

echo "Database Configuration Test\n";
echo "============================\n\n";

echo "Active Group: " . $active_group . "\n";
echo "Query Builder: " . ($query_builder ? 'Enabled' : 'Disabled') . "\n\n";

if (isset($db[$active_group])) {
    $config = $db[$active_group];
    
    echo "Attempting to connect to: " . $config['database'] . "@" . $config['hostname'] . "\n";
    echo "Using driver: " . $config['dbdriver'] . "\n\n";
    
    // Try to connect
    $conn = mysqli_connect(
        $config['hostname'],
        $config['username'],
        $config['password'],
        $config['database']
    );
    
    if ($conn) {
        echo "✓ Connection SUCCESSFUL!\n";
        echo "Character set: " . mysqli_get_charset($conn)->charset . "\n";
        mysqli_close($conn);
    } else {
        echo "✗ Connection FAILED!\n";
        echo "Error: " . mysqli_connect_error() . "\n";
    }
} else {
    echo "✗ Active group '$active_group' not found in database config!\n";
}
?>
