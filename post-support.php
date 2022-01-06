<?php

$mysqli = new mysqli("localhost", "drnihatkaya_iletisim", "!nk!klinik!", "drnihatkaya_iletisim");/* Bağlantıyı Kontrol Et */
if ($mysqli->connect_error) {
    /* Bağlantı Başarısız İse */
    echo "Bağlantı Başarısız. Hata: " . $mysqli->connect_error;
    exit;
}

$name = mysqli_real_escape_string($mysqli, $_REQUEST['name']);
$tel = mysqli_real_escape_string($mysqli, $_REQUEST['tel']);

if (!empty($name) && !empty($tel)) {
    $sql = "INSERT INTO contact_sm (name,tel) VALUES ('$name','$tel')";


    mysqli_set_charset($mysqli, "utf8");

    if (mysqli_query($mysqli, $sql)) {
        ##mesaj gönderme kısmı
        $message = urlencode('Dr. Nihat Kaya Destek Formu

İsim:' . $name . '
Telefon:' . $tel . '
        
');

        $message2 = str_replace("'", '`', $message);
        $message3 = str_replace(" ", '%20', $message2);
        $postUrl = "http://panel.1sms.com.tr:8080/api/smsget/v1?username=bw&password=9bcd9b9d53b99ea8d54e7b2d5e006626&header=BadiWorks&gsm=905374689929&message=" . $message3;

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
