<?php

$mysqli = new mysqli("localhost", "drnihatkaya_iletisim", "!nk!klinik!", "drnihatkaya_iletisim");/* Bağlantıyı Kontrol Et */
if ($mysqli->connect_error) {
    /* Bağlantı Başarısız İse */
    echo "Bağlantı Başarısız. Hata: " . $mysqli->connect_error;
    exit;
}


$messeage = mysqli_real_escape_string($mysqli, $_REQUEST['message']);
$name = mysqli_real_escape_string($mysqli, $_REQUEST['name']);
$email = mysqli_real_escape_string($mysqli, $_REQUEST['email']);
$tel = mysqli_real_escape_string($mysqli, $_REQUEST['tel']);



if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Geçersiz Email adresi girdiniz!";
    return;
}


if (!empty($messeage) && !empty($name) && !empty($email) && !empty($tel)) {
    $sql = "INSERT INTO contact (name,email,tel,message) VALUES ('$name','$email','$tel','$messeage')";


    mysqli_set_charset($mysqli, "utf8");

    if (mysqli_query($mysqli, $sql)) {
        ##mesaj gönderme kısmı
        $message = urlencode($messeage . ' drnihatkaya.com');
        $message2 = str_replace("'", ' ', $message);
        $message3 = str_replace(" ", '%20', $message2);
        $postUrl = "http://panel.1sms.com.tr:8080/api/smsget/v1?username=bw&password=9bcd9b9d53b99ea8d54e7b2d5e006626&header=BadiWorks&gsm=905334597473&message=" . $message3;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $postUrl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);
        curl_close($ch);

        echo "Mesajınız İletildi";
    } else {
        echo "Hata: Mesajınız İletilemedi";
    }
} else {
    echo "Tüm alanlar doldurulmalı!";
}



$mysqli->close();
