<?php
include 'db.php';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$submitted = ($_SERVER['REQUEST_METHOD'] === 'POST');
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login API</title>
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-3xl">

    <?php if (!$submitted): ?>
      <!-- Form Login -->
      <h2 class="text-2xl font-semibold text-center mb-6">Login Akun - Ambil API Key</h2>
      <form action="" method="post" class="space-y-4">
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input type="email" name="email" id="email" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input type="password" name="password" id="password" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        <button type="submit"
          class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-200">
          Login
        </button>
      </form>
      <p class="mt-4 text-center text-sm text-gray-600">
        Belum punya akun?
        <a href="index.php" class="text-blue-600 hover:underline">Daftar Sekarang</a>
      </p>
      
    <?php else: ?>
      <!-- Proses Login -->
      <?php
      $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
      $stmt->execute([$email]);
      $user = $stmt->fetch();
      ?>

      <?php if ($user && password_verify($password, $user['password'])): ?>
        <h2 class="text-2xl font-semibold text-green-600 mb-4">Login berhasil!</h2>
        <p class="mb-4">API Key Anda: <strong class="text-blue-600"><?php echo $user['api_key']; ?></strong></p>

        <h3 class="text-lg font-semibold mt-6 mb-2">Daftar Kabupaten Jawa Timur:</h3>
        <div class="overflow-x-auto">
          <table class="min-w-full border border-gray-300 rounded-lg shadow-sm">
            <thead class="bg-gray-200">
              <tr>
                <th class="px-4 py-2 text-left border-b">ID</th>
                <th class="px-4 py-2 text-left border-b">Nama Kabupaten</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $stmt = $pdo->query("SELECT * FROM kabupaten");
              $kabupaten = $stmt->fetchAll(PDO::FETCH_ASSOC);
              foreach ($kabupaten as $row):
              ?>
                <tr class="hover:bg-gray-100">
                  <td class="px-4 py-2 border-b"><?php echo $row['id']; ?></td>
                  <td class="px-4 py-2 border-b"><?php echo $row['name']; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        </div>
        
      <?php else: ?>
        <h2 class="text-2xl font-semibold text-red-600 mb-4">Login gagal</h2>
        <p class="text-gray-700 mb-4">Email atau password salah.</p>
        <a href="login.php" class="text-blue-600 hover:underline">Coba lagi</a>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</body>
</html>
