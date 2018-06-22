<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

//Get All ogrenci
$app->get('/api/ogrenci', function(Request $request, Response $response){

    $sql = "SELECT * FROM ogrenci";

    try{
     // GET DB object
     $db = new db();
     //connect
     $db = $db->connect();

     $stmt = $db->prepare($sql);
     $stmt->execute();       
     $ogrenci = $stmt->fetchAll(PDO::FETCH_OBJ);
     $db = null;   
     echo json_encode($ogrenci);
} 
catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMassage().'}';
}

});


// Get sadece ogrenci
$app->get('/api/ogrenci/{ogrenci_id}', function(Request $request, Response $response){
        $ogrenci_id = $request->getAttribute('ogrenci_id');
        $sql = "SELECT * FROM ogrenci WHERE ogrenci_id = $ogrenci_id";
    
        try{
         // GET DB object
         $db = new db();
         //connect
         $db = $db->connect();
    
         $stmt = $db->prepare($sql);
         $stmt->execute();       
         $ogrenci = $stmt->fetchAll(PDO::FETCH_OBJ);
         $db = null;   
         echo json_encode($ogrenci);
    } 
    catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMassage().'}';
    }
    
    });


    // ogrenci ekle
$app->post('/api/ogrenci/add', function(Request $request, Response $response){
    $adi = $request->getParam('adi');
    $soyadi = $request->getParam('soyadi');
    $telefon = $request->getParam('telefon');
    $okul_firma = $request->getParam('okul_firma');
    $sifre = $request->getParam('sifre');
    $tc = $request->getParam('tc');   
    $servis_id = $request->getParam('servis_id');
    $plaka = $request->getParam('plaka');
    

    $sql = "INSERT INTO ogrenci(adi,soyadi,telefon,okul_firma,sifre,tc,servis_id,plaka) VALUES
    (:adi,:soyadi,:telefon,:okul_firma,:sifre,:tc,:servis_id,:plaka)";

    try{
     // GET DB object
     $db = new db();
     //connect
     $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':adi',      $adi);
        $stmt->bindParam(':soyadi',   $soyadi);
        $stmt->bindParam(':telefon',  $telefon);
        $stmt->bindParam(':okul_firma',    $okul_firma);
        $stmt->bindParam(':sifre',    $sifre);
        $stmt->bindParam(':tc',       $tc);        
        $stmt->bindParam(':servis_id',       $servis_id);
        $stmt->bindParam(':plaka',      $plaka);
     
        $stmt->execute();
        
        echo '{"notice": {"text": "ogrenci eklendi"}';
} 
catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMassage().'}';
}

});


// ogrenci Güncelle
$app->put('/api/ogrenci/update/{ogrenci_id}', function(Request $request, Response $response){
    $ogrenci_id = $request->getAttribute('ogrenci_id');
    $adi = $request->getParam('adi');
    $soyadi = $request->getParam('soyadi');
    $telefon = $request->getParam('telefon');
    $okul_firma = $request->getParam('okul_firma');
    $sifre = $request->getParam('sifre');
    $tc = $request->getParam('tc');
    $servis_id = $request->getParam('servis_id');
    $plaka = $request->getParam('plaka');
    

    $sql = "UPDATE ogrenci SET
                    adi      = :adi,
                    soyadi   = :soyadi,
                    telefon  = :telefon,
                    okul_firma    = :okul_firma,
                    sifre    = :sifre,
                    tc       = :tc,
                    servis_id= :servis_id,
                    plaka    = :plaka

            WHERE ogrenci_id = $ogrenci_id";
    try{
     // GET DB object
     $db = new db();
     //connect
     $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':adi',      $adi);
        $stmt->bindParam(':soyadi',   $soyadi);
        $stmt->bindParam(':telefon',  $telefon);
        $stmt->bindParam(':okul_firma',    $okul_firma);
        $stmt->bindParam(':sifre',    $sifre);
        $stmt->bindParam(':tc',       $tc);
        $stmt->bindParam(':servis_id',       $servis_id);
        $stmt->bindParam(':plaka',      $plaka);
     
        $stmt->execute();

        echo '{"notice": {"text": "ogrenci güncellendi"}';



} 
catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMassage().'}';
}

});

// ogrenci silme
$app->delete('/api/ogrenci/delete/{ogrenci_id}', function(Request $request, Response $response){
    $ogrenci_id = $request->getAttribute('ogrenci_id');

    $sql = "DELETE  FROM ogrenci WHERE ogrenci_id = $ogrenci_id";
    echo "DELETE  FROM ogrenci WHERE ogrenci_id = $ogrenci_id";

    try{
     // GET DB object
     $db = new db();
     //connect
     $db = $db->connect();
     
     $stmt = $db->prepare($sql);
     $stmt->execute();
     
     echo '{"notice": {"text": "ogrenci silindi"}';
} 
catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMassage().'}';
}

});