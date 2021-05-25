<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizen</title>
    <?php
        require_once "init.php";


        // end POINT : https://enterprise-search-deployment-a4007f.kb.us-west1.gcp.cloud.es.io:9243/
        // Clustor ID : 36a4cf18dd14403489f20a4319869f35


        if(isset($_POST['send'])){


            $name = $_POST['name'];
            $age = $_POST['age'];
            $city = $_POST['city'];
        
            $head = "[
                {
                    'name':'$name',
                    'age':'$age',
                    'city':'$city'
                }
                ]";
        
            // $head = array(
            //     'file' => '@' .realpath('vendor1.json')
            // );

            print_r($head);
            $ch = curl_init();
        
            curl_setopt($ch, CURLOPT_URL, 'https://enterprise-search-deployment-a4007f.ent.us-west1.gcp.cloud.es.io/api/as/v1/engines/vendor/documents');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Authorization: Bearer private-n1roq6tgc8ujj1ijq5wcscqe';
            curl_setopt($ch, CURLOPT_POSTFIELDS, $head);
            curl_setopt($ch, CURLOPT_USERPWD, 'elastic' . ':' . 'KLMF5FcbmCra0vo31LVyBttw');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);
            print_r($result);
        }
print_r($_GET);

        
        if(isset($_GET['Search'])){

            $se = $_GET['Search'];
         
            $params = [
            'body'  => [
                'query' => [
                    'multi_match' => [
                        'regexp' => [
                            'city' =>  '[a-zA-Z]*'.$se.'[a-zA-Z]*'
                        ]
                        ,
                        'regexp' => [
                            'name' =>  '[a-zA-Z]*'.$se.'[a-zA-Z]*'
                        ]        
                    ]
                ]
            ]
        ];


        $params = "{
            'query':$se
        }";

            $ch = curl_init();
        
            curl_setopt($ch, CURLOPT_URL, 'https://enterprise-search-deployment-a4007f.ent.us-west1.gcp.cloud.es.io/api/as/v1/engines/vendor/search.json');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Authorization: Bearer search-ib9qahpun59xib1oqn2z7yny';
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_USERPWD, 'elastic' . ':' . 'KLMF5FcbmCra0vo31LVyBttw');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);
            print_r($result);
        }



// die();


        // $hosts = ['https://enterprise-search-deployment-a4007f.ent.us-west1.gcp.cloud.es.io'];

        // $client = Elasticsearch\ClientBuilder::create()
        // ->setElasticCloudId('VendorElasticProject:dXMtd2VzdDEuZ2NwLmNsb3VkLmVzLmlvJGM4OTgyY2JjODgzMDQ2ZTFhMWNmZDFmZjI0MDNiOTJlJDM2YTRjZjE4ZGQxNDQwMzQ4OWYyMGE0MzE5ODY5ZjM1')
        // ->setBasicAuthentication('elastic', 'KLMF5FcbmCra0vo31LVyBttw')
        // ->setSelector('\Elasticsearch\ConnectionPool\Selectors\RandomSelector')
        // ->setHosts($hosts)
        // ->build();

        

        // $results = NULL;

        // $params = [
        //     'index' => 'IND',
        //     'body' => [
        //         'settings' => [
        //             'number_of_shards' => 3,
        //             'number_of_replicas' => 2
        //         ],
        //         'mappings' => [
        //             '_source' => [
        //                 'enabled' => true
        //             ],
        //             'properties' => [
        //                 'name' => [
        //                     'type' => 'keyword'
        //                 ],
        //                 'age' => [
        //                     'type' => 'integer'
        //                 ]
        //             ]
        //         ]
        //     ]
        // ];
        
        
        // // Create the index with mappings and settings now
        // $response = $client->indices()->create($params);




        //  $response = $client->delete($params);
        // $response = $client->indices()->delete(['index'=>'test']);
        //         die();
        
        
        // $se = "Ab";

        // $params = [
        //     'body'  => [
        //         'query' => [
        //             'multi_match' => [
        //                 'regexp' => [
        //                     'text' =>  '[a-zA-Z]*'.$se.'[a-zA-Z]*'
        //                 ]
        //                 ,
        //                 'regexp' => [
        //                     'name' =>  '[a-zA-Z]*'.$se.'[a-zA-Z]*'
        //                 ]        
        //             ]
        //         ]
        //     ]
        // ];


        

        // $results = $client->search();
        // print_r($results);


        // Create the index
        // $results = $client->indices()->create($params);
        // print_r($results);

        // $params = [
        //     'index' => 'my_index',
        //     'body'  => ['name' => 'Abhi']
        // ];
        
        // $results = $client->index($params);
        // $results = $client->search();
        // print_r($results)

