<?php
include 'db.php';

$name = $email = $password = '';
$submitted = false;
$api_key = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Form HTML
    $submitted = true;
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {
    // JSON API
    $data = json_decode(file_get_contents("php://input"), true);
    $name = $data['name'] ?? '';
    $email = $data['email'] ?? '';
    $password = $data['password'] ?? '';
    $submitted = true;
}

// Jika data dikirim, proses simpan
if ($submitted && $name && $email && $password) {
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $api_key = bin2hex(random_bytes(32));

    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, api_key) VALUES (?, ?, ?, ?)");
    try {
        $stmt->execute([$name, $email, $hashed, $api_key]);

        // Balasan untuk JSON (API)
        if (strpos($_SERVER['CONTENT_TYPE'] ?? '', 'application/json') !== false) {
            header('Content-Type: application/json');
            echo json_encode(['api_key' => $api_key]);
            exit;
        }
    } catch (PDOException $e) {
        $error = 'Email sudah terdaftar.';
        if (strpos($_SERVER['CONTENT_TYPE'] ?? '', 'application/json') !== false) {
            http_response_code(500);
            header('Content-Type: application/json');
            echo json_encode(['error' => $error]);
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Register API Key</title>
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-3xl">
    <?php if (!$submitted || $error): ?>
      <h2 class="text-2xl font-semibold text-center mb-6">Daftar Akun - Dapatkan API Key</h2>
      <?php if ($error): ?>
        <p class="text-red-600 mb-4 text-center"><?= $error ?></p>
      <?php endif; ?>
      <form action="" method="post" class="space-y-4">
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
          <input type="text" name="name" id="name" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400"
            value="<?= htmlspecialchars($name) ?>">
        </div>
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input type="email" name="email" id="email" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400"
            value="<?= htmlspecialchars($email) ?>">
        </div>
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input type="password" name="password" id="password" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400">
        </div>
        <button type="submit"
          class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-200">
          Daftar
        </button>
      </form>
      <p class="mt-4 text-center text-sm text-gray-600">
        Sudah punya akun?
        <a href="login.php" class="text-blue-600 hover:underline">Login</a>
      </p>
    <?php else: ?>
      <h2 class="text-2xl font-semibold text-green-600 mb-4">Registrasi Berhasil!</h2>
      <p class="text-gray-700 mb-2">Selamat datang, <strong><?= htmlspecialchars($name) ?></strong>.</p>
      <p class="text-gray-700">API Key Anda:</p>
      <div class="bg-gray-100 text-blue-700 font-mono p-3 mt-2 rounded-md break-all"><?= $api_key ?></div>
      <p class="mt-4">
        <a href="login.php" class="text-blue-600 hover:underline">Login Sekarang</a>
      </p>
    <?php endif; ?>
  </div>
</body>
</html>
