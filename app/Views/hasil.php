<!DOCTYPE html>
<html>
<head>
    <title>Hasil Diagnosa</title>
</head>
<style>
    /* Main content styles */
    .main-content {
        width: 100%;
        max-width: 1200px;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        border-radius: 8px;
    }

    h1 {
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 12px;
        text-align: left;
        border: 1px solid #ddd;
    }

    th {
        background-color: #f1f1f1;
        color: #333;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    a {
        color: #007bff;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }
</style>
<body>
    <h1>Hasil Diagnosa</h1>

    <?php if (!empty($kerusakan)): ?>
        <ul>
            <?php foreach ($kerusakan as $k): ?>
                <li>
                    <strong><?php echo $k->nama_kerusakan; ?></strong><br>
                    Gejala: <?php echo $k->gejala; ?><br>
                    <a href="<?php echo site_url('solusi/'.$k->id_kerusakan); ?>">Lihat Solusi</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Tidak ada kerusakan yang sesuai dengan gejala yang dipilih.</p>
    <?php endif; ?>

    <a href="<?php echo site_url('pakar'); ?>">Kembali ke Pemilihan Gejala</a>
</body>
</html>
