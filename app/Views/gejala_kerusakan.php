<!DOCTYPE html>
<html>
<style>
        body 
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
<head>
    <title>Pilih Gejala Kerusakan</title>
</head>
<body>
    <h1>Pilih Gejala Kerusakan</h1>
    <form action="<?php echo site_url('pakar/diagnosa'); ?>" method="post">
        <?php foreach ($gejala as $g): ?>
            <label>
                <input type="checkbox" name="gejala[]" value="<?php echo $g->id; ?>">
                <?php echo $g->nama_gejala; ?>
            </label><br>
        <?php endforeach; ?>
        <button type="submit">Diagnosa</button>
    </form>
</body>
</html>
