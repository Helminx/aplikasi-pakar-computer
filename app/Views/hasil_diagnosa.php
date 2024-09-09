<h2>Hasil Diagnosa</h2>
<?php if (!empty($solusi)): ?>
    <h3>Solusi:</h3>
    <ul>
        <?php foreach ($solusi as $s): ?>
            <li><?= $s['solusi'] ?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Tidak ada solusi yang ditemukan untuk gejala tersebut.</p>
<?php endif; ?>
