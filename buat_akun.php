
<?php
require_once "koneksi.php";

$username = "linda";
$password = password_hash("linda123", PASSWORD_DEFAULT);

$stmt = mysqli_prepare(
    $conn,
    "UPDATE users SET password = ? WHERE username = ?"
);

mysqli_stmt_bind_param($stmt, "ss", $password, $username);
mysqli_stmt_execute($stmt);

if (mysqli_stmt_affected_rows($stmt) >= 0) {
    echo "Password akun berhasil diperbarui.";
} else {
    echo "Gagal memperbarui password.";
}

mysqli_stmt_close($stmt);
?>