//         if(isset($_POST['import'])){
//             print_r($_POST);
//         }
// // die();
//         if(isset($post['import']) and false){
//             $fp = fopen($_GET['fileName'],"r") or die("Unable to open file!");
//             while(!feof($fp)) {

//                 $dat = null;
//                 $get = fgets($fp);
//                 echo"<br>$get";

//                 echo"<br><br>while<br>";
//                 $i = 0;
//                 if(strpos($get, '{') !== false)
//                 while(strpos($get, '}') === false){
//                         $dat.=$get;
//                         $i++;
//                     $get = fgets($fp);
//                 }

//                 $dat.="}";
//                 $dat = json_decode($dat);
//                 $dat = json_decode(json_encode($dat), true);

//                 if($dat!=null and count($dat)>0){
//                     $params = [
//                         'index'=>'test',
//                         'body'=>[
//                             'name'=> $dat['name'],
//                             'age'=> $dat['age'],
//                             'city'=> $dat['city'],
//                         ]
//                     ];
//                     $response = $client->index($params);    
//                 }
//               }
//               fclose($fp);

//         }

//         if(isset($_GET['Search'])){
//             $se = $_GET['Search'];
//             echo $se;
//             // $params = [
//             //     'index' => 'students',
//             //     'body'  => [
//             //         'query' => [
//             //             'bool' => [
//             //                 'should' => [
//             //                     ['match' => ['name' => $se]],
//             //                     ['match' => ['text' => $se]]
//             //                 ]
//             //             ]
//             //         ]
//             //     ]
//             // ];


//             $params = [
//                 'index' => 'students',
//                 'body'  => [
//                     'query' => [
//                         'multi_match' => [
//                             'regexp' => [
//                                 // 'name' => '\''.$se.'.\''
//                                 // 'name' => '[a-zA-Z]*a*'
//                                 'text' =>  '[a-zA-Z]*'.$se.'[a-zA-Z]*'
//                             ]
//                             ,
//                             'regexp' => [
//                                 // 'name' => '\''.$se.'.\''
//                                 // 'name' => '[a-zA-Z]*a*'
//                                 'name' =>  '[a-zA-Z]*'.$se.'[a-zA-Z]*'
//                             ]        
//                         ]
//                 ]
//                 ]
//             ];

//             $data = [
//                 'index' => 'students',
//                 'body' => [
//                   'query' => [
//                     'bool' => [
//                       'should' => [
//                         ['regexp' => ['name' => ".*".$se.".*"]],
//                         ['regexp' => ['text' => ".*".$se.".*"]],
//                       ]
//                     ]
//                   ]
//                 ]
//               ];



//             // 'name' => '.*'.$se.'.*'

//             // $results = $client->get($params);
//             // $results = $client->search($params);
//             $results = $client->search($data);
//         }


    ?>
</head>
<body>
    <form action="index1.php" method="get" autocomplete="off">
        <label for="text">
            Search For Something
        </label>
        <input type="text" name="Search" id="seach">
        <input type="submit" value="Search">
    </form>

    <form action="index1.php" method="post" autocomplete="off">
        <label for="text">
            Name
        </label>
        <input type="text" name="name" id="fname">
        <label for="text">
            age
        </label>
        <input type="text" name="age" id="fname">
        <label for="text">
            city
        </label>
        <input type="text" name="city" id="fname">
        <input type="submit" value="send" name="send">
    </form>


    <?php

        if(isset($results)){
            foreach($results["hits"]["hits"] as $res){
                print_r($res);
                echo "<br>";
            }
        }
        // echo "<pre>",print_r($results["hits"]["hits"]),"</pre>";

        // if(isset($results))
        // print_r($results["hits"]["hits"]) ;
    ?>
</body>
</html> 