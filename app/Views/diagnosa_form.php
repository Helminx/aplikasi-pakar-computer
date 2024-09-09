<!DOCTYPE html>
<html>
<head>
    <title>Form Diagnosa</title>
</head>
<body>
    <form action="<?= site_url('diagnosa/proses_diagnosa') ?>" method="post">
        <?php foreach ($gejala as $g): ?>
            <label>
                <input type="checkbox" name="gejala[]" value="<?= $g->id_gejala ?>"> <?= $g->nama_gejala ?>
            </label><br>
        <?php endforeach; ?>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
