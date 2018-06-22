<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//Tüm firmaları  getir
$app->get('/api/firma', function(Request $request, Response $response){
    
        $sql = "SELECT * FROM firma";
    
        try{
         // GET DB object
         $db = new db();
         //connect
         $db = $db->connect();
    
         $stmt = $db->prepare($sql);
         $stmt->execute();       
         $firma = $stmt->fetchAll(PDO::FETCH_OBJ);
         $db = null;   
         echo json_encode($firma);
} 
    catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMassage().'}';
}
    
});

  // Get sadece firma
  $app->get('/api/firma/{firma_id}', function(Request $request, Response $response){
    $firma_id = $request->getAttribute('firma_id');
    $sql = "SELECT * FROM firma WHERE firma_id = $firma_id";

    try{
     // GET DB object
     $db = new db();
     //connect
     $db = $db->connect();
     $stmt = $db->prepare($sql);
     $stmt->execute();       
     $firma = $stmt->fetchAll(PDO::FETCH_OBJ);
     $db = null;   
     echo json_encode($firma);
     
} 
catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMassage().'}';
}

});


    // firma ekle
    $app->post('/api/firma/add', function(Request $request, Response $response){
        $adi = $request->getParam('adi');
        $adres = $request->getParam('adres');
        $telefon = $request->getParam('telefon');
       
        
    
        $sql = "INSERT INTO firma(adi,adres,telefon) VALUES
        (:adi,:adres,:telefon)";
    
        try{
         // GET DB object
         $db = new db();
         //connect
         $db = $db->connect();
    
            $stmt = $db->prepare($sql);
    
            $stmt->bindParam(':adi',      $adi);
            $stmt->bindParam(':adres',   $adres);
            $stmt->bindParam(':telefon',  $telefon);
            
         
            $stmt->execute();
            
            echo '{"notice": {"text": "firma eklendi"}';
    } 
    catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMassage().'}';
    }
    
    });

    // firma Güncelle
$app->put('/api/firma/update/{firma_id}', function(Request $request, Response $response){
    $firma_id = $request->getAttribute('firma_id');
    $adi = $request->getParam('adi');
    $adres = $request->getParam('adres');
    $telefon = $request->getParam('telefon');
 
    

    $sql = "UPDATE firma SET
                    adi      = :adi,
                    adres   = :adres,
                    telefon  = :telefon
                   

            WHERE firma_id = $firma_id";
    try{
     // GET DB object
     $db = new db();
     //connect
     $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':adi',      $adi);
        $stmt->bindParam(':adres',   $adres);
        $stmt->bindParam(':telefon',  $telefon);
       
     
        $stmt->execute();

        echo '{"notice": {"text": "firma güncellendi"}';



} 
catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMassage().'}';
}

});

// firma silme
$app->delete('/api/firma/delete/{firma_id}', function(Request $request, Response $response){
    $firma_id = $request->getAttribute('firma_id');

    $sql = "DELETE  FROM firma WHERE firma_id = $firma_id";
    echo "DELETE  FROM firma WHERE firma_id = $firma_id";

    try{
     // GET DB object
     $db = new db();
     //connect
     $db = $db->connect();
     
     $stmt = $db->prepare($sql);
     $stmt->execute();
     
     echo '{"notice": {"text": "firma silindi"}';
} 
catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMassage().'}';
}

});
    