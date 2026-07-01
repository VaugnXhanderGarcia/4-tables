<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "lablocator";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Helper: check if a table exists
function table_exists($conn, $table) {
    $tbl = $conn->real_escape_string($table);
    $res = $conn->query("SHOW TABLES LIKE '$tbl'");
    return ($res && $res->num_rows > 0);
}

// If core table missing, attempt to import database_vet.sql automatically
if (!table_exists($conn, 'veterinarian')) {
    $sqlFile = __DIR__ . '/../database_vet.sql';
    if (file_exists($sqlFile) && is_readable($sqlFile)) {
        $sql = file_get_contents($sqlFile);
        if ($sql !== false) {
            // Execute multiple statements
            if ($conn->multi_query($sql)) {
                // consume all results to finish the multi_query
                while ($conn->more_results() && $conn->next_result()) {
                    // no-op: just advance
                }
            } else {
                error_log('Failed to import DB schema: ' . $conn->error);
            }
        }
    } else {
        error_log('database_vet.sql not found or not readable at ' . $sqlFile);
    }
}

?>