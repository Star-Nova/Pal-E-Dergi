<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Veritabanı bağlantısını burada kurun
    // Örneğin, PDO veya MySQLi kullanarak
    // Aşağıda örnek bir dosya içeriği:

    // Veritabanı bilgilerinizi burada ayarlayın
    $servername = "localhost";
    $usernameDB = "your_db_username";
    $passwordDB = "your_db_password";
    $dbname = "your_db_name";

    // Veritabanı bağlantısı oluştur
    $conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

    // Bağlantıyı kontrol et
    if ($conn->connect_error) {
        die("Bağlantı Hatası: " . $conn->connect_error);
    }

    // Kullanıcı bilgilerini veritabanına ekle
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, password_hash($password, PASSWORD_DEFAULT));

    if ($stmt->execute()) {
        echo "Kayıt başarılı.";
    } else {
        echo "Hata: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
