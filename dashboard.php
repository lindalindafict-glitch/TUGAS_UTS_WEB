
<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$username = htmlspecialchars($_SESSION["username"]);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Kelompok Kami</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #FFF7FB;
            color: #49313D;
            min-height: 100vh;
        }

        header {
            background: linear-gradient(135deg, #D96C9D, #E9A1C3);
            color: white;
            padding: 25px 7%;
            box-shadow: 0 4px 15px rgba(173, 71, 120, 0.15);
        }

        header h1 {
            font-size: 27px;
            margin-bottom: 8px;
        }

        header p {
            color: #FFF0F7;
            font-size: 14px;
        }

        .container {
            max-width: 1050px;
            margin: 40px auto;
            padding: 0 25px;
        }

        .welcome {
            background: white;
            padding: 35px;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(173, 71, 120, 0.07);
            margin-bottom: 30px;
            border: 1px solid #F8DCE9;
        }

        .label {
            display: inline-block;
            background: #FCE7F3;
            color: #AD4778;
            padding: 7px 13px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 18px;
        }

        .welcome h2 {
            color: #AD4778;
            font-size: 25px;
            margin-bottom: 12px;
        }

        .welcome p {
            color: #80717A;
            line-height: 1.8;
        }

        .username {
            color: #D96C9D;
            font-weight: bold;
        }

        .section-title {
            margin-bottom: 18px;
            font-size: 20px;
            color: #49313D;
        }

        .menu {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
        }

        .card {
            background: white;
            padding: 28px;
            border-radius: 16px;
            border: 1px solid #F8DCE9;
            box-shadow: 0 8px 25px rgba(173, 71, 120, 0.06);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(173, 71, 120, 0.13);
        }

        .icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #FCE7F3;
            color: #AD4778;
            border-radius: 12px;
            font-size: 25px;
            margin-bottom: 20px;
        }

        .card h3 {
            color: #AD4778;
            font-size: 19px;
            margin-bottom: 12px;
        }

        .card p {
            color: #80717A;
            line-height: 1.7;
            font-size: 14px;
            margin-bottom: 23px;
        }

        .button {
            display: inline-block;
            background: #D96C9D;
            color: white;
            padding: 12px 18px;
            border-radius: 9px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            transition: background 0.2s;
        }

        .button:hover {
            background: #AD4778;
        }

        .logout {
            display: inline-block;
            margin-top: 28px;
            color: #AD4778;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
        }

        .logout:hover {
            color: #87335D;
            text-decoration: underline;
        }

        footer {
            text-align: center;
            padding: 25px 15px;
            color: #A18B96;
            font-size: 13px;
            border-top: 1px solid #F8DCE9;
            margin-top: 35px;
        }

        @media (max-width: 600px) {
            header {
                padding: 23px 20px;
            }

            header h1 {
                font-size: 23px;
            }

            .container {
                margin: 25px auto;
                padding: 0 16px;
            }

            .welcome {
                padding: 24px;
            }

            .welcome h2 {
                font-size: 21px;
            }

            .menu {
                grid-template-columns: 1fr;
            }

            .card {
                padding: 24px;
            }
        }
    </style>
</head>
<body>

    <header>
        <h1>Dashboard Kelompok Kami</h1>
        <p>UTS Web Programming I</p>
    </header>

    <main class="container">
        <section class="welcome">
            <span class="label">DASHBOARD</span>
            <h2>Selamat datang di Website Kelompok Kami!</h2>
            <p>Login sebagai:
                <span class="username"><?= $username ?></span>
            </p>
            <p>Kelola data tugas kuliah dengan lebih mudah melalui website kami.</p>
        </section>

        <h2 class="section-title">Menu Utama</h2>

        <section class="menu">
            <div class="card">
                <div class="icon">＋</div>
                <h3>Form Input</h3>
                <p>Tambahkan data tugas kuliah beserta mata kuliah dan tanggal pengumpulannya.</p>
                <a href="form.php" class="button">Tambah Data &rarr;</a>
            </div>

            <div class="card">
                <div class="icon">☷</div>
                <h3>Daftar Tugas</h3>
                <p>Lihat dan kelola data tugas yang sudah kamu simpan di website.</p>
                <a href="daftar_tugas.php" class="button">Lihat Daftar Tugas &rarr;</a>
            </div>
        </section>

        <a href="logout.php" class="logout">↪ Logout</a>
    </main>

    <footer>
        &copy; 2026 Kelompok Kami - UTS Web Programming I
    </footer>

</body>
</html>
