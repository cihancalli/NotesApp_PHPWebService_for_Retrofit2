<?php
    // array for JSON response
    $response = array();
    
    //DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE değişkenleri alınır.
    require_once __DIR__ . '/db_config.php';
    
    // Bağlantı oluşturuluyor.
    $baglanti = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
    
    // Bağlanti kontrolü yapılır.
    if (!$baglanti) {
        die("Faulty connection : " . mysqli_connect_error());
    }
    
    $sqlsorgu = "SELECT * FROM notes";
    $result = mysqli_query($baglanti, $sqlsorgu);
    
    // result kontrolü yap
    if (mysqli_num_rows($result) > 0) {
        
        $response["notes"] = array();
        
        while ($row = mysqli_fetch_assoc($result)) {
            // temp user array
            $notlar = array();
            
            $notlar["note_id"] = $row["note_id"];
            $notlar["lesson_name"] = $row["lesson_name"];
            $notlar["note1"] = $row["note1"];
            $notlar["note2"] = $row["note2"];
            
            // push single product into final response array
            array_push($response["notes"], $notlar);
        }
        // success
        $response["success"] = 1;
        
        // echoing JSON response
        echo json_encode($response);
        
    } else {
        // no products found
        $response["success"] = 0;
        $response["message"] = "No data found";
        
        // echo no users JSON
        echo json_encode($response);
    }
    //bağlantı koparılır.
    mysqli_close($baglanti);
    ?>
