
<?php
session_start();
require_once "koneksi.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: form.php");
    exit;
}

$nama_tugas = trim($_POST["nama_tugas"] ?? "");
$mata_kuliah = trim($_POST["mata_kuliah"] ?? "");
$tanggal = $_POST["tanggal"] ?? "";

if ($nama_tugas === "" || $mata_kuliah === "" || $tanggal === "") {
    header("Location: form.php");
    exit;
}

$stmt = mysqli_prepare(
    $conn,
    "INSERT INTO tugas (nama_tugas, mata_kuliah, tanggal)
     VALUES (?, ?, ?)"
);

mysqli_stmt_bind_param(
    $stmt,
    "sss",
    $nama_tugas,
    $mata_kuliah,
    $tanggal
);

$berhasil = mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Input - UTS Web</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #FFF7FB;
            color: #654052;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .result-card {
            background: white;
            width: 100%;
            max-width: 480px;
            padding: 35px;
            border-radius: 18px;
            text-align: center;
            box-shadow: 0 8px 28px rgba(217, 108, 157, 0.15);
        }

        .icon {
            width: 65px;
            height: 65px;
            margin: 0 auto 20px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 32px;
            background: #FCE7F3;
            color: #D96C9D;
        }

        h1 {
            color: #D96C9D;
            font-size: 25px;
            margin-bottom: 12px;
        }

        .description {
            color: #927586;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        .data {
            background: #FFF7FB;
            padding: 18px;
            border: 1px solid #F8E1EC;
            border-radius: 12px;
            text-align: left;
            margin-bottom: 25px;
        }

        .data p {
            margin-bottom: 12px;
            overflow-wrap: anywhere;
        }

        .data p:last-child {
            margin-bottom: 0;
        }

        .data strong {
            color: #AD4778;
        }

        .button {
            display: block;
            width: 100%;
            padding: 13px;
            border-radius: 9px;
            background: #D96C9D;
            color: white;
            text-decoration: none;
            font-weight: bold;
            margin-top: 12px;
            transition: 0.3s;
        }

        .button:hover {
            background: #AD4778;
        }

        .secondary {
            background: white;
            color: #D96C9D;
            border: 1px solid #F0C4D9;
        }

        .secondary:hover {
            background: #FCE7F3;
            color: #AD4778;
        }
    </style>
</head>
<body>

    <div class="result-card">
        <?php if ($berhasil): ?>

            <div class="icon">&#10003;</div>

            <h1>Data Berhasil Ditambahkan!</h1>
            <p class="description">
                Data tugas kamu sudah berhasil disimpan ke database.
            </p>

            <div class="data">
                <p><strong>Nama Tugas:</strong><br>
                    <?= htmlspecialchars($nama_tugas) ?>
                </p>

                <p><strong>Mata Kuliah:</strong><br>
                    <?= htmlspecialchars($mata_kuliah) ?>
                </p>

                <p><strong>Tanggal Pengumpulan:</strong><br>
                    <?= htmlspecialchars($tanggal) ?>
                </p>
            </div>

            <a href="form.php" class="button">Tambah Tugas Lagi</a>
            <a href="dashboard.php" class="button secondary">
                Kembali ke Dashboard
            </a>

        <?php else: ?>

            <div class="icon">!</div>

            <h1>Data Gagal Disimpan</h1>
            <p class="description">
                Terjadi kesalahan saat menyimpan data. Silakan coba lagi.
            </p>

            <a href="form.php" class="button">Kembali ke Form</a>

        <?php endif; ?>
    </div>

</body>
</html>