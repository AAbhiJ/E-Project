<?php

if(isset($_POST['send'])){


    $name = $_POST['name'];
    $age = $_POST['age'];
    $city = $_POST['city'];

    $head = "[
        {
            'name':$name,
            'age':$age,
            'city':$city,
        }
        ]"


    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://enterprise-search-deployment-a4007f.ent.us-west1.gcp.cloud.es.io/api/as/v1/engines/vendor/documents');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: Bearer private-n1roq6tgc8ujj1ijq5wcscqe';
    curl_setopt($ch, CURLOPT_POSTFIELDS, );
    curl_setopt($ch, CURLOPT_USERPWD, 'elastic' . ':' . 'KLMF5FcbmCra0vo31LVyBttw');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
}


?>