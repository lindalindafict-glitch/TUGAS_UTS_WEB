
<?php
session_start();
require_once "koneksi.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$cari = trim($_GET["cari"] ?? "");

$stmt = mysqli_prepare(
    $conn,
    "SELECT * FROM tugas
     WHERE nama_tugas LIKE ? OR mata_kuliah LIKE ?
     ORDER BY id DESC"
);

$kata = "%" . $cari . "%";
mysqli_stmt_bind_param($stmt, "ss", $kata, $kata);
mysqli_stmt_execute($stmt);
$query = mysqli_stmt_get_result($stmt);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tugas</title>

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
            padding: 30px 20px;
        }

        .container {
            max-width: 1000px;
            margin: 30px auto;
            background: white;
            padding: 30px;
            border-radius: 20px;
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

        .tabel-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px;
            border-bottom: 1px solid #F8E1EC;
            text-align: left;
        }

        th {
            background: #D96C9D;
            color: white;
        }

        tr:hover td {
            background: #FFF7FB;
        }

        .button {
            display: inline-block;
            margin-top: 25px;
            margin-right: 8px;
            padding: 12px 18px;
            border-radius: 9px;
            background: #D96C9D;
            color: white;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
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

        .hapus {
            margin: 0;
            padding: 8px 12px;
            background: #DC4C65;
        }

        .hapus:hover {
            background: #B8324A;
        }

        .edit {
            margin: 0 0 8px;
            padding: 8px 12px;
        }

        .aksi {
            min-width: 100px;
        }

        .aksi form {
            margin: 0;
        }

        .kosong {
            text-align: center;
            color: #927586;
        }

        .pencarian {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 25px;
        }

        .pencarian input {
            flex: 1;
            min-width: 200px;
            padding: 12px;
            border: 1px solid #F0C4D9;
            border-radius: 9px;
            font-size: 14px;
            outline: none;
        }

        .pencarian input:focus {
            border-color: #D96C9D;
            box-shadow: 0 0 5px rgba(217, 108, 157, 0.2);
        }

        .pencarian .button {
            margin: 0;
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px 15px;
            }

            th, td {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Daftar Tugas</h1>

        <p class="deskripsi">
            Lihat dan kelola semua tugas yang sudah kamu tambahkan.
        </p>

        <form method="GET" action="daftar_tugas.php" class="pencarian">
            <input
                type="text"
                name="cari"
                placeholder="Cari nama tugas atau mata kuliah..."
                value="<?= htmlspecialchars($cari) ?>"
            >
            <button type="submit" class="button">Cari</button>
            <a href="daftar_tugas.php" class="button secondary">Reset</a>
        </form>

        <div class="tabel-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Tugas</th>
                        <th>Mata Kuliah</th>
                        <th>Tanggal Pengumpulan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (mysqli_num_rows($query) > 0): ?>
                        <?php $no = 1; ?>

                        <?php while ($data = mysqli_fetch_assoc($query)): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($data["nama_tugas"]) ?></td>
                                <td><?= htmlspecialchars($data["mata_kuliah"]) ?></td>
                                <td><?= htmlspecialchars($data["tanggal"]) ?></td>

                                <td class="aksi">
                                    <a
                                        href="edit_tugas.php?id=<?= (int)$data["id"] ?>"
                                        class="button edit"
                                    >Edit</a>

                                    <form
                                        action="hapus_tugas.php"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus tugas ini?');"
                                    >
                                        <input
                                            type="hidden"
                                            name="id"
                                            value="<?= (int)$data["id"] ?>"
                                        >

                                        <button type="submit" class="button hapus">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>

                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="kosong">
                                <?= $cari !== ""
                                    ? "Tugas yang kamu cari tidak ditemukan."
                                    : "Belum ada tugas." ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <a href="form.php" class="button">+ Tambah Tugas</a>

        <a href="dashboard.php" class="button secondary">
            Kembali ke Dashboard
        </a>
    </div>
</body>
</html>
```