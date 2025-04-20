<?php
include 'db.php';

$sql = file_get_contents("kabupaten_api.sql");

if ($conn->multi_query($sql)) {
    echo "Import SQL sukses!";
} else {
    echo "Gagal import: " . $conn->error;
}
?>
