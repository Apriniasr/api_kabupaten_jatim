<?php
include 'db.php';
header('Content-Type: application/json');

$headers = getallheaders();
if (!isset($headers['x-api-key'])) {
    http_response_code(401);
    echo json_encode(['error' => 'API Key diperlukan']);
    exit;
}

$key = $headers['x-api-key'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE api_key = ?");
$stmt->execute([$key]);

if ($stmt->rowCount() === 0) {
    http_response_code(401);
    echo json_encode(['error' => 'API Key tidak valid']);
    exit;
}

$kabupaten = $pdo->query("SELECT name FROM kabupaten ORDER BY name ASC")->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($kabupaten);
?>
