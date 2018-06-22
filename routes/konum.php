<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//Tüm konumları  getir
$app->get('/api/konum', function(Request $request, Response $response){
    
        $sql = "SELECT * FROM konum";
    
        try{
         // GET DB object
         $db = new db();
         //connect
         $db = $db->connect();
    
        
         $stmt = $db->prepare($sql);
         $stmt->execute();       
         $konum  = $stmt->fetchAll(PDO::FETCH_OBJ);
         $db = null;   
         echo json_encode($konum);
} 
    catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMassage().'}';
}
    
});

  // Get sadece konum
  $app->get('/api/konum/{konum_id}', function(Request $request, Response $response){
    $konum_id = $request->getAttribute('konum_id');
    $sql = "SELECT * FROM konum WHERE konum_id = $konum_id";

    try{
     // GET DB object
     $db = new db();
     //connect
     $db = $db->connect();

     $stmt = $db->prepare($sql);
     $stmt->execute();       
     $konum = $stmt->fetchAll(PDO::FETCH_OBJ);
     $db = null;   
     echo json_encode($konum);
} 
catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMassage().'}';
}

});


    // konum ekle
    $app->post('/api/konum/add', function(Request $request, Response $response){
        $adsoyad = $request->getParam('adsoyad');
        $telefon = $request->getParam('telefon');
        $konum = $request->getParam('konum');
        $ogrenci_id = $request->getParam('ogrenci_id');
        $servis_id = $request->getParam('servis_id');
       
        
    
        $sql = "INSERT INTO konum(adsoyad,telefon,konum,ogrenci_id,servis_id) VALUES
        (:adsoyad,:telefon,:konum,:ogrenci_id,:servis_id)";
    
        try{
         // GET DB object
         $db = new db();
         //connect
         $db = $db->connect();
    
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':adsoyad',      $adsoyad);
            $stmt->bindParam(':telefon',      $telefon);
            $stmt->bindParam(':konum',      $konum);
            $stmt->bindParam(':ogrenci_id',   $ogrenci_id);
            $stmt->bindParam(':servis_id',  $servis_id);
            
         
            $stmt->execute();
            
            echo '{"notice": {"text": "konum eklendi"}';
    } 
    catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMassage().'}';
    }
    
    });

    // konum Güncelle
$app->put('/api/konum/update/{konum_id}', function(Request $request, Response $response){
    $konum_id = $request->getAttribute('konum_id');
    $adsoyad = $request->getParam('adsoyad');
    $telefon = $request->getParam('telefon');
    $konum = $request->getParam('konum');
    $ogrenci_id = $request->getParam('ogrenci_id');
    $servis_id = $request->getParam('servis_id');
 
    

    $sql = "UPDATE konum SET
                    adsoyad       = :adsoyad,
                    telefon       = :telefon,
                    konum         = :konum,
                    ogrenci_id    = :ogrenci_id,
                    servis_id     = :servis_id
                   

            WHERE konum_id = $konum_id";
    try{
     // GET DB object
     $db = new db();
     //connect
     $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':adsoyad',      $adsoyad);
        $stmt->bindParam(':telefon',      $telefon);
        $stmt->bindParam(':konum',        $konum);
        $stmt->bindParam(':ogrenci_id',   $ogrenci_id);
        $stmt->bindParam(':servis_id',    $servis_id);
       
     
        $stmt->execute();

        echo '{"notice": {"text": "konum güncellendi"}';



} 
catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMassage().'}';
}

});

// konum silme
$app->delete('/api/konum/delete/{konum_id}', function(Request $request, Response $response){
    $konum_id = $request->getAttribute('konum_id');

    $sql = "DELETE  FROM konum WHERE konum_id = $konum_id";
    echo "DELETE  FROM konum WHERE konum_id = $konum_id";

    try{
     // GET DB object
     $db = new db();
     //connect
     $db = $db->connect();
     
     $stmt = $db->prepare($sql);
     $stmt->execute();
     
     echo '{"notice": {"text": "konum silindi"}';
} 
catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMassage().'}';
}

});