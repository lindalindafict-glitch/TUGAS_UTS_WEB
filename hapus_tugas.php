
<?php
session_start();
require_once "koneksi.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: daftar_tugas.php");
    exit;
}

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    header("Location: daftar_tugas.php");
    exit;
}

$stmt = mysqli_prepare($conn, "DELETE FROM tugas WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header("Location: daftar_tugas.php");
exit;
?>
