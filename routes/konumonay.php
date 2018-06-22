<?php
ob_start();

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$db = new db();
//connect
$db = $db->connect();



if (isset($_POST['konumonay'])) {
$ogrenci_id = $_POST['ogrenci_id'];
$konum = $_POST['konum'];




$kullanicisor=$db->prepare("SELECT * FROM konum WHERE ogrenci_id=:ogrenci_id and konum=:konum");
$kullanicisor->execute(array(
'ogrenci_id' => $ogrenci_id,
'konum' => $konum





));
$say =$kullanicisor->rowCount();
#çalışıyor . burdan html e veri çekebilmem gerek ki orda hata döndürebileyim
if ($say == 0){
   
   echo "bu konum eklenmemiş . eklenebilir" ;
    exit;

}
else{
    
   echo "aynı konumdan var bu iş olmaz";
   
    exit;


}

}