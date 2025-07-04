<?php
// Aktifkan semua error & warning
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ✅ Lebih baik gunakan autoload Composer, bukan require manual
require '../vendor/autoload.php';

use YuF1Dev\OrderKuota;

$username = 'banijebe';
$password = 'Hacess1930!@';
$otp = '98666'; // ← ganti dengan OTP jika diperlukan
$token = '991701:s0ATQOtgYuJIDaKZ2zLvMRw4qml13bNC'; // ← opsional jika ingin pakai token

// Buat instance API (bisa tanpa token dulu)
$orderkuota = new OrderKuota($username);

// ==============================
// STEP 1 - LOGIN (Minta OTP atau Langsung Dapat Token)
// ==============================
echo "\n== Step 1: Kirim loginRequest ==\n";
$login = $orderkuota->loginRequest($username, $password);

if (!$login) {
    echo "❌ Login gagal / tidak ada respons.\n";
} else {
    echo "✅ Respons login:\n";
    var_dump($login);
}

// ==============================
// STEP 2 - Kirim OTP (jika dibutuhkan)
// ==============================
echo "\n== Step 2: Kirim getAuthToken dengan OTP ==\n";
$otpResponse = $orderkuota->getAuthToken($username, $otp);

if (!$otpResponse) {
    echo "❌ OTP gagal / tidak ada respons.\n";
} else {
    echo "✅ Respons token:\n";
    var_dump($otpResponse);
}
