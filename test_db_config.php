<?php
define('BASEPATH', '.');

error_reporting(E_ALL);
ini_set('display_errors', 1);

include('application/config/database.php');

echo "Testing database.php configuration...\n\n";

if (isset($db) && is_array($db)) {
    echo "✓ Database array exists\n";
    echo "✓ Default group exists: " . (isset($db['default']) ? 'YES' : 'NO') . "\n";
    
    if (isset($db['default'])) {
        echo "\nConfiguration values:\n";
        foreach ($db['default'] as $key => $value) {
            if (is_array($value)) {
                echo "  $key: (array)\n";
            } else {
                echo "  $key: $value\n";
            }
        }
    }
} else {
    echo "✗ Database array NOT found or invalid\n";
}

echo "\nFile analysis complete!\n";
?>
