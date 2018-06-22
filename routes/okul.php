<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//Tüm okulları  getir
$app->get('/api/okul', function(Request $request, Response $response){
    
        $sql = "SELECT * FROM okul";
    
        try{
         // GET DB object
         $db = new db();
         //connect
         $db = $db->connect();
    
        
         $stmt = $db->prepare($sql);
         $stmt->execute();       
         $okul = $stmt->fetchAll(PDO::FETCH_OBJ);
         $db = null;   
         echo json_encode($okul);
} 
    catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMassage().'}';
}
    
});

  // Get sadece okul
  $app->get('/api/okul/{okul_id}', function(Request $request, Response $response){
    $okul_id = $request->getAttribute('okul_id');
    $sql = "SELECT * FROM okul WHERE okul_id = $okul_id";

    try{
     // GET DB object
     $db = new db();
     //connect
     $db = $db->connect();

     $stmt = $db->prepare($sql);
     $stmt->execute();       
     $okul = $stmt->fetchAll(PDO::FETCH_OBJ);
     $db = null;   
     echo json_encode($okul);
} 
catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMassage().'}';
}

});


    // okul ekle
    $app->post('/api/okul/add', function(Request $request, Response $response){
        $adi = $request->getParam('adi');
        $adres = $request->getParam('adres');
        $telefon = $request->getParam('telefon');
       
        
    
        $sql = "INSERT INTO okul(adi,adres,telefon) VALUES
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
            
            echo '{"notice": {"text": "okul eklendi"}';
    } 
    catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMassage().'}';
    }
    
    });

    // okul Güncelle
$app->put('/api/okul/update/{okul_id}', function(Request $request, Response $response){
    $okul_id = $request->getAttribute('okul_id');
    $adi = $request->getParam('adi');
    $adres = $request->getParam('adres');
    $telefon = $request->getParam('telefon');
 
    

    $sql = "UPDATE okul SET
                    adi      = :adi,
                    adres   = :adres,
                    telefon  = :telefon
                   

            WHERE okul_id = $okul_id";
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

        echo '{"notice": {"text": "okul güncellendi"}';



} 
catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMassage().'}';
}

});

// okul silme
$app->delete('/api/okul/delete/{okul_id}', function(Request $request, Response $response){
    $okul_id = $request->getAttribute('okul_id');

    $sql = "DELETE  FROM okul WHERE okul_id = $okul_id";
    echo "DELETE  FROM okul WHERE okul_id = $okul_id";

    try{
     // GET DB object
     $db = new db();
     //connect
     $db = $db->connect();
     
     $stmt = $db->prepare($sql);
     $stmt->execute();
     
     echo '{"notice": {"text": "okul silindi"}';
} 
catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMassage().'}';
}

});