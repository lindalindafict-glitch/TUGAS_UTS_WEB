
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input - UTS Web</title>

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
            padding: 30px 20px;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            padding: 35px;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(217, 108, 157, 0.15);
        }

        h1 {
            text-align: center;
            color: #D96C9D;
            margin-bottom: 30px;
            font-size: 27px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #AD4778;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #F0C4D9;
            border-radius: 8px;
            font-size: 15px;
            margin-bottom: 22px;
            outline: none;
        }

        input:focus {
            border-color: #D96C9D;
            box-shadow: 0 0 5px rgba(217, 108, 157, 0.2);
        }

        button {
            width: 100%;
            padding: 13px;
            background: #D96C9D;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #AD4778;
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 22px;
            color: #D96C9D;
            text-decoration: none;
        }

        .back:hover {
            color: #AD4778;
        }

        @media (max-width: 600px) {
            .container {
                padding: 25px 20px;
                margin: 20px auto;
            }

            h1 {
                font-size: 23px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Form Input Data Tugas</h1>

        <form action="proses.php" method="POST">
            <label>Nama Tugas</label>
            <input type="text" name="nama_tugas" required>

            <label>Mata Kuliah</label>
            <input type="text" name="mata_kuliah" required>

            <label>Tanggal Pengumpulan</label>
            <input type="date" name="tanggal" required>

            <button type="submit">Simpan Data</button>
        </form>

        <a href="dashboard.php" class="back">← Kembali ke Dashboard</a>
    </div>

</body>
</html>
```