<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


//Tüm Servis sahiplerini getir
$app->get('/api/servis', function(Request $request, Response $response){
    
        $sql = "SELECT * FROM servis";
    
        try{
         // GET DB object
         $db = new db();
         //connect
         $db = $db->connect();
    
         $stmt = $db->prepare($sql);
         $stmt->execute();       
         $servis = $stmt->fetchAll(PDO::FETCH_OBJ);
         $db = null;   
         echo json_encode($servis);
} 
    catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMassage().'}';
}
    
});

    // Get sadece servis
$app->get('/api/servis/{servis_id}', function(Request $request, Response $response){
    $servis_id = $request->getAttribute('servis_id');
    $sql = "SELECT * FROM servis WHERE servis_id = $servis_id";

    try{
     // GET DB object
     $db = new db();
     //connect
     $db = $db->connect();

     $stmt = $db->prepare($sql);
     $stmt->execute();       
     $servis = $stmt->fetchAll(PDO::FETCH_OBJ);
     $db = null;   
     echo json_encode($servis);
} 
catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMassage().'}';
}

});

    //servis ekle
$app->post('/api/servis/add', function(Request $request, Response $response){
    $adi = $request->getParam('adi');
    $soyadi = $request->getParam('soyadi');
    $telefon = $request->getParam('telefon');
    $eposta = $request->getParam('eposta');
    $sifre = $request->getParam('sifre');
    $tc = $request->getParam('tc');
    $plaka = $request->getParam('plaka');   
    $firma_id = $request->getParam('firma_id');
    $foto = $request->getParam('foto');

    
    $sql = "INSERT INTO servis(adi,soyadi,telefon,eposta,sifre,tc,plaka,firma_id,foto) VALUES
    (:adi,:soyadi,:telefon,:eposta,:sifre,:tc,:plaka,:firma_id,:foto)";

    try{
        // GET DB object
        $db = new db();
        //connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':adi',      $adi);
        $stmt->bindParam(':soyadi',   $soyadi);
        $stmt->bindParam(':telefon',  $telefon);
        $stmt->bindParam(':eposta',   $eposta);
        $stmt->bindParam(':sifre',    $sifre);
        $stmt->bindParam(':tc',       $tc);
        $stmt->bindParam(':plaka',    $plaka);       
        $stmt->bindParam(':firma_id', $firma_id);
        $stmt->bindParam(':foto',     $foto);
        
        
        $stmt->execute();
        
        echo '{"notice": {"text": "servis eklendi"}';
        } 
        catch(PDOException $e){
            echo '{"error": {"text": '.$e->getMassage().'}';
        }
        
        });

// servis Güncelle
$app->put('/api/servis/update/{servis_id}', function(Request $request, Response $response){
    $servis_id = $request->getAttribute('servis_id');
    $adi = $request->getParam('adi');
    $soyadi = $request->getParam('soyadi');
    $telefon = $request->getParam('telefon');
    $eposta = $request->getParam('eposta');
    $sifre = $request->getParam('sifre');
    $tc = $request->getParam('tc');
    $plaka = $request->getParam('plaka');
    $firma_id = $request->getParam('firma_id');
    $foto = $request->getParam('foto');
    
    

    $sql = "UPDATE servis SET
                    adi      = :adi,
                    soyadi   = :soyadi,
                    telefon  = :telefon,
                    eposta   = :eposta,
                    sifre    = :sifre,
                    tc       = :tc,
                    plaka    = :plaka,
                    firma_id = :firma_id,
                    foto = :foto

                    

            WHERE servis_id = $servis_id";
    try{
     // GET DB object
     $db = new db();
     //connect
     $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':adi',      $adi);
        $stmt->bindParam(':soyadi',   $soyadi);
        $stmt->bindParam(':telefon',  $telefon);
        $stmt->bindParam(':eposta',   $eposta);
        $stmt->bindParam(':sifre',    $sifre);
        $stmt->bindParam(':tc',       $tc);
        $stmt->bindParam(':plaka',    $plaka);
        $stmt->bindParam(':firma_id', $firma_id);
        $stmt->bindParam(':foto',    $foto);
        
     
        $stmt->execute();

        echo '{"notice": {"text": "servis güncellendi"}';



} 
catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMassage().'}';
}

});

// servis silme
$app->delete('/api/servis/delete/{servis_id}', function(Request $request, Response $response){
    $servis_id = $request->getAttribute('servis_id');

    $sql = "DELETE  FROM servis WHERE servis_id = $servis_id";
    echo "DELETE  FROM servis WHERE servis_id = $servis_id";

    try{
     // GET DB object
     $db = new db();
     //connect
     $db = $db->connect();
     
     $stmt = $db->prepare($sql);
     $stmt->execute();
     
     echo '{"notice": {"text": "servis silindi"}';
} 
catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMassage().'}';
}

});
    