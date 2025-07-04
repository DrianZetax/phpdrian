<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../vendor/autoload.php';
use YuF1Dev\OrderKuota;

$username = 'banijebe';
$authToken = '991701:s0ATQOtgYuJIDaKZ2zLvMRw4qml13bNC';

$orderkuota = new OrderKuota($username, $authToken);
$response = $orderkuota->getTransactionQris();
$decoded = json_decode($response, true);
$results = $decoded['data']['qris_history']['results'] ?? [];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>QRIS History</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background-color: #f9f9f9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0;
            background: #fff;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px 10px;
            text-align: left;
            font-size: 14px;
        }
        th {
            background: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background: #f2f2f2;
        }
        .debug {
            background: #eee;
            border: 1px solid #ccc;
            padding: 15px;
            margin-top: 20px;
            font-family: monospace;
            white-space: pre;
            overflow-x: auto;
            max-height: 300px;
        }
    </style>
</head>
<body>

<?php if (!empty($results)): ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Debet</th>
                <th>Kredit</th>
                <th>Saldo</th>
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

<div class="debug">
<?= json_encode($decoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); ?>
</div>

</body>
</html>
