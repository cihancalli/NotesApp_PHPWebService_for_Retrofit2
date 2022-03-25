<?php
    
    $response = array();
    
    if (isset($_POST['lesson_name']) && isset($_POST['note1']) && isset($_POST['note2'])) {
        $ders_adi = $_POST['lesson_name'];
        $not1 = $_POST['note1'];
        $not2 = $_POST['note2'];
        
        //DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE değişkenleri alınır.
        require_once __DIR__ . '/db_config.php';
        
        // Bağlantı oluşturuluyor.
        $baglanti = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
        
        // Bağlanti kontrolü yapılır.
        if (!$baglanti) {
            die("Faulty connection : " . mysqli_connect_error());
        }
        
        $sqlsorgu = "INSERT INTO notes (lesson_name,note1,note2) VALUES ('$lesson_name',$note1,$note2)";
        
        
        if (mysqli_query($baglanti, $sqlsorgu)) {
            
            $response["success"] = 1;
            $response["message"] = "successfully ";
            
            echo json_encode($response);
        } else {
            
            $response["success"] = 0;
            $response["message"] = "No product found";
            
            echo json_encode($response);
        }
        //bağlantı koparılır.
        mysqli_close($baglanti);
    } else {
        
        $response["success"] = 0;
        $response["message"] = "Required field(s) is missing";
        
        echo json_encode($response);
    }
    ?>



