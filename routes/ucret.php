<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//Tüm ucretler  getir
$app->get('/api/ucret', function(Request $request, Response $response){
    
   
    
    $sql = "SELECT * FROM ucret";

    try{
     // GET DB object
     $db = new db();
     //connect
     $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->execute();       
        $ucret = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;   
        echo json_encode($ucret);
                      
} 
catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMassage().'}';
}

});
        

  // Get sadece ucret
  $app->get('/api/ucret/{ucret_id}', function(Request $request, Response $response){
    $ucret_id = $request->getAttribute('ucret_id');
    $sql = "SELECT * FROM ucret WHERE ucret_id = $ucret_id";

    try{
        // GET DB object
        $db = new db();
        //connect
        $db = $db->connect();
   
           $stmt = $db->prepare($sql);
           $stmt->execute();       
           $ucret = $stmt->fetchAll(PDO::FETCH_OBJ);
           $db = null;   
           echo json_encode($ucret);
} 
catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMassage().'}';
}

});


    // ucret ekle
    $app->post('/api/ucret/add', function(Request $request, Response $response){
        $tutar = $request->getParam('tutar');
        $taksit = $request->getParam('taksit');
        $odeme_tarihi = $request->getParam('odeme_tarihi');
        $ogrenci_id = $request->getParam('ogrenci_id');
       
        
    
        $sql = "INSERT INTO ucret(tutar,taksit,odeme_tarihi,ogrenci_id) VALUES
        (:tutar,:taksit,:odeme_tarihi,:ogrenci_id)";
    
        try{
         // GET DB object
         $db = new db();
         //connect
         $db = $db->connect();
    
            $stmt = $db->prepare($sql);
    
            $stmt->bindParam(':tutar',      $tutar);
            $stmt->bindParam(':taksit',   $taksit);
            $stmt->bindParam(':odeme_tarihi',  $odeme_tarihi);
            $stmt->bindParam(':ogrenci_id',  $ogrenci_id);
            
         
            $stmt->execute();
            
            echo '{"notice": {"text": "ucret eklendi"}';
    } 
    catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMassage().'}';
    }
    
    });

    // ucret Güncelle
$app->put('/api/ucret/update/{ucret_id}', function(Request $request, Response $response){
    $ucret_id = $request->getAttribute('ucret_id');
    $tutar = $request->getParam('tutar');
    $taksit = $request->getParam('taksit');
    $odeme_tarihi = $request->getParam('odeme_tarihi');
    $ogrenci_id = $request->getParam('ogrenci_id');
 
    

    $sql = "UPDATE ucret SET
                    tutar      = :tutar,
                    taksit   = :taksit,
                    odeme_tarihi  = :odeme_tarihi,
                    ogrenci_id = :ogrenci_id
                   

            WHERE ucret_id = $ucret_id";
    try{
     // GET DB object
     $db = new db();
     //connect
     $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':tutar',      $tutar);
        $stmt->bindParam(':taksit',   $taksit);
        $stmt->bindParam(':odeme_tarihi',  $odeme_tarihi);
        $stmt->bindParam(':ogrenci_id',  $ogrenci_id);
       
     
        $stmt->execute();

        echo '{"notice": {"text": "ucret güncellendi"}';



} 
catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMassage().'}';
}

});

// ucret silme
$app->delete('/api/ucret/delete/{ucret_id}', function(Request $request, Response $response){
    $ucret_id = $request->getAttribute('ucret_id');

    $sql = "DELETE  FROM ucret WHERE ucret_id = $ucret_id";
    echo "DELETE  FROM ucret WHERE ucret_id = $ucret_id";

    try{
     // GET DB object
     $db = new db();
     //connect
     $db = $db->connect();
     
     $stmt = $db->prepare($sql);
     $stmt->execute();
     
     echo '{"notice": {"text": "ucret silindi"}';
} 
catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMassage().'}';
}

});