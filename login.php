<?php
session_start();
require_once 'config/Database.php';

// Cek jika tombol login ditekan
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sesuai syarat UAS: Akun Admin dan User
    if ($username == 'admin' && $password == 'admin123') {
        $_SESSION['login'] = true;
        $_SESSION['username'] = 'Admin Ganteng';
        $_SESSION['role'] = 'admin';
        header("Location: index.php");
        exit;
    } elseif ($username == 'user' && $password == 'user123') {
        $_SESSION['login'] = true;
        $_SESSION['username'] = 'User Pembeli';
        $_SESSION['role'] = 'user';
        header("Location: index.php");
        exit;
    } else {
        $error = true;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Stock Sembako</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4 card p-4 shadow">
                <h3 class="text-center">LOGIN SYSTEM</h3>
                <?php if(isset($error)) : ?>
                    <div class="alert alert-danger">Username / Password Salah!</div>
                <?php endif; ?>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="admin / user" required>
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="admin123 / user123" required>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary w-100">Masuk</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>