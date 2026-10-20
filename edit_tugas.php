```php
<?php
session_start();
require_once "koneksi.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
    $nama_tugas = trim($_POST["nama_tugas"] ?? "");
    $mata_kuliah = trim($_POST["mata_kuliah"] ?? "");
    $tanggal = $_POST["tanggal"] ?? "";

    if ($id && $id > 0 && $nama_tugas !== "" &&
        $mata_kuliah !== "" && $tanggal !== "") {

        $stmt = mysqli_prepare(
            $conn,
            "UPDATE tugas SET nama_tugas = ?, mata_kuliah = ?, tanggal = ? WHERE id = ?"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "sssi",
            $nama_tugas,
            $mata_kuliah,
            $tanggal,
            $id
        );

        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("Location: daftar_tugas.php");
        exit;
    }

    $pesan = "Semua kolom harus diisi dengan benar.";
} else {
    $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
    $pesan = "";
}

if (!$id || $id < 1) {
    header("Location: daftar_tugas.php");
    exit;
}

$stmt = mysqli_prepare($conn, "SELECT * FROM tugas WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$hasil = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($hasil);
mysqli_stmt_close($stmt);

if (!$data) {
    header("Location: daftar_tugas.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tugas</title>

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
            padding: 25px 15px;
        }

        .container {
            max-width: 650px;
            margin: 35px auto;
            padding: 30px;
            background: white;
            border-radius: 18px;
            box-shadow: 0 8px 28px rgba(217, 108, 157, 0.15);
        }

        h1 {
            color: #D96C9D;
            margin-bottom: 12px;
        }

        .deskripsi {
            color: #927586;
            margin-bottom: 25px;
            line-height: 1.5;
        }

        label {
            display: block;
            font-weight: bold;
            margin: 18px 0 8px;
            color: #AD4778;
        }

        input {
            width: 100%;
            padding: 13px;
            border: 1px solid #F0C4D9;
            border-radius: 9px;
            font-size: 15px;
            color: #654052;
        }

        input:focus {
            outline: 2px solid #E9A1C3;
            border-color: #D96C9D;
        }

        .button {
            display: inline-block;
            width: 100%;
            margin-top: 22px;
            padding: 13px;
            background: #D96C9D;
            color: white;
            border: none;
            border-radius: 9px;
            text-align: center;
            text-decoration: none;
            font-size: 15px;
            cursor: pointer;
            transition: 0.3s;
        }

        .button:hover {
            background: #AD4778;
        }

        .kembali {
            display: inline-block;
            margin-top: 20px;
            color: #D96C9D;
            text-decoration: none;
        }

        .kembali:hover {
            color: #AD4778;
        }

        .pesan {
            color: #C0394F;
            margin-bottom: 15px;
        }

        @media (max-width: 600px) {
            .container {
                padding: 25px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Tugas</h1>
        <p class="deskripsi">
            Ubah informasi tugas kamu melalui formulir berikut.
        </p>

        <?php if (!empty($pesan)): ?>
            <p class="pesan"><?= htmlspecialchars($pesan) ?></p>
        <?php endif; ?>

        <form action="edit_tugas.php" method="POST">
            <input type="hidden" name="id" value="<?= (int)$data["id"] ?>">

            <label for="nama_tugas">Nama Tugas</label>
            <input
                type="text"
                id="nama_tugas"
                name="nama_tugas"
                value="<?= htmlspecialchars($data["nama_tugas"]) ?>"
                required
            >

            <label for="mata_kuliah">Mata Kuliah</label>
            <input
                type="text"
                id="mata_kuliah"
                name="mata_kuliah"
                value="<?= htmlspecialchars($data["mata_kuliah"]) ?>"
                required
            >

            <label for="tanggal">Tanggal Pengumpulan</label>
            <input
                type="date"
                id="tanggal"
                name="tanggal"
                value="<?= htmlspecialchars($data["tanggal"]) ?>"
                required
            >

            <button type="submit" class="button">
                Simpan Perubahan
            </button>
        </form>

        <a href="daftar_tugas.php" class="kembali">
            ← Kembali ke Daftar Tugas
        </a>
    </div>
</body>
</html>
```