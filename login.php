
<?php
session_start();
require_once "koneksi.php";

$pesan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    $stmt = mysqli_prepare(
        $conn,
        "SELECT id, username, password FROM users WHERE username = ?"
    );

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $hasil = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($hasil);

    if ($user && password_verify($password, $user["password"])) {
        session_regenerate_id(true);
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];

        header("Location: dashboard.php");
        exit;
    } else {
        $pesan = "Username atau password salah!";
    }

    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UTS Web</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #FFF7FB, #F8DCE9, #E9A1C3);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            width: 100%;
            max-width: 410px;
            padding: 38px;
            border-radius: 20px;
            border: 1px solid #F8DCE9;
            box-shadow: 0 12px 35px rgba(173, 71, 120, 0.15);
        }

        .logo {
            width: 58px;
            height: 58px;
            margin: 0 auto 20px;
            background: #FCE7F3;
            color: #AD4778;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        .login-container h1 {
            color: #AD4778;
            text-align: center;
            margin-bottom: 10px;
            font-size: 27px;
        }

        .subtitle {
            color: #80717A;
            text-align: center;
            margin-bottom: 30px;
            font-size: 14px;
            line-height: 1.6;
        }

        label {
            display: block;
            color: #624252;
            margin-bottom: 9px;
            font-weight: bold;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 13px;
            margin-bottom: 21px;
            border: 1px solid #EACAD9;
            border-radius: 9px;
            font-size: 14px;
            background: #FFFBFD;
            color: #49313D;
        }

        input:focus {
            outline: none;
            border-color: #D96C9D;
            box-shadow: 0 0 0 3px #FCE7F3;
        }

        input::placeholder {
            color: #B5A1AB;
        }

        button {
            width: 100%;
            padding: 14px;
            background: #D96C9D;
            color: white;
            border: none;
            border-radius: 9px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s, transform 0.2s;
        }

        button:hover {
            background: #AD4778;
            transform: translateY(-2px);
        }

        .pesan-error {
            color: #B42318;
            background: #FFF0EF;
            border: 1px solid #FFD5D1;
            padding: 12px;
            border-radius: 9px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .footer {
            text-align: center;
            margin-top: 25px;
            padding-top: 18px;
            border-top: 1px solid #F8DCE9;
            color: #A18B96;
            font-size: 12px;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 28px 22px;
            }

            .login-container h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="logo">♡</div>

        <h1>Selamat Datang!</h1>
        <p class="subtitle">Silakan login untuk melanjutkan</p>

        <?php if ($pesan != ""): ?>
            <p class="pesan-error">
                <?= htmlspecialchars($pesan) ?>
            </p>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <label for="username">Username</label>
            <input
                type="text"
                id="username"
                name="username"
                placeholder="Masukkan username"
                required
            >

            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Masukkan password"
                required
            >

            <button type="submit">Login</button>
        </form>

        <p class="footer">UTS Web Programming I</p>
    </div>

</body>
</html>
