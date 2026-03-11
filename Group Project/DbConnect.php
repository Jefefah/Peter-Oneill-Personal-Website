<?php
Function dbOpen() {
$db = new SQLite3('DBWassignment.db');
if ($db) {
    //echo "Opened database successfully\n";
    return $db;
} else {
    echo "Error: Unable to open database\n";
}
}

function dbClose($db) {
    $db->close();
}
?>
