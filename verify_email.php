<?php
// Veritabanı bağlantı bilgileri
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kullanici_veritabani";

try {
    // Veritabanı bağlantısı oluştur
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Doğrulama kodunu al
    if (isset($_GET['code'])) {
        $verificationCode = htmlspecialchars(trim($_GET['code']));

        // Doğrulama kodunu veritabanında kontrol et
        $stmt = $conn->prepare("SELECT COUNT(*) FROM kullanicilar WHERE verification_code = :verification_code AND is_verified = 0");
        $stmt->bindParam(':verification_code', $verificationCode);
        $stmt->execute();

        if ($stmt->fetchColumn() > 0) {
            // Hesabı aktif et
            $stmt = $conn->prepare("UPDATE kullanicilar SET is_verified = 1 WHERE verification_code = :verification_code");
            $stmt->bindParam(':verification_code', $verificationCode);
            $stmt->execute();

            echo "Hesabınız başarıyla doğrulandı!";
        } else {
            echo "Geçersiz doğrulama kodu veya hesap zaten doğrulandı.";
        }
    } else {
        echo "Geçersiz istek.";
    }

} catch(PDOException $e) {
    echo "Hata: " . $e->getMessage();
}

// Bağlantıyı kapat
$conn = null;
?>
