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

    // Formdan gelen verileri al
    $firstName = htmlspecialchars(trim($_POST['firstName']));
    $lastName = htmlspecialchars(trim($_POST['lastName']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    // E-posta formatını kontrol et
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Geçersiz e-posta formatı.";
        exit();
    }

    // Şifre uzunluğunu kontrol et
    if (strlen($password) < 6) {
        echo "Şifre en az 6 karakter olmalıdır.";
        exit();
    }

    // Veritabanında aynı e-posta adresinin olup olmadığını kontrol et
    $stmt = $conn->prepare("SELECT COUNT(*) FROM kullanicilar WHERE eposta = :eposta");
    $stmt->bindParam(':eposta', $email);
    $stmt->execute();
    if ($stmt->fetchColumn() > 0) {
        echo "Bu e-posta adresi zaten kullanılıyor. Lütfen başka bir e-posta adresi girin.";
        exit();
    }

    // Şifreyi hashle
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Doğrulama kodu oluştur
    $verificationCode = bin2hex(random_bytes(16)); // 16 byte uzunluğunda doğrulama kodu

    // Veritabanına kaydet (aktif olmayan kullanıcı olarak)
    $stmt = $conn->prepare("INSERT INTO kullanicilar (ad, soyad, eposta, sifre, verification_code, is_verified) 
                            VALUES (:ad, :soyad, :eposta, :sifre, :verification_code, 0)");
    $stmt->bindParam(':ad', $firstName);
    $stmt->bindParam(':soyad', $lastName);
    $stmt->bindParam(':eposta', $email);
    $stmt->bindParam(':sifre', $hashedPassword);
    $stmt->bindParam(':verification_code', $verificationCode);
    $stmt->execute();

    // Kullanıcıyı bilgilendir
    echo "Kayıt başarıyla tamamlandı! E-posta adresinizi doğrulamak için lütfen e-posta kutunuzu kontrol edin.";

    // Doğrulama linki gönderme (e-posta gönderimi)
    $verificationLink = "http://localhost/verify_email.php?code=" . $verificationCode;
    $subject = "E-posta Doğrulama";
    $message = "Hesabınızı doğrulamak için şu linke tıklayın: " . $verificationLink;
    $headers = "From: paledergi2025@gmail.com\r\n";
    $headers .= "Content-type: text/html\r\n";

    // E-posta gönderimi
    if (mail($email, $subject, $message, $headers)) {
        echo " E-posta gönderildi.";
    } else {
        echo "E-posta gönderilemedi.";
    }

    // Kayıt başarılı, kullanıcıyı teşekkür sayfasına yönlendirme
    // header('Location: tesekkur.html');
    // exit();

} catch(PDOException $e) {
    echo "Hata: " . $e->getMessage();
}

// Bağlantıyı kapat
$conn = null;
?>
