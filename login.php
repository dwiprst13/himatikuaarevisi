<?php
require "config.php";
session_start();
if (isset($_SESSION['id_user'])) {
    header("Location: index.php");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $auth = trim($_POST['auth']);
    $password = $_POST['password'];
    if (empty($auth) || empty($password)) {
        echo "Both fields are required.";
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ? OR email = ? OR phone = ?");
    $stmt->bind_param("sss", $auth, $auth, $auth);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            if ($user['role'] == 'admin'){
                header("Location: admin/dashboard.php");
            } else {
                header("Location: index.php");
            }
            exit;
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with the provided identifier.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>

<form action="" method="post">
    <label for="username">Masukkan username, email atau nomor telepon:</label>
    <input type="text" id="auth" name="auth" required><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>

    <input type="submit" value="Login">
</form>