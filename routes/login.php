<?php
ob_start();
session_start();
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$db = new db();
//connect
$db = $db->connect();



if (isset($_POST['servisgiris'])) {
$servis_id = $_POST['servis_id'];
$telefon = $_POST['telefon'];
$sifre = $_POST['sifre'];



$kullanicisor=$db->prepare("SELECT * FROM servis WHERE servis_id=:servis_id and telefon=:telefon and sifre=:sifre");
$kullanicisor->execute(array(
'servis_id' => $servis_id,
'telefon' => $telefon,
'sifre' => $sifre


));
$say =$kullanicisor->rowCount();

if ($say == 1){

    $_SESSION['telefon'] = $telefon;
    $_SESSION['servis_id'] = $servis_id;
    header("Location:http://localhost:4400/servis.html");
    exit;

}
else{
    header("Location:http://localhost:4400/index.html");
    exit;


}

}

