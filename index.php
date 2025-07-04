<?php
require '../vendor/autoload.php';

use YuF1Dev\OrderKuota;

$username = 'banijebe';
$authToken = '991701:s0ATQOtgYuJIDaKZ2zLvMRw4qml13bNC';
$orderkuota = new OrderKuota($username, $authToken);

// Ambil histori QRIS
$response = $orderkuota->getTransactionQris();
$data = json_decode($response, true);

// Ambil hasil transaksi QRIS
$results = $data['data']['qris_history']['results'] ?? [];

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Histori QRIS - OrderKuota</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
        table { border-collapse: collapse; width: 100%; background: white; }
        th, td { border: 1px solid #ccc; padding: 8px 12px; text-align: left; }
        th { background: #007bff; color: white; }
        tr:nth-child(even) { background: #f9f9f9; }
    </style>
    <meta http-equiv="refresh" content="15"> <!-- Refresh setiap 15 detik -->
</head>
<body>

<h2>📋 Histori Transaksi QRIS</h2>
<p>Diperbarui otomatis setiap 15 detik.</p>

<?php if (empty($results)): ?>
    <p>Tidak ada transaksi ditemukan.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Debet</th>
                <th>Kredit</th>
                <th>Saldo Akhir</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $trx): ?>
                <tr>
                    <td><?= htmlspecialchars($trx['id'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($trx['tanggal'] ?? '-') ?></td>
                    <td><?= number_format($trx['debet'] ?? 0, 0, ',', '.') ?></td>
                    <td><?= number_format($trx['kredit'] ?? 0, 0, ',', '.') ?></td>
                    <td><?= number_format($trx['saldo_akhir'] ?? 0, 0, ',', '.') ?></td>
                    <td><?= htmlspecialchars($trx['keterangan'] ?? '-') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

</body>
</html>
