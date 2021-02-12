<?php 

$mysqli = new mysqli("localhost","drnihatkaya_iletisim","!nk!klinik!","drnihatkaya_iletisim");/* Bağlantıyı Kontrol Et */
 if ($mysqli->connect_error){
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


if(!empty($messeage) && !empty($name) && !empty($email) && !empty($tel)){
    $sql = "INSERT INTO contact (name,email,tel,message) VALUES ('$name','$email','$tel','$messeage')";


    mysqli_set_charset($mysqli,"utf8");
     
    if(mysqli_query($mysqli,$sql))
    {
        echo "Mesajınız İletildi";
    }
       else
       {
           echo "Hata: Mesajınız İletilemedi";
       }
       
} else 
{
    echo "Tüm alanlar doldurulmalı!";
}



    $mysqli->close();


?>