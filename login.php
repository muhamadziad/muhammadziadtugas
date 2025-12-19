<?php
require_once "config.php";
if (isset($_SESSION['user_id'])) {
    header("Location: data_siswa_form.php");
    exit;
}
$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $stmt = $conn->prepare("SELECT id,password FROM users WHERE username=?");
    $stmt->bind_param("s",$username);
    $stmt->execute();
    $stmt->bind_result($uid,$hash);
    if ($stmt->fetch() && hash("sha256",$password)===$hash) {
        $_SESSION['user_id']=$uid;
        $_SESSION['username']=$username;
        header("Location: data_siswa_form.php");
    } else {
        $error="Username atau password salah";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/style.css">
</head>
<body class="login-wrapper">
<div class="login-card">
<h1 class="login-title">LOGIN</h1>
<form method="post">
<label class="login-label">Username</label>
<input class="login-input" name="username">
<label class="login-label">Password</label>
<input class="login-input" type="password" name="password">
<?php if($error){echo "<div class='login-error'>$error</div>";} ?>
<button class="btn-main login-btn">Login</button>
</form>
</div>
</body>
</html>
