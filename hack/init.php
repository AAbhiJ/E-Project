<?php

require_once 'vendor/autoload.php';


// $es = new Elasticsearch\Client([
//     'hosts'=>['localhost']
// ]);

    $hosts = ['localhost'];


$client = Elasticsearch\ClientBuilder::create()->setHosts($hosts)->build();
?>